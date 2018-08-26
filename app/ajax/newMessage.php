<?php

require_once '../db.php';

$date = date('Y-m-d H:i:s');
$insert = "INSERT INTO inbox (SenderNumber, UDH, TextDecoded, ReceivingDateTime) VALUES ('{$_POST['phone_number']}', '{$_POST['name']}', '{$_POST['message']}', '{$date}')";

if ($conn->query($insert) === TRUE) :
  echo json_encode(['status' => 'success']);
else :
  echo json_encode(['status' => 'error', 'error' => $conn->error]);
endif;