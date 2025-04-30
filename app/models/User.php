<?php

namespace App\Models;
use App\Core\Database;

class User extends Database
{
    private $conn;

    public function __construct()
    {
        $this->conn = $this->connect();
    }

    public function create($firstname, $lastname, $email, $password)
    {
        try {
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO usercreds_tb (firstname, lastname, email, password) VALUES (:fname, :lname, :email, :passw)";

            $stmt = $this->conn->prepare($query);

            // $stmt->bindParam(':fname', $firstname);
            // $stmt->bindParam(':lname', $lastname);
            // $stmt->bindParam(':email', $email);
            // $stmt->bindParam(':passw', $hashed);

            return $stmt->execute([':fname' => $firstname, ':lname' => $lastname, ':email' => $email, ':passw' => $hashed]);
        } catch (\PDOException $e) {
            echo $e->getMessage();

            return false;
        }

    }

    public function findByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM usercreds_tb WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM usercreds_tb";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return $stmt->fetchAll();
        }
    }

    public function findById($id)
    {
        $query = "SELECT * FROM usercreds_tb WHERE user_id = :user_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $id);

        if ($stmt->execute()) {
            return $stmt->fetch();
        }

    }
}