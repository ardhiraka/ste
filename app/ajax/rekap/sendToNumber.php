<?php

require_once '../../db.php';

$sms = $_POST['sms'];
$send = [
    'DestinationNumber' => '+6289647793930',
    'TextDecoded'       => $sms,
    'CreatorID'         => 'Gammu'
];

$db->insert('outbox', $send);

echo json_encode(['message' => 'SMS berhasil disimpan. Menunggu antrian untuk dikirim!']);
