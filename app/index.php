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
		<form id="#" action="">
			<div class="row">
				<div class="col">
					<select name="kode" type="text" class="form-control" required="required" aria-describedby="basic-addon2">
					<option hidden>Code Type</option>
					<option>All</option>
					<option>4D</option>
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
</div>

<div id="hasilrekap">
	
</div>

<?php
include('footer.php');
?>