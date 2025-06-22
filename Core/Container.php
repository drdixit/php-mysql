<?php

namespace Core;

class Container
{
    protected $bindings = [];

    // use Core\Database;
    // $config = require base_path('config.php');
    // $db = new Database($config['database']);
    // we are doing this so many times that we need to make a container
    // we need to store things in the container
    // we need to add things to the container
    // you can totally call this add() but just in case your future self might use a framework
    // we call this bind to add / bind things to the container
    public function bind($key, $resolver)
    {
        $this->bindings[$key] = $resolver;
    }
    // we need to remove / resolve things from the container
    // again we can totally call this remove() but just in case your future self might use a framework
    // we call this resolve() to remove / resolve things from the container
    // resolve to grab things out of the container
    public function resolve($key)
    {
        // $container->resolve('fsdfsdfs');
        if (! array_key_exists($key, $this->bindings)) {
            throw new \Exception("No matching binding found for {$key}");
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);

        // if it exists we don't need to check the condition
        // if (array_key_exists($key, $this->bindings)) {
        //     $resolver = $this->bindings[$key];

        //     return call_user_func($resolver);
        // }
    }
}
