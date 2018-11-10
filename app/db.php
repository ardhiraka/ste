<?php

date_default_timezone_set('Asia/Jakarta');

require_once 'class/Machine.php';
require_once 'class/LogActivity.php';
require_once __DIR__.'/vendor/autoload.php';

use vielhuber\dbhelper\dbhelper;

if (Machine::validate()) :
    try {
        $db = new dbhelper();

        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'io_ste';

        $db->connect('pdo', 'mysql', $dbhost, $dbuser, $dbpass, $dbname, 3306);
        $logActivity = (new LogActivity)->setDbHelper($db);
    } catch (Exception $e) {
        header("location: /error/db.php");
    }

    function numToRupiah($number) {
    	$total 		= abs($number);
    	$isNegative = $number < 0;

    	return ($isNegative ? '- ' : '') . number_format(($total * 1000), 0, ',', '.');
    }
else :
    header("location: /error/machine.php");
endif;