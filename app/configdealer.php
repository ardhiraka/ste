<?php

include('header.php');

require_once 'db.php';

$diskonq = $db->fetch_var("SELECT * FROM `member` where 1;");
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
						<?php while($diskon = mysqli_fetch_array($diskonq)) :?>
						<tr>
							<td>
								<?= $diskon['nama'] ;?>
							</td>
							<td>
								<?= $diskon['nohp'] ;?>
							</td>
							<td>
								<?= $diskon['kodeid'] ;?>
							</td>
							<td>
								<?= $diskon['deposit'] ;?>
							</td>
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>

	</div>
	<?php
	include('footer.php');
	?>