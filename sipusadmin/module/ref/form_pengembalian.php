<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	include "controller/act_transaksi_pengembalian.php";

?>

<div class="row">
	<div class="col-lg-6 col-xs-6">
		<h4><i class="fa fa-tasks"></i> Form Pengembalian Buku </h4>
	</div>
	<div class="col-lg-6 col-xs-6">
		<h4 align="right">
			<a href="?module=peminjaman" class="btn btn-default btn-flat"><i class="fa fa-angle-double-left"></i> Kembali ke halaman peminjaman</a>
		</h4>
	</div>
</div>

<form action="" method="POST" />
<?php include "../utiliti/autonumber.php" ?>
<p>No. Pengembalian  = <input type="text" readonly="" name="kd_pengembalian" value="<?=id("t_pengembalian","kd_pengembalian",3,date("dmy"))?>"></p>
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
						<td width="80"><input type="text" readonly="" class="form-control" name="kd_pinjam" value="<?php echo $fetch_tampil['kd_pinjam'] ?>"></td>
						
						<td width="3"></td>
						
						<td width="30">Tanggal Peminjaman</td>
						<td width="5">:</td>
						<td width="80"><input type="text" readonly="" name="tgl_pinjam" class="form-control" value="<?php echo tgl_db($fetch_tampil['tgl_pinjam']) ?>"></td>
					</tr>
					<tr>
						<td width="30">Id Anggota</td>
						<td width="5">:</td>
						<td width="80"><input type="text" readonly="" name="id_anggota" class="form-control" value="<?php echo $fetch_tampil['id_anggota'] ?>"></td>
						
						<td width="3"></td>
						
						<td width="30">Tanggal Harus Kembali</td>
						<td width="5">:</td>
						<td width="80"><input type="text" readonly="" class="form-control" name="tgl_hrskembali" value="<?php echo tgl_db($fetch_tampil['tgl_hrskembali']) ?>"> </td>
					</tr>
					<tr>
						<td width="30">Nama Peminjam</td>
						<td width="5">:</td>
						<td width="80"><input type="text" readonly="" class="form-control" value="<?php echo $fetch_tampil['nama'] ?>"></td>
						
						<td width="3"></td>
											
						<td width="30">Tanggal kembali</td>
						<td width="5">:</td>
						<td width="80">
							<?php 
								$tgl_sekarang  = date("Y-m-d");
								echo '<input type="text" readonly name="tgl_sekarang" class="form-control" value="'.tgl_db($tgl_sekarang).'">';
							?>
						</td>
					</tr>
					<tr>
						<td width="30"></td>
						<td width="5"></td>
						<td width="80"></td>
						
						<td width="3"></td>
						
						<td width="30">Telat Pengembalian</td>
						<td width="5">:</td>
						<td width="80">
							<?php  
								#deklarasi pecahan tgl harus kembali
								$pecah_tgl1 = explode("-", $fetch_tampil['tgl_hrskembali']);
								$tgl1 		= $pecah_tgl1[2];
								$bulan1 	= $pecah_tgl1[1];
								$tahun1 	= $pecah_tgl1[0];

								#deklarasi pecahan tgl sekarang
								$pecah_tgl2 = explode("-", $tgl_sekarang);
								$tgl2 		= $pecah_tgl2[2];
								$bulan2 	= $pecah_tgl2[1];
								$tahun2		= $pecah_tgl2[0];

								#deklarasi JD pertanggal
								$jd1 = GregorianToJD($bulan1, $tgl1, $tahun1);
								$jd2 = GregorianToJD($bulan2, $tgl2, $tahun2);

								#menghitung selisih hari
								$selisih  = $jd2 - $jd1;

								if ($selisih <= 0) {
									echo "0 Hari";		
								} else {
									echo $selisih." Hari";
								}		
							?>
						</td>
					</tr>
					<tr>
						<td width="30"></td>
						<td width="5"></td>
						<td width="80"></td>
						
						<td width="3"></td>
											
						<td width="30">Denda</td>
						<td width="5">:</td>
						<td width="80">
							<?php 
								#deklrasi pecahan tgl pinjam
								$pecah_tgl3 = explode("-", $fetch_tampil['tgl_pinjam']);
								$tgl3 		= $pecah_tgl3[2];
								$bulan3     = $pecah_tgl3[1];
								$tahun3  	= $pecah_tgl3[0];

								#perubahan tanggal ke JD
								$jd3 = GregorianToJD($bulan3, $tgl3, $tahun3);

								#menghitung selisih tanggal untuk denda
								$selisih2 = $jd2 - $jd3;

								if (($selisih2 - 7) <= 0) {
									echo "Tidak ada denda !!!";
								} else {
									$total_denda = ($selisih2 - 7) * 500;
									echo '<div class="input-group">
											<span class="input-group-addon"><strong>Rp.</strong></span>
										 	 <input type="text" readonly class="form-control" name="denda" value="'.$total_denda.'">
										  </div>';
								}
							?>
						</td>
					</tr>
					<tr>
						<td width="30"></td>
						<td width="5"></td>
						<td width="80"></td>
						
						<td width="3"></td>
											
						<td width="30">Kondisi Buku</td>
						<td width="5">:</td>
						<td width="80">
							<select name="kondisi" class="form-control" required />
								<option value="">Pilih Kondisi</option>
								<option value="baik">BAIK</option>
								<option value="hilang">HILANG</option>
								<option value="rusak">RUSAK</option>
							</select>
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
								<th></th><th>Kode Buku</th><th>Judul Buku</th><th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php  
								#query tam[il daftar buku yang di pinjam
								$query_daftar = mysql_query("SELECT det_pinjam.kd_buku, t_buku.judul, det_pinjam.status FROM det_pinjam JOIN t_buku ON det_pinjam.kd_buku = t_buku.kd_buku JOIN t_peminjaman ON det_pinjam.kd_pinjam = t_peminjaman.kd_pinjam WHERE det_pinjam.kd_pinjam = '$id_pinjam'");
								while ($fetch_daftar = mysql_fetch_array($query_daftar)) {
									?>
										<tr>
											<td align="center">
												<?php  
													if ($fetch_daftar['status'] == "sudah dikembalikan") {
														echo '<input type="checkbox" class="minimal" disabled />';
													} else {
														echo '<input type="checkbox" name="kd_buku[]" class="minimal" value="'.$fetch_daftar['kd_buku'].'" >';
													}
												?>
											</td>
											<td><?php echo $fetch_daftar['kd_buku'] ?></td>
											<td><?php echo $fetch_daftar['judul'] ?></td>
											<td><?php echo $fetch_daftar['status'] ?></td>
										</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div> <!-- end box in-->
			<br>
			<button type="submit" onclick="return confirm('Pastikan Buku Yang Akan di Kembalikan Sudah di Centang. Jika Status semua buku sudah di kembalikan, jangan lanjutkan transaksi / Pilih Cancel')" class="btn btn-primary btn-flat" name="simpan_pengembalian"><i class="fa fa-save"></i> Simpan Pengembalian</button>
			<a href="?module=peminjaman" class="btn btn-danger btn-flat">Batalkan Transaksi Pengembalian</a>
		</form>
	</div>	
</div> <!-- end box -->

<h4>Petunjuk Penggunaan</h4>
<ul>
	<li>Dalam form ini hanya di minta untuk mencentang buku yang akan di kembalikan dan memilih kondisi buku.</li>
	<li>Telat pengembalian dan denda akan otomatis terinput jika tanggal pengembalian lebih dari tanggal harus kembali.</li>
	<li>Jika semua status buku sudah dikembalikan jangan pilih tombol simpan pengembalian.</li>
</ul>