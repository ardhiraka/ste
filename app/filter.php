<?php

include('header.php');

require_once 'db.php';

$angkaoutq = "SELECT angka FROM `angkakeluar` where id = 1;";
$result = mysqli_query($conn, $angkaoutq) or die(mysqli_error($conn));
$angkaout = mysqli_fetch_array($result);

?>

	<div class="container">
		<br />
		<br />
		<br />


		<div class="row form-group">
			<input type="text" class="form-control" id="angkaout" name="angkaout" value="<?= $angkaout['angka'] ;?>" readonly/>
		</div>
		
		<div class="row form-group">
			<textarea type="text" class="form-control" id="hasildapat" name="hasildapat" rows="10" readonly></textarea>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<button class="btn btn-primary btn-block my-4" type="submit"><i class="fa fa-circle-o-notch mr-2"></i>Sinkronisasi</button>
			</div>
			<div class="col-md-6">
				<button class="btn btn-primary btn-block my-4" type="submit" onclick="location.reload();"><i class="fa fa-refresh mr-2"></i>Refresh SMS</button>
			</div>
		</div>

		<div class="md-form">
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
		</div>

		<div class="row form-group">
			<div class="col-md-7">
				<div class="card card-body">
					<table id="tablesms" class="table table-striped table-hover table-sm" cellspacing="0" width="100%">
						<!-- <table class="table table-hover table-stripped table-sm"> -->
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

			<div class="col-md-5">
				<div class="card card-body">
					<label for="smsedit">SMS Edit</label>
					<textarea class="form-control" id="smsedit" rows="10"></textarea>
				</div>
			</div>
		</div>

		<div class="card card-body">
			<div class="row form-group">
				<div class="col-md-4">
					<label for="smsasli">SMS Asli</label>
					<textarea class="form-control" id="smsasli" rows="10" readonly=""></textarea>
				</div>
				<div class="col-md-4">
					<label for="smsalah">SMS Salah</label>
					<textarea class="form-control" id="smssalah" rows="10" readonly=""></textarea>
				</div>
				<div class="col-md-4">
					<label for="smsbenar">SMS Benar</label>
					<textarea class="form-control" id="smsbenar" rows="10" readonly=""></textarea>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<button class="btn btn-info btn-block my-4" type="submit">Switch</button>
			</div>
			<div class="col-md-3">
				<button class="btn btn-info btn-block my-4" type="submit">Submit Server</button>
			</div>
			<div class="col-md-3">
				<button class="btn btn-default btn-block my-4" type="submit">Submit SMS</button>
			</div>
			<div class="col-md-3">
				<button class="btn btn-warning btn-block my-4" type="submit">Cancel SMS</button>
			</div>
		</div>

	</div>

	<?php
	include('footer.php');
	?>