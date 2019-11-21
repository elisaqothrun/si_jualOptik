<?php
session_start();
$koneksi = new mysqli("localhost","root","","jualoptikbaru");

?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>checkout</title>
	<link rel="stylesheet" href="ADMIN2/assets/css/bootstrap.css">
</head>
<body>

<!-- Navbar -->
	<nav class="navbar navbar-default">
		<div class="container">

			<ul class="nav navbar-nav">
				
					<li><a href="index.php">Optik Surya</li>
					<li><a href="kategori.php">Kategori</li>
					<li><a href="keranjang.php">Keranjang</li>
				  	<li><a href="daftar.php">Daftar</li>
					<li><a href="login_pembeli.php">Login</li>
			</ul>
		</div>
	</nav>
<pre>
	<?php print_r($_SESSION["pembeli"]); ?>
</pre>

</body>
</html>