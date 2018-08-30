<?php

require_once '../db.php';

$data = $db->fetch_row("SELECT * FROM `member` WHERE nohp = ?", $_POST['number']);

echo json_encode($data);
