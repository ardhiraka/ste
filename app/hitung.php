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

if (empty($list))
    return header('location: ' . $prev . "?error=empty");

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

$nType = [
    'J' => [1, 3, 5, 7, 9],
    'P' => [0, 2, 4, 6, 8],
    'T' => [5, 6, 7, 8, 9],
    'S' => [0, 1, 2, 3, 4]
];

$sType = [
    'J' => 'odd',
    'P' => 'even',
    'T' => 'big',
    'S' => 'small',
];

function nToSType($number)
{
    global $nType;

    $result = [];
    foreach ($nType as $type => $list) :
        if (in_array($number, $list)) :
            $result[] = getSType($type);
        endif;
    endforeach;

    return $result;
}

function getNType($number, $code = 'M')
{
    global $nType;

    $number = (string) $number;

    if (strlen($number) == 2) :
        if ($code == 'M') :
            $result = [nToSType($number[0]), nToSType($number[1])];
        elseif ($code == 'H') :
            $result = ["big", ($number % 2 ? "odd" : "even")];
        endif;
    elseif (strlen($number) == 1) :
        $result = nToSType($number);
    endif;

    return $result;
}

function getSType($string)
{
    global $sType;

    if (strlen($string) == 4) :
        $result = [[$sType[$string[0]], $sType[$string[1]]], [$sType[$string[2]], $sType[$string[3]]]];
    elseif (strlen($string) == 2) :
        $result = [$sType[$string[0]], $sType[$string[1]]];
    elseif (strlen($string) == 1) :
        $result = $sType[$string[0]];
    endif;

    return $string ? $result : false;
}

