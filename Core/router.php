<?php

namespace Core;

class Router
{
    // public means the methods or properties can be accessed from outside the class
    // so if you have access to the object instance of the class, you can call this public methods and you can access public properties
    // public $routes = [];
    // protected means this property is not protected, and is not available to the outside world
    // within this class and within this object instance, we can interact with this property
    // but outside of this class, we cannot access this property or you don't need ot interact with it
    protected $routes = [];

    public function get($uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'methods' => 'GET'
        ];
    }

    public function post($uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'methods' => 'POST'
        ];
    }

    public function delete($uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'methods' => 'DELETE'
        ];
    }

    // This is a common method used to update resources
    // there are some differences between patch and put
    // patch is used to update a part of the resource
    // put is used to update the entire resource
    // but don't think too much about it
    public function patch($uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'methods' => 'PATCH'
        ];
    }

    public function put($uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'methods' => 'PUT'
        ];
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['methods'] === strtoupper($method)) {
                return require base_path($route['controller']);
            }
        }

        // abort
        $this->abort();
    }

    protected function abort($code = 404)
    {
        http_response_code($code);
        // TODO: check for corresponding view file if it exists or not
        require base_path("views/{$code}.php");
        die();
    }
}


// $routes = require(base_path('routes.php'));

// $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

// routeToController($uri, $routes);

// function routeToController($uri, $routes)
// {
//     if (array_key_exists($uri, $routes)) {
//         // dd($routes[$uri]);
//         require base_path($routes[$uri]);
//     } else {
//         abort();
//     }
// }

// // In PHP, functions can be called before they are defined in the file, as long as the function definition is included somewhere in the script before the code is executed. This is because PHP parses the entire file and registers all function definitions before executing any code.
// // the default is 404 you can overwrite it
// function abort($code = 404)
// {
//     http_response_code($code);
//     // TODO: check for corresponding view file if it exists or not
//     require base_path("views/{$code}.php");
//     die();
// }

// // the default is 404 you can overwrite it
// // function abort($code = 404) {
// //     http_response_code($code);
// //     // TODO: check for corresponding view file if it exists or not
// //     require "views/{$code}.php";
// //     die();
// // }


// // if (array_key_exists($uri, $routes)) {
// //     require $routes[$uri];
// // } else {
// //     abort();
// // }

// // /contact?name=dixit
// // $uri = $_SERVER['REQUEST_URI'];
// // solution
// // dd(parse_url($uri));
// // $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
// // $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// // refactoring this
// // if ($uri === '/') {
// //     require 'controllers/index.php';
// // } else if ($uri === '/contact') {
// //     require 'controllers/contact.php';
// // } else if ($uri === '/about') {
// //     require 'controllers/about.php';
// // }

// // $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

// // dd($uri);
// // little map or look up table
// // $routes = [
// //     '/' => 'controllers/index.php',
// //     '/contact' => 'controllers/contact.php',
// //     '/about' => 'controllers/about.php',
// // ];

// // require "views/{$code}.php";
// // require "views/$code.php"; this is a problem of ambiguity and entire thing treat as a single variable name