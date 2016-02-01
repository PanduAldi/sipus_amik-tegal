<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

?>

<script>
	$(document).ready(function() {
		$("#tabel").dataTable();
	});	
</script>

<div class="box box-primary">
	<div class="box-body">
	<h4>Daftar Keseluruhan Pengembalian Buku</h4>
		<div class="box box-warning">
			<div class="box-body">
				<table class="table table-bordered table-hover" id="tabel">
					<thead>
						<tr>
							<th>No. Pengembalian</th>
							<th>Kode Pinjam</th>
							<th>Tanggal Pinjam</th>
							<th>Tanggal Kembali</th>
							<th>Kode Buku</th>
							<th>Denda</th>
							<th>Kondisi</th>
						</tr>
					</thead>
					<tbody>
						<?php  
							$query_tampil = mysql_query("SELECT t_pengembalian.kd_pengembalian, t_peminjaman.kd_pinjam, t_peminjaman.tgl_pinjam, t_pengembalian.tgl_kembali,t_pengembalian.denda, det_pinjam.kd_buku, t_pengembalian.kondisi FROM  t_pengembalian 
														 JOIN t_peminjaman ON t_pengembalian.kd_pinjam = t_peminjaman.kd_pinjam 
														 JOIN det_pinjam ON t_pengembalian.kd_buku = det_pinjam.kd_buku");
							while ($data = mysql_fetch_array($query_tampil)) {
								?>
									<tr>
										<td><?php echo $data['kd_pengembalian'] ?></td>
										<td><a href="?module=peminjaman&ref=det_pinjam&id=<?php echo $data['kd_pinjam'] ?>" title="Klik Untuk Melihat Detail Peminjaman"><?php echo $data['kd_pinjam'] ?></a></td>
										<td><?php echo $data['tgl_pinjam'] ?></td>
										<td><?php echo $data['tgl_kembali'] ?></td>
										<td><a href="?module=buku&ref=det_buku&id=<?php echo $data['kd_buku'] ?>" title="Klik Untuk Melihat Detail Buku"><?php echo $data['kd_buku'] ?></a></td>
										<td><?php echo $data['denda'] ?></td>
										<td><?php echo $data['kondisi'] ?></td>
									</tr>
								<?php
							}
						?>
							
					</tbody>
				</table>				
			</div>
		</div>	

		<h4>NB</h4>
		<ul>
			<li>Halaman ini hanya menampilkan keseluruhan data pengembalian.</li>
			<li>Jika ingin menginput pengembalian. Pergi ke halaman peminjaman dan klikpengembalian.</li>
		</ul>	
	</div>	
</div>
