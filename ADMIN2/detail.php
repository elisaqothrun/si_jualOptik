<h2>Detail Pemesanan</h2>
<?php 
$ambil = $koneksi->query ("SELECT * FROM pemesanan JOIN pembeli ON pemesanan.NIK=pembeli.NIK WHERE pemesanan.ID_PEMESANAN='$_GET [id]'");
$detail = $ambil->fetch_assoc();
?>
<pre><?php print_r($detail); ?></pre>
<strong><?php echo $detail ['NAMA_PEMBELI'];?></strong> <br>
<p>
	<?php echo $detail ['NO_TELEPON']; ?> <br>
	<?php echo $detail ['GAMBAR_BUKTIPEMBAYARAN']; ?> 
</p> 

<p>
	<?php echo $detail ['TGL_PEMESANAN']; ?> <br>
	<?php echo $detail ['TOTAL_HARGA']; ?> 
</p> 
<table class= "table table-bordered">
	<thead>
		<tr>
			<th>no</th>
			<th>nama produk</th>
			<th>nama pembeli</th>
			<th>harga</th>
			<th>jumlah</th>
			<th>subtotal</th>
		</tr>
	</thead>
	<tbody>
	<?php $nomor=1; ?>
	<?php $ambil = $koneksi-> query ("SELECT * FROM detail_pemesanan JOIN barang ON detail_pemesanan.ID_BARANG = barang.ID_BARANG
	 WHERE detail_pemesanan.ID_PEMESANAN= $_GET[id]'"); ?>
	<?php 
	while ($pecah =$ambil-> fetch_assoc()){ ?>
	<tr>
		<td><?php echo $nomor;?></td>
		<td><?php echo $pecah['NAMA_BARANG'];?></td>
		<td><?php echo $pecah['HARGA_BARANG'];?></td>
		<td><?php echo $pecah['JUMLAH_BARANG'];?></td>
		<td>
		<?php echo $pecah['HARGA_BARANG'] * $pecah['JUMLAH_BARANG'];?></td>
		
	</tr>
	<?php $nomor++ ?>
	<?php } ?>
		
	</tbody>
</table>