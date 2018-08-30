<?php

include('header.php');

require_once 'db.php';

$diskonq = "SELECT * FROM `member` where 1;";
$result = mysqli_query($conn, $diskonq) or die(mysqli_error($conn));
?>

	<div class="container">
		<br />
		<br />
		<br />

		<div align="center">
			<h3>
				Configuration
			</h3>
		</div>

		<div class="md-form">
			<form id="#" action="">
				<div class="row">
					<div class="col">
						<input name="winningnumber" type="text" class="form-control" placeholder="Winning Number" required="required" aria-describedby="basic-addon2">
					</div>
					<div class="col-2 input-group-append">
						<button class="btn btn-info waves-effect m-0" type="submit">Submit</button>
					</div>
				</div>
			</form>
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
							<th>Win 2d</th>
							<th>Win 3d</th>
							<th>Win 4d</th>
							<th>Disc 2d</th>
							<th>Disc 2d</th>
							<th>Disc 2d</th>
							<th>Win C</th>
							<th>Disc C</th>
							<th>Win Jitu</th>
							<th>Disc Jitu</th>
							<th>Win CM1</th>
							<th>Win CM2</th>
							<th>Win CM3</th>
							<th>Disc CM</th>
							<th>Win CN</th>
							<th>Disc CN</th>
							<th>Win J</th>
							<th>Disc J</th>
							<th>Win P</th>
							<th>Disc P</th>
							<th>Win T</th>
							<th>Disc T</th>
							<th>Win S</th>
							<th>Disc S</th>
						</tr>
					</thead>
					<tbody>
						<?php while($diskon = mysqli_fetch_array($result)) :?>
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
							<td>
								<?= $diskon['2d_win'] ;?>
							</td>
							<td>
								<?= $diskon['3d_win'] ;?>
							</td>
							<td>
								<?= $diskon['4d_win'] ;?>
							</td>
							<td>
								<?= $diskon['2d_disc'] ;?>
							</td>
							<td>
								<?= $diskon['2d_disc'] ;?>
							</td>
							<td>
								<?= $diskon['2d_disc'] ;?>
							</td>
							<td>
								<?= $diskon['C_win'] ;?>
							</td>
							<td>
								<?= $diskon['C_disc'] ;?>
							</td>
							<td>
								<?= $diskon['Jitu_win'] ;?>
							</td>
							<td>
								<?= $diskon['Jitu_disc'] ;?>
							</td>
							<td>
								<?= $diskon['CM1_win'] ;?>
							</td>
							<td>
								<?= $diskon['CM2_win'] ;?>
							</td>
							<td>
								<?= $diskon['CM3_win'] ;?>
							</td>
							<td>
								<?= $diskon['CM_disc'] ;?>
							</td>
							<td>
								<?= $diskon['CN_win'] ;?>
							</td>
							<td>
								<?= $diskon['CN_disc'] ;?>
							</td>
							<td>
								<?= $diskon['J_win'] ;?>
							</td>
							<td>
								<?= $diskon['J_disc'] ;?>
							</td>
							<td>
								<?= $diskon['P_win'] ;?>
							</td>
							<td>
								<?= $diskon['P_disc'] ;?>
							</td>
							<td>
								<?= $diskon['T_win'] ;?>
							</td>
							<td>
								<?= $diskon['T_disc'] ;?>
							</td>
							<td>
								<?= $diskon['S_win'] ;?>
							</td>
							<td>
								<?= $diskon['S_disc'] ;?>
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