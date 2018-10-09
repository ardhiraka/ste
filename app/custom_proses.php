<?php

require 'db.php';

$post 	= $_POST;
$update	= [];

foreach ($post as $asli => $custom) :
	$update[] = [
		['custom' 	=> strtoupper($custom)],
		['asli'		=> str_replace('_', '.', $asli)]
	];
endforeach;

$db->update('custom', $update);

return header('location: custom.php');