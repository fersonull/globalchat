<?php

namespace App\Classes;
use App\Classes\Database;

class User extends Database
{
    private $conn;

    public function __construct()
    {
        $this->conn = $this->connect();
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM usercreds_tb";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return $stmt->fetchAll();
        }
    }

    public function getUser($id)
    {
        $query = "SELECT * FROM usercreds_tb WHERE user_id = :user_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $id);

        if ($stmt->execute()) {
            return $stmt->fetch();
        }

    }
}