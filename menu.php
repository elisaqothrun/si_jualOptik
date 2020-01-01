<!-- Navbar -->
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

</body>
</html>
     <link rel="stylesheet" href="assets/css/bootstrap.css">
     <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
     <link rel="stylesheet" type="text/css" href="style_footer.css">
     <nav class="navbar navbar-expand-lg navbar-light bg-custom fixed-top" id="mainNav" style="border-radius: 0;">
      <div class="container">
      <a href="index.php" class="navbar-brand"><img src="assets/img/logo-brand.png" height="20"></a>
      <ul class="nav navbar-nav">
          <li><a href="kategori.php">Kategori</a></li>
          <li><a href="keranjang.php">Keranjang</a></li>
          <li><a href="riwayat.php">Riwayat Belanja</a></li>
          <li><a href="daftar.php">Daftar</a></li>

            <!--jk sudah login(ada session pembeli)-->
            <?php if (isset($_SESSION["pembeli"])): ?> 
            <li><a href="logout.php">Logout</a></li>
             <!--jika belum login belum ada session pembeli--> 
            <?php else : ?>
              <li><a href="login.php">Login</a></li>
            <?php endif ?>

      </ul>

      <form action="pencarian.php" method="get" class="navbar-form navbar-right">
        <input type="text" class="form-control" placeholder="masukan nama barang" name="keyword">
        <button class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
      </form>
     
    <!--<form action="datacoba.php" method="post" class="navbar-form navbar-right">
            <input type="text" name="s_keyword" id="s_keyword" class="form-control">
            <button id="search" name="search" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>     
    </form>-->
 
<div class="data"></div>
    </div>
  </nav>