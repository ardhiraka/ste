<?php

require_once '../db.php';

$inbox  = $db->fetch_row('select * from inbox where ID = ?', $_POST['id']);
$member = $db->fetch_row('select * from member where nohp = ?', $inbox['SenderNumber']);
$insert = [];
$splits = $_POST['split'];

foreach ($splits as $format => $items) :
    foreach ($items as $item) :
        $split      = explode(' ', $item);
        $theCode    = is_numeric($split[0]) ? "N/A" : $split[0];
        $thePrice   = $split[count($split) - 1];
        $number     = '';

        if ($theCode == 'N/A') :
            $theCode = strlen($split[0]) . 'd';
            $number  = $split[0];
        elseif ($theCode == 'C') :
            $theHead = is_numeric($split[1]) ? false : true;
            $number  = $theHead ? $split[2] : $split[1];
            $theCode = $theHead ? "{$theCode}.{$split[1]}" : $theCode;
        elseif ($theCode == 'M') :
            $theCode = "{$theCode}.{$split[1]}";
        else :
            $number = $split[1];
        endif;

        $insert[] = [
            'member_id' => $member['id'],
            'inbox_id'  => $inbox['ID'],
            'kode'      => $theCode,
            'angka'     => $number,
            'nominal'   => $thePrice,
            'tanggal'   => date('Y-m-d', strtotime($inbox['UpdatedInDB']))
        ];
    endforeach;
endforeach;

$store = $db->insert('split', $insert);

if ($store) :
  echo json_encode(['status' => 'success']);
else :
  echo json_encode(['status' => 'error', 'error' => 'Gagal menyimpan!']);
endif;
