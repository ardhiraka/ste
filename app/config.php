<?php

include('header.php');

$members = $db->fetch_all("SELECT * FROM member WHERE downline != ?", 0);
?>

	<div class="container">
		<br />
		<br />
		<br />

		<div align="center">
			<h3>
				Configuration (Member)
			</h3>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<a href="new_member.php" class="btn btn-primary mb-3">Tambah Member</a>
				<a href="template.php" class="btn btn-primary mb-3">Template Config</a>

				<table class="table table-sm table-bordered table-hover">
					<thead>
						<tr>
							<th>Nama</th>
							<th>No HP</th>
							<th>Kode</th>
							<th>Deposit</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($members as $member) :?>
							<tr>
								<td>
									<?= $member['nama'] ;?>
								</td>
								<td>
									<?= $member['nohp'] ;?>
								</td>
								<td>
									<?= $member['kodeid'] ;?>
								</td>
								<td>
									<?= $member['deposit'] ;?>
								</td>
								<td>
									<a href="edit_member.php?id=<?= $member['id'] ?>">Edit</a> |
									<a hapus-member href="javascript:;" data-id="<?= $member['id'] ?>">Hapus</a>
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
			$('[hapus-member]').on('click', function() {
				let id = $(this).data('id');
				let hapus = confirm("Apa anda yakin ingin menghapus member tersebut?");

				if (hapus) {
					window.location = "hapus_member.php?id=" + id;
				}
			});
		});
	</script>

	<?php
	include('footer.php');
	?>
