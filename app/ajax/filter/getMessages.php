<?php

require_once '../../db.php';

$messages = $db->fetch_all("SELECT ID, UDH, SenderNumber, TextDecoded FROM inbox ORDER BY ReceivingDateTime ASC");

echo json_encode(['data' => $messages]);
