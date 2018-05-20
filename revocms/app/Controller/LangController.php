<?php 
namespace App\Controller;

use Core\Controller;

class LangController extends Controller{

	public function __construct(){
		parent::__construct();
    	}

	public function set_fr($redirect){
        $this->session->writeUser("lang", "fr");
		$this->url->redirect($redirect);
    }
    
    public function set_en($redirect){
        $this->session->writeUser("lang", "en");
		$this->url->redirect($redirect);
	}
}