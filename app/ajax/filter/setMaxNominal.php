<?php

session_start();

require_once '../../db.php';

$max = $_POST['max'];

$db->update('admin', ['max_nominal' => $max], ['id' => $_SESSION['uid']]);

echo json_encode(['status' => 'success']);