<?php

include('header.php');

require_once 'db.php';

$diskonq = "SELECT * FROM `hit_diskonangka` where 1;";
$result = mysqli_query($conn, $diskonq) or die(mysqli_error($conn));


?>

	<div class="container">
		<br />
		<br />
		<br />
		
		<div align="center">
			<h3>
				Master Diskon Angka
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
								<th>Win 2d</th>
								<th>Win 3d</th>
								<th>Win 4d</th>
								<th>Disc 2d</th>
								<th>Disc 3d</th>
								<th>Disc 4d</th>

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
									<?= $diskon['win2d'] ;?>
								</td>
								<td>
									<?= $diskon['win3d'] ;?>
								</td>
								<td>
									<?= $diskon['win4d'] ;?>
								</td>
								<td>
									<?= $diskon['disc2d'] ;?>
								</td>
								<td>
									<?= $diskon['disc3d'] ;?>
								</td>
								<td>
									<?= $diskon['disc4d'] ;?>
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