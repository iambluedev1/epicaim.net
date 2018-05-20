<?php 
namespace App\Controller;

use Core\Controller;
use Session\Session;
use Usage\Arr;
use Web\Request;
use Usage\Validate;
use Security\Password;
use Usage\Geolocation;
use \DateTime;
use Usage\Number;
use Usage\Browser;

use Events\Api\RedeemConfirmationEvent;
use Events\User\UserChangePasswordEvent;
use Events\User\UserConfirmedEvent;
use Events\User\UserCreateAccountEvent;
use Events\User\UserNewPasswordEvent;

class UserController extends Controller{

	public function __construct(){
		parent::__construct();
		$this->loadModel(["User", "Logs", "Token"]);
    	}

	public function login(){
		if($this->session->readUser("token") != null){
			$this->url->redirect("/");
			return;
		}
		$this->view->set(["title" => $this->translate->element("view", "login", "title")]);
		$this->view->js(["js/login.js"]);
		$this->view->css(["css/login.css"]);
		$this->view->render(["folder" => "user", "file" => "login"]);
	}

	public function lostpassword(){
		if($this->session->readUser("token") != null){
			$this->url->redirect("/");
			return;
		}
		$this->view->set(["title" => $this->translate->element("view", "lost_password", "title")]);
		$this->view->js(["js/lostpassword.js"]);
		$this->view->css(["css/lostpassword.css"]);
		$this->view->render(["folder" => "user", "file" => "lostpassword"]);
	}
	
	public function register(){
		if($this->session->readUser("token") != null){
			$this->url->redirect("/");
			return;
		}
		$this->view->set(["title" => $this->translate->element("view", "register", "title")]);
		$this->view->js(["js/register.js"]);
		$this->view->css(["css/register.css"]);
		$this->view->render(["folder" => "user", "file" => "register"]);
	}

	public function logout(){
		if($this->session->readUser("token") == null){
			$this->url->redirect("login");
			return;
		}
		$this->loadModel("Online");
		$this->Online->logout($this->session->readUser("id"));
		$this->session->destroy("user");
		$this->url->redirect("login");
		exit();
	}
	
	public function account(){
		if($this->session->readUser("token") == null){
			$this->url->redirect("login");
			return;
		}
		$this->view->set([
			"title" => $this->translate->element("view", "account", "title"), 
			"newsletter" => $this->User->isNewsletterActivated($this->session->readUser("id"), "userId")
		]);
		$this->view->js(["js/account.js"]);
		$this->view->render(["folder" => "user", "file" => "account"]);
	}
	
	public function logs(){
		if($this->session->readUser("token") == null){
			$this->url->redirect("login");
			return;
		}

		$logs = $this->Logs->getLogs($this->session->readUser("id"));

		$this->view->set(["title" => $this->translate->element("view", "logs", "sub_title"), "logs" => $logs]);
		$this->view->js(["https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js", "https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js", "js/logs.js"]);
		$this->view->css(["https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css", "css/logs.css"]);
		$this->view->render(["folder" => "user", "file" => "logs"]);
	}

	public function tokens(){
		if($this->session->readUser("token") == null){
			$this->url->redirect("login");
			return;
		}

		$logs = $this->Token->getActiveLogs($this->session->readUser("email"));

		$this->view->set(["title" => $this->translate->element("view", "tokens", "sub_title"), "logs" => $logs]);
		$this->view->js(["https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js", "https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js", "js/tokens.js"]);
		$this->view->css(["https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css", "css/logs.css"]);
		$this->view->render(["folder" => "user", "file" => "tokens"]);
	}

