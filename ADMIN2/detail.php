<h2>Detail Pemesanan</h2>
<?php 
$ambil = $koneksi->query ("SELECT * FROM pemesanan JOIN pembeli ON pemesanan.NIK=pembeli.NIK WHERE pemesanan.ID_PEMESANAN='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>
<p>ID Pembelian :</p>
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
	<?php $ambil = $koneksi-> query ("SELECT * FROM detail_pemesanan JOIN barang ON detail_pemesanan.ID_BARANG = barang.ID_BARANG
	 WHERE detail_pemesanan.ID_PEMESANAN= '$_GET[id]'"); ?>
	<?php 
	while ($pecah =$ambil-> fetch_assoc()){ ?>
	<tr>
		<td><?php echo $nomor;?></td>
		<td><?php echo $pecah['NAMA_BARANG'];?></td>
		<td><?php echo $pecah['HARGA_BARANG'];?></td>
		<td><?php echo $pecah['STOK_BARANG'];?></td>
		<td>
		<?php echo $pecah['HARGA_BARANG'] * $pecah['STOK_BARANG'];?></td>
		
	</tr>
	<?php $nomor++ ?>
	<?php } ?>
		
	</tbody>