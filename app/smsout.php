<?php

include('header.php');

$admin 		= $db->fetch_row("SELECT * FROM `admin` WHERE id = ?", $_SESSION['uid']);
$member 	= $db->fetch_all("SELECT m.nama, m.nohp, sm.* FROM `smsout_member` AS sm LEFT JOIN `member` AS m ON m.id = sm.member_id WHERE tgl = ?", date('Y-m-d'));
$rekap 		= $db->fetch_all("SELECT * FROM `smsout_dealer` WHERE tgl = ?", date('Y-m-d'));

?>

<div class="container">
	<br />
	<br />
	<br />

	<div align="center">
		<h3>SMS OUT</h3>
	</div>

	<br />

	<?php
	if (isset($_GET['error'])) :
		if ($_GET['error'] == 'numeric') :
			$message = "Winning Number harus angka!";
		elseif ($_GET['error'] == 'length') :
			$message = "Winning Number harus 4 huruf!";
		elseif ($_GET['error'] == 'max') :
			$message = "Maksimal 2 kali dalam sehari!";
		endif;

		echo "<div class=\"alert\" align=\"center\">{$message}</div>";
	endif;
	?>

	<div class="win_number mb-4">
		<form action="perhitungan.php" method="post">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">Winning Number</div>
						</div>
						<input name="win_number" value="<?= $admin['win_number'] ?>" type="number" class="form-control" placeholder="Winning Number" required="required" style="border-top-right-radius: 0;border-bottom-right-radius: 0;">
						<div class="input-group-append">
							<button class="btn btn-info btn-sm waves-effect m-0" type="submit">Hitung</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="row mt-5">
		<div class="col" align="center">
			<h4>Member</h4>
			<a href="sendToMember.php" class="btn btn-success btn-sm">Kirim ke Member</a>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nama</th>
						<th>No. HP</th>
						<th>Win</th>
						<th>Lose</th>
						<th>Hasil</th>
					</tr>
				</thead>
				<tbody>
					<?php $total = 0; foreach ($member as $item) : ?>
						<tr>
							<td><?= $item['nama'] ?></td>
							<td><?= $item['nohp'] ?></td>
							<td><?= $item['win'] ?></td>
							<td><?= $item['lose'] ?></td>
							<td><?= numToRupiah($item['hasil']) ?></td>
						</tr>
					<?php $total += $item['hasil']; endforeach; ?>
					<?php if ($member) : ?>
					<tr>
						<td colspan="4" align="right">Total</td>
						<td><?= numToRupiah($total) ?></td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
		<div class="col" align="center">
			<h4>Rekap</h4>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Win</th>
						<th>Lose</th>
						<th>Hasil Makan</th>
						<th>Hasil Dealer</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($rekap as $item) : ?>
						<tr>
							<td><?= $item['win'] ?></td>
							<td><?= $item['lose'] ?></td>
							<td><?= numToRupiah($item['hasil_makan']) ?></td>
							<td><?= numToRupiah($item['hasil_dealer']) ?></td>
							<td><?= numToRupiah($item['hasil_makan'] + $item['hasil_dealer']) ?></td>
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
