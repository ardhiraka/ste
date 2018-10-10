<?php

require 'db.php';

$table 	= 'custom';
$post 	= $_POST;
$update	= [];
$insert	= [];

foreach ($post as $asli => $custom) :
	$update[] = [
		['custom' 	=> strtoupper($custom)],
		['asli'		=> str_replace('_', '.', $asli)]
	];
	$insert[] = [
		'asli'		=> str_replace('_', '.', $asli),
		'custom'	=> strtoupper($custom)
	];
endforeach;

$db->clear($table);
$db->insert($table, $insert);

return header('location: custom.php');
