<?php

require_once '../../db.php';

if ($_POST['kode'] == '_all_') :
    $splits = $db->fetch_all('select * from split where isProcessed = 0 and tanggal = ?', $_POST['recapdate']);
elseif ($_POST['kode'] == '_other_') :
    $splits = $db->fetch_all('select * from split where isProcessed = 0 and tanggal = ? and kode not in ("2D", "3D", "4D")', $_POST['recapdate']);
else :
    $splits = $db->fetch_all('select * from split where isProcessed = 0 and kode = ? and tanggal = ?', $_POST['kode'], $_POST['recapdate']);
endif;

$inData = [];
foreach ($splits as $split) :
    if (in_array($split['kode'], ['2D', '3D', '4D'])) :
        $angka = explode('.', $split['angka']);

        if (array_key_exists($split['kode'], $inData)) :
            foreach ($angka as $item) :
                if (array_key_exists($item, $inData[$split['kode']])) :
                    $inData[$split['kode']][$item]['id'][]              = $split['id'];
                    $inData[$split['kode']][$item]['nominal'][]         = $split['nominal'];
                    $inData[$split['kode']][$item]['nom_makan'][]       = $split['nom_makan'];
                    $inData[$split['kode']][$item]['nom_dealer'][]      = $split['nom_dealer'];
                    $inData[$split['kode']][$item]['total']             += $split['nominal'];
                    $inData[$split['kode']][$item]['total_makan']       += $split['nom_makan'];
                    $inData[$split['kode']][$item]['total_dealer']      += $split['nom_dealer'];
                else :
                    $inData[$split['kode']][$item] = [
                        'id'            => [$split['id']],
                        'nominal'       => [$split['nominal']],
                        'nom_makan'     => [$split['nom_makan']],
                        'nom_dealer'    => [$split['nom_dealer']],
                        'total'         => $split['nominal'],
                        'total_makan'   => $split['nom_makan'],
                        'total_dealer'  => $split['nom_dealer'],
                    ];
                endif;
            endforeach;
        else :
            foreach ($angka as $item) :
                $inData[$split['kode']][$item] = [
                    'id'            => [$split['id']],
                    'nominal'       => [$split['nominal']],
                    'nom_makan'     => [$split['nom_makan']],
                    'nom_dealer'    => [$split['nom_dealer']],
                    'total'         => $split['nominal'],
                    'total_makan'   => $split['nom_makan'],
                    'total_dealer'  => $split['nom_dealer'],
                ];
            endforeach;
        endif;
    else :
        if (array_key_exists($split['kode'], $inData)) :
            if ($inData[$split['kode']]['child']) :
                if (array_key_exists($split['angka'], $inData[$split['kode']]['children'])) :
                    $inData[$split['kode']]['children'][$split['angka']]['id'][]            = $split['id'];
                    $inData[$split['kode']]['children'][$split['angka']]['nominal'][]       = $split['nominal'];
                    $inData[$split['kode']]['children'][$split['angka']]['nom_makan'][]     = $split['nom_makan'];
                    $inData[$split['kode']]['children'][$split['angka']]['nom_dealer'][]    = $split['nom_dealer'];
                    $inData[$split['kode']]['children'][$split['angka']]['total']           += $split['nominal'];
                    $inData[$split['kode']]['children'][$split['angka']]['total_makan']     += $split['nom_makan'];
                    $inData[$split['kode']]['children'][$split['angka']]['total_dealer']    += $split['nom_dealer'];
                else :
                    $inData[$split['kode']]['child'] = true;
                    $inData[$split['kode']]['children'][$split['angka']] = [
                        'id'            => [$split['id']],
                        'nominal'       => [$split['nominal']],
                        'nom_makan'     => [$split['nom_makan']],
                        'nom_dealer'    => [$split['nom_dealer']],
                        'total'         => $split['nominal'],
                        'total_makan'   => $split['nom_makan'],
                        'total_dealer'  => $split['nom_dealer'],
                    ];
                endif;
            else :
                $inData[$split['kode']]['id'][]         = $split['id'];
                $inData[$split['kode']]['nominal'][]    = $split['nominal'];
                $inData[$split['kode']]['nom_makan'][]  = $split['nom_makan'];
                $inData[$split['kode']]['nom_dealer'][] = $split['nom_dealer'];
                $inData[$split['kode']]['total']        += $split['nominal'];
                $inData[$split['kode']]['total_makan']  += $split['nom_makan'];
                $inData[$split['kode']]['total_dealer'] += $split['nom_dealer'];
            endif;
        else :
            if (is_null($split['angka'])) :
                $inData[$split['kode']] = [
                    'child'         => false,
                    'id'            => [$split['id']],
                    'nominal'       => [$split['nominal']],
                    'nom_makan'     => [$split['nom_makan']],
                    'nom_dealer'    => [$split['nom_dealer']],
                    'total'         => $split['nominal'],
                    'total_makan'   => $split['nom_makan'],
                    'total_dealer'  => $split['nom_dealer'],
                ];
            else :
                $inData[$split['kode']]['child'] = true;
                $inData[$split['kode']]['children'][$split['angka']] = [
                    'id'            => [$split['id']],
                    'nominal'       => [$split['nominal']],
                    'nom_makan'     => [$split['nom_makan']],
                    'nom_dealer'    => [$split['nom_dealer']],
                    'total'         => $split['nominal'],
                    'total_makan'   => $split['nom_makan'],
                    'total_dealer'  => $split['nom_dealer'],
                ];
            endif;
        endif;
    endif;
endforeach;

foreach ($inData as $kode => $data) :
    if (in_array($kode, ['2D', '3D', '4D'])) :
        foreach ($data as $angka => $item) :
            echo "<tr data-id='" . join($item['id'], ',') . "'>";
            echo "<td><a href='info.php?by=kode&with={$kode}'>{$kode}</a></td>";
            echo "<td align='center'><a href='info.php?by=number&with=" . join($item['id'], ',') . "'>{$angka}</a></td>";
            echo "<td>{$item['total']}</td>";
            echo "<td>{$item['total_makan']}</td>";
            echo "<td>{$item['total_dealer']}</td>";
            echo "</tr>";
        endforeach;
    else :
        if ($data['child']) :
            foreach ($data['children'] as $angka => $item) :
                echo "<tr data-id='" . join($item['id'], ',') . "'>";
                echo "<td><a href='info.php?by=kode&with={$kode}'>{$kode}</a></td>";
                echo "<td align='center'><a href='info.php?by=number&with=" . join($item['id'], ',') . "'>{$angka}</a></td>";
                echo "<td>{$item['total']}</td>";
                echo "<td>{$item['total_makan']}</td>";
                echo "<td>{$item['total_dealer']}</td>";
                echo "</tr>";
            endforeach;
        else :
            // No Link SMS Detail
            echo "<tr data-id='" . join($data['id'], ',') . "'>";
            echo "<td><a href='info.php?by=kode&with={$kode}'>{$kode}</a></td>";
            echo "<td align='center'>-</td>";
            echo "<td>{$data['total']}</td>";
            echo "<td>{$data['total_makan']}</td>";
            echo "<td>{$data['total_dealer']}</td>";
            echo "</tr>";
        endif;
    endif;
endforeach;