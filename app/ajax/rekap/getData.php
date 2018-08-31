<?php

require_once '../../db.php';

if ($_POST['kode'] == '_all_') :
    $rows = $db->fetch_all('select * from split where tanggal = ? group by kode, angka, nominal', $_POST['recapdate']);
else :
    $rows = $db->fetch_all('select * from split where kode = ? and tanggal = ? group by kode, angka, nominal', $_POST['kode'], $_POST['recapdate']);
endif;

foreach ($rows as $row) :
    echo "<tr>";
    echo "<td>{$row['kode']}</td>";
    echo "<td>{$row['angka']}</td>";
    echo "<td>{$row['nominal']}</td>";
    echo "</tr>";
endforeach;
