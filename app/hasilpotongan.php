<?php

if (!$_POST || empty($_POST['ids'])) header('location:laporan.php');

include('header.php');

$tipe 	= $_POST['tipe'];
$ids  	= $_POST['ids'];
$jumlah = $_POST['jumlah'];
$list 	= $db->fetch_all("SELECT * FROM split WHERE id IN ({$ids})");

foreach ($list as $split) :
	$nominal 	= $split['nominal'];
	$nom_makan 	= 0;
	$nom_dealer	= 0;

	if ($tipe == 'nominal') :
		$nom_makan 	= ($jumlah >= $nominal) ? $nominal : $jumlah;
		$sisa 		= $nominal - $jumlah;
		$nom_dealer = $sisa <= 0 ? 0 : $sisa;
	elseif ($tipe == 'persen') :
		$jumlah 	= ($jumlah >= 100) ? 100 : $jumlah;
		$nom_makan 	= ceil($nominal * ($jumlah / 100));
		$sisa 		= $nominal - $nom_makan;
		$nom_dealer = $sisa <= 0 ? 0 : $sisa;
	endif;

	$db->update('split', ['nom_makan' => $nom_makan, 'nom_dealer' => $nom_dealer], ['id' => $split['id']]);
endforeach;

$result	= $db->fetch_all("SELECT * FROM split WHERE id IN ({$ids}) order by cast(nom_dealer as SIGNED) desc");

$outBox = $db->fetch_all("SELECT kode, group_concat(angka SEPARATOR '.') as nominal, nom_dealer FROM split WHERE id IN ({$ids}) GROUP BY nom_dealer,kode ORDER BY cast(nom_dealer as SIGNED) DESC");

$sms = "";
foreach ($outBox as $ob) :
	$pecah = explode('.', $ob['kode']);
	$theCode = $pecah[0];
	$theHead = isset($pecah[1]) ? $pecah[1] : false;

	if (in_array($theCode, ['2d', '3d', '4d'])) :
		$sms .= "{$ob['nominal']}@{$ob['nom_dealer']} ";
	elseif (in_array($theCode, ['J', 'P', 'T', 'S'])) :
		$sms .= "{$theCode}@{$ob['nom_dealer']} ";
	elseif (in_array($theCode, ['CM', 'CN', 'C'])) :
		if ($theHead) :
			$sms .= "{$ob['kode']};{$ob['nominal']}@{$ob['nom_dealer']} ";
		else :
			$sms .= "{$theCode};{$ob['nominal']}@{$ob['nom_dealer']} ";
		endif;
	elseif (in_array($theCode, ['M', 'H'])) :
		$sms .= "{$ob['kode']}@{$ob['nom_dealer']} ";
	endif;
endforeach;
$sms = rtrim($sms, ' ');

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

		<div id="submitSmsOutbox" class="row">
			<div class="col-md-6">
				<button class="btn btn-warning btn-block my-4" type="submit">Cancel SMS</button>
			</div>
			<div class="col-md-6">
				<form id="sendToNumber">
					<input type="hidden" name="sms" value="<?= $sms ?>">
					<button type="submit" id="submitSms" class="btn btn-default btn-block my-4">Submit SMS</button>
				</form>
			</div>
		</div>

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
						<?php foreach($result as $data) : ?>
						<tr>
							<td>
								<?= $data['kode'] ?>
							</td>
							<td>
								<?= $data['angka'] ?>
							</td>
							<td>
								<?= $data['nom_makan'] ?>
							</td>
						</tr>
						<?php endforeach; ?>
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
						<?php foreach($result as $data) : ?>
						<tr>
							<td>
								<?= $data['kode'] ?>
							</td>
							<td>
								<?= $data['angka'] ?>
							</td>
							<td>
								<?= $data['nom_dealer'] ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

	</div>

	<script src="../assets/js/pages/rekap.js"></script>

	<?php
include('footer.php');
?>
