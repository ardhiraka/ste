<?php

require_once 'db.php';

$id 		= $_GET['id'];
$posts 		= $_POST;
$userdata 	= ['nama', 'kodeid', 'nohp', 'deposit', 'auto_reply'];
$member		= [];
$member_config = [];
$dataMember = $db->fetch_row("select * from member where id = ?", $id);

foreach ($posts as $name => $value) :
    if (in_array($name, $userdata)) :
        $member[$name] = $value;
    else :
        $member_config[$name] = $value;
    endif;
endforeach;

$db->update('member', $member, ['id' => $id]);
$db->update('member_config', ['config' => json_encode($member_config)], ['member_id' => $id]);

$logActivity->setLog("Update data member {$dataMember['nama']} [{$dataMember['kodeid']}]");

return header('location: config.php');