<?php 
namespace App\Controller;

use Core\Controller;
use Usage\Arr;
use Web\Request;
use Usage\Geolocation;

class TokenController extends Controller{

	public function __construct(){
		parent::__construct();
		$this->loadModel(["Token", "User"]);
    }

	public function index(){
		if($this->session->readUser("token") == null){
			$this->url->redirect("login");
			return;
		}
		$this->view->set(["title" => $this->translate->element("view", "title")]);
		$this->view->js(["js/token.js"]);
		$this->view->js(["css/token.css"]);
		$this->view->render(["folder" => "token", "file" => "index"]);
	}

	public function ajax_token(){
		$this->view->addHeaders(["Content-Type: application/json", "Access-Control-Allow-Origin: *"]);
		$this->view->sendHeaders();
		if(Request::isPost()){
		    $tmp = array(
				"input_token" => Request::post("token")
		    );
	
		    $errors = "";
	
		    if($tmp["input_token"] == ""){
					$errors .= $this->translate->element("controller", "error_1");
		    } else {
				if(!$this->Token->tokenExist($tmp["input_token"])){
					$errors .= $this->translate->element("controller", "error_2");
				} else {
					if(!$this->Token->isActivated($tmp["input_token"])){
						$errors .= $this->translate->element("controller", "error_3");
					}
				}
			}
	
		    if($errors != ""){
				$data["result"]["error"] = $errors;
		    }else{
				$data["result"]["success"] = $this->translate->element("controller", "success");
				$datas = $this->Token->getToken($tmp["input_token"]);

				$this->Token->desactivate($datas->id);

				$newDay = ($this->session->readUser("is_vip") + $datas->day);
				$this->User->update("is_vip", $newDay, $this->session->readUser("id"));
				$this->session->writeUser("is_vip", $newDay);

				$geo = new Geolocation();

				$this->Token->log([
					"username" => $this->session->readUser("username"),
					"email"=> $this->session->readUser("email"),
					"token" => $tmp["input_token"],
					"ip" => $geo->getIp()
				]);
		    }
		}else{
		    $data["result"]["error"] = $this->translate->element("controller", "error_0");
		}
		echo json_encode(Arr::merge($data, ["version" => "1.0.0"]));
	}

}