	public function ajax_account_login(){
		$this->view->addHeaders(["Content-Type: application/json", "Access-Control-Allow-Origin: *", "Access-Control-Allow-Headers: token"]);
		$this->view->sendHeaders();
		if(Request::isPost()){
		    $tmp = array(
				"input_login" => Request::post("login"),
				"input_password" => Request::post("password"),
				"input_checkbox" => Request::post("checkbox")
		    );
	
		    $errors = "";
	
		    foreach($tmp as $input_name => $input_value){
				if($input_value == "" && $input_name != "input_checkbox") {
					$errors .= str_replace("input_", "", $input_name) .", ";
				}
		    }
	
		    $field = (Validate::validateEmail($tmp["input_login"])) ? "userEmail" : "userName";
	
		    if(!$this->User->isRegistered($tmp["input_login"], $field) && $tmp["input_login"] != ""){
				$errors .= (
					($field == "userName") ? 
						$this->translate->element("controller", "login", "username_not_in_use") : 
							$this->translate->element("controller", "login", "email_not_in_use")
					) . "<br>";
		    }else{
				if(!Password::verify($tmp["input_password"], $this->User->getPassword($tmp["input_login"], $field))){
					$errors .= $this->translate->element("controller", "login", "bad_password") . "<br>";
				}
		    }
	
		    if($errors != ""){
				$data["result"]["error"] = $this->translate->element("controller", "login", "action") . "<br>" . $errors;
		    }else{
			if($this->User->getState($tmp["input_login"], $field) != 1){
			    $data["result"]["error"] = $this->translate->element("controller", "login", "no_confirmed");
			}else {
			    $geo = new Geolocation();
			    $token = $this->User->getToken($tmp["input_login"], $field);
			    $user_data = $this->User->getDatas($token);
			    $data["result"]["token"] = $token;
			    $data["result"]["msg"] = $this->translate->element("controller", "login", "success");
			    $this->session->writeUser("token", $token);
			    $this->session->writeUser("id", $user_data->userId);
			    $this->session->writeUser("username", $user_data->userName);
			    $this->session->writeUser("email", $user_data->userEmail);
			    $this->session->writeUser("register", $user_data->registeredAt);
			    $this->session->writeUser("is_admin", $user_data->is_admin);
			    $this->session->writeUser("is_vip", $user_data->is_vip);
			   	$this->Logs->newLog(array(
					"user_id" => $user_data->userId,
					"ip" => $geo->getIp(),
					"mail" => $user_data->userEmail,
					"city" => $geo->getCity(),
					"region" => $geo->getRegion(),
					"country_code" => $geo->getCountryCode(),
					"country_name" => $geo->getCountryName(),
					"continent_code" => $geo->getContinentCode(),
					"browser" => serialize(Browser::get())
			    ));
			}
		    }
		}else{
		    $data["result"]["error"] = $this->translate->element("controller", "not_allowed");
		}
		echo json_encode(Arr::merge($data, ["version" => "1.0.0"]));
	    }

	public function ajax_account_create(){
		$this->view->addHeaders(["Content-Type: application/json", "Access-Control-Allow-Origin: *", "Access-Control-Allow-Headers: token"]);
		$this->view->sendHeaders();
		if(Request::isPost()){
			$tmp = array(
				"input_login" => Request::post("login"),
				"input_email" => Request::post("email"),
				"input_password" => Request::post("password"),
				"input_rpassword" => Request::post("rpassword"),
				"newsletter" => Request::post("newsletter")
			);

			$errors = "";

			foreach ($tmp as $input_name => $input_value) {
				if ($input_value == "" && $input_name != "newsletter") {
					$errors .= str_replace("input_", "", $input_name) . ", ";
				}
			}

			if (strlen($tmp["input_login"]) < 3 && $tmp["input_login"] != "") {
				$errors .= $this->translate->element("controller", "register", "username_too_short") . "<br>";
			} else {
				if ($this->User->isRegistered($tmp["input_login"])) {
					$errors .= $this->translate->element("controller", "register", "username_in_use") . "<br>";
				}
			}

			if (!Validate::validateEmail($tmp["input_email"]) && $tmp["input_email"] != "") {
				$errors .= $this->translate->element("controller", "register", "bad_email") . "<br>";
			} else {
				if ($this->User->isRegistered($tmp['input_email'], "userEmail") && $tmp["input_email"] != "") {
					$errors .= $this->translate->element("controller", "register", "email_in_use") . "<br>";
				}
			}
			if (strlen($tmp["input_password"]) < 5 && $tmp["input_password"] != "") {
				$errors .= $this->translate->element("controller", "register", "password_too_short") . "<br>";
			} else if ($tmp["input_password"] != $tmp["input_rpassword"]) {
				$errors .= $this->translate->element("controller", "register", "bad_password") . "<br>";
			}

			if($errors != ""){
				$data["result"]["error"] = $this->translate->element("controller", "register", "action") . "<br>" . $errors;
			}else{
				$geo = new Geolocation();
				if ($this->User->isRegistered($geo->getIp(), "ip")) {
					$data["result"]["error"] = $this->translate->element("controller", "register", "ip_in_use") . "<br>";
				} else {
					$tmp = Arr::merge($tmp, array(
						"token" => md5(microtime().rand()),
						"register" => time(),
						"ip" => $geo->getIp()
					));
					$result = $this->User->newMember($tmp);
	
					if($result){
						$user = $this->User->getDatas($tmp["token"]);
						$data["result"]["success"] = $this->translate->element("controller", "register", "success");
	
						if($tmp["newsletter"] == "on"){
							$this->User->update("newsletter", 1, $user->userId);
						}
	
						$this->rcms->events->raise(new UserCreateAccountEvent($tmp["input_login"], $user->userId, $tmp["token"], $tmp["input_email"]));
					   }else{
						$data["result"]["error"] = $this->translate->element("controller", "error");
					}
				}
			}
		}else{
			$data["result"]["error"] = $this->translate->element("controller", "not_allowed");
		}
		echo json_encode(Arr::merge($data, ["version" => "1.0.0"]));
	}

