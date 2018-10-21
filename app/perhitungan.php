<?php

if (!$_POST)
    return header('location:smsout.php');

require_once 'class/Hitung.php';
require_once 'db.php';

// $winNumber = 1468;

$number = (string) $_POST['win_number'];

if (isset($_SERVER['HTTP_REFERER'])) :
    $url  = (object) parse_url($_SERVER['HTTP_REFERER']);
    $prev = "{$url->scheme}://{$url->host}{$url->path}";
else :
    $prev = 'index.php';
endif;

if (!is_numeric($number)) :
    return header('location: ' . $prev . "?error=numeric");
elseif (strlen($number) != 4) :
    return header('location: ' . $prev . "?error=length");
endif;

// Data Rekap
// $hitungRekap = new Hitung;
// $hitungRekap->for('dealer')->setDBHelper($db)->setWinNumber($winNumber)->exec();
// Data Rekap

// Data Member
// $hitungMember = new Hitung;
// $hitungMember->for('member')->setDBHelper($db)->setWinNumber($winNumber)->exec();
// Data Member

return header('location: ' . $prev . "?success=true");