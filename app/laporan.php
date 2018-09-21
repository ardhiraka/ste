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
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">Nominal</button>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">Persentase</button>
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

	<div id="hasilrekap">
		<table class="table table-sm">
			<thead>
				<tr>
					<th>Kode</th>
					<th>Angka</th>
					<th>Nominal</th>
				</tr>
			</thead>
			<tbody id="showRekapData"></tbody>
			<tfoot>
				<tr>
					<td>Total</td>
					<td></td>
					<td></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Masukan Nominal Potongan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<input type="text" class="form-control" placeholder="nominal">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="hasilpotongan.php" class="btn btn-primary">Ambil</a>
			</div>
		</div>
	</div>
</div>
	
<script src="../assets/js/pages/rekap.js"></script>

<?php
include('footer.php');
?>