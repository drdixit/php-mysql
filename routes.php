<?php

$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

$router->get('/notes', 'controllers/notes/index.php')->only('auth');
$router->get('/note', 'controllers/notes/show.php');
$router->delete('/note', 'controllers/notes/destroy.php');

$router->get('/note/edit', 'controllers/notes/edit.php');
$router->patch('/note', 'controllers/notes/update.php');

$router->get('/notes/create', 'controllers/notes/create.php');
$router->post('/notes', 'controllers/notes/store.php');

// what if there was a way to declare when i register the route that it should
// be restricted to only guests?
// $router->get('/register', 'controllers/registration/create.php');

$router->get('/register', 'controllers/registration/create.php')->only('guest');
$router->post('/register', 'controllers/registration/store.php');

// $router->post('/login', 'controllers/sessions/store.php')->only('guest');
// if you are wondering why i didn't do /sessions/create, you can that would be fine too
// in this case /login is just an alias for /sessions/create
// but you can also have redirect from /login to /sessions/create
// again you are in charge of the routing and you can do whatever you want
// there is no requirements, there is just guidelines that maybe you should follow if you want
// if you are on a team may be you adapt the same system but otherwise there is very few rules when it comes to this stuff
// $router->get('/sessions/create', 'controllers/sessions/create.php')->only('guest');
$router->get('/login', 'controllers/sessions/create.php')->only('guest');
$router->post('/sessions', 'controllers/sessions/store.php')->only('guest');
