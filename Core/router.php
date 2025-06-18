<?php

$routes = require(base_path('routes.php'));

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

routeToController($uri, $routes);

function routeToController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        // dd($routes[$uri]);
        require base_path($routes[$uri]);
    } else {
        abort();
    }
}

// In PHP, functions can be called before they are defined in the file, as long as the function definition is included somewhere in the script before the code is executed. This is because PHP parses the entire file and registers all function definitions before executing any code.
// the default is 404 you can overwrite it
function abort($code = 404)
{
    http_response_code($code);
    // TODO: check for corresponding view file if it exists or not
    require "views/{$code}.php";
    die();
}

// the default is 404 you can overwrite it
// function abort($code = 404) {
//     http_response_code($code);
//     // TODO: check for corresponding view file if it exists or not
//     require "views/{$code}.php";
//     die();
// }


// if (array_key_exists($uri, $routes)) {
//     require $routes[$uri];
// } else {
//     abort();
// }

// /contact?name=dixit
// $uri = $_SERVER['REQUEST_URI'];
// solution
// dd(parse_url($uri));
// $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
// $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// refactoring this
// if ($uri === '/') {
//     require 'controllers/index.php';
// } else if ($uri === '/contact') {
//     require 'controllers/contact.php';
// } else if ($uri === '/about') {
//     require 'controllers/about.php';
// }

// $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

// dd($uri);
// little map or look up table
// $routes = [
//     '/' => 'controllers/index.php',
//     '/contact' => 'controllers/contact.php',
//     '/about' => 'controllers/about.php',
// ];

// require "views/{$code}.php";
// require "views/$code.php"; this is a problem of ambiguity and entire thing treat as a single variable name