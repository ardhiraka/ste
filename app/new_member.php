<?php

include('header.php');

$info = false;

if ($_POST) :
	$db->insert('member', $_POST);

	$info = "Data berhasil disimpan!";
endif;

?>
	<style scoped>
		.tab-content {
			margin-bottom: 1rem;
		}
		.nav-tabs .nav-item .nav-link {
			color: inherit;
		}
	</style>

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
					<input name="nama" type="text" class="form-control" placeholder="Nama" required="required">
				</div>
				<div class="col">
					<input name="kodeid" type="text" class="form-control" placeholder="Kode" required="required">
				</div>
				<div class="col">
					<input name="nohp" type="text" class="form-control" placeholder="No HP" required="required">
				</div>
				<div class="col">
					<input name="deposit" type="text" class="form-control" placeholder="Deposit" required="required">
				</div>
			</div>

			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="angka-tab" data-toggle="tab" href="#i-tab-angka" role="tab" aria-controls="angka" aria-selected="true">
						Angka
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#i-tab-50" role="tab" aria-controls="profile" aria-selected="false">
						50:50
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
						Partai
					</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="i-tab-angka" role="tabpanel" aria-labelledby="angka-tab">
					<div class="row mb-3">
						<div class="col">
							<input type="text" name="2d_win" class="form-control" placeholder="Win 2D" required="required">
						</div>
						<div class="col">
							<input type="text" name="2d_disc" class="form-control" placeholder="Disc 2D" required="required">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col">
							<input type="text" name="3d_win" class="form-control" placeholder="Win 3D" required="required">
						</div>
						<div class="col">
							<input type="text" name="3d_disc" class="form-control" placeholder="Disc 3D" required="required">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col">
							<input type="text" name="4d_win" class="form-control" placeholder="Win 4D" required="required">
						</div>
						<div class="col">
							<input type="text" name="4d_disc" class="form-control" placeholder="Disc 4D" required="required">
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="i-tab-50" role="tabpanel" aria-labelledby="profile-tab">
					<div class="row">
						<div class="col">
							<div class="row mb-3">
								<div class="col">
									<input type="text" name="J_disc" class="form-control" placeholder="Disc J" required="required">
								</div>
							</div>
							<?php foreach (['AS', 'KP', 'K'] as $head) : ?>
								<div class="row mb-3">
									<div class="col">
										<input type="text" name='<?= "J_{$head}_disc" ?>' class="form-control" placeholder='<?= "Disc J.{$head}" ?>' required="required">
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="col">
							<div class="row mb-3">
								<div class="col">
									<input type="text" name="P_disc" class="form-control" placeholder="Disc P" required="required">
								</div>
							</div>
							<?php foreach (['AS', 'KP', 'K'] as $head) : ?>
								<div class="row mb-3">
									<div class="col">
										<input type="text" name='<?= "P_{$head}_disc" ?>' class="form-control" placeholder='<?= "Disc P.{$head}" ?>' required="required">
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="col">
							<div class="row mb-3">
								<div class="col">
									<input type="text" name="T_disc" class="form-control" placeholder="Disc T" required="required">
								</div>
							</div>
							<?php foreach (['AS', 'KP', 'E'] as $head) : ?>
								<div class="row mb-3">
									<div class="col">
										<input type="text" name='<?= "T_{$head}_disc" ?>' class="form-control" placeholder='<?= "Disc T.{$head}" ?>' required="required">
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="col">
							<div class="row mb-3">
								<div class="col">
									<input type="text" name="S_disc" class="form-control" placeholder="Disc S" required="required">
								</div>
							</div>
							<?php foreach (['AS', 'KP', 'E'] as $head) : ?>
								<div class="row mb-3">
									<div class="col">
										<input type="text" name='<?= "S_{$head}_disc" ?>' class="form-control" placeholder='<?= "Disc S.{$head}" ?>' required="required">
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
					<div class="row mb-3">
						<div class="col">
							<input type="text" name="C_win" class="form-control" placeholder="Win C" required="required">
						</div>
						<div class="col">
							<input type="text" name="C_disc" class="form-control" placeholder="Disc C" required="required">
						</div>
					</div>
					<?php foreach (['AS', 'KP', 'K', 'E'] as $head) : ?>
						<div class="row mb-3">
							<div class="col">
								<input type="text" name='<?= "C_{$head}_win" ?>' class="form-control" placeholder='<?= "Win C.{$head}" ?>' required="required">
							</div>
							<div class="col">
								<input type="text" name='<?= "C_{$head}_disc" ?>' class="form-control" placeholder='<?= "Disc C.{$head}" ?>' required="required">
							</div>
						</div>
					<?php endforeach; ?>
					<div class="row mb-3">
						<div class="col">
							<input type="text" name="CM_win" class="form-control" placeholder="Win CM" required="required">
						</div>
						<div class="col">
							<input type="text" name="CM_disc" class="form-control" placeholder="Disc CM" required="required">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col">
							<input type="text" name="CN_win" class="form-control" placeholder="Win CN" required="required">
						</div>
						<div class="col">
							<input type="text" name="CN_disc" class="form-control" placeholder="Disc CN" required="required">
						</div>
					</div>
				</div>
			</div>
			
			<!-- <div class="form-row mb-4">
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
			</div> -->
			
			<!-- <div class="form-row mb-4">
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
			</div> -->
			
			<button class="btn btn-info my-4 btn-block" type="submit">Tambah Member</button>

		</form>
		<!-- Default form register -->


	</div>
	<?php
	include('footer.php');
	?>
