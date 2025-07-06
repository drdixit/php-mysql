<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function validate($email, $password)
    {
        // validate the form inputs.

        if (!Validator::email($email)) {
            $this->errors['email'] = 'Please enter a valid email address.';
        }

        if (!Validator::string($password)) {
            $this->errors['password'] = 'Please provide a valid password.';
        }

        // this return $errors array but we want boolean value
        return empty($this->errors);
    }

    // this is a getter method to access the errors
    // we can use this method to get the errors after validation
    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;
    }
}