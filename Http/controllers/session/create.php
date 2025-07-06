<?php

use Core\Session;


view('session/create.view.php',[
    // 'errors' => $_SESSION['_flash']['errors'] ?? []
    // this don't work
    // 'errors' => Session::get('errors')
    // 'errors' => Session::get('_flash.errors')
    // i don't want to do that because i don't want that to leak out _flash unique out of the session class
    'errors' => Session::get('errors')
]);