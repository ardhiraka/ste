<?php

include('header.php');

$customs 	= $db->fetch_all("SELECT custom, asli FROM custom ORDER BY CHAR_LENGTH(custom) DESC");
$custom 	= [];

foreach ($customs as $item) :
	$custom[$item['asli']] = $item['custom'];
endforeach;
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
				<style scoped>
					.tab-content {
						margin-bottom: 1rem;
					}
					.nav-tabs .nav-item .nav-link {
						color: inherit;
					}
				</style>
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="profile-tab" data-toggle="tab" href="#i-tab-50" role="tab" aria-controls="profile" aria-selected="false">
							50:50
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#i-tab-partai" role="tab" aria-controls="contact" aria-selected="false">
							Partai
						</a>
					</li>
				</ul>
				<form action="custom_proses.php" method="POST">
					<div class="form">
						<style scoped>
							.input-group-text {
								min-width: 118px;
							}
							.input-group-text.big-label {
								min-width: 148px;
							}
							.input-group-text.big-label-2X {
								min-width: 160px;
							}
						</style>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="i-tab-50" role="tabpanel" aria-labelledby="angka-tab">
								<div class="row">
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">J (Ganjil)</div>
										    </div>
										    <input value="<?= $custom['J'] ?>" name="J" type="text" class="form-control" placeholder="Custom J" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">J.AS (Ganjil)</div>
										    </div>
										    <input value="<?= $custom['J.AS'] ?>" name="J.AS" type="text" class="form-control" placeholder="Custom J.AS" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">J.KP (Ganjil)</div>
										    </div>
										    <input value="<?= $custom['J.KP'] ?>" name="J.KP" type="text" class="form-control" placeholder="Custom J.KP" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">J.K (Ganjil)</div>
										    </div>
										    <input value="<?= $custom['J.K'] ?>" name="J.K" type="text" class="form-control" placeholder="Custom J.K" required="required">
										</div>
									</div>
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">P (Genap)</div>
										    </div>
										    <input value="<?= $custom['P'] ?>" name="P" type="text" class="form-control" placeholder="Custom P" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">P.AS (Genap)</div>
										    </div>
										    <input value="<?= $custom['P.AS'] ?>" name="P.AS" type="text" class="form-control" placeholder="Custom P.AS" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">P.KP (Genap)</div>
										    </div>
										    <input value="<?= $custom['P.KP'] ?>" name="P.KP" type="text" class="form-control" placeholder="Custom P.KP" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">P.K (Genap)</div>
										    </div>
										    <input value="<?= $custom['P.K'] ?>" name="P.K" type="text" class="form-control" placeholder="Custom P.K" required="required">
										</div>
									</div>
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">T (Besar)</div>
										    </div>
										    <input value="<?= $custom['T'] ?>" name="T" type="text" class="form-control" placeholder="Custom T" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">T.AS (Besar)</div>
										    </div>
										    <input value="<?= $custom['T.AS'] ?>" name="T.AS" type="text" class="form-control" placeholder="Custom T.AS" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">T.KP (Besar)</div>
										    </div>
										    <input value="<?= $custom['T.KP'] ?>" name="T.KP" type="text" class="form-control" placeholder="Custom T.KP" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">T.E (Besar)</div>
										    </div>
										    <input value="<?= $custom['T.E'] ?>" name="T.E" type="text" class="form-control" placeholder="Custom T.E" required="required">
										</div>
									</div>
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">S (Kecil)</div>
										    </div>
										    <input value="<?= $custom['S'] ?>" name="S" type="text" class="form-control" placeholder="Custom S" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">S.AS (Kecil)</div>
										    </div>
										    <input value="<?= $custom['S.AS'] ?>" name="S.AS" type="text" class="form-control" placeholder="Custom S.AS" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">S.KP (Kecil)</div>
										    </div>
										    <input value="<?= $custom['S.KP'] ?>" name="S.KP" type="text" class="form-control" placeholder="Custom S.KP" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">S.E (Kecil)</div>
										    </div>
										    <input value="<?= $custom['S.E'] ?>" name="S.E" type="text" class="form-control" placeholder="Custom S.E" required="required">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">PING (Pinggir)</div>
										    </div>
										    <input value="<?= $custom['PING'] ?>" name="PING" type="text" class="form-control" placeholder="Custom PING" required="required">
										</div>
									</div>
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TENG (Tengah)</div>
										    </div>
										    <input value="<?= $custom['TENG'] ?>" name="TENG" type="text" class="form-control" placeholder="Custom TENG" required="required">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TS (TSST)</div>
										    </div>
										    <input value="<?= $custom['TS'] ?>" name="TS" type="text" class="form-control" placeholder="Custom TS" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TS.AS.KP (TSST)</div>
										    </div>
										    <input value="<?= $custom['TS.AS.KP'] ?>" name="TS.AS.KP" type="text" class="form-control" placeholder="Custom TS.AS.KP" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TS.AS.K (TSST)</div>
										    </div>
										    <input value="<?= $custom['TS.AS.K'] ?>" name="TS.AS.K" type="text" class="form-control" placeholder="Custom TS.AS.K" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TS.AS.E (TSST)</div>
										    </div>
										    <input value="<?= $custom['TS.AS.E'] ?>" name="TS.AS.E" type="text" class="form-control" placeholder="Custom TS.AS.E" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TS.KP.K (TSST)</div>
										    </div>
										    <input value="<?= $custom['TS.KP.K'] ?>" name="TS.KP.K" type="text" class="form-control" placeholder="Custom TS.KP.K" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TS.KP.E (TSST)</div>
										    </div>
										    <input value="<?= $custom['TS.KP.E'] ?>" name="TS.KP.E" type="text" class="form-control" placeholder="Custom TS.KP.E" required="required">
										</div>
									</div>
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TT (TTSS)</div>
										    </div>
										    <input value="<?= $custom['TT'] ?>" name="TT" type="text" class="form-control" placeholder="Custom TT" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TT.AS.KP (TTSS)</div>
										    </div>
										    <input value="<?= $custom['TT.AS.KP'] ?>" name="TT.AS.KP" type="text" class="form-control" placeholder="Custom TT.AS.KP" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TT.AS.K (TTSS)</div>
										    </div>
										    <input value="<?= $custom['TT.AS.K'] ?>" name="TT.AS.K" type="text" class="form-control" placeholder="Custom TT.AS.K" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TT.AS.E (TTSS)</div>
										    </div>
										    <input value="<?= $custom['TT.AS.E'] ?>" name="TT.AS.E" type="text" class="form-control" placeholder="Custom TT.AS.E" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TT.KP.K (TTSS)</div>
										    </div>
										    <input value="<?= $custom['TT.KP.K'] ?>" name="TT.KP.K" type="text" class="form-control" placeholder="Custom TT.KP.K" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TT.KP.E (TTSS)</div>
										    </div>
										    <input value="<?= $custom['TT.KP.E'] ?>" name="TT.KP.E" type="text" class="form-control" placeholder="Custom TT.KP.E" required="required">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">JP (JPPJ)</div>
										    </div>
										    <input value="<?= $custom['JP'] ?>" name="JP" type="text" class="form-control" placeholder="Custom JP" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">JP.AS.KP (JPPJ)</div>
										    </div>
										    <input value="<?= $custom['JP.AS.KP'] ?>" name="JP.AS.KP" type="text" class="form-control" placeholder="Custom JP.AS.KP" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">JP.AS.K (JPPJ)</div>
										    </div>
										    <input value="<?= $custom['JP.AS.K'] ?>" name="JP.AS.K" type="text" class="form-control" placeholder="Custom JP.AS.K" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">JP.AS.E (JPPJ)</div>
										    </div>
										    <input value="<?= $custom['JP.AS.E'] ?>" name="JP.AS.E" type="text" class="form-control" placeholder="Custom JP.AS.E" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">JP.KP.K (JPPJ)</div>
										    </div>
										    <input value="<?= $custom['JP.KP.K'] ?>" name="JP.KP.K" type="text" class="form-control" placeholder="Custom JP.KP.K" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">JP.KP.E (JPPJ)</div>
										    </div>
										    <input value="<?= $custom['JP.KP.E'] ?>" name="JP.KP.E" type="text" class="form-control" placeholder="Custom JP.KP.E" required="required">
										</div>
									</div>
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">JJ (JJPP)</div>
										    </div>
										    <input value="<?= $custom['JJ'] ?>" name="JJ" type="text" class="form-control" placeholder="Custom JJ" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">JJ.AS.KP (JJPP)</div>
										    </div>
										    <input value="<?= $custom['JJ.AS.KP'] ?>" name="JJ.AS.KP" type="text" class="form-control" placeholder="Custom JJ.AS.KP" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">JJ.AS.K (JJPP)</div>
										    </div>
										    <input value="<?= $custom['JJ.AS.K'] ?>" name="JJ.AS.K" type="text" class="form-control" placeholder="Custom JJ.AS.K" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">JJ.AS.E (JJPP)</div>
										    </div>
										    <input value="<?= $custom['JJ.AS.E'] ?>" name="JJ.AS.E" type="text" class="form-control" placeholder="Custom JJ.AS.E" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">JJ.KP.K (JJPP)</div>
										    </div>
										    <input value="<?= $custom['JJ.KP.K'] ?>" name="JJ.KP.K" type="text" class="form-control" placeholder="Custom JJ.KP.K" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">JJ.KP.E (JJPP)</div>
										    </div>
										    <input value="<?= $custom['JJ.KP.E'] ?>" name="JJ.KP.E" type="text" class="form-control" placeholder="Custom JJ.KP.E" required="required">
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="i-tab-partai" role="tabpanel" aria-labelledby="profile-tab">
								<div class="row">
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">C (Colok Bebas)</div>
										    </div>
										    <input value="<?= $custom['C'] ?>" name="C" type="text" class="form-control" placeholder="Custom C" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">C.AS (Jitu AS)</div>
										    </div>
										    <input value="<?= $custom['C.AS'] ?>" name="C.AS" type="text" class="form-control" placeholder="Custom C.AS" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">C.KP (Jitu KP)</div>
										    </div>
										    <input value="<?= $custom['C.KP'] ?>" name="C.KP" type="text" class="form-control" placeholder="Custom C.KP" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">C.K (Jitu K)</div>
										    </div>
										    <input value="<?= $custom['C.K'] ?>" name="C.K" type="text" class="form-control" placeholder="Custom C.K" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">C.E (Jitu E)</div>
										    </div>
										    <input value="<?= $custom['C.E'] ?>" name="C.E" type="text" class="form-control" placeholder="Custom C.E" required="required">
										</div>
									</div>
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label-2X">CM (Colok Makau)</div>
										    </div>
										    <input value="<?= $custom['CM'] ?>" name="CM" type="text" class="form-control" placeholder="Custom CM" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label-2X">CN (Colok Naga)</div>
										    </div>
										    <input value="<?= $custom['CN'] ?>" name="CN" type="text" class="form-control" placeholder="Custom CN" required="required">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<button type="Submit" class="btn btn-primary">Submit</button>
				</form>
			</div>

		</div>
	</div>
	<?php
	include('footer.php');
	?>