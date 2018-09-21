<?php

require_once '../../db.php';

// $messages = $db->fetch_all("SELECT ID, UDH, SenderNumber, SUBSTRING(`TextDecoded`, 1, 5) as TextDecoded FROM inbox WHERE isFiltered = 0 ORDER BY ReceivingDateTime ASC");

$messages = $db->fetch_all("SELECT ID, UDH, SenderNumber, TextDecoded FROM inbox WHERE isFiltered = 0 ORDER BY ReceivingDateTime ASC");


echo json_encode(['data' => $messages]);
