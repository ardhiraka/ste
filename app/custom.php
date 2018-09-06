<?php

include('header.php');

require_once 'db.php';

$diskonq = $db->fetch_var("SELECT * FROM `member` where 1;");
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

		<div class="row">
			<div class="col-sm-12">
				<h4>
					Masukan Kode Custom
				</h4>
				<div class="form">
					<div class="row">
						<div class="col">
							<input type="text" class="form-control" value="CM">
						</div>
						<div class="col">
							<input type="text" class="form-control" placeholder="Masukan Kode Custom">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<input type="text" class="form-control" value="CN">
						</div>
						<div class="col">
							<input type="text" class="form-control" placeholder="Masukan Kode Custom">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<input type="text" class="form-control" value="J">
						</div>
						<div class="col">
							<input type="text" class="form-control" placeholder="Masukan Kode Custom">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<input type="text" class="form-control" value="P">
						</div>
						<div class="col">
							<input type="text" class="form-control" placeholder="Masukan Kode Custom">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<input type="text" class="form-control" value="T">
						</div>
						<div class="col">
							<input type="text" class="form-control" placeholder="Masukan Kode Custom">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<input type="text" class="form-control" value="S">
						</div>
						<div class="col">
							<input type="text" class="form-control" placeholder="Masukan Kode Custom">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<input type="text" class="form-control" value="M">
						</div>
						<div class="col">
							<input type="text" class="form-control" placeholder="Masukan Kode Custom">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<input type="text" class="form-control" value="H">
						</div>
						<div class="col">
							<input type="text" class="form-control" placeholder="Masukan Kode Custom">
						</div>
					</div>
					<button class="btn btn-primary">
						Submit
					</button>
				</div>
			</div>

		</div>
	</div>
	<?php
	include('footer.php');
	?>