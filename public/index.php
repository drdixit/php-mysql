<?php

use Core\Session;
use Core\ValidationException;

const BASE_PATH = __DIR__.'/../';

require BASE_PATH.'vendor/autoload.php';

session_start();


require BASE_PATH.'Core/functions.php';

// we are going to use composer's autoloading
// spl_autoload_register(function ($class) {
//     $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

//     require base_path("{$class}.php");
// });

// require BASE_PATH.'vendor/autoload.php';

require base_path('bootstrap.php');

$router = new \Core\Router();
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    // try to the route to the controller
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    // but catch any validation exceptions that might be thrown
    // and here in a single place not every controller
    // but a single place we can flash the errors and old data
    // and then redirect back
    // thats one way we can solve this problem
    // dd($_SERVER);
    // $_SERVER['HTTP_REFERER']
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    // this needs to be dynamic
    // return redirect('/login');
    return redirect($router->previousUrl());
}


// right here we can clear out any _flash session data
// later we will refactor this and organize it better
// $_SESSION['_flash'] = [];
// or

// unset($_SESSION['_flash']);

Session::unflash();
