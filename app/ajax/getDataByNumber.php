<?php

require_once '../db.php';

$number   = $_POST['number'];
$getData  = "SELECT * FROM `member` WHERE nohp = '{$number}'";
$result   = $conn->query($getData);

echo json_encode($result->fetch_assoc());