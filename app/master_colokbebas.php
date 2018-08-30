<?php

include('header.php');

require_once 'db.php';

$diskonq = "SELECT * FROM `hit_colokbebas` where 1;";
$result = mysqli_query($conn, $diskonq) or die(mysqli_error($conn));


?>

	<div class="container">
		<br />
		<br />
		<br />

		<div align="center">
			<h3>
				Master Colok Bebas
			</h3>
		</div>

		<div class="row form-group">
			<div class="col-md-12">
				<div class="card card-body">
					<table class="table table-striped table-hover table-sm" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>No Hp</th>
								<th>Nama</th>
								<th>Win</th>
								<th>Disc</th>
							</tr>
						</thead>
						<tbody>
							<?php while($diskon = mysqli_fetch_array($result)) :?>
							<tr>
								<td>
									<?= $diskon['id'] ;?>
								</td>
								<td>
									<?= $diskon['nohp'] ;?>
								</td>
								<td>
									<?= $diskon['nama'] ;?>
								</td>
								<td>
									<?= $diskon['win'] ;?>
								</td>
								<td>
									<?= $diskon['disc'] ;?>
								</td>
							</tr>
							<?php endwhile ;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<?php
	include('footer.php');
	?>