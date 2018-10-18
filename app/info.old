<?php
include('header.php');

$type   = $_GET['by'];
$with   = $_GET['with'];

if ($type == 'number') :
	$data = $db->fetch_all("SELECT * FROM `split` WHERE id IN (?) GROUP BY inbox_id", $with);
else :
	$data = $db->fetch_all("SELECT * FROM `split` WHERE kode = ? GROUP BY inbox_id", $with);
endif;

$inboxIDs = [];
foreach ($data as $row) :
	$inboxIDs[] = $row['inbox_id'];
endforeach;

$inboxs = $db->fetch_all("SELECT * FROM `inbox` WHERE id IN (?)", $inboxIDs);
?>

<div class="container">
		<br />
		<br />
		<br />

		<div align="center">
			<h3>
				SMS Detail
			</h3>
		</div>
	
	<div class="row">
			<div class="col-sm-12">
				<table class="table table-sm table-bordered table-hover">
					<thead>
					<tr>
						<th>Nomor Hp</th>
						<th>Isi SMS</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($inboxs as $info) : ?>
							<tr>
								<td><?= $info['SenderNumber'] ?></td>
								<td><?= $info['TextDecoded'] ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
		</div>
	</div>
</div>

<?php
include('footer.php');
?>
