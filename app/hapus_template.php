<?php

require_once 'db.php';

$id = $_GET['id'];

$hapus = $db->delete('template', ['id' => $id]);

return header('location: template.php');