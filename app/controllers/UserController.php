<?php
namespace App\Controllers;
use App\Models\User;

class UserController
{
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function register($post)
    {
        $fname = $post['fname'] ?? '';
        $lname = $post['lname'] ?? '';
        $email = $post['email'] ?? '';
        $password = $post['password'] ?? '';

        if (empty($fname) || empty($lname) || empty($email) || empty($password)) {
            return 'empty';
        }

        if ($this->userModel->findByEmail($email)) {
            return 'Email already taken';
        }

        if ($this->userModel->create($fname, $lname, $email, $password)) {
            return 'sakses';
        }

        return 'may mali, pero hindi knows';
    }
}