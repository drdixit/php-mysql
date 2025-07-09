<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    // public $attributes;
    protected $errors = [];


    // we have a way to perform validation
    public function __construct(public array $attributes)
    {
        // $this->attributes = $attributes;
        // or in php 8 we can directly assign the attributes from the constructor
        // you can also do it like this too
        // if (!Validator::email($this->attributes['email'])) {
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please enter a valid email address.';
        }

        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Please provide a valid password.';
        }

    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;

        // these two can be combined
        // if ($instance->failed()) {
        //     // throw new ValidationException();
        //     // ValidationException::throw($instance->errors(), $instance->attributes);
        //     $instance->throw();
        // }

        // // what if the form is valid?
        // return $instance;

    }

    // now we have a way to throw the validation exception
    public function throw()
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function failed()
    {
        return count($this->errors);
    }

    // this is a getter method to access the errors
    // we can use this method to get the errors after validation
    public function errors()
    {
        return $this->errors;
    }

    // we have a way to manually add an error to the validation errors list
    public function error($field, $message)
    {
        $this->errors[$field] = $message;

        return $this;
    }
}