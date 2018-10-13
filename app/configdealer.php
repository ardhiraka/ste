<?php

include('header.php');

$member = $db->fetch_all("SELECT * FROM member WHERE downline = ?", 0);
?>

	<div class="container">
		<br />
		<br />
		<br />

		<div align="center">
			<h3>
				Configuration (Dealer)
			</h3>
		</div>
		
		<div class="row">
			<div class="col-sm-12">
				<a href="new_member.php" class="btn btn-primary">Tambah Member (Dealer)</a>
			</div>
		</div>
		
		
		
		<div class="row">
			<div class="col-sm-12"><br />
				<table class="table table-sm table-bordered table-hover">
					<thead>
						<tr>
							<th>Nama</th>
							<th>No HP</th>
							<th>Kode</th>
							<th>Deposit</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($member as $user) :?>
						<tr>
							<td>
								<?= $user['nama'] ;?>
							</td>
							<td>
								<?= $user['nohp'] ;?>
							</td>
							<td>
								<?= $user['kodeid'] ;?>
							</td>
							<td>
								<?= $user['deposit'] ;?>
							</td>
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
