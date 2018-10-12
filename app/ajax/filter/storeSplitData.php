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

	foreach ($results as $format => $result) :
		list($theForm, $thePrice) = explode('@', $format);

		if (array_key_exists('win', $result) || array_key_exists('lose', $result)) :
			$expl 		= explode(';', $theForm);
			$theCode	= $expl[0];
			$theNumber 	= count($expl) > 1 ? $expl[1] : null;
			$isWin 		= isset($result['win']);
			$isLose		= isset($result['lose']);

			$inData[] = [
				'member_id' => $member['id'],
				'inbox_id'  => $inbox['ID'],
				'kode'		=> $theCode,
				'nominal'	=> $thePrice,
				'angka'		=> $theNumber,
				'win'		=> $isWin ? count($result['win']) : 0,
				'lose'		=> $isLose ? count($result['lose']) : 0,
				'tanggal'	=> $dateTime
			];
		else :
			// 2D, 3D, 4D
			$number[$format] = [];

			foreach ($result as $kode => $item) :
				$isWin 	= isset($item['win']);
				$isLose	= isset($item['lose']);

				if ($isWin) :
					$number[$format][$kode] = join($item['win'], '.');
				endif;

				if ($isLose) :
					$number[$format][$kode] = join($item['lose'], '.');
				endif;

				$inData[] = [
					'member_id' => $member['id'],
	                'inbox_id'  => $inbox['ID'],
					'kode'		=> $kode,
					'nominal'	=> $thePrice,
					'angka'		=> $number[$format][$kode],
					'win'		=> $isWin ? count($item['win']) : 0,
					'lose'		=> $isLose ? count($item['lose']) : 0,
					'tanggal'	=> $dateTime
				];
			endforeach;
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
