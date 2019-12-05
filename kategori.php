<?php
session_start();
include 'koneksi.php';
?>
 <!DOCTYPE html>
<html>
<head>
	<title>Kategori Barang</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>

	<?php include "menu.php"; ?>


  <!--Konten-->
  <section class="konten">
    <div class="container">
      <h1>Kategori Barang</h1>

      <div class="row">

        <?php 
        // $idk = $_GET["id"];
        $ambil = $koneksi->query("SELECT* FROM kategori"); 
          while ($perbarang = $ambil->fetch_assoc() ){ ?>



        <div class="col-md-4">
          <div class="thumbnail">
            <img src="foto_produk/<?php echo $perbarang['GAMBAR_BARANG']; ?>" alt="">
            <div class="caption">
              <h3><?php echo $perbarang['KATEGORI'];?></h3>
              <a href="barang.php?id=<?php echo $perbarang['ID_KATEGORI'];?> " class="btn-danger btn">Selengkapnya</a>

            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </section>

</body>
</html>

