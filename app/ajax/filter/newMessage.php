<?php

require_once '../../db.php';

$date = date('Y-m-d H:i:s');

$insert = $db->insert('inbox', [
    'SenderNumber'      => $_POST['phone_number'],
    'UDH'               => $_POST['name'],
    'TextDecoded'       => $_POST['message'],
    'ReceivingDateTime' => $date,
    'Text'              => '',
    'RecipientID'       => ''
    ]);

if ($insert) :
  echo json_encode(['status' => 'success']);
else :
  echo json_encode(['status' => 'error', 'error' => 'Gagal membuat baru!']);
endif;
