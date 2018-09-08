<?php
include('header.php');

$lists = $db->fetch_all("SELECT so.id as so_id, so.inbox_id, so.member_id, so.win, so.lose, so.total, m.* FROM sms_out AS so LEFT JOIN member AS m ON m.id = so.member_id ORDER BY so.id ASC");

?>

<div class="container">
	<br />
	<br />
	<br />

	<div align="center">
		<h3>
			SMS OUT
		</h3>
	</div>
	<br />
	<div class="row">

		<div class="col-sm-12" align="center">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Nomor HP</th>
						<th>Kode</th>
						<th>Win</th>
						<th>Lose</th>
						<th>Total Transaksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($lists as $sms) : ?>
						<tr>
							<td><?= $sms['nohp'] ?></td>
							<td><?= $sms['kodeid'] ?></td>
							<td><?= $sms['win'] ?></td>
							<td><?= $sms['lose'] ?></td>
							<td>
								<?php
									$total 		= abs($sms['total']);
									$isNegative = $sms['total'] < 0;

									echo ($isNegative ? '-- Rp' : 'Rp') . number_format(($total * 1000), 0, ',', '.');
								?>
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
