<?php

date_default_timezone_set('Asia/Jakarta');

require __DIR__.'/vendor/autoload.php';

use vielhuber\dbhelper\dbhelper;

$db = new dbhelper();

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'project_io';

$db->connect('pdo', 'mysql', $dbhost, $dbuser, $dbpass, $dbname, 3306);

function numToRupiah($number) {
	$total 		= abs($number);
	$isNegative = $number < 0;

	return ($isNegative ? '- ' : '') . number_format(($total * 1000), 0, ',', '.');
}