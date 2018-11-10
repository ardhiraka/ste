<?php
include('header.php');

$data 	= $db->fetch_all("SELECT * FROM `rekap` WHERE tanggal = ?", date('Y-m-d'));
$groups	= [];

foreach ($data as $item) :
	$g50 	= ['J', 'P', 'T', 'S', 'PING', 'TENG', 'TS', 'TT', 'JP', 'JJ', 'H'];
	$fCode	= explode('.', $item['kode'])[0];

	// jika termasuk angka
	if (in_array($item['kode'], ['2D', '3D', '4D'])) :
		$groups['angka'][] = $item;
	// jika termasuk 50:50
	elseif (in_array($fCode, $g50)) :
		$groups['50_50'][] = $item;
	// jika termasuk partai
	else :
		$groups['partai'][] = $item;
	endif;
endforeach;

$getIDs = [
	'angka' 	=> isset($groups['angka']) ? implode(',', array_column($groups['angka'], 'id')) : '',
	'50_50' 	=> isset($groups['50_50']) ? implode(',', array_column($groups['50_50'], 'id')) : '',
	'partai' 	=> isset($groups['partai']) ? implode(',', array_column($groups['partai'], 'id')) : '',
	'semua'		=> implode(',', array_column($data, 'id'))
];

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

	<?php if ($data) : ?>
		<div class="form-group"><br />
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalNominal">Nominal</button>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalPersentase">Persentase</button>
			<button type="button" class="sendToDealer btn btn-success">Kirim ke Dealer</button>
		</div>
	<?php endif; ?>

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
			<a class="nav-link" id="contact-tab" data-toggle="tab" href="#i-tab-angka" role="tab" aria-controls="contact" aria-selected="false">
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
		<li class="nav-item">
			<a class="nav-link" id="contact-tab" data-toggle="tab" href="#i-tab-semua" role="tab" aria-controls="contact" aria-selected="false">
				Semua
			</a>
		</li>
	</ul>

	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade" id="i-tab-angka" data-ids='<?= $getIDs['angka'] ?>' role="tabpanel" aria-labelledby="angka-tab">
			<table class="table table-sm">
				<thead>
					<tr>
						<th>Kode</th>
						<th>Angka</th>
						<th>Nominal</th>
						<th>Potongan Makan</th>
						<th>Potongan Dealer</th>
						<th align="center">Dikirim</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Kode</th>
						<th>Angka</th>
						<th>Nominal</th>
						<th>Potongan Makan</th>
						<th>Potongan Dealer</th>
						<th align="center">Dikirim</th>
					</tr>
				</tfoot>
				<?php if (isset($groups['angka'])) : foreach ($groups['angka'] as $item) : ?>
					<tr>
						<td>
							<a href="info.php?by=kode&with=<?= $item['kode'] ?>">
								<?= $item['kode'] ?>
							</a>
						</td>
						<td>
							<a href="info.php?by=angka&with=<?= $item['angka'] ?>">
								<?= $item['angka'] ?? '-' ?>
							</a>
						</td>
						<td><?= $item['nominal'] ?></td>
						<td><?= $item['nom_makan'] ?></td>
						<td><?= $item['nom_dealer'] ?></td>
						<td align="center" class="text-white <?= $item['sendToDealer'] ? 'bg-success' : 'bg-danger' ?>"><?= $item['sendToDealer'] ? '✔' : '❌' ?></td>
					</tr>
				<?php endforeach; else : ?>
					<tr>
						<td colspan="5" align="center">Tidak ada data!</td>
					</tr>
				<?php endif; ?>
				<tbody>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="i-tab-50" data-ids='<?= $getIDs['50_50'] ?>' role="tabpanel" aria-labelledby="50-tab">
			<table class="table table-sm">
				<thead>
					<tr>
						<th>Kode</th>
						<th>Angka</th>
						<th>Nominal</th>
						<th>Potongan Makan</th>
						<th>Potongan Dealer</th>
						<th align="center">Dikirim</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Kode</th>
						<th>Angka</th>
						<th>Nominal</th>
						<th>Potongan Makan</th>
						<th>Potongan Dealer</th>
						<th align="center">Dikirim</th>
					</tr>
				</tfoot>
				<?php if (isset($groups['50_50'])) : foreach ($groups['50_50'] as $item) : ?>
					<tr>
						<td>
							<a href="info.php?by=kode&with=<?= $item['kode'] ?>">
								<?= $item['kode'] ?>
							</a>
						</td>
						<td>
							<a href="info.php?by=angka&with=<?= $item['angka'] ?>">
								<?= $item['angka'] ?? '-' ?>
							</a>
						</td>
						<td><?= $item['nominal'] ?></td>
						<td><?= $item['nom_makan'] ?></td>
						<td><?= $item['nom_dealer'] ?></td>
						<td align="center" class="text-white <?= $item['sendToDealer'] ? 'bg-success' : 'bg-danger' ?>"><?= $item['sendToDealer'] ? '✔' : '❌' ?></td>
					</tr>
				<?php endforeach; else : ?>
					<tr>
						<td colspan="5" align="center">Tidak ada data!</td>
					</tr>
				<?php endif; ?>
				<tbody>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="i-tab-partai" data-ids='<?= $getIDs['partai'] ?>' role="tabpanel" aria-labelledby="partai-tab">
			<table class="table table-sm">
				<thead>
					<tr>
						<th>Kode</th>
						<th>Angka</th>
						<th>Nominal</th>
						<th>Potongan Makan</th>
						<th>Potongan Dealer</th>
						<th align="center">Dikirim</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Kode</th>
						<th>Angka</th>
						<th>Nominal</th>
						<th>Potongan Makan</th>
						<th>Potongan Dealer</th>
						<th align="center">Dikirim</th>
					</tr>
				</tfoot>
				<?php if (isset($groups['partai'])) : foreach ($groups['partai'] as $item) : ?>
					<tr>
						<td>
							<a href="info.php?by=kode&with=<?= $item['kode'] ?>">
								<?= $item['kode'] ?>
							</a>
						</td>
						<td>
							<a href="info.php?by=angka&with=<?= $item['angka'] ?>">
								<?= $item['angka'] ?? '-' ?>
							</a>
						</td>
						<td><?= $item['nominal'] ?></td>
						<td><?= $item['nom_makan'] ?></td>
						<td><?= $item['nom_dealer'] ?></td>
						<td align="center" class="text-white <?= $item['sendToDealer'] ? 'bg-success' : 'bg-danger' ?>"><?= $item['sendToDealer'] ? '✔' : '❌' ?></td>
					</tr>
				<?php endforeach; else : ?>
					<tr>
						<td colspan="5" align="center">Tidak ada data!</td>
					</tr>
				<?php endif; ?>
				<tbody>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="i-tab-semua" data-ids='<?= $getIDs['semua'] ?>' role="tabpanel" aria-labelledby="semua-tab">
			<table class="table table-sm">
				<thead>
					<tr>
						<th>Kode</th>
						<th>Angka</th>
						<th>Nominal</th>
						<th>Potongan Makan</th>
						<th>Potongan Dealer</th>
						<th align="center">Dikirim</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Kode</th>
						<th>Angka</th>
						<th>Nominal</th>
						<th>Potongan Makan</th>
						<th>Potongan Dealer</th>
						<th align="center">Dikirim</th>
					</tr>
				</tfoot>
				<?php if ($data) : foreach ($data as $item) : ?>
					<tr>
						<td>
							<a href="info.php?by=kode&with=<?= $item['kode'] ?>">
								<?= $item['kode'] ?>
							</a>
						</td>
						<td>
							<a href="info.php?by=angka&with=<?= $item['angka'] ?>">
								<?= $item['angka'] ?? '-' ?>
							</a>
						</td>
						<td><?= $item['nominal'] ?></td>
						<td><?= $item['nom_makan'] ?></td>
						<td><?= $item['nom_dealer'] ?></td>
						<td align="center" class="text-white <?= $item['sendToDealer'] ? 'bg-success' : 'bg-danger' ?>"><?= $item['sendToDealer'] ? '✔' : '❌' ?></td>
					</tr>
				<?php endforeach; else : ?>
					<tr>
						<td colspan="5" align="center">Tidak ada data!</td>
					</tr>
				<?php endif; ?>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>

	<?php if ($data) : ?>
		<div class="form-group mb-4"><br />
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalNominal">Nominal</button>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalPersentase">Persentase</button>
			<button type="button" class="sendToDealer btn btn-success">Kirim ke Dealer</button>
		</div>
	<?php endif; ?>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalNominal" tabindex="-1" role="dialog" aria-labelledby="ModalNominal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ModalNominal">Masukan Nominal Potongan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="pemotongan.php" method="post">
				<div class="modal-body">
					<input type="hidden" name="tipe" value="nominal">
					<input type="hidden" name="ids">
					<input type="hidden" name="tab">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">Nominal</div>
						</div>
						<input type="number" name="jumlah" class="form-control" placeholder="nominal" required="required">
					</div>
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
			<form action="pemotongan.php" method="post">
				<div class="modal-body">
					<input type="hidden" name="tipe" value="persen">
					<input type="hidden" name="ids">
					<input type="hidden" name="tab">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">Persentase</div>
						</div>
						<input type="number" name="jumlah" class="form-control" placeholder="Persentase" required="required" style="border-bottom-right-radius: 0;border-top-right-radius: 0">
						<div class="input-group-append">
							<div class="input-group-text">%</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Ambil</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(function($) {

		let getUrlParam = function(name){
			var results = new RegExp('[\?&]' + name + '=([^]*)').exec(window.location.href);
			if (results==null){
				return null;
			}
			else{
				return results[1] || 0;
			}
		}

		let activateTab = function () {
			let tabName = getUrlParam('tab');

			if (tabName) {
				$('#myTab a[href="#' + tabName + '"]').tab('show');
			} else {
				$('#myTab li:first-child a').tab('show');
			}
		}

		activateTab();

		let setUpModal = function(event) {
			let theIDs 	= $('.tab-pane.active').data('ids');
			let tabName	= $('.tab-pane.active').attr('id');

			$(this).find('input[name="ids"]').val(theIDs);
			$(this).find('input[name="tab"]').val(tabName);
		};

		$('#ModalNominal').on('show.bs.modal', setUpModal);
		$('#ModalPersentase').on('show.bs.modal', setUpModal);

		let submitForm = function(path, params, method) {
			method = method || "POST";

			let form = document.createElement("form");
			form.setAttribute("method", method);
			form.setAttribute("action", path);

			for(let key in params) {
				if(params.hasOwnProperty(key)) {
					let field = document.createElement("input");
					field.setAttribute("type", "hidden");
					field.setAttribute("name", key);
					field.setAttribute("value", params[key]);

					form.appendChild(field);
				}
			}

			document.body.appendChild(form);
			form.submit();
		}

		$('.sendToDealer').on('click', function() {
			let sendToDealer = confirm("Apa anda yakin ingin mengirimkan data tersebut ke dealer?");

			if (sendToDealer) {
				let theIDs 	= $('.tab-pane.active').data('ids');
				let tabName	= $('.tab-pane.active').attr('id');
				let length 	= theIDs.toString().length;

				if (length > 0) {
					submitForm('sendToDealer.php', {ids: theIDs, tab: tabName});
				} else {
					alert('Tidak ada data!');
				}
			}
		});

		$("body").on("contextmenu",function(e){
	        return false;
	    });

	    $('body').bind('cut copy paste', function (e) {
	        e.preventDefault();
	    });

	    $('body').css({
	    	'-webkit-touch-callout': 'none',
	    	'-webkit-user-select': 'none',
	    	'-khtml-user-select': 'none',
	    	'-moz-user-select': 'none',
	    	'-ms-user-select': 'none',
	    	'user-select': 'none'
	    });
	});
</script>

<?php
include('footer.php');
?>
