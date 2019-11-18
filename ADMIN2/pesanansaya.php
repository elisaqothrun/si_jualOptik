<h2>pesanan saya</h2>

<table class="table table-bodered">
		<thead>
			<tr>
				<th>No</th>
				<th>id_pembeli</th>
				<th>NAMA</th>
				<th>Jumlah Harus Dibayar</th>
				<th>Status</th>
				<th>Tanggal Pemesanan</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $nomor=1; ?>
			<?php $ambil= $koneksi-> query ("SELECT * FROM pemesanan JOIN pembeli ON pemesanan.NIK = pembeli.NIK"); ?>
			<?php while ($pecah = $ambil->fetch_assoc()){ ?>
			<tr>
				<td><?php echo $nomor;  ?></td>
				<td><?php echo $pecah['ID_PEMESANAN'];?></td>
				<td><?php echo $pecah ['NAMA_PEMBELI'];?></td>
				<td><?php echo $pecah ['TOTAL_HARGA'];?></td>
				<td><?php echo $pecah ['GAMBAR_BUKTIPEMBAYARAN'];?>
				<td><?php echo $pecah ['TGL_PEMESANAN'];?>
				<td>

				<a href="index.php?halaman=detail&id=<?php echo $pecah['ID_PEMESANAN']; ?> "class="btn-info btn">detail</a>
				</td>
			</tr>
			<?php $nomor++; ?>
			<?php } ?>
		</tbody>
	</table>