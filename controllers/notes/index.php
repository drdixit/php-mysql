<?php

// you can do something like this or use keyword
// $db = new Core\Database($config['database']);
use Core\Database;

$config = require(base_path('config.php'));
$db = new Database($config['database']);

// $heading = 'My Notes';

$notes = $db->query('SELECT * FROM notes where user_id = 5')->get();

// include base_path('views/notes/index.view.php');

// turns out i don't need to access $config and $db variable from my views
// before this refactor you could do that
// now this two variables are only available inside our view
view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes' => $notes
]);