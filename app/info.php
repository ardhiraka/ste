<?php

include('header.php');

$type   = $_GET['by'];
$with   = $_GET['with'];
$isVal 	= $with ? "= '$with'" : 'IS NULL';

if (!in_array($type, ['kode', 'angka'])) :
	header('location: checkin.php');
endif;

$data = $db->fetch_all("SELECT i.ID, m.nama, i.SenderNumber as no_hp, i.TextDecoded AS message FROM split AS s LEFT JOIN inbox AS i ON i.ID = s.inbox_id LEFT JOIN member AS m ON m.nohp = i.SenderNumber WHERE s.{$type} {$isVal} GROUP BY s.inbox_id");

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
						<th>Nama</th>
						<th>Nomor Hp</th>
						<th>Isi SMS</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($data as $info) : ?>
							<tr>
								<td><?= $info['nama'] ?></td>
								<td><?= $info['no_hp'] ?></td>
								<td><?= $info['message'] ?></td>
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
