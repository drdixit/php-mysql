<?php

class Validator
{
    // this method is what we call a pure function
    // A pure function is a function that is not contention or dependent upon state or values from the outside world.
    // and we can make pure functions a static function
    // and we can call them without creating an instance of the class
    // like this if (! Validator::string($_POST['body'], 1, 1000)) {}
    // NOTE: you can't call non-static method with ::
    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value)
    {
        // Validator::email('user@example.com');
        // NOTE: you can do this with very dramatic regular expressions
        // instead we are gonna use PHP's built-in filter_var function
        // this gives us to sanitize and validate strings in number of ways
        // invalid email return false, valid email return the email address
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
