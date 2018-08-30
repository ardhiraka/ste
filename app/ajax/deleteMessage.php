<?php

require_once '../db.php';

$delete = "DELETE FROM inbox WHERE ID = {$_POST['id']}";

if ($conn->query($delete) === TRUE) :
  echo json_encode(['status' => 'success']);
else :
  echo json_encode(['status' => 'error', 'error' => $conn->error]);
endif;