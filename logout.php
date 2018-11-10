<?php

session_start();

require_once 'app/db.php';

$logActivity->setLog("{$_SESSION['username']} logged out");

session_destroy();

header('location:/');
