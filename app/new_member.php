<?php

include('header.php');

require_once 'db.php';

?>

	<div class="container">
		<br />
		<br />
		<br />

		<div align="center">
			<h3>
				Tambah Member
			</h3>
		</div>

		<form class="text-center"><br />

			<div class="form-row mb-4">
				<div class="col">
					<input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="Nama">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Kode">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="No HP">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Deposit">
				</div>
			</div>
			
			<div class="form-row mb-4">
				<div class="col">
					<input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="Win 2D">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Win 3D">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Win 4D">
				</div>
			</div>
			
			<div class="form-row mb-4">
				<div class="col">
					<input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="Disc 2D">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Disc 3D">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Disc 4D">
				</div>
			</div>
			
			<div class="form-row mb-4">
				<div class="col">
					<input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="C Win">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="C Disc">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Jitu Win">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Jitu Disc">
				</div>
			</div>
			
			<div class="form-row mb-4">
				<div class="col">
					<input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="J Win">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="J Disc">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="P Win">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="P Disc">
				</div>
			</div>
			
			<div class="form-row mb-4">
				<div class="col">
					<input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="T Win">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="T Disc">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="S Win">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="S Disc">
				</div>
			</div>
			
			<div class="form-row mb-4">
				<div class="col">
					<input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="M Win">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="M Disc">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="H Win">
				</div>
				<div class="col">
					<input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="H Disc">
				</div>
			</div>
			
			<button class="btn btn-info my-4 btn-block" type="submit">Tambah Member</button>

		</form>
		<!-- Default form register -->


	</div>
	<?php
	include('footer.php');
	?>