	public function ajax_confirm_redeem(){
		$this->view->addHeaders(["Content-Type: application/json", "Access-Control-Allow-Origin: *"]);
		$this->view->sendHeaders();
		if(Request::isPost()){
		    $tmp = array(
			"input_login" => Request::post("login"),
			"input_password" => Request::post("password")
		    );
	
		    $errors = "";
	
		    foreach ($tmp as $input_name => $input_value) {
			if ($input_value == "" && $input_name != "input_checkbox") {
			    $errors .= str_replace("input_", "", $input_name) . ", ";
			}
		    }
	
		    if(!$this->User->isRegistered($tmp["input_login"]) && $tmp["input_login"] != ""){
			$errors .= $this->translate->element("controller", "confirm_redeem", "username_not_in_use") . "<br>";
		    }else{
			if(!Password::verify($tmp["input_password"], $this->User->getPassword($tmp["input_login"]))){
			    $errors .= $this->translate->element("controller", "confirm_redeem", "bad_password") . "<br>";
			}
		    }
	
		    if($errors != ""){
			$data["result"]["error"] = $this->translate->element("controller", "confirm_redeem", "action") . "<br>" . $errors;
		    }else{
			if($this->User->getState($tmp["input_login"]) == 1){
			    $data["result"]["error"] = $this->translate->element("controller", "confirm_redeem", "already_confirmed");
			}else{
			    $data["result"]["success"] = $this->translate->element("controller", "confirm_redeem", "success");
				$token = $this->User->getToken($tmp["input_login"]);
				$user = $this->User->getDatas($token);
			    $this->rcms->events->raise(new RedeemConfirmationEvent($tmp["input_login"], $user->userId, $token, $user->userEmail));
			}
		    }
		}else{
		    $data["result"]["error"] = $this->translate->element("controller", "not_allowed");
		}
		echo json_encode(Arr::merge($data, ["version" => "1.0.0"]));
	    }


	public function confirm_account(string $token, string $email, int $id){
		$errors = "";
		$user = null;
	
		if($id == null){
		    $errors .= $this->translate->element("controller", "confirm_account", "bad_url") . "<br>";
		}
	
		if(strlen($token) != 32 || $token == ""){
		    $errors .= $this->translate->element("controller", "confirm_account", "bad_url") . "<br>";
		}else{
		    $user = $this->User->getDatas($token);
	
		    if($user == null){
			$errors .= $this->translate->element("controller", "confirm_account", "bad_url") . "<br>";
		    }else{
			if($user->userId != $id && $id != null){
			    $errors .= $this->translate->element("controller", "confirm_account", "bad_url") . "<br>";
			}else{
			    if($user->userState == 1){
				$errors .= $this->translate->element("controller", "confirm_account", "already_registered") . "<br>";
			    }
			}
		    }
		}
	
		if(strlen($email) != 32 || $email == ""){
		    $errors .= $this->translate->element("controller", "confirm_account", "bad_url") . "<br>";
		}else{
		    if(md5($user->userEmail) != $email && $email != ""){
			$errors .= $this->translate->element("controller", "confirm_account", "bad_url") . "<br>";
		    }
		}
	
		if($errors != ""){
		    $this->flash->add("error", $errors);
		}else{
			$this->flash->add("success", $this->translate->element("controller", "confirm_account", "success"));
			$this->User->setConfirmed($id);
			$this->rcms->events->raise(new UserConfirmedEvent($user->userName, $user->userEmail));
		}
	
		$this->url->redirect("login");
	}

