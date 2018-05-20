<?php 
namespace App\Controller;

use Core\Controller;

class ShopController extends Controller{

	public function __construct(){
		parent::__construct();
   	}

	public function index(){
		if($this->session->readUser("token") == null){
			$this->url->redirect("login");
			return;
		}
		$this->view->set(["title" => $this->translate->element("view", "title")]);
		$this->view->css(["css/shop.css"]);
		$this->view->render(["folder" => "shop", "file" => "index"]);
	}

}