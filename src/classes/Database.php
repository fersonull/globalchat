<?php

namespace App\Classes;

class Database
{
    private $host = 'localhost';
    private $username = 'root';
    private $dbname = 'globalchat_db';
    private $password = '';
    private $conn;

    public function connect()
    {
        $this->conn = null;

        $dsn = "mysql:host=$this->host;dbname=$this->dbname";

        try {
            $this->conn = new \PDO($dsn, $this->username, $this->password, [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]);

        } catch (\PDOException $err) {
            echo "error " . $err->getMessage();
        }

        return $this->conn;
    }
}