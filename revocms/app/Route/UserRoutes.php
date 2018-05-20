<?php
use Core\Router;

Router::get('login', ["controller" => "UserController", "method" => "login"]);
Router::get('register', ["controller" => "UserController", "method" => "register"]);
Router::get('lost-password', ["controller" => "UserController", "method" => "lostpassword"]);

Router::get('logout', ["controller" => "UserController", "method" => "logout"]);
Router::get('account', ["controller" => "UserController", "method" => "account"]);
Router::get('account/logs', ["controller" => "UserController", "method" => "logs"]);
Router::get('account/tokens', ["controller" => "UserController", "method" => "tokens"]);

Router::post('ajax/account/create', ["controller" => "UserController", "method" => "ajax_account_create"]);
Router::post('ajax/account/login', ["controller" => "UserController", "method" => "ajax_account_login"]);
Router::post('ajax/redeem/confirmation', ["controller" => "UserController", "method" => "ajax_confirm_redeem"]);
Router::post('ajax/account/update', ["controller" => "UserController", "method" => "ajax_account_update"]);
Router::post('ajax/account/lost-password', ["controller" => "UserController", "method" => "ajax_lost_password"]);

Router::get('confirm/(:any)/(:any)/(:num)', ["controller" => "UserController", "method" => "confirm_account"]);