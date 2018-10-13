<?php require_once 'session.php'; require_once 'db.php'; ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>SGP</title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Bootstrap core CSS -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="../assets/css/mdb.min.css" rel="stylesheet">
	<!-- Your custom styles (optional) -->
	<link href="../assets/css/style.css" rel="stylesheet">
	<link href="../assets/css/addons/datatables.min.css" rel="stylesheet">
	<!-- SCRIPTS -->
	<!-- JQuery -->
	<script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="../assets/js/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="../assets/js/mdb.min.js"></script>
	<script type="text/javascript" src="../assets/js/addons/datatables.min.js"></script>
</head>

<body>
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark primary-color">
		<a class="navbar-brand" href="index.php">SGP</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="config.php">Member Conf.</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="configdealer.php">Dealer Conf.</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="custom.php">Kustom Kode</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="checkin.php">Check In</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="laporan.php">Rekap</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="smsout.php">SMS Out</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../logout.php">Keluar</a>
				</li>
			</ul>
		</div>
	</nav>
