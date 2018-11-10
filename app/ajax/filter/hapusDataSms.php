<?php

require_once '../../db.php';

$id     = $_POST['id'];
$inbox  = $db->fetch_row('select * from inbox where ID = ?', $id);
$member = $db->fetch_row('select * from member where nohp = ?', $inbox['SenderNumber']);

$logActivity->setLog("Message from {$member['nama']} [{$member['kodeid']}] deleted");

$db->delete('inbox', ['ID' => $id]);

echo json_encode(['status' => 'success']);