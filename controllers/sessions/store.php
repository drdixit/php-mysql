<?php

// log in the user if the credentials match.

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

// validate the form inputs.
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please enter a valid email address.';
}

if (!Validator::string($password)) {
    $errors['password'] = 'Please provide a valid password.';
}

if (! empty($errors)) {
    return view('/sessions/create.view.php', [
        'errors' => $errors
    ]);
}

// match the credentials with the database.

$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

// dd($user);

// if (! $user) {
//     return view('/sessions/create.view.php', [
//         'errors' => [
//             'email' => 'No matching account found for that email address.'
//         ]
//     ]);
// }

// we have a user,but we don't know if the password provided matches what we have in the database.
// its not simple like that because we store hash
// if ($user['password' === $password]) {}

// if (password_verify($password, $user['password'])) {
//     login([
//         'email' => $email,
//     ]);

//     header('Location: /');
//     exit(); // or die
// }
// // else {
// //     // i can do else for otherwise
// //     // in this case i use exit so i don't need to use else
// // the else statement is little superfluous here i don't need to do it
// // }

if (! $user) {
    // if we found the corresponding user then we do the check
    if (password_verify($password, $user['password'])) {
        login([
            'email' => $email,
        ]);

        header('Location: /');
        exit(); // or die
    }
}

// otherwise there was no user or if there was a user but the password didn't match
// it gets us around , it allows us to skirt around the issue of us letting the user check if there are certain email addresses in our database.

return view('/sessions/create.view.php', [
    'errors' => [
        'email' => 'No matching account found for that email address and password.'
    ]
]);
