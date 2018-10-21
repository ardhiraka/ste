<?php

require_once 'db.php';

$id 		= 1;
$posts 		= $_POST;
$userdata 	= ['nama', 'kodeid', 'nohp', 'deposit'];
$member		= [];
$member_config = [];

foreach ($posts as $name => $value) :
    if (in_array($name, $userdata)) :
        $member[$name] = $value;
    else :
        $member_config[$name] = $value;
    endif;
endforeach;

$db->update('member', $member, ['id' => $id]);
$db->update('member_config', ['config' => json_encode($member_config)], ['member_id' => $id]);

return header('location: configdealer.php');