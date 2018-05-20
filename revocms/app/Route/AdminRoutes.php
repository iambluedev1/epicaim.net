<?php
use Core\Router;

Router::get('admin', ["controller" => "AdminController", "method" => "index"]);
Router::get('admin/list/vip', ["controller" => "AdminController", "method" => "list_vip"]);
Router::get('admin/list/users', ["controller" => "AdminController", "method" => "list_users"]);
Router::get('admin/list/tokens', ["controller" => "AdminController", "method" => "list_tokens"]);

Router::get('admin/ajax/toggle/free-mode', ["controller" => "AdminController", "method" => "toggle_free_mode"]);

Router::get('admin/newsletter', ["controller" => "AdminController", "method" => "newsletter"]);
Router::get('admin/newsletter/add', ["controller" => "AdminController", "method" => "add_newsletter"]);
Router::get('admin/newsletter/view/(:num)', ["controller" => "AdminController", "method" => "view_newsletter"]);
Router::get('admin/newsletter/load/(:num)', ["controller" => "AdminController", "method" => "load_newsletter"]);
Router::get('admin/newsletter/prepare/(:num)', ["controller" => "AdminController", "method" => "prepare_newsletter"]);
Router::get('admin/newsletter/delete/(:num)', ["controller" => "AdminController", "method" => "delete_newsletter"]);
Router::post('admin/ajax/newsletter/update', ["controller" => "AdminController", "method" => "ajax_update_newsletter"]);
Router::post('admin/ajax/newsletter/type', ["controller" => "AdminController", "method" => "ajax_type_newsletter"]);
Router::post('admin/ajax/newsletter/send', ["controller" => "AdminController", "method" => "ajax_send_newsletter"]);

Router::get('admin/view/user/(:num)', ["controller" => "AdminController", "method" => "view_user"]);
Router::get('admin/view/user/(:num)/logs', ["controller" => "AdminController", "method" => "view_user_logs"]);
Router::get('admin/view/user/(:num)/tokens', ["controller" => "AdminController", "method" => "view_user_tokens"]);
Router::get('admin/view/user/(:num)/injects', ["controller" => "AdminController", "method" => "view_user_injects"]);
Router::get('admin/view/user/(:num)/free-injects', ["controller" => "AdminController", "method" => "view_user_free_injects"]);
Router::post('admin/ajax/user/confirm', ["controller" => "AdminController", "method" => "ajax_account_confirm"]);
Router::post('admin/ajax/user/hwid/change', ["controller" => "AdminController", "method" => "ajax_change_hwid"]);

Router::get('admin/token/delete/(:num)', ["controller" => "AdminController", "method" => "delete_token"]);
Router::get('admin/token/activate/(:num)', ["controller" => "AdminController", "method" => "activate_token"]);
Router::get('admin/token/desactivate/(:num)', ["controller" => "AdminController", "method" => "desactivate_token"]);
Router::get('admin/token/add', ["controller" => "AdminController", "method" => "token_add"]);
Router::post('admin/ajax/token/add', ["controller" => "AdminController", "method" => "ajax_token_add"]);



