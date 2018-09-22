<?php

function generatePassword($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 11]);
}

// echo generatePassword('aris');

$password = '$2y$11$S5rO.3tznE4jZEtXvJp4C.AAQGhjO0r9xcDC0iEkr5wey3dyZRPEy';

var_dump(password_verify('aris', $password));
