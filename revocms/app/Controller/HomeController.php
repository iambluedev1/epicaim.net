<?php 
namespace App\Controller;

use Core\Controller;
use Mail\Mail;

class HomeController extends Controller{

	public function __construct(){
		parent::__construct();
    	}

	public function index(){
		if($this->session->readUser("token") == null){
			$this->url->redirect("login");
			return;
		}

		if($this->session->readUser("is_vip") == 0){
			$this->url->redirect(($this->rcms->configs->config->get("FREE_MODE")) ? "free" : "shop");
			return;
		}

		$this->view->set(["title" => $this->translate->element("view", "title")]);
		$this->view->render(["folder" => "home", "file" => "index"]);
	}

	public function free(){
		if($this->session->readUser("token") == null){
			$this->url->redirect("login");
			return;
		}

		if($this->session->readUser("is_vip") != 0){
			$this->url->redirect("home");
			return;
		}

		$this->view->set(["title" => $this->translate->element("view", "title")]);
		$this->view->render(["folder" => "home", "file" => "free"]);
	}

	public function sitemap(){
		$this->view->addHeaders(["Content-Type: text/xml"]);
		$this->view->autoRender(false);
		$this->view->render(["folder" => "home", "file" => "sitemap"]);
	}

	public function robot(){
		/*ob_start();
		$this->view->autoRender(false);
		$this->view->translate("emails");
		$this->view->set([
			"username" => "testtestest", 
			"url" => "aaaaaaa"
		]);
		$this->view->render(["folder" => "_emails", "file" => "confirm_account"]);
		$content = ob_get_clean();
		echo '<pre>';
		$mail = new Mail();
		$mail->SMTPDebug  = 4;
		$mail->addAddress("darkpit58@gmail.com", "testtestest");
		$mail->Subject = "Un titre de test";
		$mail->msgHTML($content);
		$mail->send();
		echo '</pre>';*/
	}

}
