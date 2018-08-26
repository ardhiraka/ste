<?php

include('header.php');

require_once 'db.php';

$memberq = "SELECT * FROM `member` where 1;";
$result = mysqli_query($conn, $memberq) or die(mysqli_error($conn));


?>

	<div class="container">
		<br />
		<br />
		<br />
		
		<div align="center">
			<h3>
				Master Member
			</h3>
		</div>

		<div class="row form-group">
			<div class="col-md-12">
				<div class="card card-body">
					<table class="table table-striped table-hover table-sm" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>No Hp</th>
								<th>Nama</th>
							</tr>
						</thead>
						<tbody>
							<?php while($member = mysqli_fetch_array($result)) :?>
						<tr>
							<td><?= $member['id'] ;?></td>
							<td><?= $member['nohp'] ;?></td>
							<td><?= $member['nama'] ;?></td>
							</tr>
							<?php endwhile ;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<?php
	include('footer.php');
	?>