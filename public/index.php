<?php

// this is good way to show errors in php just set this values
// and you don't need to change php.ini file
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// const BASE_PATH = __DIR__ . '/../';
const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'functions.php';
require base_path('Database.php');
require base_path('Response.php');
require base_path('router.php');







// $config = require('config.php');
// $db = new Database($config['database']);
// $id = $_GET['id'];

// $query = "select * from posts where id = :id";
// $post = $db->query($query, [':id' => $id])->fetchAll();
// dd($post);

// $query = "select * from posts where id = ?";
// $post = $db->query($query, [$id])->fetchAll();
// or you could use :id
// $query = "select * from posts where id = :id";
// $post = $db->query($query, ['id' => $id])->fetchAll();
// both of them are same
// $post = $db->query($query, [':id' => $id])->fetchAll();