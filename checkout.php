<?php
session_start();
$koneksi = new mysqli("localhost","root","","jualoptikbaru");
//jk adasessiom pembeli (belum login), mk dilarikan ke login.php
if (!isset($_SESSION["pembeli"])) 
{
	echo "<script>alert('silahkna login');</script>";
	echo "<script>location='login.php' ; </script>";	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
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
		<!--<h1>Keranjang</h1>-->
			<hr>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Sub total</th>

					</tr>
				</thead>
				<tbody>
				<?php $nomor=1 ?>
				<?php $totalbelanja = 0; ?>
				<?php  foreach ($_SESSION["keranjang"] as $ID_BARANG=>$jumlah):?>
				<!--menampilkan produk yang di masukan ke keranjang berdasarkan id baranf -->
				<?php
				$ambil = $koneksi->query("SELECT * FROM barang WHERE ID_BARANG='$ID_BARANG'");
				$pecah =$ambil->fetch_assoc();
				$subtotal = $pecah["HARGA_BARANG"]*$jumlah;
				?>
				<tr>
					<td><?php echo $nomor;?></td>
					<td><?php echo $pecah['NAMA_BARANG'];?></td>
					<td>Rp. <?php echo number_format($pecah['HARGA_BARANG']);?></td>
					<td><?php echo $jumlah ;?></td>
					<td>Rp. <?php echo number_format($subtotal);?></td>
				</tr>
				<?php $nomor++ ?>
				<?php $totalbelanja+=$subtotal; ?>
				<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4">Total Belanja</th>
						<th>Rp. <?php echo number_format($totalbelanja) ?></th>
					</tr>
				</tfoot>
			</table>
			<form method="post">
				<div class="row">	
				<div class="col-md-2">
				<div class="form-group">
				 <input type="text" readonly value="<?php echo $_SESSION["pembeli"]['NAMA_PEMBELI'] ?>" 
					class="form-control">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<input type="text" readonly value="<?php echo $_SESSION["pembeli"]['NO_TELEPON'] ?>"
						 class="form-control">	
						 </div>
						 </div>	
					<div class="col-md-2">
						<select class="form-control" name="ID_ONGKIR">
							<option value="" >Pilih Ongkos Kirim</option>
							<?php
							$ambil = $koneksi->query("SELECT * FROM ongkir");
							while ($perongkir = $ambil-> fetch_assoc()) {
							?>
							<option value="<?php echo $perongkir["ID_ONGKIR"]?>">
								<?php
								echo $perongkir['KOTA'];
							 	echo number_format($perongkir['TARIF']);
								?>
							</option> 
						<?php } ?>
							
						</select>
			</div>
			</div>
			<button class="btn btn-primary" name="checout">Checkout</button>

			</form>

			<?php
			if (isset($_POST["Checkout"]))
			 {
				$NIK = $_SESSION["pembeli"]["NIK"];
				$ID_ADMIN= $_POST["ID_ADMIN"];
				$ID_PEMESANAN = $_POST["ID_PEMESANAN"];
				$ID_ONGKIR = $_POST["ID_ONGKIR"];
				$TGL_PEMESANAN =date("y-m-d");

				$ambil = $koneksi->query("SELECT * FROM ongkir WHERE ID_ONGKIR='$ID_ONGKIR'");
				$arrayongkir = $ambil -> fetch_assoc();
				$TARIF = $arrayongkir['TARIF'];

				$TOTAL_HARGA = $totalbelanja + $TARIF;
				//1. menyimpan data ke tabel pembelian
				$koneksi->query("INSERT INTO pemesanan (ID_PEMESANAN, ID_ADMIN, ID_ONGKIR, NIK, TGL_PEMESANAN, TOTAL_HARGA, JUMLAH_BARANG, BUKTI_PEMBAYARAN,STATUS_PEMBAYARAN,TGL_TRANSFER) VALUES ('$ID_PEMESANAN', '$ID_ADMIN','$ID_ONGKIR','$NIK','$TGL_PEMESANAN','$TOTAL_HARGA', '$JUMLAH_BARANG','$BUKTI_PEMBAYARAN','$STATUS_PEMBAYARAN','$TGL_TRANSFER')");
				//mendapat ID_PEMESANAN barusan terjadi
				$ID_PEMESANAN = $koneksi->insert_ID;
				foreach ($_SESSION["keranjang"] as $ID_BARANG => $jumlah) 
				{
					$koneksi->query("INSERT INTO pemesanan (ID_PEMESANAN, ID_ADMIN, ID_ONGKIR, NIK, TGL_PEMESANAN, TOTAL_HARGA, JUMLAH_BARANG, BUKTI_PEMBAYARAN,STATUS_PEMBAYARAN,TGL_TRANSFER) VALUES ('$ID_PEMESANAN', '$ID_ADMIN','$ID_ONGKIR','$NIK','$TGL_PEMESANAN','$TOTAL_HARGA', '$JUMLAH_BARANG','$BUKTI_PEMBAYARAN','$STATUS_PEMBAYARAN','$TGL_TRANSFER')");
				}
			
		
			}
			?>
			<?php
			{//mengkosongkan keranjang belanja
				unset($_SESSION["keranjang"]);

				//tampilan dialihkan ke halaman nota,nota dari pemsesanan
				echo "<script>alert('pembelian sukses')</script>";
				echo "<script>location='nota.php';</script>";
			}
			?>
			</div>
			
</section>

<pre><?php print_r($_SESSION['pembeli']) ?></pre>
<pre><?php print_r($_SESSION["keranjang"]) ?></pre>
</body>
</html>