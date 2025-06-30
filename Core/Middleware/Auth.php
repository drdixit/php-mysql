<?php

namespace Core\Middleware;

class Auth
{
    // notice how each one has similar method that sort of means the'r confirming to a similar contract
    // and that contract states that
    // each of middleware classes provides a handle method
    // that can be called to determine and evaluate whether
    // the request can further continue to the core of your application
    // the request should be allowed to proceed or not
    public function handle()
    {
        if (! $_SESSION['user'] ?? false) {
            header('Location: /');
            exit(); // or die
        }
    }
}
