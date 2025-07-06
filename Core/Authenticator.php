<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        // there is no db class anymore we can do dependency injection
        // but for just now lets do this
        $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [
            'email' => $email
        ])->find();

        if ($user) {
            // if we found the corresponding user then we do the check
            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email,
                ]);

                return true; // if the password matches, we log in the user and return true
            }
        }

        return false; // if we didn't find the user or the password didn't match, return false
    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email']
            // 'name' => $user['name'],
        ];

        // generate a new session ID and true means that the old session data will be deleted
        session_regenerate_id(true); // regenerate the session ID to prevent session fixation attacks
    }

    public function logout()
    {
        // $_SESSION = []; // clear the session array
        // Session::flush();
        // session_destroy(); // destroy the session on the server

        // $params = session_get_cookie_params(); // to grab the path and domain of the cookie
        // setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']); // expire the session cookie

        Session::destroy();
    }
}
