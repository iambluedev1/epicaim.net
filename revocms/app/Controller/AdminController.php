<?php
namespace App\Controller;

use Core\Controller;
use Web\Request;
use Usage\Arr;
use Mail\Mail;

class AdminController extends Controller{

    public function __construct()
    {
        parent::__construct();
        if($this->session->readUser("token") == null){
			$this->url->redirect("login");
			return;
        }
        
        if($this->session->readUser("is_admin") == 0){
            $this->e404();
            exit();
        }

        $this->loadModel(["User", "Logs", "Token", "Newsletter"]);
    }

    public function index(){
        $this->view->set(["title" => "Panel admin"]);
        $this->view->js(["https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js", "https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js", "js/admin.js"]);
		$this->view->css(["https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css", "css/logs.css"]);
        $this->view->render(["folder" => "admin", "file" => "index"]);
    }

    public function list_users(){
        $this->view->set(["title" => "Liste des utilisateurs", "users" => $this->User->getUsers()]);
        $this->view->js(["https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js", "https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"]);
		$this->view->css(["https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css", "css/logs.css"]);
        $this->view->render(["folder" => "admin", "file" => "users"]);
    }

    public function list_vip(){
        $this->view->set(["title" => "Liste des vips", "logs" => $this->User->getVips()]);
        $this->view->js(["https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js", "https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js", "js/admin_vip.js"]);
		$this->view->css(["https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css", "css/logs.css"]);
        $this->view->render(["folder" => "admin", "file" => "vip"]);
    }

    public function list_tokens(){
        $this->view->set(["title" => "Liste des tokens", "tokens" => $this->Token->getTokens()]);
        $this->view->js(["https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js", "https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"]);
		$this->view->css(["https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css", "css/logs.css"]);
        $this->view->render(["folder" => "admin", "file" => "tokens"]);
    }

    public function newsletter(){
        $this->view->set(["title" => "Newsletter", "logs" => $this->Newsletter->getnewsletters()]);
        $this->view->js(["https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js", "https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"]);
		$this->view->css(["https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css", "css/logs.css"]);
        $this->view->render(["folder" => "admin", "file" => "newsletter"]);
    }

    public function view_newsletter($id){
        if($this->Newsletter->isRegistered($id)){
            $newsletter = $this->Newsletter->getDatas($id);
            $this->view->set(["title" => "Newsletter : " . $newsletter->newsletterTitle, "newsletter" =>  $newsletter]);
            $this->view->css(["https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css"]);
            $this->view->js(["https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js", "js/newsletter.js"]);
            $this->view->render(["folder" => "admin", "file" => "newsletter_view"]);
        }else{
            $this->e404();
            exit();
        }
    }

    public function prepare_newsletter($id){
        if($this->Newsletter->isRegistered($id)){
            $newsletter = $this->Newsletter->getDatas($id);
            $this->view->set(["title" => "Préparation de l'envoie de la newsletter : " . $newsletter->newsletterTitle, "newsletter" =>  $newsletter]);
            $this->view->js(["https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js", "https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js", "js/newsletter_prepare.js"]);
		    $this->view->css(["https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css", "css/logs.css"]);
            $this->view->render(["folder" => "admin", "file" => "newsletter_prepare"]);
        }else{
            $this->e404();
            exit();
        }
    }

    public function load_newsletter($id){
        if($this->Newsletter->isRegistered($id)){
            $newsletter = $this->Newsletter->getDatas($id);
            $content = $newsletter->newsletterContent;
            $lang = $this->session->readUser("lang");

            foreach(json_decode($newsletter->newsletterTranslate) as $trad){
                $tmp = "";
                if($lang == "fr"){
                    $tmp = $trad->fr;
                }else if($lang == "en"){
                    $tmp = $trad->en;
                }
                $content = str_replace("%".$trad->name."%", $tmp, $content);
            }

            $this->view->autoRender(false);
            $this->view->translate("emails");
            $this->view->set([
                "title" => $newsletter->newsletterTitle,
                "content" => $content
            ]);
            $this->view->render(["folder" => "_emails", "file" => "template"]);
        }else{
            $this->e404();
            exit();
        }
    }

