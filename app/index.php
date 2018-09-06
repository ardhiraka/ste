<?php

include('header.php');

$angkaout = $db->fetch_var("select angka from angkakeluar where id = ?", 1);

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

		<div class="row form-group">
			<div class="col-md-6">
				<input type="text" class="form-control" id="angkaout" name="angkaout" value="<?= $angkaout ;?>" readonly/>
			</div>
			<div class="col-md-6">
				<textarea type="text" class="form-control" id="hasildapat" name="hasildapat" rows="10" readonly></textarea>
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

		<!-- 		<div class="md-form">
			<form id="newMessageForm" action="">
				<div class="row">
					<div class="col">
						<input name="phone_number" type="text" class="form-control" placeholder="Masukan No. HP (Trial Purposes)" required="required" aria-describedby="basic-addon2">
					</div>
					<div class="col">
						<input name="name" type="text" class="form-control" placeholder="Masukan Nama (Trial Purposes)" required="required" aria-describedby="basic-addon2">
					</div>
					<div class="col">
						<input name="message" type="text" class="form-control" placeholder="Masukan format SMS (Trial Purposes)" required="required" aria-describedby="basic-addon2">
					</div>
					<div class="col-2 input-group-append">
						<button class="btn btn-info waves-effect m-0" type="submit">Submit</button>
					</div>
				</div>
			</form>
		</div> -->

		<div class="row form-group">
			<div class="col-md-4">
				<div class="card card-body">
					<table id="tablesms" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>No HP</th>
								<th>Nama</th>
								<th>SMS</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>

			<div class="col-md-8">
				<div class="row form-group">
					<div class="col-md-6">
						<div class="card card-body">
							<label for="smsedit">SMS Edit</label>
							<textarea class="form-control" id="smsedit" rows="10"></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card card-body">
							<label for="smsbenar">SMS Benar</label>
							<textarea class="form-control" id="smsbenar" rows="10" readonly=""></textarea>
						</div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-6">
						<div class="card card-body">
							<label for="smsasli">SMS Asli</label>
							<textarea class="form-control" id="smsasli" rows="10" readonly=""></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card card-body">
							<label for="smsalah">SMS Salah</label>
							<textarea class="form-control" id="smssalah" rows="10" readonly=""></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>

		<br />

		<!-- 		<div class="row">
			<div class="col-md-3">
				<button class="btn btn-info btn-block my-4" type="submit">Switch</button>
			</div>
			<div class="col-md-3">
				<button class="btn btn-info btn-block my-4" type="submit">Submit Server</button>
			</div>
			<div class="col-md-3">
				<button id="submitSms" class="btn btn-default btn-block my-4">Submit SMS</button>
			</div>
			<div class="col-md-3">
				<button class="btn btn-warning btn-block my-4" type="submit">Cancel SMS</button>
			</div>
		</div> -->

	</div>

	<!-- SMS Parse Module - Aris - Techarea -->
	<script type="text/javascript" src="../assets/js/sms.js"></script>
	<!-- Page Scripts -->
	<script src="../assets/js/pages/filter.js"></script>

	<?php
	include('footer.php');
	?>