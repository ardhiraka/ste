<?php

if (!$_POST || empty($_POST['ids'])) header('location:laporan.php');

include('header.php');

$tipe 	= $_POST['tipe'];
$ids  	= $_POST['ids'];
$jumlah = $_POST['jumlah'];
$list 	= $db->fetch_all("SELECT * FROM rekap WHERE id IN ({$ids}) AND subtraction = 0");

foreach ($list as $item) :
	$nominal 	= $item['nominal'];
	$nom_makan 	= 0;
	$nom_dealer	= 0;

	if ($tipe == 'nominal') :
		$nom_makan 	= ($jumlah >= $nominal) ? $nominal : $jumlah;
		$sisa 		= $nominal - $jumlah;
		$nom_dealer = $sisa <= 0 ? 0 : $sisa;
	elseif ($tipe == 'persen') :
		$jumlah 	= ($jumlah >= 100) ? 100 : $jumlah;
		$nom_makan 	= ceil($nominal * ($jumlah / 100));
		$sisa 		= $nominal - $nom_makan;
		$nom_dealer = $sisa <= 0 ? 0 : $sisa;
	endif;

	$db->update('rekap', ['nom_makan' => $nom_makan, 'nom_dealer' => $nom_dealer, 'subtraction' => 1], ['id' => $item['id']]);
endforeach;

header("location: laporan.php?tab={$_POST['tab']}");