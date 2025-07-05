<?php

namespace Core;

use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Middleware\Middleware;

class Router
{
    protected $routes = [];

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }

    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function only($key)
    {
        // what we need to do is grab the last route that was added
        // and set its middleware to the key that was passed in
        // this is a very simple way to do it, but it works
        // there are several ways to do this, but this is the simplest
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                // apply middleware if it exists
                // if ($route['middleware'] === 'guest') {
                //     if($_SESSION['user'] ?? false) {
                //         header('Location: /');
                //         exit(); // or die
                //     }
                // }
                // if ($route['middleware'] === 'auth') {
                //     if(! $_SESSION['user'] ?? false) {
                //         header('Location: /');
                //         exit(); // or die
                //     }
                // }
                // this is pretty sloppy, instead what if the handlers of each of these
                // stored in a separate file, and we just require that file

                // this is more dynamic way of handling middleware that is we are handling below in comment
                // null handling
                Middleware::resolve($route['middleware']);
                // added below handling in Router.php
                // if ($route['middleware']) {
                //     $middleware = Middleware::MAP[$route['middleware']];
                //     (new $middleware)->handle();
                // }

                // if ($route['middleware'] === 'guest') {
                //     (new Guest)->handle();
                // }
                // if ($route['middleware'] === 'auth') {
                //     (new Auth)->handle();
                // }

                // if later we need to add more middleware, we need to do this
                // and its not look good we could simplify this
                // its sound like we are associating a key with a corresponding middleware class
                // so the guest key points to the Guest class
                // the auth key points to the Auth class
                // something like that
                // so why don't we setup some kind of lookup table
                // lets add some kind of parent class called Middleware
                // if ($route['middleware'] === 'email-confirmed') {
                //     (new ConfirmedEmail)->handle();
                // }
                return require base_path('Http/controllers/' . $route['controller']);
            }
        }

        $this->abort();
    }

    protected function abort($code = 404)
    {
        http_response_code($code);

        require base_path("views/{$code}.php");

        die();
    }
}
