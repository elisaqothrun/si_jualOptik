<?php

$koneksi->query("DELETE FROM barang WHERE ID_BARANG='$_GET[id]'");
echo "<script>alert('produk terhapus');</script>";
echo "<script>location='index.php?halaman=barang;</script>";
?>