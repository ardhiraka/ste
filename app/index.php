<?php

include('header.php');

$admin = $db->fetch_row("SELECT * FROM `admin` WHERE id = ?", $_SESSION['uid']);

?>

	<div class="container-fluid">
		<br />
		<br />
		<br />

		<div align="center">
			<h3>
				Filter SMS
			</h3>
		</div>

		<div class="row mb-4">
			<div class="col-md-12">
				<div class="card card-body">
					<table id="tablesms" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th width="5%">No</th>
								<th width="15%">No HP</th>
								<th width="20%">Nama</th>
								<th width="60%">SMS</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<button class="btn btn-warning btn-block my-4" type="submit">Cancel SMS</button>
			</div>
			<div class="col-md-6">
				<button id="submitSms" class="btn btn-default btn-block my-4">Submit SMS</button>
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-12">
				<div class="row form-group">
					<div class="col-md-4">
						<div class="card card-body mb-3">
							<label for="smsedit">SMS Edit</label>
							<textarea class="form-control" id="smsedit" rows="10"></textarea>
						</div>
						<div class="card card-body mb-3">
							<label for="smsasli">SMS Asli</label>
							<textarea class="form-control" id="smsasli" rows="10" readonly=""></textarea>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-body mb-3">
							<label for="smsbenar">SMS Benar</label>
							<textarea class="form-control" id="smsbenar" rows="10" readonly=""></textarea>
						</div>
						<div class="card card-body mb-3">
							<label for="smsalah">SMS Salah</label>
							<textarea class="form-control" id="smssalah" rows="10" readonly=""></textarea>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-body mb-3">
							<label for="smsbenar">Hasil</label>
							<textarea type="text" class="form-control" id="hasildapat" name="hasildapat" rows="10" readonly></textarea>
						</div>
						<input type="hidden" class="form-control" id="angkaout" name="angkaout" value="<?= $admin['win_number'] ;?>" readonly/>
					</div>
				</div>
			</div>
		</div>

		<br />

	</div>

	<!-- SMS Parse Module - Aris - Techarea -->
	<script type="text/javascript" src="../assets/js/combinatorial.js"></script>
	<script type="text/javascript" src="../assets/js/sms.js"></script>
	<!-- Page Scripts -->
	<script src="../assets/js/pages/filter.js"></script>

	<?php
	include('footer.php');
	?>
