<?php
include('header.php');

$inbox_id   = $_GET['data'];
$data       = $db->fetch_all("select * from inbox where ID = ?", $inbox_id);
?>

<?php
include('footer.php');
?>
