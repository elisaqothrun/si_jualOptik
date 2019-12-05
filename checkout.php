<?php
session_start();
include 'koneksi.php';
$carikode= mysqli_query($koneksi,"SELECT * FROM pemesanan") OR DIE (mysqli_error($koneksi));
$datakode= mysqli_fetch_array($carikode);
$hitung=mysqli_num_rows($carikode);
if($datakode){
	//$nilaikode=substr($datakode[0], 1);
	//$kode=(int)$nilaikode; 
	$kode=$hitung+1;
	$hasilkode="TR" .str_pad($kode,3,"0",STR_PAD_LEFT);
}else{
	$hasilkode="TR001";
}
//jk adasessiom pembeli (belum login), mk dilarikan ke login.php
if (!isset($_SESSION["pembeli"])) 
{
	echo "<script>alert('silahkan login');</script>";
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
<?php include "menu.php"; ?>

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
				<!--menampilkan produk yang di masukan ke keranjang berdasarkan id barang -->
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
				<?php $nomor++;
				 $totalbelanja+=$subtotal;
				 endforeach ?>
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
			<button class="btn btn-primary" name="nota">Nota</button>
			</form>

			<?php
			 //echo $id_pemesanan_baru = $koneksi->insert_id;
			if (isset($_POST["nota"]))
			 {
				echo $nik = $_SESSION["pembeli"]["NIK"];
				echo $id_ongkir = $_POST["ID_ONGKIR"];
				echo $tgl_pemesanan =date("Y-m-d");
				$ambil = $koneksi->query("SELECT * FROM ongkir WHERE ID_ONGKIR='$id_ongkir'");
				$arrayongkir = $ambil -> fetch_assoc();
				echo $TARIF= $arrayongkir['TARIF'];
				echo $totalharga = $totalbelanja + $TARIF;

				//1. menyimpan data ke tabel pembelian
				echo $koneksi->query("INSERT INTO pemesanan (ID_PEMESANAN, ID_ONGKIR, NIK, TGL_PEMESANAN, JUMLAH_BARANG, TOTAL_HARGA) VALUES ('$hasilkode',$id_ongkir','$nik','$tgl_pemesanan','$jumlah','$totalharga')");
				//mendapat ID_PEMESANAN barusan terjadi
				echo $id_pemesanan_baru = $koneksi->insert_id;
				foreach ($_SESSION["keranjang"] as $ID_BARANG => $jumlah) 
				{
					//medapatkam data produk berdasarkan id barang
					$ambil = $koneksi->query("SELECT * FROM barang WHERE ID_BARANG='$ID_BARANG'");
					$perbarang= $ambil->fetch_assoc();
					echo $nama = $perbarang['NAMA_BARANG'];
					echo $harga = $perbarang['HARGA_BARANG'];
					echo $subtotal = $perbarang['HARGA_BARANG']*$jumlah;

					$koneksi->query("INSERT INTO detail_pemesanan (ID_PEMESANAN, ID_BARANG, NAMA_BARANG, HARGA_BARANG, JUMLAH_BARANG,SUB_TOTAL) VALUES ('$hasilkode',$ID_BARANG, $nama, $harga,'$jumlah','$subtotal')");
				}
				//mengkosongkan keranjang belanja
				//unset($_SESSION["keranjang"]);
				//tampilan dialihkan kehalaman nota
				//echo "<script>alert('Pembelian sukses');</script>";
				//echo "<script>location='nota.php?idn=$id_pemesanan_baru';</script>";
			}
			?>
			</div>
			
</section>

<pre><?php print_r($_SESSION['pembeli']) ?></pre>
<pre><?php print_r($_SESSION["keranjang"]) ?></pre>
</body>
</html>