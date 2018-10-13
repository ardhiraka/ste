<?php

require_once 'db.php';

$splits = $db->fetch_all('select * from split where inRekap = ? and tanggal = ?', 1, date('Y-m-d'));

foreach ($splits as $split) :
endforeach;

echo "<pre>";
print_r($splits);