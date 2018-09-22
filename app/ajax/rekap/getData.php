<?php

require_once '../../db.php';

if ($_POST['kode'] == '_all_') :
    $rows = $db->fetch_all('select * from split where isProcessed = 0 and tanggal = ? group by kode, angka, nominal order by nominal desc', $_POST['recapdate']);
elseif ($_POST['kode'] == '_other_') :
    $rows = $db->fetch_all('select * from split where isProcessed = 0 and tanggal = ? and kode not in ("2D", "3D", "4D") group by kode, angka, nominal order by nominal desc', $_POST['recapdate']);
else :
    $rows = $db->fetch_all('select * from split where isProcessed = 0 and kode = ? and tanggal = ? group by kode, angka, nominal order by nominal desc', $_POST['kode'], $_POST['recapdate']);
endif;

foreach ($rows as $row) :
    echo "<tr data-id='" . $row['id'] . "'>";
    echo "<td>{$row['kode']}</td>";
    echo "<td><a href='info.php?data=" . $row['inbox_id'] . "'>{$row['angka']}</a></td>";
    echo "<td>{$row['nominal']}</td>";
    echo "<td>" . $row['nom_makan'] . "</td>";
    echo "<td>" . $row['nom_dealer'] . "</td>";
    echo "</tr>";
endforeach;
