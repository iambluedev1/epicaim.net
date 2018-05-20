<?php
namespace RevoCMS;

use Config\Config;
use Dir\DirManager;
use Event\EventPublisher;
use Events\Theme\ThemeLoadEvent;
use Events\Plugin\PluginLoadEvent;
use Core\Translate;
use App\Model\Permissions;
use App\Model\Ranks;
use Cache\Cache;

/**
 * Class RevoCMS
 * @package RevoCMS
 * @author iambluedev
 * @copyright RevoCMS.fr | 2017
 */

class RevoCMS {

    /**
     * Instance of RevoCMS
     * @var RevoCMS
     */
	private static $instance;

    /**
     * RevoCMS constructor.
     */

    private function __construct()
    {
        self::$instance = $this;

		$this->events = EventPublisher::getInstance();
        $this->themes = new \stdClass();
        $this->themes->outdated = new \stdClass();
        $this->themes->unavailable = new \stdClass();
        $this->themes->available = new \stdClass();
        $this->configs = new \stdClass();

		$this->loadListeners();
		
        $this->loadConfigs();
        $this->loadRoutes();
        $this->loadThemes();
    }

    /**
     * Get the instance of RevoCMS
     * @return RevoCMS
     */

	public static function getInstance() : RevoCMS {
		if(!self::$instance){
			self::$instance = new RevoCMS();
		}
		
		return self::$instance;
	}

	/**
     * Load Listeners Method
     *
     * @param string|null $path
     */

	private function loadListeners(string $path = null){
		if($path == null) $path = APPDIR . "Listeners";
        
		$dirManager = new DirManager();
		$listener = $dirManager->getListenersFiles($path);
		foreach($listener as $file){
			require_once $file;
		}
	}
	
    /**
     * Load Configs Method
     */

	private function loadConfigs(){

        $dirManager = new DirManager();
		$ini = $dirManager->getIni(ROOTDIR . "config");
		foreach($ini as $file){
			$tmp = basename($file);
			$tmp = str_replace(".ini", "", $tmp);
			$this->configs->$tmp = new Config($file);
		}
	}

    /**
     * Load Themes Method
     */

	private function loadThemes(){

		$dirManager = new DirManager();
		$theme = $dirManager->getJson(APPDIR . "Template");
        $lang = $this->configs->config->get("LANGUAGE_CODE");
	    foreach ($theme as $file){
			$data = json_decode(file_get_contents($file), false);
            $slug = $data->slug;
            if(@!is_null($data->translate->supported->$lang)){
                $this->themes->available->$slug = $data;
                $this->events->raise(new ThemeLoadEvent($file, $data));
                if($data->slug == $this->configs->config->get("TEMPLATE")){
                    $this->themes->selected = $data;
                }
            }else{
                $this->themes->unavailable->$slug = $data;
            }
        }
    }

    /**
     * Load Routes Method
     */

    private function loadRoutes(){

		$dirManager = new DirManager();
		$routesFiles = $dirManager->getRoutesFiles(APPDIR . "Route");
        foreach($routesFiles as $file){
            require_once $file;
        }
    }

    /**
     * Load Route(s) in a specified directory
     *
     * @param string $path
     */

    private function loadRoutesInFolder(string $path){

		$dirManager = new DirManager();
		$routesFiles = $dirManager->getRoutesFiles($path);
        $cache_name = "caches_" . $path;
        foreach($routesFiles as $file){
            require_once $file;
        }
    }

    /**
     * Load Config(s) in a specified plugin directory
     *
     * @param string $path
     * @param string $slug
     */

    private function loadConfigInFolder(string $path, string $slug){

		$dirManager = new DirManager();
		$ini = $dirManager->getIni($path);
        $cache_name = "configs_" . $path;
        $this->plugins->configs->$slug = new \stdClass();

        foreach($ini as $file){
            $tmp = basename($file);
            $tmp = str_replace(".ini", "", $tmp);
            $this->plugins->configs->$slug->$tmp = new Config($file);
        }
    }

}

