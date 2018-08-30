<?php require_once 'db.php'; ?>

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
    <style type="text/css">
    .table-wrapper-scroll-y {
      display: block;
      max-height: 200px;
      overflow-y: auto;
      -ms-overflow-style: -ms-autohiding-scrollbar;
  }
</style>
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark primary-color">
        <a class="navbar-brand" href="#">SGP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">Master</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="config.php">Config</a>
<!--                     <a class="dropdown-item" href="master_angka.php">Angka</a>
                    <a class="dropdown-item" href="master_colokjitu.php">Colok Jitu</a>
                    <a class="dropdown-item" href="master_colokbebas.php">Colok Bebas</a>
                    <a class="dropdown-item" href="#">Genap Ganjil</a>
                    <a class="dropdown-item" href="#">Besar Kecil</a>
                    <a class="dropdown-item" href="master_makao.php">Makao</a>
                    <a class="dropdown-item" href="master_naga.php">Naga</a> -->
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">Dealer</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Angka</a>
                    <a class="dropdown-item" href="#">Colok Jitu</a>
                    <a class="dropdown-item" href="#">Colok Bebas</a>
                    <a class="dropdown-item" href="#">Genap Ganjil</a>
                    <a class="dropdown-item" href="#">Besar Kecil</a>
                    <a class="dropdown-item" href="#">Makao</a>
                    <a class="dropdown-item" href="#">Naga</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Transaksi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Laporan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Tools</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">Utility</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="member.php">Member</a>
                    <a class="dropdown-item" href="filter.php">Filter SMS</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../">Keluar</a>
            </li>
        </ul>
    </div>
</nav>