foreach ($list as $item) :
    $storages[$item['inbox_id']]['info']['member_id'] = $item['member_id'];
    $multiCode = explode('.', $item['kode']);

    // harus ada: $result, $resultMakan, $resultDealer
    if (in_array($item['kode'], ['2d', '3d', '4d'])) :
        $validNumber    = getDNumber($item['kode'], $number);
        $isNumberValid  = $item['angka'] == $validNumber;
        $win        = $isNumberValid ? 1 : 0;
        $lose       = $isNumberValid ? 0 : 1;
        $getWin     = getWin($win, $item['nominal'], $item[$item['kode'] . '_win']);
        $getDisc    = getDisc($lose, $item['nominal'], $item[$item['kode'] . '_disc']);
        $result     = $getWin - $getDisc;

        $getWinMakan     = getWin($win, $item['nom_makan'], $item[$item['kode'] . '_win']);
        $getDiscMakan    = getDisc($lose, $item['nom_makan'], $item[$item['kode'] . '_disc']);
        $resultMakan     = $getWinMakan - $getDiscMakan;

        $getWinDealer     = getWin($win, $item['nom_dealer'], $item[$item['kode'] . '_win']);
        $getDiscDealer    = getDisc($lose, $item['nom_dealer'], $item[$item['kode'] . '_disc']);
        $resultDealer     = $getWinDealer - $getDiscDealer;

        $storages[$item['inbox_id']]['info'][$isNumberValid ? 'win' : 'lose'][] = $item['angka'];

    elseif (in_array($item['kode'], ['J', 'P', 'T', 'S'])) :
        $validNumber    = in_array($item['kode'], ['J', 'P']) ? $number[3] : $number[2];
        $isNumberValid  = in_array($validNumber, $nType[$item['kode']]);
        $win        = $isNumberValid ? 1 : 0;
        $getWin     = $win > 0 ? getWin(1, $item['nominal'], $item[$item['kode'] . '_win']) : 0;
        $getTax     = $win > 0 ? 0 : getTax(5, $item['nominal'], $item[$item['kode'] . '_disc']);
        $result     = $getWin - $getTax;

        $getWinMakan     = $win > 0 ? getWin(1, $item['nom_makan'], $item[$item['kode'] . '_win']) : 0;
        $getTaxMakan     = $win > 0 ? 0 : getTax(5, $item['nom_makan'], $item[$item['kode'] . '_disc']);
        $resultMakan     = $getWinMakan - $getTaxMakan;

        $getWinDealer     = $win > 0 ? getWin(1, $item['nom_dealer'], $item[$item['kode'] . '_win']) : 0;
        $getTaxDealer     = $win > 0 ? 0 : getTax(5, $item['nom_dealer'], $item[$item['kode'] . '_disc']);
        $resultDealer     = $getWinDealer - $getTaxDealer;

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
    elseif (in_array($item['kode'], ['CM', 'CN'])) :
        $availableNumber    = str_split($number);
        $selectedNumber     = str_split($item['angka']);
        $isValid            = [];

        foreach ($selectedNumber as $select) :
            $isValid[] = in_array($select, $availableNumber);
        endforeach;

        $isNumberValid      = array_sum($isValid) == count($selectedNumber) ? true : false;
        $win        = $isNumberValid ? 1 : 0;
        $lose       = $isNumberValid ? 0 : 1;
        $getWin     = getWin($win, $item['nominal'], $item[$item['kode'] . ($item['kode'] == 'CM' ? '1' : '') . '_win']);
        $getDisc    = getDisc($lose, $item['nominal'], $item[$item['kode'] . '_disc']);
        $result     = $getWin - $getDisc;

        $getWinMakan     = getWin($win, $item['nom_makan'], $item[$item['kode'] . ($item['kode'] == 'CM' ? '1' : '') . '_win']);
        $getDiscMakan    = getDisc($lose, $item['nom_makan'], $item[$item['kode'] . '_disc']);
        $resultMakan     = $getWinMakan - $getDiscMakan;

        $getWinDealer     = getWin($win, $item['nom_dealer'], $item[$item['kode'] . ($item['kode'] == 'CM' ? '1' : '') . '_win']);
        $getDiscDealer    = getDisc($lose, $item['nom_dealer'], $item[$item['kode'] . '_disc']);
        $resultDealer     = $getWinDealer - $getDiscDealer;

        $storages[$item['inbox_id']]['info'][$isNumberValid ? 'win' : 'lose'][] = $item['angka'];
    elseif ($multiCode[0] == 'C') :
        $theHead    = isset($multiCode[1]) ? $multiCode[1] : false;
        $iHead      = ['AS' => '0', 'KP' => '1', 'K' => '2', 'E' => '3'];
        $index      = $theHead ? (int) $iHead[$theHead] : 'C';

        if ($index == 'C') :
            $isNumberValid = in_array($item['angka'], str_split($number));
        else :
            $isNumberValid = $item['angka'] == $number[$index];
        endif;

        $win        = $isNumberValid ? 1 : 0;
        $lose       = $isNumberValid ? 0 : 1;
        $getWin     = getWin($win, $item['nominal'], $item[($theHead ? 'Jitu' : $item['kode']) . '_win']);
        $getDisc    = getDisc($lose, $item['nominal'], $item[($theHead ? 'Jitu' : $item['kode']) . '_disc']);
        $result     = $getWin - $getDisc;

        $getWinMakan     = getWin($win, $item['nom_makan'], $item[($theHead ? 'Jitu' : $item['kode']) . '_win']);
        $getDiscMakan    = getDisc($lose, $item['nom_makan'], $item[($theHead ? 'Jitu' : $item['kode']) . '_disc']);
        $resultMakan     = $getWinMakan - $getDiscMakan;

        $getWinDealer     = getWin($win, $item['nom_dealer'], $item[($theHead ? 'Jitu' : $item['kode']) . '_win']);
        $getDiscDealer    = getDisc($lose, $item['nom_dealer'], $item[($theHead ? 'Jitu' : $item['kode']) . '_disc']);
        $resultDealer     = $getWinDealer - $getDiscDealer;

        $storages[$item['inbox_id']]['info'][$isNumberValid ? 'win' : 'lose'][] = $item['angka'];
    elseif ($multiCode[0] == 'M' || $multiCode[0] == 'H') :
        $theHead    = $multiCode[1];
        $theHeadIs  = getSType($theHead);

        if ($multiCode[0] == 'M') :
            $numberConcat   = $number[2].$number[3];
            $theNumberIs    = getNType($numberConcat, 'M');
        elseif ($multiCode[0] == 'H') :
            $numberAdd = (int) $number[2] + (int) $number[3];
            $theNumberIs    = getNType($numberAdd, 'H');
        endif;
        
        if (strlen($theHead) == 4) :
            $kondisi1 = in_array($theHeadIs[0][0], $theNumberIs[0]) && in_array($theHeadIs[0][1], $theNumberIs[1]);
            $storages[$item['inbox_id']]['info'][$kondisi1 ? 'win' : 'lose'][] = $numberConcat;
            
            $kondisi2 = in_array($theHeadIs[1][0], $theNumberIs[0]) && in_array($theHeadIs[1][1], $theNumberIs[1]);
            $storages[$item['inbox_id']]['info'][$kondisi2 ? 'win' : 'lose'][] = $numberConcat;
            
            $isNumberValid  = $kondisi1 || $kondisi2;
        elseif (strlen($theHead) == 2) :
            $isNumberValid  = in_array($theHeadIs[0], $theNumberIs[0]) && in_array($theHeadIs[1], $theNumberIs[1]);
            $storages[$item['inbox_id']]['info'][$isNumberValid ? 'win' : 'lose'][] = $numberConcat;
        elseif (strlen($theHead) == 1) :
            $isNumberValid  = in_array($theHeadIs, $theNumberIs);
            $storages[$item['inbox_id']]['info'][$isNumberValid ? 'win' : 'lose'][] = $numberAdd;
        endif;

        $win        = $isNumberValid ? 1 : 0;
        $getWin     = $win > 0 ? getWin(1, $item['nominal'], $item[$multiCode[0] . '_win']) : 0;
        $getTax     = $win > 0 ? 0 : getTax(1, $item['nominal'], $item[$multiCode[0] . '_disc']);
        $result     = $getWin - $getTax;

        $getWinMakan     = $win > 0 ? getWin(1, $item['nom_makan'], $item[$multiCode[0] . '_win']) : 0;
        $getTaxMakan     = $win > 0 ? 0 : getTax(1, $item['nom_makan'], $item[$multiCode[0] . '_disc']);
        $resultMakan     = $getWinMakan - $getTaxMakan;

        $getWinDealer     = $win > 0 ? getWin(1, $item['nom_dealer'], $item[$multiCode[0] . '_win']) : 0;
        $getTaxDealer     = $win > 0 ? 0 : getTax(1, $item['nom_dealer'], $item[$multiCode[0] . '_disc']);
        $resultDealer     = $getWinDealer - $getTaxDealer;
    endif;

    $storages[$item['inbox_id']]['result'][$item['kode']][] = $result;
    $storages[$item['inbox_id']]['result_makan'][$item['kode']][] = $resultMakan;
    $storages[$item['inbox_id']]['result_dealer'][$item['kode']][] = $resultDealer;
endforeach;
// echo "<pre>";print_r($storages);die();

$result = [];

foreach ($storages as $inbox_id => $list) :
    $_result[$inbox_id] = [];
    $_resultMakan[$inbox_id] = [];
    $_resultDealer[$inbox_id] = [];

    foreach ($list['result'] as $kode => $item) :
        $_result[$inbox_id][$kode] = array_sum($item);
    endforeach;

    foreach ($list['result_makan'] as $kode => $item) :
        $_resultMakan[$inbox_id][$kode] = array_sum($item);
    endforeach;

    foreach ($list['result_dealer'] as $kode => $item) :
        $_resultDealer[$inbox_id][$kode] = array_sum($item);
    endforeach;

    $result[$inbox_id] = [
        'inbox_id'  => $inbox_id,
        'member_id' => $list['info']['member_id'],
        'win'       => isset($list['info']['win']) ? count($list['info']['win']) : 0,
        'lose'      => isset($list['info']['lose']) ? count($list['info']['lose']) : 0,
        'total'     => array_sum($_result[$inbox_id]),
        'total_makan'   => array_sum($_resultMakan[$inbox_id]),
        'total_dealer'  => array_sum($_resultDealer[$inbox_id])
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
