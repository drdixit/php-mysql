<?php
function dd($value)
{
    echo '<pre>';
    echo '<h1>Dump and Die</h1>';
    var_dump($value);
    echo '</pre>';
    die();
}
// dd($_SERVER['REQUEST_URI']);
// echo($_SERVER['REQUEST_URI']);

// if ($_SERVER['REQUEST_URI'] === '/contact.php') {
//     echo 'bg-gray-900 text-white';
// } else {
//     echo 'text-gray-300';
// }

// echo $_SERVER['REQUEST_URI'] === '/' ? 'bg-gray-900 text-white' : 'text-gray-300';

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function authorize($condition, $status = \Core\Response::FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [] ){
    // it accepts an array and turn them into set of variables
    // where the name of the variable is the key of the array
    // and the value of the variable is the value associated with the key
    extract($attributes);
    require base_path('views/' . $path);
}