<?php 
session_start();
$koneksi = new mysqli("localhost", "root","","jualoptik");
 ?>
 <!DOCTYPE html>
<html>
<head>
	<title>Optik Surya</title>
	<link rel="stylesheet" href="ADMIN2/assets/css/bootstrap.css">
</head>
<body>



	<!-- Navbar -->
	<nav class="navbar navbar-default">
		<div class="container">

			<ul class="nav navbar-nav">
				
					<li><a href="index.php">Optik Surya</li>
					<li><a href="kategori.php">Kategori</li>
					<li><a href="keranjang.php">Keranjang</li>
				  	<li><a href="daftar.php">Daftar</li>
					<li><a href="login.php">Login</li>
			</ul>
		</div>
	</nav>


	<!--Konten-->
	<section class="konten">
		<div class="container">
			<h1>Rekomendasi Produk</h1>

			<div class="row">

				<?php $ambil = $koneksi->query("SELECT * FROM barang"); ?>
				<?php while ($perbarang = $ambil->fetch_assoc() ){ ?>
					

				<div class="col-md-3">
					<div class="thumbnail">
						<img src="foto_produk/<?php echo $perbarang['GAMBAR_BARANG']; ?>" alt="">
						<div class="caption">
							<h3><?php echo $perbarang['NAMA_BARANG'];?></h3>
							<h5>Rp. <?php echo number_format($perbarang['HARGA_BARANG']);?></h5>
							<h6>Stok : <?php echo $perbarang['STOK_BARANG']; ?></h6>
								<a href="beli.php?id=<?php echo $perbarang['ID_BARANG']; ?>" class="btn btn-primary">Beli</a>
							
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</section>

</body>
</html>