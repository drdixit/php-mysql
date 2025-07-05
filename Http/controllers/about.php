<?php

// you cant use $_SESSION here because session_start() is not called
// you need to start the session then you can use session variables
// keep that in mind session variables are not available all the times
// it gets automatically destroyed when the session ends or you close the tab or browser
// 6:59:18
// session data is temporary
// dd($_SESSION['name']);

view("about.view.php", [
    'heading' => 'About Us',
]);