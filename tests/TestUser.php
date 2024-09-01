<?php

require __DIR__ . '/../config.php';
require_once __DIR__ . '/../core/Model.php';
require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../models/User.php';

function testRegisterUser() {
    $user = new User();
    $email = 'test@example.com';
    $username = 'testuser';
    $password = 'password123';

    $userId = $user->registerUser($email, $username, $password);
    assert(!empty($userId), 'Falha ao registrar usuário.');
}

function testCheckUser() {
    $user = new User();
    $email = 'test@example.com';
    $password = 'password123';

    $userData = $user->checkUser($email, $password);
    assert(!empty($userData), 'Falha ao verificar usuário.');
}