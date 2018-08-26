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
				Configuration
			</h3>
		</div>

		<div class="md-form">
			<form id="#" action="">
				<div class="row">
					<div class="col">
						<input name="winningnumber" type="text" class="form-control" placeholder="Winning Number" required="required" aria-describedby="basic-addon2">
					</div>
					<div class="col">
						<input name="tanggal" type="text" class="form-control" placeholder="Tanggal" required="required" aria-describedby="basic-addon2">
					</div>
					<div class="col-2 input-group-append">
						<button class="btn btn-info waves-effect m-0" type="submit">Submit</button>
					</div>
				</div>
			</form>
		</div>

	</div>
	<?php
	include('footer.php');
	?>