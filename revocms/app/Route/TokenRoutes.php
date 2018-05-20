<?php
use Core\Router;

Router::get('token', ["controller" => "TokenController", "method" => "index"]);
Router::post('ajax/token', ["controller" => "TokenController", "method" => "ajax_token"]);