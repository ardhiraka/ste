<?php

require_once 'db.php';

$id 		= $_GET['id'];
$posts 		= $_POST;
$userdata 	= ['nama', 'tampil'];
$template	= [];
$config 	= [];
$dataTemplate = $db->fetch_row("select * from template where id = ?", $id);

foreach ($posts as $name => $value) :
    if (in_array($name, $userdata)) :
        $template[$name] = $value;
    else :
        $config[$name] = $value;
    endif;
endforeach;

$template['config'] = json_encode($config);

$db->update('template', $template, ['id' => $id]);

$logActivity->setLog("Update data template {$dataTemplate['nama']}");

return header('location: template.php');
