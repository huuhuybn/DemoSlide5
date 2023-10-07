<?php

namespace Huuhuy\DemoSlide5;
class DBConnection
{
    private $connection;

    public function connect(){
        $host = $_ENV['DB_HOST'];
        $dbname= $_ENV['DB_NAME'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];;
        $this->connection =
            new \PDO("mysql:host=$host; dbname=$dbname; charset=utf8",
                $username, $password);  // thực hiện kết nối đến database
        return $this->connection;
    }
}