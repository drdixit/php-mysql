<?php

// log in the user if the credentials match.

// use Core\App;
use Core\Authenticator;
// use Core\Database;
// use Core\Validator;
use Http\Forms\LoginForm;

// $db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {
    // $auth = new Authenticator();
    // if you are not passing constructor parameters then you can omit the ()
    // if ((new Authenticator)->attempt($email, $password)) {
    if ((new Authenticator())->attempt($email, $password)) {
        redirect('/');
    }

    $form->error('email', 'No matching account found for that email address and password.');
}

return view('session/create.view.php', [
    'errors' => $form->errors()
]);

// return view('session/create.view.php', [
//     'errors' => [
//         'email' => 'No matching account found for that email address and password.'
//     ]
// ]);


// both options are right, it's just do it the way that time it feels right.
// sometimes one options feels right, sometimes the other.
// do it what feels right at that time.
// if ($auth->attempt($email, $password)) {
//     // if the credentials match, we log in the user
//     // and redirect them to the home page
//     redirect('/'); // this is a helper function that redirects to the home page
//     // header('Location: /');
//     // exit(); // or die
// } else {
//     // we don't move this to the Authenticator class is not responsible for rendering views
//     return view('session/create.view.php', [
//         'errors' => [
//             'email' => 'No matching account found for that email address and password.'
//         ]
//     ]);
// }
// if we redirect we kill the script so there is no need to use else statement
// this is just a style choice, you can use else if you want





// validate the form inputs.
// $errors = [];
// if (!Validator::email($email)) {
//     $errors['email'] = 'Please enter a valid email address.';
// }

// if (!Validator::string($password)) {
//     $errors['password'] = 'Please provide a valid password.';
// }

// if (! empty($errors)) {
//     return view('session/create.view.php', [
//         'errors' => $errors
//     ]);
// }

// match the credentials with the database.

// $user = $db->query('SELECT * FROM users WHERE email = :email', [
//     'email' => $email
// ])->find();

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

// if ($user) {
//     // if we found the corresponding user then we do the check
//     if (password_verify($password, $user['password'])) {
//         login([
//             'email' => $email,
//         ]);

//         header('Location: /');
//         exit(); // or die
//     }
// }

// otherwise there was no user or if there was a user but the password didn't match
// it gets us around , it allows us to skirt around the issue of us letting the user check if there are certain email addresses in our database.
// return view('session/create.view.php', [
//     'errors' => [
//         'email' => 'No matching account found for that email address and password.'
//     ]
// ]);
