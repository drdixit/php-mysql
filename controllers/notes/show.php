<?php

$config = require(base_path('config.php'));
$db = new Database($config['database']);

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