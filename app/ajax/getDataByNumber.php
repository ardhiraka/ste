<?php

require_once '../db.php';

$number   = 089668615914; //$_POST['number'];
$getData  = "SELECT * FROM member WHERE nohp = '{$number}'";
$result   = $conn->query($getData);

echo json_encode($result->num_rows);