<?php

if (!$_POST || empty($_POST['ids'])) header('location:laporan.php');

include('header.php');

$tipe 	= $_POST['tipe'];
$ids  	= $_POST['ids'];
$jumlah = $_POST['jumlah'];
$list 	= $db->fetch_all("SELECT * FROM split WHERE id IN ({$ids})");
?>

<div class="container">
	<br />
	<br />
	<br />

	<div align="center">
		<h3>
			Hasil Recap
		</h3>
	</div>
	<br />
	<div class="row">

		<div class="col-sm-6">
			<h4>
				Angka Makan
			</h4>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Kode</th>
						<th>Angka</th>
						<th>Nominal</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="col-sm-6">
			<h4>
				Angka Dealer
			</h4>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Kode</th>
						<th>Angka</th>
						<th>Nominal</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

</div>

<script src="../assets/js/pages/rekap.js"></script>

<?php
include('footer.php');
?>
