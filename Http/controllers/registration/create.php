<?php

// if user already logged in, redirect to home page
// you don't want to allow logged-in users to access the registration page
// copy and paste this code in every controller that needs to restrict access
// or we can takel it at route level
// this code is added to Router.php
// if ($_SESSION['user'] ?? false) {
//     header('Location: /');
//     exit();
// }

view('registration/create.view.php');