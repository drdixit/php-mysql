<?php


// what if we have something like router object
// our router object has a methods like get, post, put, delete, patch
// all of the different request types that a form can potentially submit
// $router->delete('/note', 'controllers/notes/destory.php');
// destroy is common term there

// in our routes.php file we are calling methods all over the place
// so maybe each time we call a request type method maybe it should be cached may be we should store it within
// the array that the Router class has access to so we add new public property called $routes to Router class
$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

$router->get('/notes', 'controllers/notes/index.php');
$router->get('/note', 'controllers/notes/show.php');
$router->get('/notes/create', 'controllers/notes/create.php');





// return [
//     '/' => 'controllers/index.php',
//     '/about' => 'controllers/about.php',
//     '/notes' => 'controllers/notes/index.php',
//     '/note' => 'controllers/notes/show.php',
//     '/notes/create' => 'controllers/notes/create.php',
//     '/contact' => 'controllers/contact.php',
// ];

// i guess its fine but its not overly friendly to interact with
// return [
//     [
//         'uri' => '/',
//         'controller' => 'controllers/index.php',
//         'methods' => 'GET'
//     ],
//     [
//         'uri' => '/about',
//         'controller' => 'controllers/about.php',
//         'methods' => 'GET'
//     ],
// ];