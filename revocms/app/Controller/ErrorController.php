<?php
namespace App\Controller;

use Core\Controller;

class ErrorController extends Controller{

    private $error = null;

   
    public function __construct($error = null)
    {
        parent::__construct();
        $this->error = $error;
    }

    public function index($error = null){
        if($this->session->readUser("token") == null){
			$this->url->redirect("login");
			return;
		}

        header("HTTP/1.0 404 Not Found");
        $datas['title'] = $this->translate->element("view", "title");
        $datas['error'] = $error ? $error : $this->error;
        $this->view->set($datas);
        $this->view->render(["folder" => "error", "file" => "index"]);
    }

}