    public function view_user($id){
        if($this->User->isRegistered($id, "userId")){
            $user = $this->User->getDatas($id, "userId");
            $this->loadModel("Online");
            $this->view->set(["title" => "Compte de " . $user->userName, "user" =>  $user, "online" => $this->Online->isConnected($id, "userId")]);
            $this->view->js(["js/admin_user.js"]);
            $this->view->render(["folder" => "admin", "file" => "user"]);
        }else{
            $this->e404();
            exit();
        }
    }

    public function view_user_logs($id){
        if($this->User->isRegistered($id, "userId")){
            $user = $this->User->getDatas($id, "userId");
            $this->view->set([
                "title" => "Compte de " . $user->userName, 
                "logs" =>  $this->Logs->getLogs($id), 
                "user" => $user
            ]);
            $this->view->js(["https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js", "https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js", "js/logs.js"]);
		    $this->view->css(["https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css", "css/logs.css"]);
		    $this->view->render(["folder" => "admin", "file" => "user_logs"]);
        }else{
            $this->e404();
            exit();
        }
    }

    public function view_user_tokens($id){
        if($this->User->isRegistered($id, "userId")){
            $user = $this->User->getDatas($id, "userId");
            $this->view->set([
                "title" => "Compte de " . $user->userName, 
                "logs" =>  $this->Token->getActiveLogs($user->userEmail), 
                "user" => $user
            ]);
            $this->view->js(["https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js", "https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"]);
		    $this->view->css(["https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css", "css/logs.css"]);
		    $this->view->render(["folder" => "admin", "file" => "user_tokens"]);
        }else{
            $this->e404();
            exit();
        }
    }

    public function view_user_injects($id){
        if($this->User->isRegistered($id, "userId")){
            $user = $this->User->getDatas($id, "userId");
            $this->view->set([
                "title" => "Compte de " . $user->userName, 
                "logs" =>  $this->User->getInjectionsLogs($user->userEmail), 
                "user" => $user
            ]);
            $this->view->js(["https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js", "https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"]);
		    $this->view->css(["https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css", "css/logs.css"]);
		    $this->view->render(["folder" => "admin", "file" => "user_injects"]);
        }else{
            $this->e404();
            exit();
        }
    }

    public function view_user_free_injects($id){
        if($this->User->isRegistered($id, "userId")){
            $user = $this->User->getDatas($id, "userId");
            $this->view->set([
                "title" => "Compte de " . $user->userName, 
                "logs" =>  $this->User->getFreeInjectionsLogs($user->userEmail), 
                "user" => $user
            ]);
            $this->view->js(["https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js", "https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"]);
		    $this->view->css(["https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css", "css/logs.css"]);
		    $this->view->render(["folder" => "admin", "file" => "user_free_injects"]);
        }else{
            $this->e404();
            exit();
        }
    }

    public function delete_token($id){
        if($this->Token->tokenExist($id, "id")){
            $this->Token->del($id);
            $this->url->redirect("admin/list/tokens");
            exit();
        } else {
            $this->e404();
            exit();
        }
    }

    public function activate_token($id){
        if($this->Token->tokenExist($id, "id")){
            $this->Token->activate($id);
            $this->url->redirect("admin/list/tokens");
            exit();
        } else {
            $this->e404();
            exit();
        }
    }

    public function desactivate_token($id){
        if($this->Token->tokenExist($id, "id")){
            $this->Token->desactivate($id);
            $this->url->redirect("admin/list/tokens");
            exit();
        } else {
            $this->e404();
            exit();
        }
    }

    public function token_add(){
        $this->view->set(["title" => "Ajouter un token"]);
        $this->view->js(["js/admin_tokens.js"]);
        $this->view->render(["folder" => "admin", "file" => "add_token"]);
    }

