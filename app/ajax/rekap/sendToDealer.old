<?php

require_once '../../db.php';

$sms 	= $_POST['sms'];
$dealer	= $db->fetch_row('SELECT * FROM member WHERE downline = ?', 0);
$send 	= [
    'DestinationNumber' => $dealer['nohp'],
    'TextDecoded'       => $sms,
    'CreatorID'         => 'Gammu'
];

$db->insert('outbox', $send);

echo json_encode(['message' => 'SMS berhasil disimpan. Menunggu antrian untuk dikirim!']);
