<?php 
require '../koneksi.php';
$carikode= mysqli_query($koneksi,"SELECT * FROM barang") OR DIE (mysqli_error($koneksi));
$datakode= mysqli_fetch_array($carikode);
$hitung=mysqli_num_rows($carikode);
//if($datakode){
	//$nilaikode=substr($datakode[0], 1);
	//$kode=(int)$nilaikode; 
	$kode=$hitung+1;
	$cekkode ="BR" .str_pad($kode,3,"0",STR_PAD_LEFT);
//}else{
	//$hasilkode="BR001";
//}
	$kodeupdate = mysqli_query($koneksi,"SELECT * FROM barang WHERE ID_BARANG = '$cekkode'");
	$kodebaru = mysqli_fetch_array($kodeupdate);
	$cek = mysqli_num_rows($kodeupdate);
	if ($cek == 1){
		$kode2 = $kode+1;
		$hasilkode ="BR" .str_pad($kode2,3,"0",STR_PAD_LEFT);
	}else{
		$hasilkode=$cekkode;
	}

?>
<h2>tambah produk</h2>

<form method ="post" enctype="multipart/form-data">
<div class = "form-group">
	<label>Id Kategori</label>
	<!-- <input type="" class= "form-control" name="id_kategori"> -->
	<select class="form-control" name="id_kategori">
		<option value="ACC001">accecories</option>
		<option value="KCAN001">Kacamata anak anak</option>
		<option value="KCLK001">Kacamata Laki-laki</option>
		<option value="KCWN001">Kacamata Wanita</option>
		<option value="LS001">Lensa</option>
		<option value="SF001">Softlens</option>
		<option value="SG001">Sun Glasses</option>
	</select>
</div>
<div class="form-group">
	<label>ID Barang</label>
	<input type="text" class="form-control" name="id_barang" value="<?php echo $hasilkode?>" readonly>
</div>
<div class ="form-group">
	<label>Nama Barang</label>
	<input type="text" class= "form-control" name="nama_barang">
</div>
<div class ="form-group">
	<label>Harga (RP)</label>
	<input type="number" class= "form-control" name="harga">
</div>
<div class ="form-group">
	<label>Stok</label>
	<input type="number" class= "form-control" name="stok">
</div>
<div class ="form-group">
	<label>tanggal kadaluarsa </label>
	<input type="date" class= "form-control" name="tanggal_kadaluarsa" date="tanggal_kadaluarsa">
</div>
<div class ="form-group">
	<label>Deskripsi Produk</label>
	<textarea class="form-control" name="deskripsi_barang" rows="10"></textarea>
</div>
<div class ="form-group">
	<label>Foto Produk</label>
	<input type="file" class= "form-control" name="foto">
</div>
<button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php
if (isset($_POST['save']))
{ //JIKA DATA PRODUK BARU SUDAH TERSIMPAN MAKA AKAN MUNCUL INFO "DATA TERSIMPAN"
	if(tambahproduk($_POST)==1){
		echo "<script>alert(' Data Tersimpan'); window.location.href='index.php?halaman=produk'</script>";
	}
	else{
		echo mysqli_error($koneksi);
		echo "<script>alert(' Data gagal tersimpan'); window.location.href='index.php?halaman=produk'</script>";
	}
	
}
?>