    public function ajax_token_add(){
        $this->view->addHeaders(["Content-Type: application/json", "Access-Control-Allow-Origin: *", "Access-Control-Allow-Headers: token"]);
        $this->view->sendHeaders();
        if(Request::isPost()){
            $tmp = array(
				"input_token" => Request::post("token"),
				"input_time" => Request::post("time")
		    );
	
            $errors = "";
            
            foreach($tmp as $input_name => $input_value){
				if($input_value == "") {
					$errors .= str_replace("input_", "", $input_name) .", ";
				}
            }
            
            if($tmp["input_time"] != ""){
                if(!is_numeric($tmp["input_time"])){
                    $errors .= "Veuilliez entrer un temps valide !<br>";
                } else if(intval($tmp["input_time"]) < 0) {
                    $errors .= "Le temps du token ne doit pas être inférieur à 0 !<br>";
                }
            }

            if($tmp["input_token"] != "" && $this->Token->tokenExist($tmp["input_token"])){
                $errors .= "Le token choisit existe déjà !<br>";
            }

            if($errors != ""){
				$data["result"]["error"] = "Merci de verifier les champs suivant : <br>" . $errors;
		    }else{
                $data["result"]["success"] = "Le token a bien été ajouté !";
                $this->Token->addToken([
                    "token" => $tmp["input_token"],
                    "day" => intval($tmp["input_time"])
                ]);
            }
        }else{
            $data["result"]["error"] = "Cette méthode n'est pas autorisée pour cette requete";
        }
        echo json_encode(Arr::merge($data, ["version" => "1.0.0"]));
    }

    public function ajax_account_confirm(){
        $this->view->addHeaders(["Content-Type: application/json", "Access-Control-Allow-Origin: *", "Access-Control-Allow-Headers: token"]);
        $this->view->sendHeaders();
        if(Request::isPost()){
            $tmp = array(
				"input_id" => Request::post("id"),
		    );
	
            $errors = "";
            
            foreach($tmp as $input_name => $input_value){
				if($input_value == "") {
					$errors .= str_replace("input_", "", $input_name) .", ";
				}
            }
            
            if(!$this->User->isRegistered($tmp["input_id"], "userId") && $tmp["input_id"] != ""){
                $errors .= "Aucun compte avec cet id ! <br>";
            }

            if($errors != ""){
				$data["result"]["error"] = "Merci de verifier les champs suivant : <br>" . $errors;
		    }else{
                $user = $this->User->getDatas($id, "userId");
                if($user->userState != 0){
                    $data["result"]["error"] = "Ce compte est déjà confirmé !";
                }else{
                    $data["result"]["success"] = "Le compte a bien été confirmé";
                    $this->User->setConfirmed($user->userId);
                }
            }
        }else{
            $data["result"]["error"] = "Cette méthode n'est pas autorisée pour cette requete";
        }
        echo json_encode(Arr::merge($data, ["version" => "1.0.0"]));
    }

    public function ajax_change_hwid(){
        $this->view->addHeaders(["Content-Type: application/json", "Access-Control-Allow-Origin: *", "Access-Control-Allow-Headers: token"]);
        $this->view->sendHeaders();
        if(Request::isPost()){
            $tmp = array(
                "input_id" => Request::post("id"),
                "input_hwid" => Request::post("new_hwid")
		    );
	
            $errors = "";
            
            foreach($tmp as $input_name => $input_value){
				if($input_value == "" && $input_value != "input_hwid") {
					$errors .= str_replace("input_", "", $input_name) .", ";
				}
            }
            
            if(!$this->User->isRegistered($tmp["input_id"], "userId") && $tmp["input_id"] != ""){
                $errors .= "Aucun compte avec cet id ! <br>";
            }

            if($errors != ""){
				$data["result"]["error"] = "Merci de verifier les champs suivant : <br>" . $errors;
		    }else{
                $data["result"]["success"] = "L'HWID a bien été modifié";
                $this->User->update("hwid", $tmp["input_hwid"], $tmp["input_id"]);
            }
        }else{
            $data["result"]["error"] = "Cette méthode n'est pas autorisée pour cette requete";
        }
        echo json_encode(Arr::merge($data, ["version" => "1.0.0"]));
    }

