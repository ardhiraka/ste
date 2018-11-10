<?php

require_once 'db.php';

$id = $_GET['id'];
$dataMember = $db->fetch_row("select * from member where id = ?", $id);

$hapus = $db->delete('member', ['id' => $id]);

if ($hapus) :
	$db->delete('member_config', ['member_id' => $id]);

    $logActivity->setLog("Member {$dataMember['nama']} [{$dataMember['kodeid']}] deleted");
endif;

return header('location: config.php');