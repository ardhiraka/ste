<?php

if (!$_POST)
    return header('location:smsout.php');

require_once 'session.php';
require_once 'class/Hitung.php';
require_once 'db.php';

$number = (string) $_POST['win_number'];

if (isset($_SERVER['HTTP_REFERER'])) :
    $prev = "smsout.php";
else :
    $prev = 'index.php';
endif;

if (!is_numeric($number)) :
    return header('location: ' . $prev . "?error=numeric");
elseif (strlen($number) != 4) :
    return header('location: ' . $prev . "?error=length");
endif;

$log = $db->fetch_all("SELECT * FROM `log_hitung` WHERE tgl = ?", date('Y-m-d'));

if (count($log) <= 2) :
	// Save new win number
	$db->update('admin', ['win_number' => $number], ['id' => $_SESSION['uid']]);

	// Data Member
	$hitungMember = new Hitung;
	$hitungMember->for('member')->setDBHelper($db)->setWinNumber($number)->exec();
	// Data Member

	// Data Rekap
	$hitungRekap = new Hitung;
	$hitungRekap->for('dealer')->setDBHelper($db)->setWinNumber($number)->setTotalFromMember($hitungMember->getTotal())->exec();
	// Data Rekap

	if ($hitungRekap->log) :
		(new Hitung)->setDBHelper($db)->saveLog();
	endif;

    $logActivity->setLog("Calculation message with win number = {$number}");
else :
	return header('location: ' . $prev . "?error=max");
endif;

return header('location: ' . $prev . "?success=true");