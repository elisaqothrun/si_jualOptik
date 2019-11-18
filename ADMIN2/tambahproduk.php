<h2>tambah produk</h2>
<form method ="post" enctype="multipart/form-data">
<div class = "form-group">
	<label>Id Kategori</label>
	<input type="text" class= "form-control" name="id_kategori">
</div>
<div class = "form-group">
	<label>Nama Barang</label>
	<input type="text" class= "form-control" name="nama_barang">
</div>
<div class = "form-group">
	<label>Harga (RP)</label>
	<input type="number" class= "form-control" name="harga">
</div>
<div class = "form-group">
	<label>Stok</label>
	<input type="number" class= "form-control" name="stok">
</div>
<div class = "form-group">
	<label>tanggal kadaluarsa </label>
	<input type="date" class= "form-control" date="tanggal_kadaluarsa">
</div>
<div class = "form-group">
	<label>Deskripsi Produk</label>
	<textarea class= "form-control" name="deskripsi_barang" rows="10"></textarea>
</div>
<div class = "form-group">
	<label>Foto Produk</label>
	<input type="file" class= "form-control" name="foto">
</div>
<button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php
if (isset($_POST['save']))
{
	$nama= $_FILES['foto']['name'];
	$lokasi= $_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasi,"../foto_produk/".$nama);
	$koneksi->query("INSERT INTO barang(ID_KATEGORI,NAMA_BARANG,HARGA_BARANG,STOK_BARANG,GAMBAR_BARANG,TGL_KADALUARSA,DESKRIPSI_BARANG)
		VALUES('$_POST[id_kategori]','$_POST[nama_barang]','$_POST[harga]','$_POST[stok]','$nama','$_POST[tanggal_kadaluarsa]','$_POST[deskripsi_barang]')");
	//JIKA DATA PRODUK BARU SUDAH TERSIMPAN MAKA AKAN MUNCUL INFO "DATA TERSIMPAN"
	echo "<div class = 'alert alert-info'> Data Tersimpan</div>";
	//kemudian akan merefresh
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=barang'>";
	
}