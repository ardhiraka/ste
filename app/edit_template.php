<?php

include('header.php');

$field_tsjp 	= ['TS', 'TS.A.KP', 'TS.A.K', 'TS.A.E', 'TS.KP.K', 'TS.KP.E', 'JP', 'JP.A.KP', 'JP.A.K', 'JP.A.E', 'JP.KP.K', 'JP.KP.E'];
$field_ttjj 	= ['TT', 'TT.A.KP', 'TT.A.K', 'TT.A.E', 'TT.KP.K', 'TT.KP.E', 'JJ', 'JJ.A.KP', 'JJ.A.K', 'JJ.A.E', 'JJ.KP.K', 'JJ.KP.E'];
$field_h 		= [['H.T', 'H.J'], ['H.S', 'H.P']];
$field_partai 	= ['C', 'C.A', 'C.KP', 'C.K', 'C.E', 'CM', 'CN', 'M'];

$data  	= $db->fetch_row("SELECT * FROM `template` WHERE id = ?", $_GET['id']);
$config = (array) json_decode($data['config']);
$tampil = ['Sembunyikan', 'Tampilkan'];

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
				Edit Template
			</h3>
		</div>

		<style scoped>
			.input-group-text {
				min-width: 80px;
			}
			.input-group-text.label-55,
			.input-group-text.label-partai {
				min-width: 98px;
			}
			.input-group-text.label-55-lg {
				min-width: 120px;
			}
			.input-group-text.big-label-2X {
				min-width: 160px;
			}
			.input-group-prepend input {
				border-top-right-radius: unset;
				border-bottom-right-radius: unset;
			}
		</style>

		<form action="edit_template_proses.php?id=<?= $_GET['id'] ?>" method="post" class="text-center"><br />
			<div class="form-row mb-4">
				<div class="col">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">Nama Template</div>
						</div>
						<input name="nama" value="<?= $data['nama'] ?>" userdata type="text" class="form-control" placeholder="Nama Template" required="required">
					</div>
				</div>
				<div class="col">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">Status</div>
						</div>
						<select name="tampil" class="form-control" required="required">
							<?php foreach ($tampil as $value => $name) : ?>
								<option value="<?= $value ?>" <?= $value == $data['tampil'] ? 'selected="selected"' : null ?>><?= $name ?></option>
							<?php endforeach; ?>
						</select>
					</div>
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
					<a class="nav-link" id="contact-tab" data-toggle="tab" href="#i-tab-partai" role="tab" aria-controls="contact" aria-selected="false">
						Partai
					</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<!-- tab angka -->
				<div class="tab-pane fade show active" id="i-tab-angka" role="tabpanel" aria-labelledby="angka-tab">
					<div class="row mb-3">
						<div class="col">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">Win 2D</div>
								</div>
								<input name="WIN_2D" value="<?= $config['WIN_2D'] ?>" type="text" class="form-control" placeholder="Win 2D" required="required">
							</div>
						</div>
						<div class="col">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">Disc 2D</div>
								</div>
								<input name="DISC_2D" value="<?= $config['DISC_2D'] ?>" type="text" class="form-control" placeholder="Disc 2D" required="required">
							</div>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">Win 3D</div>
								</div>
								<input name="WIN_3D" value="<?= $config['WIN_3D'] ?>" type="text" class="form-control" placeholder="Win 3D" required="required">
							</div>
						</div>
						<div class="col">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">Disc 3D</div>
								</div>
								<input name="DISC_3D" value="<?= $config['DISC_3D'] ?>" type="text" class="form-control" placeholder="Disc 3D" required="required">
							</div>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">Win 4D</div>
								</div>
								<input name="WIN_4D" value="<?= $config['WIN_4D'] ?>" type="text" class="form-control" placeholder="Win 4D" required="required">
							</div>
						</div>
						<div class="col">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">Disc 4D</div>
								</div>
								<input name="DISC_4D" value="<?= $config['DISC_4D'] ?>" type="text" class="form-control" placeholder="Disc 4D" required="required">
							</div>
						</div>
					</div>
				</div>

				<!-- tab 50:50 -->
				<div class="tab-pane fade" id="i-tab-50" role="tabpanel" aria-labelledby="profile-tab">
					<div class="row">
						<div class="col">
							<div class="row mb-3">
								<div class="col">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text label-55">Disc J</div>
										</div>
										<input name="DISC_J" value="<?= $config['DISC_J'] ?>" type="text" class="form-control" placeholder="Disc J" required="required">
									</div>
								</div>
							</div>
							<?php foreach (['A', 'KP', 'K'] as $head) : ?>
								<div class="row mb-3">
									<div class="col">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text label-55"><?= "Disc J.{$head}" ?></div>
											</div>
											<input name='<?= "DISC_J_{$head}" ?>' value='<?= $config["DISC_J_{$head}"] ?>' type="text" class="form-control" placeholder='<?= "Disc J.{$head}" ?>' required="required">
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="col">
							<div class="row mb-3">
								<div class="col">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text label-55">Disc P</div>
										</div>
										<input name="DISC_P" value='<?= $config["DISC_P"] ?>' type="text" class="form-control" placeholder="Disc P" required="required">
									</div>
								</div>
							</div>
							<?php foreach (['A', 'KP', 'K'] as $head) : ?>
								<div class="row mb-3">
									<div class="col">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text label-55"><?= "Disc P.{$head}" ?></div>
											</div>
											<input name='<?= "DISC_P_{$head}" ?>' value='<?= $config["DISC_P_{$head}"] ?>' type="text" class="form-control" placeholder='<?= "Disc P.{$head}" ?>' required="required">
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="col">
							<div class="row mb-3">
								<div class="col">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text label-55">Disc T</div>
										</div>
										<input name="DISC_T" value='<?= $config["DISC_T"] ?>' type="text" class="form-control" placeholder="Disc T" required="required">
									</div>
								</div>
							</div>
							<?php foreach (['A', 'KP', 'E'] as $head) : ?>
								<div class="row mb-3">
									<div class="col">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text label-55"><?= "Disc T.{$head}" ?></div>
											</div>
											<input name='<?= "DISC_T_{$head}" ?>' value='<?= $config["DISC_T_{$head}"] ?>' type="text" class="form-control" placeholder='<?= "Disc T.{$head}" ?>' required="required">
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="col">
							<div class="row mb-3">
								<div class="col">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text label-55">Disc S</div>
										</div>
										<input name="DISC_S" value='<?= $config["DISC_S"] ?>' type="text" class="form-control" placeholder="Disc S" required="required">
									</div>
								</div>
							</div>
							<?php foreach (['A', 'KP', 'E'] as $head) : ?>
								<div class="row mb-3">
									<div class="col">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text label-55"><?= "Disc S.{$head}" ?></div>
											</div>
											<input name='<?= "DISC_S_{$head}" ?>' value='<?= $config["DISC_S_{$head}"] ?>' type="text" class="form-control" placeholder='<?= "Disc S.{$head}" ?>' required="required">
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<div class="input-group-text label-55-lg">Disc PING</div>
								</div>
								<input name="DISC_PING" value='<?= $config["DISC_PING"] ?>' type="text" class="form-control" placeholder="Disc PING" required="required">
							</div>
						</div>
						<div class="col">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<div class="input-group-text label-55-lg">Disc TENG</div>
								</div>
								<input name="DISC_TENG" value='<?= $config["DISC_TENG"] ?>' type="text" class="form-control" placeholder="Disc TENG" required="required">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<?php foreach ($field_tsjp as $item) : ?>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<div class="input-group-text label-55-lg"><?= "Disc {$item}" ?></div>
									</div>
									<input name='<?= "DISC_" . str_replace('.', '_', $item) ?>' value='<?= $config["DISC_" . str_replace('.', '_', $item)] ?>' type="text" class="form-control" placeholder='<?= "Disc {$item}" ?>' required="required">
								</div>
							<?php endforeach; ?>
						</div>
						<div class="col">
							<?php foreach ($field_ttjj as $item) : ?>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<div class="input-group-text label-55-lg"><?= "Disc {$item}" ?></div>
									</div>
									<input name='<?= "DISC_" . str_replace('.', '_', $item) ?>' value='<?= $config["DISC_" . str_replace('.', '_', $item)] ?>' type="text" class="form-control" placeholder='<?= "Disc {$item}" ?>' required="required">
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<?php foreach ($field_h[0] as $item) : ?>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<div class="input-group-text label-55-lg"><?= "Disc {$item}" ?></div>
									</div>
									<input name='<?= "DISC_" . str_replace('.', '_', $item) ?>' value='<?= $config["DISC_" . str_replace('.', '_', $item)] ?>' type="text" class="form-control" placeholder='<?= "Disc {$item}" ?>' required="required">
								</div>
							<?php endforeach; ?>
						</div>
						<div class="col">
							<?php foreach ($field_h[1] as $item) : ?>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<div class="input-group-text label-55-lg"><?= "Disc {$item}" ?></div>
									</div>
									<input name='<?= "DISC_" . str_replace('.', '_', $item) ?>' value='<?= $config["DISC_" . str_replace('.', '_', $item)] ?>' type="text" class="form-control" placeholder='<?= "Disc {$item}" ?>' required="required">
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>

				<!-- tab partai -->
				<div class="tab-pane fade" id="i-tab-partai" role="tabpanel" aria-labelledby="contact-tab">
					<?php foreach ($field_partai as $item) : ?>
						<div class="row mb-3">
							<div class="col">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text label-partai"><?= "Win {$item}" ?></div>
									</div>
									<input name='<?= "WIN_" . str_replace('.', '_', $item) ?>' value='<?= $config["WIN_" . str_replace('.', '_', $item)] ?>' type="text" class="form-control" placeholder='<?= "Win {$item}" ?>' required="required">
								</div>
							</div>
							<div class="col">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text label-partai"><?= "Disc {$item}" ?></div>
									</div>
									<input name='<?= "DISC_" . str_replace('.', '_', $item) ?>' value='<?= $config["DISC_" . str_replace('.', '_', $item)] ?>' type="text" class="form-control" placeholder='<?= "Disc {$item}" ?>' required="required">
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			
			<button class="btn btn-info my-4 btn-block" type="submit">Simpan Perubahan</button>

		</form>
		<!-- Default form register -->


	</div>

	<?php
	include('footer.php');
	?>
