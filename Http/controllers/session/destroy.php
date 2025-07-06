<?php

// this is quick fix only for episode 43
function logout()
{
    $_SESSION = []; // clear the session array
    session_destroy(); // destroy the session on the server

    $params = session_get_cookie_params(); // to grab the path and domain of the cookie
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']); // expire the session cookie

}

logout();

header('Location: /');
exit(); // or die

// // wrap this up in function logout()
// // log the user out.
// // all we would really need to do is destroy the session
// // may be clear out the session file, may be delete the session cookie
// // and finally just redirect the user to the home page
// $_SESSION = []; // clear the session array


// // what about the session file that stored on server
// session_destroy(); // destroy the session on the server

// // lot of people stick to this $_SESSION = []; // clear the session array
// // and session_destroy(); // destroy the session on the server
// // but we should also probably clear the session cookie that exists in the browser
// // and expiring a cookie is always little weird in my opinion
// // there is no easy way to just delete it you would have to update the cookie and set its corresponding expiration


// // to grab the path and domain of the cookie
// $params = session_get_cookie_params();

// // 3600 = 1 hour
// // you are setting it to some point in the past so it expires immediately
// setcookie('PHPSESSID', '', time() - 3600, '/', $params['path'], $params['domain'], $params['secure'], $params['httponly']); // expire the session cookie
