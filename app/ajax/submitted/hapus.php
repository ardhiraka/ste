<?php

require_once '../../db.php';

$id = $_POST['id'];

$db->delete('split', ['inbox_id' => $id, 'tanggal' => date('Y-m-d')]);

echo json_encode(['status' => 'success']);