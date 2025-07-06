<?php

namespace Core;


class Session
{

    public static function has($key)
    {
        return (bool) static::get($key);
    }

    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        // let's do this, when you get a key let's first see if you have flashed that key to the session
        // and if you have that very likely is the one you want and if it's not flashed to the session
        // then we will fallback and look for at the top level of the session super global
        // if(isset($_SESSION['_flash'][$key])) {
        //     return $_SESSION['_flash'][$key];
        // }
        // return $_SESSION[$key] ?? $default;
        // it's fine but we perform very quick refactor here

        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function flash($key, $value)
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash()
    {
        // $_SESSION['_flash'] = [];
        // or
        unset($_SESSION['_flash']);
    }

    public static function flush()
    {
        $_SESSION = [];
    }

    public static function destroy()
    {
        // $_SESSION = []; // clear the session array
        // Session::flush();
        // we are already in the session class so
        static::flush();
        session_destroy(); // destroy the session on the server

        // $params = session_get_cookie_params(); // to grab the path and domain of the cookie
        // setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']); // expire the session cookie
        // $_SESSION = []; // clear the session array
        // Session::flush();
        // session_destroy(); // destroy the session on the server

        $params = session_get_cookie_params(); // to grab the path and domain of the cookie
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']); // expire the session cookie
    }
}
