<?php

$config = require(base_path('config.php'));

use Core\Database;

$db = new Database($config['database']);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Deleting...";
}

// $heading = 'Note';
$currentUserId = 5;

$note = $db->query('SELECT * FROM notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();


authorize($note['user_id'] === $currentUserId);

// include base_path('views/notes/show.view.php');
view('notes/show.view.php', [
    'heading' => 'Note',
    'note' => $note
]);

// both is acceptable with : and without : no difference
// $notes = $db->query('SELECT * FROM notes where id = :id', ['id' => $id])->fetch();
// $notes = $db->query('SELECT * FROM notes where id = :id', [':id' => $id])->fetch();