<?php

namespace Core\Middleware;

class Middleware
{
    // we create some kind of map
    public const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public static function resolve($key)
    {
        if (! $key) {
            return; // if no middleware is specified, just return
        }

        // static means use the current instance (late static binding)
        $middleware = static::MAP[$key] ?? false;

        if (! $middleware) {
            throw new \Exception("No matching middleware found for key '{$key}'.");
        }

        (new $middleware)->handle();
    }
}
