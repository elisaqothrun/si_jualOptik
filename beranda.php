<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<br/>
	<a href="input.php">+ TAMBAH DATA</a>
	<br/>
	<br/>
	<table border="1">
		<tr>
			<th>ID</th>
			<th>Nama</th>
			<th>Kota</th>
			<th>Telepon</th>
			<th>OPSI</th>
		</tr>
		<?php 
		include 'koneksi.php';
		$data = mysqli_query($koneksi,"SELECT * FROM profile");
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
				<td><?php echo $d['id_user']; ?></td>
				<td><?php echo $d['nama']; ?></td>
				<td><?php echo $d['kota']; ?></td>
				<td><?php echo $d['telp']; ?></td>
				<td>
					<a href="profile.php?id_user=<?php echo $d['id_user']; ?>">EDIT</a>
					<a href="hapus.php?id_user=<?php echo $d['id_user']; ?>">HAPUS</a>
				</td>
			</tr>
			<?php 
		}
		?>
	</table>
</body>
</html>