    public function ajax_update_newsletter(){
        $this->view->addHeaders(["Content-Type: application/json", "Access-Control-Allow-Origin: *", "Access-Control-Allow-Headers: token"]);
        $this->view->sendHeaders();
        if(Request::isPost()){
            $tmp = array(
                "input_id" => Request::post("id"),

                "title_test" => Request::post("change_title"),
                "input_title" => Request::post("title"),

                "content_test" => Request::post("change_content"),
                "input_content" => (@$_POST["content"] != "") ? $_POST["content"] : "",

                "trad_test" => Request::post("change_trad"),
                "trad_fr" => (@$_POST["trad_fr"] != "") ? $_POST["trad_fr"] : "",
                "trad_en" => (@$_POST["trad_en"] != "") ? $_POST["trad_en"] : "",
                "trad_title" => (@$_POST["trad_title"] != "") ? $_POST["trad_title"] : "",
		    );
	
            $errors = "";
            $custom_output = "";
            $valid_id = false;
            $modification = false;
            $newsletter = null;
            
            if($tmp["input_id"] != ""){
                $valid_id = $this->Newsletter->isRegistered($tmp["input_id"]);
                $newsletter = $this->Newsletter->getDatas($tmp["input_id"]);
            }

            if($tmp["title_test"] && $valid_id){
                if($tmp["input_title"]){
                    if($tmp["input_title"] != $newsletter->newsletterTitle){
                        $modification = true;
                        $this->Newsletter->update("newsletterTitle", $tmp["input_title"], $tmp["input_id"]);
                    }
                } else {
                    $errors .= "Vous devez indiquer un titre !";
                }
            }

            if($tmp["content_test"] && $valid_id){
                if($tmp["input_content"]){
                    if($tmp["input_content"] != $newsletter->newsletterContent){
                        $modification = true;
                        $this->Newsletter->update("newsletterContent", $tmp["input_content"], $tmp["input_id"]);
                    }
                } else {
                    $errors .= "Vous devez indiquer un titre !";
                }
            }

            if($tmp["trad_test"] && $valid_id){
                $fr = $tmp["trad_fr"];
                $en = $tmp["trad_en"];
                $title = $tmp["trad_title"];

                $trads = [];

                for($i = 0; $i < count($title); $i++){
                    $trads[] = [
                        "name" => $title[$i],
                        "fr" => $fr[$i],
                        "en" => $en[$i],
                    ];
                }

                $data["result"]["trad"] = $trads;

                $hasModification = false;
                $oldTrads = json_decode($newsletter->newsletterTranslate, true);

                for($i = 0; $i < count($trads); $i++){
                    if((count($oldTrads) - 1) >= $i) {
                        $hasModification = !empty(array_diff($trads[$i], $oldTrads[$i]));
                    } else{
                        $hasModification = true;
                    }
                }

                if($hasModification){
                    $this->Newsletter->update("newsletterTranslate", json_encode($trads), $tmp["input_id"]);
                    $modification = true;
                }
            }

            if($errors != ""){
			    $data["result"]["error"] = $errors;
			}else{
			    if($modification){
				    $data["result"]["success"] = ($custom_output != "") ? $custom_output : "Les modifications ont bien été sauvegardé !";
                }else{
				    $data["result"]["success"] = "Aucune modification n'a été effectué";
			    }
			}
        }else{
            $data["result"]["error"] = "Cette méthode n'est pas autorisée pour cette requete";
        }
        echo json_encode(Arr::merge($data, ["version" => "1.0.0"]));
    }

    public function ajax_type_newsletter(){
        $this->view->addHeaders(["Content-Type: application/json", "Access-Control-Allow-Origin: *", "Access-Control-Allow-Headers: token"]);
        $this->view->sendHeaders();
        if(Request::isPost()){
            $tmp = array(
                "input_type" => Request::post("type")
		    );
	
            $errors = "";
            
            if($tmp["input_type"] == ""){
                $errors .= "Vous devez renseigner un type !<br>";
            } else if($tmp["input_type"] < 1 || $tmp["input_type"] > 3){
                $errors .= "Vous devez renseigner un type valide !<br>";
            }

            if($errors != ""){
				$data["result"]["error"] = "Merci de verifier les champs suivant : <br>" . $errors;
		    }else{
                $users = [];

                if($tmp["input_type"] == 1) {
                    $users = $this->User->getUsers();
                }else if($tmp["input_type"] == 2){
                    $users = $this->User->getVips();
                }else if($tmp["input_type"] == 3){
                    $users = $this->User->getNonVips();
                }

                $data["result"]["success"] = "Le type a bien été selectionné";
                $data["result"]["users"] = $users;
                $data["result"]["type"] = $tmp["input_type"];
            }
        }else{
            $data["result"]["error"] = "Cette méthode n'est pas autorisée pour cette requete";
        }
        echo json_encode(Arr::merge($data, ["version" => "1.0.0"]));
    }