	public function ajax_account_update(){
		$this->view->addHeaders(["Content-Type: application/json", "Access-Control-Allow-Origin: *", "Access-Control-Allow-Headers: token"]);
		$this->view->sendHeaders();
		$data = null;
		if($this->session->readUser("token") == ""){
		    $data["result"]["error"] = $this->translate->element("controller", "account_update", "connected");
		}else{
		    if(Request::isPost()){
			$tmp = array(
				"confirm_password" => Request::post("confirm_password"),
			    "new_password" => Request::post("new_password"),
			    "new_confirm_password" => Request::post("new_confirm_password"),
				"change_password" => Request::post("change_password"),
				"newsletter" => Request::post("newsletter"),
				"newsletter_test" => Request::post("newsletter_mode"),
			);
	
			$errors = "";
			$custom_output = "";
	
			$id = $this->session->readUser("id");
			$modification = false;
	
			if($tmp["change_password"]){
			    if($tmp["confirm_password"] != "" && $tmp["new_password"] != "" && $tmp["new_confirm_password"] != ""){
					if($tmp["new_password"] == $tmp["new_confirm_password"]){
						if($tmp["confirm_password"] != $tmp["new_password"]){
							if(!Password::verify($tmp["confirm_password"], $this->User->getPassword($this->session->readUser("username")))){
								$errors .= $this->translate->element("controller", "account_update", "bad_actual_password");
							}else{
								$this->User->changePassword($tmp["new_password"], $id);
								$this->rcms->events->raise(new UserChangePasswordEvent($this->session->readUser("username"), $this->session->readUser("email")));
								$modification = true;
							}
						}else{
							$errors .= $this->translate->element("controller", "account_update", "same_password");
						}
					}else{
						$errors .= $this->translate->element("controller", "account_update", "bad_password");
					}
			    }else{
				$errors .= $this->translate->element("controller", "account_update", "empty_fields");
			    }
			}

			if($tmp["newsletter_test"]){
				$newsletter = $this->User->isNewsletterActivated($this->session->readUser("id"), "userId");
				$action = ($tmp["newsletter"] == "on") ? true : false;
				if($action != $newsletter){
					if($action){
						$this->User->update("newsletter", 1, $this->session->readUser("id"));
						$modification = true;
					}else{
						$this->User->update("newsletter", 0, $this->session->readUser("id"));
						$modification = true;
					}
				}
			}
	
	
			if($errors != ""){
			    $data["result"]["error"] = $errors;
			}else{
			    if($modification){
				$data["result"]["success"] = ($custom_output != "") ? $custom_output : $this->translate->element("controller", "account_update", "success");
			    }else{
				$data["result"]["success"] = $this->translate->element("controller", "account_update", "no_modification");
			    }
			}
		    }else{
			$data["result"]["error"] = $this->translate->element("controller", "not_allowed");
		    }
		}
		echo json_encode(Arr::merge($data, ["version" => "1.0.0"]));
	}

	public function ajax_lost_password(){
		$this->view->addHeaders(["Content-Type: application/json", "Access-Control-Allow-Origin: *"]);
		$this->view->sendHeaders();
		if(Request::isPost()){
		    $tmp = array(
				"input_username" => Request::post("username"),
				"input_email" => Request::post("email"),
		    );
	
		    $errors = "";
	
			foreach ($tmp as $input_name => $input_value) {
				if ($input_value == "") {
					$errors .= str_replace("input_", "", $input_name) . ", ";
				}
			}

			if (!$this->User->isRegistered($tmp["input_username"]) && $tmp["input_username"] != "") {
				$errors .= $this->translate->element("controller", "lost_password", "username_not_in_use") . "<br>";
			}

			if (!Validate::validateEmail($tmp["input_email"]) && $tmp["input_email"] != "") {
				$errors .= $this->translate->element("controller", "lost_password", "bad_email") . "<br>";
			} else {
				if (!$this->User->isRegistered($tmp['input_email'], "userEmail") && $tmp["input_email"] != "") {
					$errors .= $this->translate->element("controller", "lost_password", "email_not_in_use") . "<br>";
				}
			}


		    if($errors != ""){
				$data["result"]["error"] = $this->translate->element("controller", "lost_password", "action") . "<br>" . $errors;
		    }else{
				$token = $this->User->getToken($tmp["input_username"]);
				$user = $this->User->getDatas($token);
				
				$password = Number::createkey(10);
				$this->User->changePassword($password, $user->userId);

				$this->rcms->events->raise(new UserNewPasswordEvent($user->userName, $user->userEmail, $password));

				$data["result"]["success"] = $this->translate->element("controller", "lost_password", "success");
		    }
		}else{
		    $data["result"]["error"] = $this->translate->element("controller", "not_allowed");
		}
		echo json_encode(Arr::merge($data, ["version" => "1.0.0"]));
	}
}