<?php

namespace Core;

use \PDO;

// Connect to the database and execute a query.
// whenever you have php file that only contains a class, it's common to name it the same as the class.
// general conventions that says make first latter uppercase.

class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = 'password')
    {

        // this is a function that takes an associative array and converts it to a query string.
        // http_build_query($data);// example.com?host=localhost&port=3306&dbname=testdb&charset=utf8mb4
        // dd('mysql:' . http_build_query($config, '', ';')); // host=localhost;port=3306;dbname=testdb;charset=utf8mb4

        $dsn = 'mysql:' . http_build_query($config, '', ';'); // host=localhost;port=3306;dbname=testdb;charset=utf8mb4

        // This is automatically called when you create a new instance of the class.
        // both are same
        // $dsn = 'mysql:' . http_build_query($config, '', ';');
        // $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";

        //$this for this instance of the class
        // we apply namespace at the top of the file so PDO is undefined because
        // it look for PDO class in this namespace (Core i mean)
        // the way it works is unless you specify otherwise, it looks in this namespace
        // every single class referenced in this file assume the namespace at the top
        // in this case PDO is assuming \Core\PDO which doesn't exist
        // $this->connection = new PDO($dsn, $username, $password, [
        //     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        // ]);
        // we solve that by
        // if we want to reference something in from global root
        // we do something like this \PDO
        // \PDO start at the root and look for PDO class
        // PDO start within whatever namespace you are currently in and then look for PDO class
        // we can do this
        // $this->connection = new \PDO($dsn, $username, $password, [
        //     \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        // ]);
        // or we can just use the PDO class
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {

        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        // return $statement;
        return $this;
    }

    public function find()
    {
        // $statement->fetch();
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (! $result) {
            abort();
        }

        return $result;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }
}

// $posts = $db->query('select * from posts');
// foreach ($posts as $post) {
//     echo '<li>' . $post['title'] . '</li>';
// }

// this class expect an argument
// new PDO($dsn);
// => dsn stands for Data Source Name
// think of that as a connection string:a string that declares your connection to the database

// class Person
// {
//     public $name;
//     public $age;

//     // Functions with in a class are called methods.
//     // Technically you don't have to do public function breathe()
//     // because the default visibility is public.
//     // it's just common practice to be explicit.
//     // just follow practices like being explicit with visibility

//     public function breathe()
//     {
//         echo $this->name . ' is breathing!';
//     }
// }

// $person = new Person();
// $person->name = 'John';
// $person->age = 30;

// $person->breathe();

// return $statement->fetchAll(PDO::FETCH_ASSOC);
// return $statement->fetch(PDO::FETCH_ASSOC);
// $post = $db->query('select * from posts where id = 1')->fetch(PDO::FETCH_ASSOC);
// $posts = $db->query('select * from posts')->fetchAll(PDO::FETCH_ASSOC);