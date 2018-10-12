<?php

include('header.php');

$admin = $db->fetch_row("SELECT * FROM `admin` WHERE id = ?", $_SESSION['uid']);

$members = $db->fetch_all("SELECT * FROM member");
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

		<?php
			if (isset($_GET['error'])) :
				if ($_GET['error'] == 'numeric') :
					$message = "Winning Number harus angka!";
				elseif ($_GET['error'] == 'length') :
					$message = "Winning Number harus 4 huruf!";
				elseif ($_GET['error'] == 'empty') :
					$message = "Belum ada data!";
				endif;

				echo "<div class=\"alert\">{$message}</div>";
			elseif (isset($_GET['success'])) :
				echo "<div class=\"alert\">Data berhasil disimpan!</div>";
			endif;
		?>

		<div class="win_number mb-4">
			<form action="setWinNumber.php" method="post">
				<div class="row">
					<div class="col">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">Winning Number</div>
							</div>
							<input name="win_number" value="<?= $admin['win_number'] ?>" type="number" class="form-control" placeholder="Winning Number" required="required">
						</div>
					</div>
					<div class="col-2 input-group-append">
						<button class="btn btn-info btn-sm waves-effect m-0" type="submit">Submit</button>
					</div>
				</div>
			</form>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<a href="new_member.php" class="btn btn-primary mb-3">Tambah Member</a><br />

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
						<?php foreach ($members as $member) :?>
							<tr>
								<td>
									<?= $member['nama'] ;?>
								</td>
								<td>
									<?= $member['nohp'] ;?>
								</td>
								<td>
									<?= $member['kodeid'] ;?>
								</td>
								<td>
									<?= $member['deposit'] ;?>
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
