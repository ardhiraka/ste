<?php

include('header.php');

$templates = $db->fetch_all("SELECT * FROM template");
?>

	<div class="container">
		<br />
		<br />
		<br />

		<div align="center">
			<h3>
				Template Config
			</h3>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<a href="config.php" class="btn btn-warning mb-3">Kembali</a>
				<a href="new_template.php" class="btn btn-primary mb-3">Tambah Template</a>

				<table class="table table-sm table-bordered table-hover">
					<thead>
						<tr>
							<th>Nama</th>
							<th>Tampilkan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($templates as $item) :?>
							<tr>
								<td>
									<?= $item['nama'] ;?>
								</td>
								<td align="center">
									<?= $item['tampil'] ? '✔' : '❌' ;?>
								</td>
								<td>
									<a href="edit_template.php?id=<?= $item['id'] ?>">Edit</a> |
									<a hapus-template href="javascript:;" data-id="<?= $item['id'] ?>">Hapus</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

			</div>

		</div>
	</div>

	<script type="text/javascript">
		jQuery(function($) {
			$('[hapus-template]').on('click', function() {
				let id = $(this).data('id');
				let hapus = confirm("Apa anda yakin ingin menghapus template tersebut?");

				if (hapus) {
					window.location = "hapus_template.php?id=" + id;
				}
			});
		});
	</script>

	<?php
	include('footer.php');
	?>
