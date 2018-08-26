<?php

require_once '../db.php';

$getMessages  = 'SELECT ID, UDH, SenderNumber, TextDecoded FROM inbox ORDER BY ReceivingDateTime ASC';
$result       = $conn->query($getMessages);
$messages     = ['data' => []];

while($row = $result->fetch_assoc()) :
  $messages['data'][] = $row;
endwhile;

echo json_encode($messages);