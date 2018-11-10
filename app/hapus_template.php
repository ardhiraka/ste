<?php

require_once 'db.php';

$id = $_GET['id'];
$dataTemplate = $db->fetch_row("select * from template where id = ?", $id);

$hapus = $db->delete('template', ['id' => $id]);

$logActivity->setLog("Template {$dataTemplate['nama']} deleted");

return header('location: template.php');