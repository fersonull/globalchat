<?php
require __DIR__ . '/vendor/autoload.php';
use App\Classes\User;

$user = new User();

$res = $user->getAllUsers();

// foreach ($res as $user) {
//     echo $user['email'];
// }

$user1 = $user->getUser(1000);

print_r($user1);