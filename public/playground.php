<?php

use Illuminate\Support\Collection;

require __DIR__.'/../vendor/autoload.php';


$numbers = new Collection([
    1, 2, 3, 4, 5, 6, 7, 8, 9, 10
]);

// we will provide a callable
// this callable will trigger for each item in the collection
$lessThanOrEqualTo5 = $numbers->filter(function ($number) {
    return $number <= 5;
});

var_dump($lessThanOrEqualTo5);

// die(var_dump($numbers));

// if ($numbers->contains(10)){
//     die('it contains 10');
// }

// notice this ultimately is going to be running php's array_map function
// $numbers->map

// $numbers->filter
// if i call filter, it's ultimately deferring to php's array_filter function


// if you want it to you can contract your own collection class
// this is where it all comes back to other then the learning purposes
// is it a good use of your time to build up your own collection class
// or would it instead be better to leverage something that has been literally pulled in millions of times
// and has been debugged hundreds and hundreds of times and improved hundreds and hundreds of times
// any you get that all for free
// so it's a good bank for your buck