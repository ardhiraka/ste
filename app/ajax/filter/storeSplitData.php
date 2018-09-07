<?php

require_once '../../db.php';

$checkInDB  = $db->fetch_all('select * from split where inbox_id = ?', $_POST['id']);
$isNotExist = count($checkInDB) > 0 ? false : true;
$response   = ['status' => 'success'];

if ($isNotExist) :
    $inbox  = $db->fetch_row('select * from inbox where ID = ?', $_POST['id']);
    $member = $db->fetch_row('select * from member where nohp = ?', $inbox['SenderNumber']);
    $insert = [];
    $splits = $_POST['split'];

    foreach ($splits as $format => $items) :
        $xpl = explode('@', $format);

        if (in_array($xpl[0], ['J', 'P', 'T', 'S'])) :
            $nType = [
                'J' => [1, 3, 5, 7, 9],
                'P' => [0, 2, 4, 6, 8],
                'T' => [5, 6, 7, 8, 9],
                'S' => [0, 1, 2, 3, 4]
            ];

            $insert[] = [
                'member_id' => $member['id'],
                'inbox_id'  => $inbox['ID'],
                'kode'      => $xpl[0],
                'angka'     => join($nType[$xpl[0]]),
                'nominal'   => $xpl[1],
                'tanggal'   => date('Y-m-d', strtotime($inbox['UpdatedInDB']))
            ];
        else :
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
        endif;
    endforeach;

    $store      = $db->insert('split', $insert);
    $response   = $store ? $response : ['status' => 'error', 'error' => 'Gagal menyimpan!'];

    if ($store) :
        $db->update('inbox', ['isFiltered' => 1], ['ID' => $_POST['id']]);
    endif;
else :
    $response   = ['status' => 'error', 'error' => 'Pesan sudah disumbit!'];
endif;

echo json_encode($response);
