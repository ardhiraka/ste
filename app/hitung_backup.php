<?php

// if (!$_POST)
//     return header('location:index.php');

require_once 'db.php';

$number = (string) 4582;//$_POST['winningnumber'];

if (isset($_SERVER['HTTP_REFERER'])) :
    $url  = (object) parse_url($_SERVER['HTTP_REFERER']);
    $prev = "{$url->scheme}://{$url->host}{$url->path}";
endif;
/*
if (!is_numeric($number)) :
    return header('location: ' . $prev . "?error=numeric");
elseif (strlen($number) != 4) :
    return header('location: ' . $prev . "?error=len");
endif;
*/
$list       = $db->fetch_all("SELECT s.id AS split_id, s.*, m.id AS user, m.* FROM split AS s LEFT JOIN member AS m ON m.id = s.member_id WHERE s.isProcessed = 0");
$ids        = [];//array_column($list, 'id');
$storages   = [];
echo "<pre>";print_r($list);die();

function getDNumber($kode, $number) {
    $format = [
        '2d' => $number[2].$number[3],
        '3d' => $number[1].$number[2].$number[3],
        '4d' => $number
    ];

    return $format[$kode];
}

foreach ($list as $item) :
    $now  = (object) $item;

    if (!$now->user) continue;

    $ids[] = $now->split_id;

    if (!isset($storages[$now->nohp]['result'][$now->kode])) :
        $storages[$now->nohp]['data'][$now->kode] = $item;
        $storages[$now->nohp]['result'][$now->kode] = ['win' => [], 'lose' => []];
    endif;

    if (in_array($now->kode, ['2d', '3d', '4d'])) :
        $isValid = getDNumber($now->kode, $number);
        
        if ($now->angka == $isValid) :
            $storages[$now->nohp]['result'][$now->kode]['win'][] = $now->angka;
        else :
            $storages[$now->nohp]['result'][$now->kode]['lose'][] = $now->angka;
        endif;
    endif;
endforeach;
echo "<pre>";print_r($storages);die();

function getWin($totalWin, $price, $dbWin)
{
    echo "{$totalWin} * {$price} * {$dbWin} <br/>";
    return $totalWin * $price * $dbWin;
}

function getDisc($totalLose, $price, $dbDisc)
{
    $total = $totalLose * $price;
    $disc  = $total * ($dbDisc / 100);

    echo "({$totalLose} * {$price}) - ({$total} * ({$dbDisc} / 100)) <br/>";

    return $total - $disc;
}

$results = [];
foreach ($storages as $nohp => $info) :
    foreach ($info['result'] as $kode => $is) :
        if (in_array($kode, ['2d', '3d', '4d'])) :
            $win  = getWin(count($is['win']), $info['data'][$kode]['nominal'], $info['data'][$kode]["{$kode}_win"]);
            $lose = getDisc(count($is['lose']), $info['data'][$kode]['nominal'], $info['data'][$kode]["{$kode}_disc"]);
            $results[$nohp]['result'][$kode][] = $win - $lose;
        endif;
    endforeach;
endforeach;

echo "<pre>";print_r([$results]);
