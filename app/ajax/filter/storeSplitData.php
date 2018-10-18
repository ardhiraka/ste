<?php

require_once '../../db.php';

$checkInDB  = $db->fetch_all('select * from split where inbox_id = ?', $_POST['id']);
$isNotExist = count($checkInDB) > 0 ? false : true;
$response   = ['status' => 'success'];

if ($isNotExist) :
	$dateTime 	= date('Y-m-d');
	$results 	= $_POST['result'];
	$inData 	= [];
	$inbox  	= $db->fetch_row('select * from inbox where ID = ?', $_POST['id']);
	$member 	= $db->fetch_row('select * from member where nohp = ?', $inbox['SenderNumber']);

	foreach ($results as $kode => $value) :
		if (is_array($value)) :
			foreach ($value as $angka => $nominal) :
				$inData[] = [
					'member_id' => $member['id'],
					'inbox_id'  => $inbox['ID'],
					'kode'		=> $kode,
					'kode'		=> explode('.', $kode)[0],
					'nominal'	=> $nominal,
					'angka'		=> $angka,
					'tanggal'	=> $dateTime
				];
			endforeach;
		else :
			$inData[] = [
				'member_id' => $member['id'],
				'inbox_id'  => $inbox['ID'],
				'kode'		=> $kode,
				'nominal'	=> $value,
				'angka'		=> null,
				'tanggal'	=> $dateTime
			];
		endif;
	endforeach;

	$store = $db->insert('split', $inData);

	if ($store) :
		$db->update('inbox', ['isFiltered' => 1], ['ID' => $_POST['id']]);
	else :
		$response = ['status' => 'error', 'error' => 'Gagal menyimpan!'];
	endif;
else :
	$response = ['status' => 'error', 'error' => 'Pesan sudah disumbit!'];
endif;

echo json_encode($response);
