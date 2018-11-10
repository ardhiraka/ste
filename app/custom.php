<?php

include('header.php');

$customs 	= $db->fetch_all("SELECT custom, asli FROM custom ORDER BY CHAR_LENGTH(custom) DESC");
$mCustoms 	= $db->fetch_all("SELECT custom, asli FROM custom WHERE asli LIKE 'M%' ORDER BY id ASC");
$custom 	= [];
$mCustom 	= [];

foreach ($customs as $item) :
	$custom[$item['asli']] = $item['custom'];
endforeach;

foreach ($mCustoms as $item) :
	$mCustom[$item['asli']] = $item['custom'];
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
					<li class="nav-item">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#i-tab-head" role="tab" aria-controls="contact" aria-selected="false">
							Head
						</a>
					</li>
				</ul>
				<form action="custom_proses.php" id="customForm" onsubmit="return false" method="POST">
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
							.input-group-prepend input {
								border-top-right-radius: unset;
    							border-bottom-right-radius: unset;
							}
							input {
								text-transform: uppercase;
							}
							/*.custom_m_item:last-child .delete_item {
								display: none;
							}*/
							.custom_m_item:not(:last-child) .add_item {
								display: none;
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
										      	<div class="input-group-text">J.A (Ganjil)</div>
										    </div>
										    <input value="<?= $custom['J.A'] ?>" name="J.A" type="text" class="form-control" placeholder="Custom J.A" required="required">
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
										      	<div class="input-group-text">P.A (Genap)</div>
										    </div>
										    <input value="<?= $custom['P.A'] ?>" name="P.A" type="text" class="form-control" placeholder="Custom P.A" required="required">
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
										      	<div class="input-group-text">T.A (Besar)</div>
										    </div>
										    <input value="<?= $custom['T.A'] ?>" name="T.A" type="text" class="form-control" placeholder="Custom T.A" required="required">
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
										      	<div class="input-group-text">S.A (Kecil)</div>
										    </div>
										    <input value="<?= $custom['S.A'] ?>" name="S.A" type="text" class="form-control" placeholder="Custom S.A" required="required">
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
										      	<div class="input-group-text big-label">TS.A.KP (TSST)</div>
										    </div>
										    <input value="<?= $custom['TS.A.KP'] ?>" name="TS.A.KP" type="text" class="form-control" placeholder="Custom TS.A.KP" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TS.A.K (TSST)</div>
										    </div>
										    <input value="<?= $custom['TS.A.K'] ?>" name="TS.A.K" type="text" class="form-control" placeholder="Custom TS.A.K" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TS.A.E (TSST)</div>
										    </div>
										    <input value="<?= $custom['TS.A.E'] ?>" name="TS.A.E" type="text" class="form-control" placeholder="Custom TS.A.E" required="required">
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
										      	<div class="input-group-text big-label">TT.A.KP (TTSS)</div>
										    </div>
										    <input value="<?= $custom['TT.A.KP'] ?>" name="TT.A.KP" type="text" class="form-control" placeholder="Custom TT.A.KP" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TT.A.K (TTSS)</div>
										    </div>
										    <input value="<?= $custom['TT.A.K'] ?>" name="TT.A.K" type="text" class="form-control" placeholder="Custom TT.A.K" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">TT.A.E (TTSS)</div>
										    </div>
										    <input value="<?= $custom['TT.A.E'] ?>" name="TT.A.E" type="text" class="form-control" placeholder="Custom TT.A.E" required="required">
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
										      	<div class="input-group-text big-label">JP.A.KP (JPPJ)</div>
										    </div>
										    <input value="<?= $custom['JP.A.KP'] ?>" name="JP.A.KP" type="text" class="form-control" placeholder="Custom JP.A.KP" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">JP.A.K (JPPJ)</div>
										    </div>
										    <input value="<?= $custom['JP.A.K'] ?>" name="JP.A.K" type="text" class="form-control" placeholder="Custom JP.A.K" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">JP.A.E (JPPJ)</div>
										    </div>
										    <input value="<?= $custom['JP.A.E'] ?>" name="JP.A.E" type="text" class="form-control" placeholder="Custom JP.A.E" required="required">
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
										      	<div class="input-group-text big-label">JJ.A.KP (JJPP)</div>
										    </div>
										    <input value="<?= $custom['JJ.A.KP'] ?>" name="JJ.A.KP" type="text" class="form-control" placeholder="Custom JJ.A.KP" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">JJ.A.K (JJPP)</div>
										    </div>
										    <input value="<?= $custom['JJ.A.K'] ?>" name="JJ.A.K" type="text" class="form-control" placeholder="Custom JJ.A.K" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">JJ.A.E (JJPP)</div>
										    </div>
										    <input value="<?= $custom['JJ.A.E'] ?>" name="JJ.A.E" type="text" class="form-control" placeholder="Custom JJ.A.E" required="required">
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
								<div class="row">
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">H.J (Jumlah)</div>
										    </div>
										    <input value="<?= $custom['H.J'] ?>" name="H.J" type="text" class="form-control" placeholder="Custom H.J" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">H.T (Jumlah)</div>
										    </div>
										    <input value="<?= $custom['H.T'] ?>" name="H.T" type="text" class="form-control" placeholder="Custom H.T" required="required">
										</div>
									</div>
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">H.P (Jumlah)</div>
										    </div>
										    <input value="<?= $custom['H.P'] ?>" name="H.P" type="text" class="form-control" placeholder="Custom H.P" required="required">
										</div>
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text big-label">H.S (Jumlah)</div>
										    </div>
										    <input value="<?= $custom['H.S'] ?>" name="H.S" type="text" class="form-control" placeholder="Custom H.S" required="required">
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
										      	<div class="input-group-text big-label">C.A (Jitu A)</div>
										    </div>
										    <input value="<?= $custom['C.A'] ?>" name="C.A" type="text" class="form-control" placeholder="Custom C.A" required="required">
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
								<div class="row">
									<div class="col-12">
										<p class="font-weight-normal">
											Custom Kode untuk M
											<a href="javascript:;" class="add_item btn btn-default btn-sm">Tambah</a>
										</p>
										<hr>
									</div>
									<div class="col-8">
										<div class="custom_m_list">
											<?php foreach ($mCustom as $asli => $custom) : ?>
												<div class="custom_m_item mb-3">
													<div class="input-group">
													    <div class="input-group-prepend">
													      	<input type="text" value="<?= $asli ?>" class="form-control in_m_asli" placeholder="Format Asli" required="required">
													    </div>
													    <input value="<?= $custom ?>" name="<?= $asli ?>" type="text" class="form-control in_m_custom" placeholder="Custom <?= $asli ?>" required="required">
													    <div class="input-group-append">
													    	<button type="button" class="delete_item btn btn-danger btn-sm" style="margin: 0 .375rem;">Hapus</button>
													    </div>
													</div>
												</div>
											<?php endforeach; ?>
										</div>
									</div>
									<div class="col-4"></div>
								</div>
							</div>
							<div class="tab-pane fade" id="i-tab-head" role="tabpanel" aria-labelledby="angka-tab">
								<div class="row">
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">A</div>
										    </div>
										    <input value="<?= $custom['A'] ?>" name="A" type="text" class="form-control" placeholder="Custom A" required="required">
										</div>
									</div>
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">KP</div>
										    </div>
										    <input value="<?= $custom['KP'] ?>" name="KP" type="text" class="form-control" placeholder="Custom KP" required="required">
										</div>
									</div>
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">K</div>
										    </div>
										    <input value="<?= $custom['K'] ?>" name="K" type="text" class="form-control" placeholder="Custom K" required="required">
										</div>
									</div>
									<div class="col">
										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										      	<div class="input-group-text">E</div>
										    </div>
										    <input value="<?= $custom['E'] ?>" name="E" type="text" class="form-control" placeholder="Custom E" required="required">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary mb-4">Submit</button>
				</form>
			</div>
			<div id="forClone" style="display: none;">
				<div class="custom_m_item mb-3">
					<div class="input-group">
						<div class="input-group-prepend">
							<input type="text" class="form-control in_m_asli" placeholder="Format Asli" required="required">
						</div>
						<input value="" name="" type="text" class="form-control in_m_custom" placeholder="Custom" required="required">
						<div class="input-group-append">
							<button type="button" class="delete_item btn btn-danger btn-sm" style="margin: 0 .375rem;">Hapus</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Page Scripts -->
	<script src="../assets/js/pages/custom.js"></script>

	<?php
	include('footer.php');
	?>