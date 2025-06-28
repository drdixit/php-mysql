<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];


// validate the form inputs.
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please enter a valid email address.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password with at least 7 characters.';
}

if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);
// check if the account already exists.
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

// dd($user);
if ($user) {
    // then someone with their email already exists and has an account.
    // If yes, redirect to the login page.
    header('Location: /');
    exit(); // or die
} else {
    // If no, save one to database, and then log the user in, and redirect.
    $db->query('INSERT INTO users (email, password, name) VALUES (:email, :password, :name)', [
        ':email' => $email,
        ':password' => $password,
        ':name' => 'test'
    ]);

    // mark that the user is logged in.
    // you can also use something like this to store the user id in the session.
    // $_SESSION['logged_id'];
    // but we are gonna take this route
    // or may be you add multiple values like below helper
    // $_SESSION['logged_in'] = true;
    $_SESSION['user'] = [
        'email' => $email,
    ];

    header('Location: /');
    exit(); // or die
}