<?php

namespace Core;

class ValidationException extends \Exception
{
    // protected $errors = [];
    // protected $old = [];
    // we cant directly access protected properties from outside the class
    // option 1 make it public
    // option 2 so we need to create a getter method to access the old data
    // public function errors()
    // {
    //     return $this->errors;
    // }
    // another option is declare it public but you can also say readonly
    // public readonly array $errors;
    // which means we can assign it only once and we can never update its value
    public readonly array $errors;
    public readonly array $old;

    public static function throw($errors, $old)
    {
        $instance = new static;

        $instance->errors = $errors;
        $instance->old = $old;

        throw $instance;
    }

}
