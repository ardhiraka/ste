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
// echo "<pre>";print_r($list);die();

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

function getTax($totalLose, $price, $dbDisc)
{
    $total = $totalLose * $price;
    $disc  = $total * ($dbDisc / 100);

    return $total + $disc;
}

foreach ($list as $item) :
    $storages[$item['inbox_id']]['info']['member_id'] = $item['member_id'];

    // harus ada: $result
    if (in_array($item['kode'], ['2d', '3d', '4d'])) :
        $validNumber    = getDNumber($item['kode'], $number);
        $isNumberValid  = $item['angka'] == $validNumber;
        $win        = $isNumberValid ? 1 : 0;
        $lose       = $isNumberValid ? 0 : 1;
        $getWin     = getWin($win, $item['nominal'], $item[$item['kode'] . '_win']);
        $getDisc    = getDisc($lose, $item['nominal'], $item[$item['kode'] . '_disc']);
        $result     = $getWin - $getDisc;

        $storages[$item['inbox_id']]['info'][$isNumberValid ? 'win' : 'lose'][] = $item['angka'];

    elseif (in_array($item['kode'], ['J', 'P', 'T', 'S'])) :
        $nType = [
            'J' => [1, 3, 5, 7, 9],
            'P' => [0, 2, 4, 6, 8],
            'T' => [5, 6, 7, 8, 9],
            'S' => [0, 1, 2, 3, 4]
        ];

        $validNumber    = in_array($item['kode'], ['J', 'P']) ? $number[3] : $number[2];
        $isNumberValid  = in_array($validNumber, $nType[$item['kode']]);
        $win        = $isNumberValid ? 1 : 0;
        $getWin     = $win > 0 ? getWin(1, $item['nominal'], $item[$item['kode'] . '_win']) : 0;
        $getTax     = $win > 0 ? 0 : getTax(5, $item['nominal'], $item[$item['kode'] . '_disc']);
        $result     = $getWin - $getTax;

        if ($isNumberValid) :
            $storages[$item['inbox_id']]['info']['win'][] = $item['angka'];
            
            for ($i = 1; $i <= 4; $i++) :
                $storages[$item['inbox_id']]['info']['lose'][] = $item['angka'];
            endfor;
        else :
            for ($i = 1; $i <= 5; $i++) :
                $storages[$item['inbox_id']]['info']['lose'][] = $item['angka'];
            endfor;
        endif;
    endif;

    // $storages[$item['inbox_id']]['info'][$isNumberValid ? 'win' : 'lose'][] = $item['angka'];
    $storages[$item['inbox_id']]['result'][$item['kode']][] = $result;
endforeach;
// echo "<pre>";print_r($storages);die();

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
// echo "<pre>";print_r($result);die();

$db->insert('sms_out', array_values($result));

$isProcessed = [];

foreach ($ids as $id) :
    $isProcessed[] = [['isProcessed' => 1], ['id' => $id]];
endforeach;

$db->update('split', $isProcessed);

return header('location: ' . $prev . "?success=true");
