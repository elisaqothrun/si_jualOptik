<?php
include 'koneksi.php';
include "menu.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title> Nota Pembelian</title>
	<link rel="stylesheet" href="ADMIN2 /assets/css/bootstrap.css">
</head>
<body>
<section class="konten">
		<div class="container">
		<?php 
			echo $idn = $_GET['idn'];
			$ambil = $koneksi->query ("SELECT * FROM pemesanan JOIN pembeli ON pemesanan.NIK=pembeli.NIK WHERE pemesanan.ID_PEMESANAN='$idn'");
			$detail = $ambil->fetch_assoc();
			?>
			<p>ID Pemesanan :</p>
			<pre><?php print_r($detail['ID_PEMESANAN']); ?></pre>
			<?php echo "Nama pembeli:<br><strong>" . $detail ['NAMA_PEMBELI'] . "</strong>";?> <br>
			<p>
				<?php echo "Nomor telepon:<br><strong>" . $detail ['NO_TELEPON'] . "</strong>"; ?> <br>
				<?php echo "Gambar bukti pembayaran:<br>" . $detail ['GAMBAR_BUKTIPEMBAYARAN']; ?> 
			</p> 

			<p>
				<?php echo "Tanggal pemesanan:<br><strong>" .$detail ['TGL_PEMESANAN'] . "</strong>"; ?> <br>
				<?php echo "Total harga:<br><strong>" . $detail ['TOTAL_HARGA'] . "</strong>"; ?> 
			</p> 
			<table class= "table table-bordered">
				<thead>
					<tr>
						<th>no</th>
						<th>nama produk</th>
						<!--<th>nama pembeli</th>-->
						<th>harga</th>
						<th>jumlah</th>
						<th>subtotal</th>
					</tr>
				</thead>
				<tbody>
				<?php $nomor=1; ?>
				<?php $ambil = $koneksi-> query ("SELECT * FROM detail_pemesanan WHERE ID_PEMESANAN= '$idn'"); ?>
				<?php 
				while ($pecah =$ambil-> fetch_assoc()){ ?>
				<tr>
					<td><?php echo $nomor;?></td>
					<td><?php echo $pecah['NAMA_BARANG'];?></td>
					<td><?php echo $pecah['HARGA_BARANG'];?></td>
					<td><?php echo $pecah['JUMLAH_BARANG'];?></td>
					<td><?php echo $pecah['SUB_TOTAL'];?></td>
					
				</tr>
				<?php $nomor++ ?>
				<?php } ?>
					
				</tbody>
			</table>
			<div class="row">
				<div class="col-md-7">
					<div class="alert alert-info">
						<p>
							Silahkan melakukan pembayaran Rp.<?php echo number_format($detail['total_pembelian']);?> ke <strong> BANK Mandiri 138-2939993-3322 AN. Fila</strong>
						</p>
					</div>
				</div>
			</div>
		</div>
</section>

</body>
</html>