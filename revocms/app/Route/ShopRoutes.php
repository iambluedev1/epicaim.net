<?php
use Core\Router;

Router::get('shop', ["controller" => "ShopController", "method" => "index"]);