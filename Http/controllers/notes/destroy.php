<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
// created new static method and above is changed
// $db = App::container()->resolve(Database::class);

// $config = require base_path('config.php');
// $db = new Database($config['database']);

// or you can inline it too
// $db = App::container()->resolve(Core\Database::class);

// $db = App::container()->resolve('Core\Database');
// dd($db);

$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$db->query('delete from notes where id = :id', [
    'id' => $_POST['id']
]);

header('location: /notes');
exit();