    public function ajax_send_newsletter(){
        $this->view->addHeaders(["Content-Type: application/json", "Access-Control-Allow-Origin: *", "Access-Control-Allow-Headers: token"]);
        $this->view->sendHeaders();
        if(Request::isPost()){
            $tmp = array(
                "input_id" => Request::post("id"),
                "input_type" => Request::post("type"),
		    );
	
            $errors = "";
            $valid_id = false;
            $newsletter = null;
            
            if($tmp["input_id"] != ""){
                $valid_id = $this->Newsletter->isRegistered($tmp["input_id"]);
                $newsletter = $this->Newsletter->getDatas($tmp["input_id"]);
            }

            if($valid_id){
                if($tmp["input_type"] == ""){
                    $errors .= "Vous devez renseigner un type !<br>";
                } else if($tmp["input_type"] < 1 || $tmp["input_type"] > 3){
                    $errors .= "Vous devez renseigner un type valide !<br>";
                }
            }

            if($errors != ""){
			    $data["result"]["error"] = $errors;
			}else{
                $users = [];

                if($tmp["input_type"] == 1) {
                    $users = $this->User->getUsers();
                }else if($tmp["input_type"] == 2){
                    $users = $this->User->getVips();
                }else if($tmp["input_type"] == 3){
                    $users = $this->User->getNonVips();
                }

                $content = $newsletter->newsletterContent;
                $lang = $this->session->readUser("lang");

                foreach(json_decode($newsletter->newsletterTranslate) as $trad){
                    $tmp = "";
                    if($lang == "fr"){
                        $tmp = $trad->fr;
                    }else if($lang == "en"){
                        $tmp = $trad->en;
                    }
                    $content = str_replace("%".$trad->name."%", $tmp, $content);
                }

                ob_start();
                $this->view->autoRender(false);
                $this->view->translate("emails");
                $this->view->set([
                    "title" => $newsletter->newsletterTitle,
                    "content" => $content
                ]);
                $this->view->render(["folder" => "_emails", "file" => "template"]);
                $content = ob_get_clean();

                $mail = new Mail();

                $i = 0;
                foreach($users as $user){
                    if($i == 0){
                        $mail->addAddress($user->userEmail, $user->userName);
                    }else{
                        $mail->addBCC($user->userEmail, $user->userName);
                    }
                    $i++;
                }

                $mail->Subject = $newsletter->newsletterTitle;
                $mail->msgHTML($content);
                $mail->send();

                $this->Newsletter->update("newsletterState", 1, $newsletter->newsletterId);

				$data["result"]["success"] = "La newsletter a bien été envoyée !";
			}
        }else{
            $data["result"]["error"] = "Cette méthode n'est pas autorisée pour cette requete";
        }
        echo json_encode(Arr::merge($data, ["version" => "1.0.0"]));
    }

    public function toggle_free_mode(){
        $state = !$this->rcms->configs->config->get("FREE_MODE");
        $this->rcms->configs->config->set("FREE_MODE", $state);
        $this->rcms->configs->config->save();

        $data["result"]["success"] = "Le mode a bien été " . (($state) ? "activé" : "désactivé") . " !";
        echo json_encode(Arr::merge($data, ["version" => "1.0.0"]));
    }

    public function add_newsletter(){
        $translate = [];
        $translate[] = [
            "name" => "title",
            "fr" => "un titre",
            "en" => "a title"
        ];
        $id = $this->Newsletter->add([
            "title" => "A title",
            "content" => "A content",
            "translate" => json_encode($translate)
        ]);
        $this->url->redirect("admin/newsletter/view/" . $id);
        exit();
    }

    public function delete_newsletter($id){
        if($this->Newsletter->isRegistered($id)){
            $this->Newsletter->del($id);
            $this->url->redirect("admin/newsletter");
        }else{
            $this->e404();
            exit();
        }
    }
}