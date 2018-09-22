<?php

require_once '../../db.php';

$sms = $_POST['sms_id'];
$list = $db->fetch_all("select so.*, m.nohp from sms_out as so left join member as m on m.id = so.member_id where so.id in ({$sms})");

foreach ($list as $data) :
    $total      = abs($data['total']);
    $isNegative = $data['total'] < 0;
    $total      = ($isNegative ? '- Rp' : 'Rp') . number_format(($total * 1000), 0, ',', '.');
    $message    = "Win: {$data['win']}, Lose: {$data['lose']}, Total: {$total}";
    $send       = [
        'DestinationNumber' => $data['nohp'],
        'TextDecoded'       => $message,
        'CreatorID'         => 'Gammu'
    ];

    $db->insert('outbox', $send);
endforeach;

echo json_encode(['message' => 'SMS berhasil disimpan. Menunggu antrian untuk dikirim!']);
