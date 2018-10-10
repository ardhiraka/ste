<?php

require_once 'db.php';

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

// for member downline
$member['downline'] = 2;

// save
$db->insert('member', $member);
$member_id = $db->last_insert_id();

$db->insert('member_config', ['member_id' => $member_id, 'config' => json_encode($member_config)]);

return header('location: config.php');