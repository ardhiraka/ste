<?php

require_once '../../db.php';

$id = $_POST['id'];
$number = $_POST['number'];

$db->update('inbox', ['SenderNumber' => $number], ['ID' => $id]);

echo json_encode(['status' => 'success']);