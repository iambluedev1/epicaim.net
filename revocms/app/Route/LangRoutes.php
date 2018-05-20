<?php
use Core\Router;

Router::get('lang/fr/(:all)', ["controller" => "LangController", "method" => "set_fr"]);
Router::get('lang/en/(:all)', ["controller" => "LangController", "method" => "set_en"]);