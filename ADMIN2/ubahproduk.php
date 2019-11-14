<h2>Ubah Produk</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM barang WHERE ID_BARANG='$_GET[ID_BARANG]'");
$pecah = $ambil->fetch_assoc();

echo "<pre>";
print_r($pecah);
echo "</pre>";
?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $pecah"['NAMA_BARANG  ']; ?>"	
	</div>

	
</form>