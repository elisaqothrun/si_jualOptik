<h2>Ubah Barang</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM kategori WHERE ID_KATEGORI='$_GET[ID_KATEGORI]'");
$pecah = $ambil->fetch_assoc();

echo "<pre>";
print_r($pecah);
echo "</pre>";
?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Barang</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $pecah"['KATEGORI  ']; ?>"	
	</div>

	
</form>