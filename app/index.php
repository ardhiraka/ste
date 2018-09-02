<?php
include('header.php');
?>

<div class="container">
	<br />
	<br />
	<br />

	<div align="center">
		<h3>
			List Recap
		</h3>
	</div>

	<div class="form-group"><br />

		<button class="btn btn-primary">Nominal</button>

		<button class="btn btn-primary">Persentase</button>

	</div>

	<div class="form-group"><br />
		<form id="formRekap">
			<div class="row">
				<div class="col">
					<select name="kode" type="text" class="form-control" required="required" aria-describedby="basic-addon2" required="required">
						<option value="_all_" selected="selected">All</option>
						<option value="2d">2D</option>
						<option value="3d">3D</option>
						<option value="4d">4D</option>
						<option value="other">Other</option>
					</select>
				</div>
				<div class="col">
					<input name="recapdate" type="date" class="form-control" placeholder="date" required="required" aria-describedby="basic-addon2">
				</div>
				<div class="col-2 input-group-append">
					<button class="btn btn-info waves-effect m-0" type="submit">Submit</button>
				</div>
			</div>
		</form>
	</div>

	<div class="btn-section">
		<button class="btn btn-default waves-effect m-0">Nominal</button>
		<button class="btn btn-default waves-effect m-0">Persentase</button>
	</div>

	<div id="hasilrekap">
		<table class="table">
			<thead>
				<tr>
					<th>Kode</th>
					<th>Angka</th>
					<th>Nominal</th>
				</tr>
			</thead>
			<tbody id="showRekapData"></tbody>
		</table>
	</div>
</div>

<script src="../assets/js/pages/rekap.js"></script>

<?php
include('footer.php');
?>