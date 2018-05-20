<?php
use Core\Router;

Router::get('', ["controller" => "HomeController", "method" => "index"]);
Router::get('home', ["controller" => "HomeController", "method" => "index"]);
Router::get('free', ["controller" => "HomeController", "method" => "free"]);

Router::get('sitemap.xml', ["controller" => "HomeController", "method" => "sitemap"]);
Router::get('robots.txt', ["controller" => "HomeController", "method" => "robot"]);