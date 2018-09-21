<?php
include('header.php');

$inbox_id   = $_GET['data'];
$data       = $db->fetch_all("select * from inbox where ID = ?", $inbox_id);
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
						<?php foreach ($data as $info) : ?>
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
