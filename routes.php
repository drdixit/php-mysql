<?php

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

$router->get('/notes', 'notes/index.php')->only('auth');
$router->get('/note', 'notes/show.php');
$router->delete('/note', 'notes/destroy.php');

$router->get('/note/edit', 'notes/edit.php');
$router->patch('/note', 'notes/update.php');

$router->get('/notes/create', 'notes/create.php');
$router->post('/notes', 'notes/store.php');

// what if there was a way to declare when i register the route that it should
// be restricted to only guests?
// $router->get('/register', 'controllers/registration/create.php');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');

// $router->post('/login', 'controllers/sessions/store.php')->only('guest');
// if you are wondering why i didn't do /sessions/create, you can that would be fine too
// in this case /login is just an alias for /sessions/create
// but you can also have redirect from /login to /sessions/create
// again you are in charge of the routing and you can do whatever you want
// there is no requirements, there is just guidelines that maybe you should follow if you want
// if you are on a team may be you adapt the same system but otherwise there is very few rules when it comes to this stuff
// $router->get('/sessions/create', 'controllers/sessions/create.php')->only('guest');
$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');
