<?php 
session_start();
//mendapat id_barang dari url
$ID_BARANG = $_GET['id'];


//jika sudah ada produk iu dikeranjang, maka produk tsb jumlahnya di +1
if (isset($_SESSION['keranjang']['$ID_BARANG']))
{
	$_SESSION['keranjang']['$ID_BARANG'] = 1;
}








//echo "<prev>"
//print_r($_SESSION);
// echo "</prev>";

//larikan ke halaman keranjang
echo "<script>alert('barang telah masuk ke keranjang');</script>";
echo "<script>location='keranjang.php' ; </script>";

?>
