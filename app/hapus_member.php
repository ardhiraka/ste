<?php

require_once 'db.php';

$id = $_GET['id'];

$hapus = $db->delete('member', ['id' => $id]);

if ($hapus) :
	$db->delete('member_config', ['member_id' => $id]);
endif;

return header('location: config.php');