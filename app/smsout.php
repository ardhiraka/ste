<?php

include('header.php');

?>

<div class="container">
	<br />
	<br />
	<br />

	<div align="center">
		<h3>SMS OUT</h3>
	</div>

	<br />

	<div class="win_number mb-4">
		<form action="perhitungan.php" method="post">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">Winning Number</div>
						</div>
						<input name="win_number" value="<?= $admin['win_number'] ?>" type="number" class="form-control" placeholder="Winning Number" style="border-top-right-radius: 0;border-bottom-right-radius: 0;">
						<div class="input-group-append">
							<button class="btn btn-info btn-sm waves-effect m-0" type="submit">Hitung</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<?php
include('footer.php');
?>
