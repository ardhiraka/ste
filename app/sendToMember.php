<?php

require_once 'db.php';

$member = $db->fetch_all("SELECT m.nama, m.nohp, sm.* FROM `smsout_member` AS sm LEFT JOIN `member` AS m ON m.id = sm.member_id WHERE sendToMember = 0 AND tgl = ?", date('Y-m-d'));

foreach ($member as $item) :
	$total      = abs($item['hasil']);
    $isNegative = $item['hasil'] < 0;
    $total      = ($isNegative ? '- Rp' : 'Rp') . number_format(($total * 1000), 0, ',', '.');
    $message    = "Win: {$item['win']}, Lose: {$item['lose']}, Total: {$total}";
    $send       = [
        'DestinationNumber' => $item['nohp'],
        'TextDecoded'       => $message,
        'CreatorID'         => 'Gammu'
    ];

    $insert = $db->insert('outbox', $send);

    if ($insert) :
    	$db->update('smsout_member', ['sendToMember' => 1], ['id' => $item['id']]);

        $logActivity->setLog("Send message to member");
    endif;
endforeach;

return header('location: smsout.php');