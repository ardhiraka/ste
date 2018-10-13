<?php

include('header.php');

$lists = $db->fetch_all("SELECT so.id as so_id, so.inbox_id, so.member_id, SUM(so.win) AS win, SUM(so.lose) AS lose, SUM(so.total) AS total, SUM(so.total_makan) AS total_makan, SUM(so.total_dealer) AS total_dealer, m.nohp, m.kodeid FROM sms_out AS so LEFT JOIN member AS m ON m.id = so.member_id GROUP BY so.member_id ORDER BY so.id ASC");
$listPotongan = $db->fetch_all("SELECT so.id as so_id, so.inbox_id, so.member_id, SUM(so.win) AS win, SUM(so.lose) AS lose, SUM(so.total) AS total, SUM(so.total_makan) AS total_makan, SUM(so.total_dealer) AS total_dealer, m.nohp, m.kodeid FROM sms_out AS so LEFT JOIN member AS m ON m.id = so.member_id");

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

		<div id="submitSmsOutbox" class="row">
			<div class="col-md-6">
				<button class="btn btn-warning btn-block my-4" type="submit">Cancel SMS</button>
			</div>
			<div class="col-md-6">
				<form id="sendToMember">
					<input type="hidden" name="sms_id" value="<?= join(',', array_column($lists, 'so_id')) ?>">
					<button id="submitSms" class="btn btn-default btn-block my-4">Submit SMS</button>
				</form>
			</div>
		</div>

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
							<td>
								<?= $sms['nohp'] ?>
							</td>
							<td>
								<?= $sms['kodeid'] ?>
							</td>
							<td>
								<?= $sms['win'] ?>
							</td>
							<td>
								<?= $sms['lose'] ?>
							</td>
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

			<div class="col-sm-12 table-group row" style="margin-top: 2rem">
				<div class="col-sm-6" align="center">
					<h2>Potongan Makan</h2>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Total Win</th>
								<th>Total Lose</th>
								<th>Total Transaksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($listPotongan as $sms) : ?>
							<tr>
								<td>
									<?= $sms['win'] ?>
								</td>
								<td>
									<?= $sms['lose'] ?>
								</td>
								<td>
									<?php
									$total 		= abs($sms['total_makan']);
									$isNegative = $sms['total_makan'] < 0;

									echo ($isNegative ? '-- Rp' : 'Rp') . number_format(($total * 1000), 0, ',', '.');
									?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

				<div class="col-sm-6" align="center">
					<h2>Potongan Dealer</h2>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Total Win</th>
								<th>Total Lose</th>
								<th>Total Transaksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($listPotongan as $sms) : ?>
							<tr>
								<td>
									<?= $sms['win'] ?>
								</td>
								<td>
									<?= $sms['lose'] ?>
								</td>
								<td>
									<?php
									$total 		= abs($sms['total_dealer']);
									$isNegative = $sms['total_dealer'] < 0;

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

	</div>

	<script>
		let ajaxTo = file => {
			return 'ajax/smsout/' + file + '.php';
		}

		$('#sendToMember').on('submit', function(event) {
			event.preventDefault();
			$.post(ajaxTo('sendToMember'), $(this).serialize(), response => {
				$('#submitSmsOutbox').remove();
				alert(response.message);
			}, 'json');
		});
	</script>

	<?php
include('footer.php');
?>
