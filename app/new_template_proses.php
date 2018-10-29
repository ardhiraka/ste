<?php

require_once 'db.php';

$posts 		= $_POST;
$info 		= ['nama', 'tampil'];
$template	= [];
$config 	= [];

foreach ($posts as $name => $value) :
    if (in_array($name, $info)) :
        $template[$name] = $value;
    else :
        $config[$name] = $value;
    endif;
endforeach;

$template['config'] = json_encode($config);

// save
$db->insert('template', $template);

return header('location: template.php');