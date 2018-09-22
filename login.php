<?php

session_start();

require_once 'app/db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$isUser = $db->fetch_row('select * from admin where username = ?', $username);

if ($isUser) :
    $isUserValid = password_verify($password, $isUser['password']);

    if ($isUserValid) :
        $_SESSION['isLoggedIn'] = true;
        header('location:app');
    else :
        header('location:/?error=password');
    endif;
else :
    header('location:/?error=user');
endif;
