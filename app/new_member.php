<?php

include('header.php');

$info = false;

if ($_POST) :
	$db->insert('member', $_POST);

	$info = "Data berhasil disimpan!";
endif;

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
	
		<?php if ($info) : ?>
		<div align="center">
			<h5><?= $info ?></h5>
		</div>
		<?php endif; ?>

		<form action="" method="post" class="text-center"><br />
			<input type="hidden" name="downline" value="2">
			<div class="form-row mb-4">
				<div class="col">
					<input name="nama" type="text" class="form-control" placeholder="Nama">
				</div>
				<div class="col">
					<input name="kodeid" type="text" class="form-control" placeholder="Kode">
				</div>
				<div class="col">
					<input name="nohp" type="text" class="form-control" placeholder="No HP">
				</div>
				<div class="col">
					<input name="deposit" type="text" class="form-control" placeholder="Deposit">
				</div>
			</div>
			
			<div class="form-row mb-4">
				<div class="col">
					<input name="2d_win" type="text" class="form-control" placeholder="Win 2D">
				</div>
				<div class="col">
					<input name="3d_win" type="text" class="form-control" placeholder="Win 3D">
				</div>
				<div class="col">
					<input name="4d_win" type="text" class="form-control" placeholder="Win 4D">
				</div>
			</div>
			
			<div class="form-row mb-4">
				<div class="col">
					<input name="2d_disc" type="text" class="form-control" placeholder="Disc 2D">
				</div>
				<div class="col">
					<input name="3d_disc" type="text" class="form-control" placeholder="Disc 3D">
				</div>
				<div class="col">
					<input name="4d_disc" type="text" class="form-control" placeholder="Disc 4D">
				</div>
			</div>
			
			<div class="form-row mb-4">
				<div class="col">
					<input name="c_win" type="text" class="form-control" placeholder="C Win">
				</div>
				<div class="col">
					<input name="c_disc" type="text" class="form-control" placeholder="C Disc">
				</div>
				<div class="col">
					<input name="Jitu_win" type="text" class="form-control" placeholder="Jitu Win">
				</div>
				<div class="col">
					<input name="Jitu_disc" type="text" class="form-control" placeholder="Jitu Disc">
				</div>
			</div>
			
			<div class="form-row mb-4">
				<div class="col">
					<input name="J_win" type="text" class="form-control" placeholder="J Win">
				</div>
				<div class="col">
					<input name="J_disc" type="text" class="form-control" placeholder="J Disc">
				</div>
				<div class="col">
					<input name="P_win" type="text" class="form-control" placeholder="P Win">
				</div>
				<div class="col">
					<input name="P_disc" type="text" class="form-control" placeholder="P Disc">
				</div>
			</div>
			
			<div class="form-row mb-4">
				<div class="col">
					<input name="T_win" type="text" class="form-control" placeholder="T Win">
				</div>
				<div class="col">
					<input name="T_disc" type="text" class="form-control" placeholder="T Disc">
				</div>
				<div class="col">
					<input name="S_win" type="text" class="form-control" placeholder="S Win">
				</div>
				<div class="col">
					<input name="S_disc" type="text" class="form-control" placeholder="S Disc">
				</div>
			</div>
			
			<div class="form-row mb-4">
				<div class="col">
					<input name="M_win" type="text" class="form-control" placeholder="M Win">
				</div>
				<div class="col">
					<input name="M_disc" type="text" class="form-control" placeholder="M Disc">
				</div>
				<div class="col">
					<input name="H_win" type="text" class="form-control" placeholder="H Win">
				</div>
				<div class="col">
					<input name="H_disc" type="text" class="form-control" placeholder="H Disc">
				</div>
			</div>

			<div class="form-row mb-4">
				<div class="col">
					<input name="CM1_win" type="text" class="form-control" placeholder="CM1 Win">
				</div>
				<div class="col">
					<input name="CM2_win" type="text" class="form-control" placeholder="CM2 Win">
				</div>
				<div class="col">
					<input name="CM3_win" type="text" class="form-control" placeholder="CM3 Win">
				</div>
				<div class="col">
					<input name="CM_disc" type="text" class="form-control" placeholder="CM Disc">
				</div>
			</div>

			<div class="form-row mb-4">
				<div class="col">
					<input name="CN_win" type="text" class="form-control" placeholder="CN Win">
				</div>
				<div class="col">
					<input name="CN_disc" type="text" class="form-control" placeholder="CN Disc">
				</div>
			</div>
			
			<button class="btn btn-info my-4 btn-block" type="submit">Tambah Member</button>

		</form>
		<!-- Default form register -->


	</div>
	<?php
	include('footer.php');
	?>
