<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

		$now = date("Y-m-d");
		$booking_cek = mysql_query("SELECT * FROM t_booking JOIN t_anggota ON t_booking.id_anggota = t_anggota.id_anggota JOIN t_buku ON t_booking.kd_buku = t_buku.kd_buku WHERE tempo = '$now'") or die(mysql_error());
		$fetch_booking_cek = mysql_fetch_array($booking_cek);
		$cek 	= mysql_num_rows($booking_cek);

		if($cek > 0) {
			$id_anggota_booking = $fetch_booking_cek['id_anggota'];
			$tempo_id = $fetch_booking_cek['tempo'];
			#tanggal tempo  
			$tempo 	 = explode("-", $fetch_booking_cek['tempo']);
			$tgl1 	 = $tempo[2];
			$bulan1	 = $tempo[1];
			$tahun1  = $tempo[0];

			#tanggal skearang
			$sekarang 	= explode("-", $now);
			$tgl2		= $sekarang[2];
			$bulan2 	= $sekarang[1];
			$tahun2 	= $sekarang[0];

			#transfomasi JD
			$jd1 = GregorianToJD($bulan1, $tgl1, $tahun1);
			$jd2 = GregorianToJD($bulan2, $tgl2, $tahun2);

			#menghitung selisih
			$selisih  = $jd1 - $jd2;
			
			if ($selisih <= 0 ) {
				mysql_query("DELETE FROM t_booking WHERE id_anggota='$id_anggota_booking' AND tempo = '$tempo_id'");
				mysql_query("UPDATE t_buku SET status='tersedia' WHERE kd_buku = '".$fetch_booking_cek['kd_buku']."'");																									
			}
		} 

?>

<script>
	$(document).ready(function() {
		$("#tabel").dataTable();
	});	
</script>

<div class="box box-primary">
	<div class="box-body">
	<div class="row">
		<div class="col-lg-6 col-xs-6">
			<h4>Daftar Booking Buku</h4>
		</div>
		<div class="col-lg-6 col-xs-6">
			<h4 align="right">
				<a href="?module=peminjaman" class="btn btn-default btn-flat"><i class="fa fa-angle-double-left"></i> Kembali ke halaman peminjaman</a>
			</h4>
		</div>
	</div>
		<div class="box box-warning">
			<div class="box-body">
				<table class="table table-bordered table-hover" id="tabel">
					<thead>
						<tr>
							<th>No</th><th>ID Anggota</th><th>Nama</th><th>Kode Buku</th><th>Judul buku</th><th>Proses</th>
						</tr>
					</thead>
					<tbody>
						<?php  
							#menampilkan data
							$no = 1;
							$query_tampil = mysql_query("SELECT t_booking.id_anggota, t_anggota.nama, t_booking.kd_buku, t_buku.judul FROM t_booking
														 JOIN t_anggota ON t_booking.id_anggota = t_anggota.id_anggota
														 JOIN t_buku ON t_booking.kd_buku = t_buku.kd_buku") or die(mysql_error());

							while ($data = mysql_fetch_array($query_tampil)) {
								?>
								<tr>
									<td><?php echo $no++?></td>
									<td><?php echo $data['id_anggota'] ?></td>
									<td><?php echo $data['nama'] ?></td>
									<td><?php echo $data['kd_buku'] ?></td>
									<td><?php echo $data['judul'] ?></td>
									<td><a href="?module=peminjaman&ref=tambah_peminjaman&id_booking=<?php echo $data['id_anggota'] ?>" class="btn btn-primary btn-flat"><i class="fa fa-angle-double-right"></i> Lanjutkan ke proses Peminjaman</a></td>
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
			<li>Halaman ini hanya menampilkan data Anggota / Mahasiswa yang melakukan booking Buku.</li>
			<li>Setiap Booking </li>
		</ul>	
	</div>	
</div>