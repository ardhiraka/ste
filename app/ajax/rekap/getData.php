<?php

require_once '../../db.php';

if ($_POST['kode'] == '_all_') :
    $rekap = $db->fetch_all('select * from rekap where isProcessed = 0 and tanggal = ?', $_POST['recapdate']);
elseif ($_POST['kode'] == '_other_') :
    $rekap = $db->fetch_all('select * from rekap where isProcessed = 0 and tanggal = ? and kode not in ("2D", "3D", "4D")', $_POST['recapdate']);
else :
    $rekap = $db->fetch_all('select * from rekap where isProcessed = 0 and kode = ? and tanggal = ?', $_POST['kode'], $_POST['recapdate']);
endif;

foreach ($rekap as $item) :
    echo "<tr data-id='". $item['id'] ."'>";
    echo "<td>{$item['kode']}</a></td>";
    echo "<td align='center'>{$item['angka']}</td>";
    echo "<td>{$item['nominal']}</td>";
    echo "<td>{$item['nom_makan']}</td>";
    echo "<td>{$item['nom_dealer']}</td>";
    echo "</tr>";
endforeach;