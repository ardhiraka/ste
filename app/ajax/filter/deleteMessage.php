<?php

require_once '../../db.php';

$delete = $db->delete('inbox', ['ID' => $_POST['id']]);

if ($delete) :
  echo json_encode(['status' => 'success']);
else :
  echo json_encode(['status' => 'error', 'error' => 'ID tidak ditemukan!']);
endif;
