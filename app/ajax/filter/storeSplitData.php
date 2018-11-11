<?php

require_once '../../db.php';

$response   = ['status' => 'success'];
$type 		= $_POST['type'];

if ($type == 'manual') :
	$db->insert('inbox', [
		'ReceivingDateTime' => date('Y-m-d H:i:s'),
		'Text'				=> '',
		'UDH'				=> 'manual',
		'SenderNumber'		=> $_POST['number'],
		'TextDecoded'		=> $_POST['new_message'],
		'RecipientID'		=> '',
		'isFiltered'		=> 1
	]);

	$inboxID = $db->last_insert_id();
else :
	$inboxID = $_POST['id'];
endif;

$checkInDB  = $db->fetch_all('select * from split where inbox_id = ?', $inboxID);
$isNotExist = count($checkInDB) > 0 ? false : true;

if ($isNotExist) :
	$dateTime 	= date('Y-m-d');
	$results 	= $_POST['result'];
	$inData 	= [];
	$inbox  	= $db->fetch_row('select * from inbox where ID = ?', $inboxID);
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
			$logActivity->setLog("[{$type}] Message from {$member['nama']} [{$member['kodeid']}] submitted");
			
			$db->update('inbox', ['TextDecoded' => $_POST['new_message'],'isFiltered' => 1], ['ID' => $inboxID]);
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
