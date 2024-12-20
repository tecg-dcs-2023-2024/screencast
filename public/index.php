<?php

use Core\Response;
use Core\Router;

const BASE_PATH = __DIR__.'/..';
require BASE_PATH.'/core/helpers/functions.php';
require base_path('vendor/autoload.php');
require base_path('config/index.php');

session_start();

if (isset($_COOKIE['remember_token']) && !isset($_SESSION['user'])) {
    $user = new User(base_path('.env.local.ini'));
    $user_data = $user->findByEmail($_COOKIE['email']);
    if ($user_data->remember_token === $_COOKIE['remember_token']) {
        $_SESSION['user'] = $user_data;
    }
}

if (Core\Auth::check()) {
    $preferences_object = json_decode($_SESSION['user']->preferences, false);
    define('CURRENT_LANGUAGE', $preferences_object->language);
} else {
    define('CURRENT_LANGUAGE', array_keys(AVAILABLE_LANGUAGES)[0]);
}

define('MESSAGES', require base_path('resources/lang/'.CURRENT_LANGUAGE.'.php'));

$router = new Router();
require base_path('routes/web.php');

if (isset($_REQUEST['_method']) && !in_array(strtoupper($_REQUEST['_method']), ['PUT', 'PATCH', 'DELETE'])) {
    Response::abort(Response::BAD_REQUEST);
}

$request_method = $_REQUEST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->route_to_controller($request_method, $request_uri);
