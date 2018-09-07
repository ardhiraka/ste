<?php

if (!$_POST)
    return header('location:index.php');

require_once 'db.php';

$number = (string) $_POST['winningnumber'];

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

$list       = $db->fetch_all("SELECT s.id AS split_id, s.*, m.id AS user, m.* FROM split AS s LEFT JOIN member AS m ON m.id = s.member_id WHERE s.isProcessed = 0");
$ids        = array_column($list, 'split_id');
$storages   = [];

function getDNumber($kode, $number) {
    $format = [
        '2d' => $number[2].$number[3],
        '3d' => $number[1].$number[2].$number[3],
        '4d' => $number
    ];

    return $format[$kode];
}

function getWin($totalWin, $price, $dbWin)
{
    return $totalWin * $price * $dbWin;
}

function getDisc($totalLose, $price, $dbDisc)
{
    $total = $totalLose * $price;
    $disc  = $total * ($dbDisc / 100);

    return $total - $disc;
}

foreach ($list as $item) :
    // harus ada: $isNumberValid dan $result

    if (in_array($item['kode'], ['2d', '3d', '4d'])) :
        $validNumber    = getDNumber($item['kode'], $number);
        $isNumberValid  = $item['angka'] == $validNumber;
        $win        = $isNumberValid ? 1 : 0;
        $lose       = $isNumberValid ? 0 : 1;
        $getWin     = getWin($win, $item['nominal'], $item[$item['kode'] . '_win']);
        $getDisc    = getDisc($lose, $item['nominal'], $item[$item['kode'] . '_disc']);

        $result     = $getWin - $getDisc;
    endif;

    $storages[$item['inbox_id']]['info']['member_id'] = $item['member_id'];
    $storages[$item['inbox_id']]['info'][$isNumberValid ? 'win' : 'lose'][] = $item['angka'];
    $storages[$item['inbox_id']]['result'][$item['kode']][] = $result;
endforeach;

$result = [];

foreach ($storages as $inbox_id => $list) :
    $_result[$inbox_id] = [];

    foreach ($list['result'] as $kode => $item) :
        $_result[$inbox_id][$kode] = array_sum($item);
    endforeach;

    $result[$inbox_id] = [
        'inbox_id'  => $inbox_id,
        'member_id' => $list['info']['member_id'],
        'win'       => isset($list['info']['win']) ? count($list['info']['win']) : 0,
        'lose'      => isset($list['info']['lose']) ? count($list['info']['lose']) : 0,
        'total'     => array_sum($_result[$inbox_id])
    ];
endforeach;

$db->insert('sms_out', array_values($result));

$isProcessed = [];

foreach ($ids as $id) :
    $isProcessed[] = [['isProcessed' => 1], ['id' => $id]];
endforeach;

$db->update('split', $isProcessed);


return header('location: ' . $prev . "?success=true");
