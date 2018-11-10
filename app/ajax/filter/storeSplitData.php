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
	$stored 	= $db->fetch_all("SELECT * FROM `split` WHERE member_id = ? AND tanggal = ? AND inbox_id IS NOT NULL GROUP BY inbox_id", $member['id'], date('Y-m-d'));
	$iNumber 	= count($stored) + 1;

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

	$deposit 	= $member['deposit'];
	$sisa 		= $deposit - $_POST['total'];

	if ($sisa < 0) :
		$response = ['status' => 'error', 'error' => 'Credit not available!'];
	else :
		$store = $db->insert('split', $inData);

		if ($store) :
			$logActivity->setLog("Message from {$member['nama']} [{$member['kodeid']}] submitted");
			
			$db->update('inbox', ['TextDecoded' => $_POST['new_message'],'isFiltered' => 1], ['ID' => $_POST['id']]);
			$db->update('member', ['deposit' => $sisa], ['id' => $member['id']]);

			if ($member['auto_reply']) :
				$db->insert('outbox', [
					'DestinationNumber' => $member['nohp'],
					'TextDecoded'       => "SMS OK [{$iNumber}]",
					'CreatorID'         => 'Gammu'
				]);
			endif;
		else :
			$response = ['status' => 'error', 'error' => 'Gagal menyimpan!'];
		endif;
	endif;
else :
	$response = ['status' => 'error', 'error' => 'Message has been submitted!'];
endif;

echo json_encode($response);
