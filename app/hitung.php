<?php

// if (!$_POST)
//     return header('location:index.php');

require_once 'db.php';

$number = 1234;//$_POST['winningnumber'];
$url  = (object) parse_url($_SERVER['HTTP_REFERER']);
$prev = "{$url->scheme}://{$url->host}{$url->path}";
/*
if (!is_numeric($number)) :
    return header('location: ' . $prev . "?error=numeric");
elseif (strlen($number) != 4) :
    return header('location: ' . $prev . "?error=len");
endif;
*/
$list   = [];//$db->fetch_all("SELECT s.id AS split_id, s.*, m.* FROM split AS s LEFT JOIN member AS m ON m.id = s.member_id WHERE s.isProcessed = 0");
echo "<pre>";print_r($list);die();
$ids    = [];//array_column($list, 'id');
$tes    = [];

// var_dump($number);
foreach ($list as $item) :
    $now  = (object) $item;
    $user = $db->fetch_row('select * from member where id = ' . $now->member_id);

    if (!$user) continue;

    if (in_array($now->kode, ['2d', '3d', '4d'])) :
        // var_dump(getDNumber($now->kode, $number));
    endif;
endforeach;

function getDNumber($kode, $number) {
    switch ($kode) :
        case '2d':
            return $number[2].$number[3];
            break;
        case '3d':
            return $number[1]$number[2].$number[3];
            break;
        case '4d':
            return $number;
            break;
    endswitch;
}

echo "<pre>";print_r($tes);