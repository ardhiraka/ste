<?php

include('header.php');

$splits = $db->fetch_all('select kode, angka, SUM(nominal) as nominal from split WHERE inRekap = 0 AND tanggal = ? GROUP BY kode, angka ORDER BY nominal DESC, kode ASC, angka ASC', date('Y-m-d'));

?>

<div class="container">
	<br />
	<br />
	<br />

	<div align="center">
		<h3>
			Check In
		</h3>
	</div>

	<?php if ($splits) : ?>
		<div class="action-button mb-3">
			<button type="button" class="saveToRekap btn btn-primary">Masukkan ke rekap</button>
		</div>
	<?php endif; ?>

	<div class="mb-3">
		<table class="table table-sm" width="500px">
			<thead>
				<tr>
					<th>Kode</th>
					<th>Angka</th>
					<th>Nominal</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($splits as $item) : ?>
					<tr>
						<td><a href="info.php?by=kode&with=<?= $item['kode'] ?>"><?= $item['kode'] ?></a></td>
						<td><a href="info.php?by=angka&with=<?= $item['angka'] ?>"><?= $item['angka'] ?? '-' ?></a></td>
						<td><?= $item['nominal'] ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<?php if ($splits) : ?>
		<div class="action-button mb-3">
			<button type="button" class="saveToRekap btn btn-primary">Masukkan ke rekap</button>
		</div>
	<?php endif; ?>
</div>

<script type="text/javascript">
	jQuery(function($) {
		$('.saveToRekap').on('click', function() {
			$.post('ajax/rekap/saveToRekap.php', response => {
				if (response.status == 'success') {
					alert("Data berhasil disimpan!");
					window.location.reload();
				} else {
					alert(response.error);
				}
			}, 'json');
		});
	});
</script>

<?php
include('footer.php');
?>
