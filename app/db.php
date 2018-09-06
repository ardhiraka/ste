<?php

date_default_timezone_set('Asia/Jakarta');

require __DIR__.'/vendor/autoload.php';

use vielhuber\dbhelper\dbhelper;

$db = new dbhelper();

$dbhost = 'localhost';
$dbuser = 'u339776760_ardhi';
$dbpass = 'seruni';
$dbname = 'u339776760_ste';

$db->connect('pdo', 'mysql', $dbhost, $dbuser, $dbpass, $dbname, 3306);
