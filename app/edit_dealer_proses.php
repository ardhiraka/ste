<?php

require_once 'db.php';

$id 		= 1;
$posts 		= $_POST;
$userdata 	= ['nama', 'kodeid', 'nohp', 'deposit'];
$member		= [];
$member_config = [];
$dataDealer = $db->fetch_row("select * from member where id = ? and downline = ?", 1, 0);

foreach ($posts as $name => $value) :
    if (in_array($name, $userdata)) :
        $member[$name] = $value;
    else :
        $member_config[$name] = $value;
    endif;
endforeach;

$db->update('member', $member, ['id' => $id]);
$db->update('member_config', ['config' => json_encode($member_config)], ['member_id' => $id]);

$logActivity->setLog("Update data dealer {$dataDealer['nama']} [{$dataDealer['kodeid']}]");

return header('location: configdealer.php');