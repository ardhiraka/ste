<?php

include('header.php');

$customs = $db->fetch_all("SELECT custom, asli FROM custom ORDER BY CHAR_LENGTH(asli) DESC");
echo "<pre>";
print_r($customs);
echo "</pre>";

// $diskonq = $db->fetch_var("SELECT * FROM `member` where 1;");
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
						<div class="col-sm-6">
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="J (Ganjil)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="J.A (As Ganjil)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="J.Kp (Kop Ganjil)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="J.K (Kepala Ganjil)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="P (Genap)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="P.A (as Genap)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="P.Kp (kop Genap)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="P.K (Kepala Genap)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="T (Ta/Besar)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="T.A (As Besar)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="T.Kp (Kop Besar)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="T.E (Ekor Besar)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="S (Siau/Kecil)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="S.A (As Kecil)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="S.Kp (Kop Kecil)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="S.E (Ekor Kecil)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="C (Colok Bebas)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="C.A (Jitu As)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="C.Kp (Jitu Kop)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="C.K (Jitu Kepala)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="C.E (Jitu Ekor)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="CM (Colok Makao)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="CN (Colok Naga)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="M (Makao)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="H (Jumlah)" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="M.TSST" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" value="H.TSST" readonly>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Masukan Kode Custom">
								</div>
							</div>
						</div>
					</div>
				</div>
				<button class="btn btn-primary">
						Submit
					</button>
			</div>

		</div>
	</div>
	<?php
	include('footer.php');
	?>