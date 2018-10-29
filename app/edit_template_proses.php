<?php

require_once 'db.php';

$id 		= $_GET['id'];
$posts 		= $_POST;
$userdata 	= ['nama', 'tampil'];
$template	= [];
$config 	= [];

foreach ($posts as $name => $value) :
    if (in_array($name, $userdata)) :
        $template[$name] = $value;
    else :
        $config[$name] = $value;
    endif;
endforeach;

$template['config'] = json_encode($config);

$db->update('template', $template, ['id' => $id]);

return header('location: template.php');
