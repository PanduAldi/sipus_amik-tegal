<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

?>

<div class="row">
	<div class="col-lg-6 col-xs-6">
		<h4><i class="fa fa-tasks"></i> Detail Peminjaman</h4>
	</div>
	<div class="col-lg-6 col-xs-6">
		<h4 align="right"><a href="?module=peminjaman" class="btn btn-default btn-flat"><i class="fa fa-angle-double-left"></i> Kembali ke halaman peminjaman</a></h4>
	</div>
</div>

<div class="box box-default">
	<div class="box-body">
		<?php  
			#menampilkan data
			$id_pinjam = isset($_GET['id'])?$_GET['id']:null;
			$query_tampil = mysql_query("SELECT t_peminjaman.kd_pinjam, t_anggota.id_anggota, t_anggota.nama, t_peminjaman.tgl_pinjam, t_peminjaman.tgl_hrskembali FROM t_peminjaman JOIN t_anggota ON t_peminjaman.id_anggota = t_anggota.id_anggota WHERE t_peminjaman.kd_pinjam = '$id_pinjam'");
			$fetch_tampil = mysql_fetch_array($query_tampil);
		
			#include format tanggal
			include "../utiliti/tgl_db.php";

		?>
		<table class="table table-striped">
			<tbody>
				<tr>
					<td width="30">Kode Peminjaman</td>
					<td width="5">:</td>
					<td width="80"><?php echo $fetch_tampil['kd_pinjam'] ?></td>
					
					<td width="3"></td>
					
					<td width="30">Tanggal Peminjaman</td>
					<td width="5">:</td>
					<td width="80"><?php echo tgl_db($fetch_tampil['tgl_pinjam']) ?></td>
				</tr>
				<tr>
					<td width="30">Id Anggota</td>
					<td width="5">:</td>
					<td width="80"><?php echo $fetch_tampil['id_anggota'] ?></td>
					
					<td width="3"></td>
					
					<td width="30">Tanggal Harus Kembali</td>
					<td width="5">:</td>
					<td width="80"><?php echo tgl_db($fetch_tampil['tgl_hrskembali']) ?></td>
				</tr>
				<tr>
					<td width="30">Nama Anggota</td>
					<td width="5">:</td>
					<td width="80"><?php echo $fetch_tampil['nama'] ?></td>
					
					<td width="3"></td>
										
					<td width="30">Tempo Peminjaman</td>
					<td width="5">:</td>
					<td width="80">
						<?php  
							#deklarasi explode tanggal pinjam
							$pecah_tgl1 = explode("-", $fetch_tampil['tgl_pinjam']);
							$tgl1 		= $pecah_tgl1[2];
							$bulan1 	= $pecah_tgl1[1];
							$tahun1 	= $pecah_tgl1[0];

							#deklarasi explode tanggal harus kembali
							$pecah_tgl2 = explode("-", $fetch_tampil['tgl_hrskembali']);
							$tgl2 		= $pecah_tgl2[2];
							$bulan2 	= $pecah_tgl2[1];
							$tahun2		= $pecah_tgl2[0];	

							#menentukan JDN dari masing masing tanggal
							$selisih1 = GregorianToJD($bulan1, $tgl1, $tahun1);
							$selisih2 = GregorianToJD($bulan2, $tgl2, $tahun2);	

							#menghitung selisih tanggal
							$total = $selisih2 - $selisih1;


							echo $total." Hari ";


						?>
					</td>

				</tr>
			</tbody>
		</table> <br>

		<div class="box box-primary">
			<div class="box-body">
				<h4>Daftar Buku Yang di Pinjam</h4>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Kode Buku</th><th>Judul Buku</th><th>Penerbit</th><th>Pengarang</th><th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php  
							#query tam[il daftar buku yang di pinjam
							$query_daftar = mysql_query("SELECT det_pinjam.kd_buku, t_buku.judul, t_penerbit.penerbit, t_pengarang.pengarang, det_pinjam.status FROM det_pinjam JOIN t_buku ON det_pinjam.kd_buku = t_buku.kd_buku JOIN t_peminjaman ON det_pinjam.kd_pinjam = t_peminjaman.kd_pinjam JOIN t_penerbit ON t_buku.kd_penerbit = t_penerbit.kd_penerbit JOIN t_pengarang ON t_buku.kd_pengarang = t_pengarang.kd_pengarang WHERE det_pinjam.kd_pinjam = '$id_pinjam'");
							while ($fetch_daftar = mysql_fetch_array($query_daftar)) {
								?>
									<tr>
										<td><?php echo $fetch_daftar['kd_buku'] ?></td>
										<td><?php echo $fetch_daftar['judul'] ?></td>
										<td><?php echo $fetch_daftar['penerbit'] ?></td>
										<td><?php echo $fetch_daftar['pengarang'] ?></td>
										<td><?php echo $fetch_daftar['status'] ?></td>
									</tr>
								<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div> <!-- end box -->
	</div>	
</div> <!-- end box -->

