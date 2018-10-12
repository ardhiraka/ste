<?php

require_once 'session.php';
require_once 'db.php';

$number = (string) $_POST['win_number'];

if (isset($_SERVER['HTTP_REFERER'])) :
    $url  = (object) parse_url($_SERVER['HTTP_REFERER']);
    $prev = "{$url->scheme}://{$url->host}{$url->path}";
else :
    $prev = 'index.php';
endif;

if (!is_numeric($number)) :
    return header('location: ' . $prev . "?error=numeric");
elseif (strlen($number) != 4) :
    return header('location: ' . $prev . "?error=length");
endif;


$db->update('admin', ['win_number' => $number], ['id' => $_SESSION['uid']]);

return header('location: ' . $prev . "?success=true");