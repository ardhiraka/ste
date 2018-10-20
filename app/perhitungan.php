<?php

require_once 'class/Hitung.php';
require_once 'db.php';

$winNumber = 1468;

// Data Rekap
$hitung = new Hitung;
$hitung->for('dealer')->setDBHelper($db)->setWinNumber($winNumber)->exec();
// Data Rekap