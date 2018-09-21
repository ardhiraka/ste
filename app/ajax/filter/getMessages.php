<?php

require_once '../../db.php';

// $messages = $db->fetch_all("SELECT ID, UDH, SenderNumber, SUBSTRING(`TextDecoded`, 1, 5) as TextDecoded FROM inbox WHERE isFiltered = 0 ORDER BY ReceivingDateTime ASC");

$messages = $db->fetch_all("SELECT i.ID, i.UDH, i.SenderNumber, i.TextDecoded, m.nama AS userName FROM inbox AS i LEFT JOIN member AS m ON m.nohp = i.SenderNumber WHERE i.isFiltered = 0 ORDER BY i.ReceivingDateTime ASC");


echo json_encode(['data' => $messages]);
