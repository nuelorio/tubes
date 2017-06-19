<?php 
require_once('../init.php');
session_start();
if(!isset($_SESSION['username']) && is_null($_SESSION['username'])){
	session_destroy();
	header("Location: ../index.php");
}
$sql = "SELECT * FROM kategori";
$pquery = $db->query($sql);
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Cari Kos-kosan Mudah dan Cepat | Bangkos</title>
	<meta name="description" content="Ngiklan kos mudah, cepat, murah dan terpercaya hanya di Bangkos." />
	<meta name="author" content="Aghi Wardani (1302144194) | Vitalis Emanuel Setiawan (1302144134) | Fathurahman Ma’ruf Hudoarma (1302144107)" />
	<script src="../js/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/custom.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="../js/custom.js"></script>
</head>
<body>
	<!-- header -->
	<nav class="navbar navbar-default navbar-fixed-top navbar-custom">
		<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#ribbon">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="index.php" class="navbar-brand">BangKos</a>
			</div>
			<div class="collapse navbar-collapse" id="ribbon">
				<ul class="nav navbar-nav">
					<!-- dropdown kategori -->
					<li class="dropdown">
						<a href="index.php" class="dropdown-toggle" data-toggle="dropdown">Kategori<span class="caret"></span></a>
						<!-- dropdownnya-->
						<ul class="dropdown-menu">
						<?php while($kategori = mysqli_fetch_assoc($pquery)): ?>
							<li><a href="index.php?kategori=<?= $kategori['id'] ?>"><?= $kategori['kategori']; ?></a></li>		
						<?php endwhile; ?>
						</ul>
					</li>
					<li>
						<a href="cari.php">
							<span class="glyphicon glyphicon-search"></span>Cari
						</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a>Selamat Datang <?= $_SESSION['username'] ?></a></li>
					<li><a href="pengguna.php"><i class="fa fa-cogs"></i>Atur Pengguna</a></li>
					<li><a href="atur.php"><span class="glyphicon glyphicon-cog"></span>Atur Iklan</a></li>
					<li><a href="logout.php"><span class="glyphicon glyphicon-user"></span>Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>
<br><br><br>