<?php

require_once 'db.php';

$ids = $_POST['ids'];
$tab = $_POST['tab'];

$prepare = $db->fetch_all("SELECT kode, group_concat(angka SEPARATOR '.') as angka, nom_dealer FROM rekap WHERE id IN ({$ids}) AND isProcessed = 0 GROUP BY nom_dealer,kode ORDER BY cast(nom_dealer as SIGNED) DESC");

$message = "";
foreach ($prepare as $ob) :
	if (in_array($ob['kode'], ['2D', '3D', '4D'])) :
		$message .= "{$ob['angka']}@{$ob['nom_dealer']} ";
	else :
		if (is_null($ob['angka'])) :
			$message .= "{$ob['kode']}@{$ob['nom_dealer']} ";
		else :
			$message .= "{$ob['kode']};{$ob['angka']}@{$ob['nom_dealer']} ";
		endif;
	endif;
endforeach;
$message = rtrim($message, ' ');

$dealer	= $db->fetch_row('SELECT * FROM member WHERE downline = ?', 0);
$send 	= [
    'DestinationNumber' => $dealer['nohp'],
    'TextDecoded'       => $message,
    'CreatorID'         => 'Gammu'
];

$db->insert('outbox', $send);

$db->query("UPDATE rekap SET isProcessed = 1 WHERE id IN ({$ids}) AND isProcessed = 0");

header("location: laporan.php?tab={$tab}");