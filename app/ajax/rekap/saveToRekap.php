<?php

require_once '../../db.php';

if (isset($_POST['save'])) :
	$data 	= $_POST['save'];
	$ids 	= $_POST['ids'];
	$insert = [];

	foreach ($data as $item) :
		$insert[] = [
			'kode' 		=> $item['kode'],
			'angka'		=> $item['angka'] == '-' ? null : $item['angka'],
			'nominal'	=> $item['nominal'],
			'win'		=> $item['win'],
			'lose'		=> $item['lose'],
			'tanggal'	=> date('Y-m-d')
		];
	endforeach;

	$db->insert('rekap', $insert);
	$db->query("update split set inRekap = 1 where id in (". implode($ids, ',') .")");

	echo json_encode(['status' => 'success']);
else :
	echo json_encode(['status' => 'error', 'error' => 'Tidak ada data!']);
endif;