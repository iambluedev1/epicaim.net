<?php
use Core\Router;

Router::get('support', ["controller" => "SupportController", "method" => "index"]);