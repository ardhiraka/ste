<?php

header('Content-Type: application/json');

require_once 'db.php';

$customs 	= $db->fetch_all("SELECT custom, asli FROM custom ORDER BY CHAR_LENGTH(custom) DESC");
$json 		= [];

foreach ($customs as $item) :
	$json[$item['custom']] = $item['asli'];
endforeach;

echo json_encode($json, JSON_PRETTY_PRINT);