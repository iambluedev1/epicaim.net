<?php
namespace Core;

use Web\Url;
use RevoCMS\RevoCMS;
use Core\View;
use Session\Session;
use Cookie\Cookie;
use Core\Translate;
use Web\Request;
use Usage\Flash;
use Mail\Mail;
use Usage\Geolocation;
use Usage\Number;

/**
 * Class Controller
 * @package Core
 * @author iambluedev
 * @copyright RevoCMS.fr | 2017
 */

abstract class Controller
{
    /**
     * Return Url Class
     *
     * @var Url
     */
    public $url;

    /**
     * Return RevoCMS Class
     *
     * @var RevoCMS
     */
	public $rcms;

    /**
     * Return View Class
     *
     * @var View
     */
	public $view;

    /**
     * Return Session Class
     *
     * @var Session
     */
	public $session;

    /**
     * Return Cookie Class
     *
     * @var Cookie
     */
	public $cookie;

    /**
     * Return Translate Class
     *
     * @var Translate
     */
	public $translate;

    /**
     * Return Flash Class
     *
     * @var Flash
     */
	public $flash;

    /**
     * Return Request Class
     *
     * @var Request
     */
	public $request;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->url = new Url();
        $this->rcms = RevoCMS::getInstance();
		$this->view = new View();
		$this->session = new Session();
		$this->cookie = new Cookie();
        $this->flash = Flash::getInstance();
        $this->request = new Request();
        $this->request->setController(substr(get_class($this), strrpos(get_class($this), '\\') + 1));
        
        if($this->session->readUser("lang") == ""){
            $geo = new Geolocation();
            if($geo->getCountryCode() == "FR"){
                $this->session->writeUser("lang", "fr");
            } else {
                $this->session->writeUser("lang", $this->rcms->configs->config->get("LANGUAGE_CODE"));
            }
        }

        $this->translate = new Translate(strtolower(str_replace("Controller", "",  substr(get_class($this), strrpos(get_class($this), '\\') + 1))));
    }

    /**
     * Load Model
     *
     * @param string|array $name
     */
	function loadModel($name){
        if(is_array($name)){
            foreach ($name as $c){
                $segments = explode("\\", get_class($this));
                $slug = "App\Model";
                $class = $slug . "\\$c";
                $this->$c = @new $class();
            }
        }else if(!isset($this->$name)){
			$class = "App\Model\\$name";
			$this->$name = new $class();
		}
	}

    /**
     * Display Error Page
     */
	function e404(){
	    $this->view->set(["title" => "Erreur 404"]);
	    $this->view->render(["folder" => "error", "file" => "index"]);
    }
}
