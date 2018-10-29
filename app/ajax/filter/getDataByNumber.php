<?php

require_once '../../db.php';

$number	= str_replace('_', '+', $_POST['number']);
$data 	= $db->fetch_row("SELECT * FROM `member` WHERE nohp = ?", $number);
$config	= $db->fetch_row("SELECT * FROM `member_config` WHERE member_id = ?", $data['id']);

echo json_encode(['data' => $data, 'config' => json_decode($config['config'])]);
