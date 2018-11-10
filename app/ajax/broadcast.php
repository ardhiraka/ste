<?php

require_once '../db.php';

$sms = $_POST['message'];
$numbers = $_POST['numbers'];

$bulk = [];

foreach ($numbers as $number) :
    $bulk[] = [
        'DestinationNumber' => $number,
        'TextDecoded'       => $sms,
        'CreatorID'         => 'Gammu'
    ];
endforeach;

$db->insert('outbox', $bulk);

echo json_encode(['status' => 'success']);