<<<<<<< HEAD
<<<<<<< HEAD
<?php
session_start();
$ID_BARANG = $_GET["id"];
unset($_SESSION["keranjang"][$ID_BARANG]);
echo "<script>alert('barang dihapus dari keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
=======
<?php
session_start();
$ID_BARANG = $_GET["id"];
unset($_SESSION["keranjang"][$ID_BARANG]);

echo "<script>alert('Barang dihapus dari keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
>>>>>>> 63b846c99e11f17da3bff0a80f9f392a6b44c586
=======
<?php
session_start();
$ID_BARANG = $_GET["id"];
unset($_SESSION["keranjang"][$ID_BARANG]);

echo "<script>alert('Barang dihapus dari keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
>>>>>>> 63b846c99e11f17da3bff0a80f9f392a6b44c586
?>