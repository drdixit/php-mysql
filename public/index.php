<?php

// this is a good way to show errors in php just set this values,
// and you don't need to change php.ini file
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// const BASE_PATH = __DIR__ . '/../';
const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';

// when class is not found, this function will be called
// this thing autoload classes on demand
// it lets us declare manually how we want to go about importing classes
// that has not already been explicitly or manually required/imported
spl_autoload_register(function ($class) {
    // dd($class);
    // require(base_path("Core/{$class}.php"));
    // when using namespaces class logic is different because of this
    // it tries to find Core\Database class
    // str_replace('\\', '/',$class);
    // this should work but why don't we make it dynamic using directory separator
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    // dd($class);
    require(base_path("{$class}.php"));
});

// require base_path('Database.php');
// require base_path('Response.php');
// require base_path('Core/router.php');

$router = new \Core\Router();

$routes = require(base_path('routes.php'));

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
// $method = isset($_POST['_method']) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];
// below is equivalent to above line
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);





// $config = require('config.php');
// $db = new Database($config['database']);
// $id = $_GET['id'];

// $query = "select * from posts where id = :id";
// $post = $db->query($query, [':id' => $id])->fetchAll();
// dd($post);

// $query = "select * from posts where id = ?";
// $post = $db->query($query, [$id])->fetchAll();
// or you could use :id
// $query = "select * from posts where id = :id";
// $post = $db->query($query, ['id' => $id])->fetchAll();
// both of them are same
// $post = $db->query($query, [':id' => $id])->fetchAll();