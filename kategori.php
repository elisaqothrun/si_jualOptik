<?php
session_start();
$koneksi = new mysqli ("localhost","root","","jualoptikbaru");

?>
 <!DOCTYPE html>
<html>
<head>
	<title>Kategori Barang</title>
	<link rel="stylesheet" href="ADMIN2 /assets/css/bootstrap.css">
</head>
<body>

		 <!-- Navbar -->
  <nav class="navbar navbar-default">
    <div class="container">

      <ul class="nav navbar-nav">
        
          <li><a href="index.php">Optik Surya</li>
          <li><a href="kategori.php">Kategori</li>
          <li><a href="Keranjang.php">Keranjang</li>
          <li><a href="Daftar.php">Daftar</li>
            <!--jk sudah login(ada session pembeli)-->
            <?php if (isset($_SESSION["pembeli"])): ?> 
            <li><a href="Logout.php">Logout</li>
             <!--jika belum login belum ada session pembeli--> 
            <?php else : ?>
              <li><a href="login.php">Login</a></li>
            <?php endif ?>

      </ul>
    </div>
  </nav>


  <!--Konten-->
  <section class="konten">
    <div class="container">
      <h1>Kategori Barang</h1>

      <div class="row">

        <?php $ambil = $koneksi->query("SELECT* FROM kategori"); 
          while ($perbarang = $ambil->fetch_assoc() ){ ?>

          

        <div class="col-md-4">
          <div class="thumbnail">
            <img src="foto_produk/<?php echo $perbarang['GAMBAR']; ?>" alt="">
            <div class="caption">
              <h3><?php echo $perbarang['KATEGORI'];?></h3>
              <a href="index.php?halaman=kategoriselengkapnya&id=<?php echo $perbarang['KATEGORI'];?> " class="btn-danger btn">Selengkapnya</a>
                <a href="barang.php" class="btn btn-primary">Selengkapnya</a>
              
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </section>
?>

</body>
</html>
