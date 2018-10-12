<?php
include('header.php');
?>

<div class="container">
	<br />
	<br />
	<br />

	<div align="center">
		<h3>
			Laporan
		</h3>
	</div>

	<div class="form-group"><br />
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalNominal">Nominal</button>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalPersentase">Persentase</button>
	</div>

	<div class="form-group"><br />
		<form id="formRekap">
			<input type="hidden" name="recapdate" value="<?= date('Y-m-d') ?>">
			<div class="row">
				<div class="col">
					<select name="kode" type="text" class="form-control" required="required" aria-describedby="basic-addon2" required="required">
						<option value="_all_" selected="selected">All</option>
						<option value="2d">2D</option>
						<option value="3d">3D</option>
						<option value="4d">4D</option>
						<option value="_other_">Other</option>
					</select>
				</div>
				<div class="col-2 input-group-append">
					<button class="btn btn-info waves-effect m-0" type="submit">Lihat</button>
				</div>
			</div>
		</form>
	</div>

	<div id="hasilrekap" class="mb-5">
		<table class="table table-sm">
			<thead>
				<tr>
					<th>Kode</th>
					<th>Angka</th>
					<th>Nominal</th>
					<th>Potongan Makan</th>
					<th>Potongan Dealer</th>
				</tr>
			</thead>
			<tbody id="showRekapData"></tbody>
			<tfoot>
				<tr>
					<td colspan="2">Total</td>
					<td id="totalNominal"></td>
					<td id="totalMakan"></td>
					<td id="totalDealer"></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalNominal" tabindex="-1" role="dialog" aria-labelledby="ModalNominal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ModalNominal">Masukan Nominal Potongan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="hasilpotongan.php" method="post">
				<div class="modal-body">
					<input type="hidden" name="tipe" value="nominal">
					<input type="hidden" name="ids">
					<input type="text" name="jumlah" class="form-control" placeholder="nominal" required="required">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Ambil</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="ModalPersentase" tabindex="-1" role="dialog" aria-labelledby="ModalPersentase" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Masukan Persentase Potongan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="hasilpotongan.php" method="post">
				<div class="modal-body">
					<input type="hidden" name="tipe" value="persen">
					<input type="hidden" name="ids">
					<input type="text" name="jumlah" class="form-control" placeholder="nominal" required="required">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Ambil</button>
				</div>
			</form>
		</div>
	</div>
</div>
	
<script src="../assets/js/pages/rekap.js"></script>

<?php
include('footer.php');
?>
