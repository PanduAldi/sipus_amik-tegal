<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";
?>

<script>
		function pop_up(mypage,myname,w,h,scroll){

		  var winl = (screen.width-w)/2;

		  var wint = (screen.height-h)/2;

		  var settings  ='height='+h+',';

		      settings +='width='+w+',';

		      settings +='top='+wint+',';

		      settings +='left='+winl+',';

		      settings +='scrollbars='+scroll+',';

		      settings +='resizable=yes';

		  win=window.open(mypage,myname,settings);

		  if(parseInt(navigator.appVersion) >= 4){win.window.focus();}

		}

	function validasi() {
		if(document.lapPin.tanggal1.value == "" || document.lapPin.tanggal2.value == "") {
			var info = document.getElementById('id_alert');
			info.innerHTML = '<div class="alert alert-danger"><i class="fa fa-minus-circle"></i> Form Periode Tidak Boleh Kosong.</div>';
			return false;
		}

		return true;
	}

	$(document).ready(function() {
		$("#tanggal1").datepicker();
		$("#tanggal2").datepicker();
	});
</script>

<div class="box box-default">
	<div class="box-body">
		<div class="col-sm-7">
			<div id="id_alert"></div>
			<table class="table table-striped table-bordered">
				<tr class="warning">
					<td colspan="3"><h4><strong><i class="fa fa-calendar"></i> Periode Transaksi peminjaman</strong></h4></td>
				</tr>
				<form action="" method="POST" name="lapPin" />
					<tr>
						<td><input type="text" class="form-control" name="tanggal1" id="tanggal1" /></td>
						<td>s/d</td>
						<td><input type="text" class="form-control" name="tanggal2" id="tanggal2" /></td>
					</tr>
					<tr>
						<td colspan="1">
							Masukan range periode transaksi Peminjaman.
						</td>
						<td colspan="2" align="right">
							<input type="submit" onclick="return validasi()" name="tampil" class="btn btn-primary btn-flat" value="Tampilkan Data">
							<input type="reset" value="Bersihkan" class="btn btn-danger btn-flat">
						</td>
					</tr>
				</form>
			</table>	
		</div> <!-- col sm 4 --> 
		<div class="col-sm-12">
			<?php  
				include "../utiliti/tgl_db.php";
				// perubahan karakter tanggal
				$tanggal1 = explode("/", $_POST['tanggal1']);
				$tanggal2 = explode("/", $_POST['tanggal2']);

				if (isset($_POST['tampil'])) {
					$tgl1 = $tanggal1[2]."-".$tanggal1[0]."-".$tanggal1[1];
					$tgl2 = $tanggal2[2]."-".$tanggal2[0]."-".$tanggal2[1];

					$query_tampil = mysql_query("SELECT * FROM t_peminjaman JOIN t_anggota ON t_peminjaman.id_anggota = t_anggota.id_anggota
												 WHERE tgl_pinjam BETWEEN '$tgl1' AND '$tgl2'")  or die(mysql_error());

					?>
					<hr />
					<table class="table table-bordered">
						<tr>
							<td colspan="4" align="left">
								<?php  
									$tgl_periode1 = $tanggal1[1]."-".$tanggal1[0]."-".$tanggal1[2];
									$tgl_periode2 = $tanggal2[1]."-".$tanggal2[0]."-".$tanggal2[2];
								
								echo "Transaksi Peminjaman Per - <strong>".$tgl_periode1." s/d ".$tgl_periode2."</strong>";
								?>

							</td>
							<td colspan="5" align="right">
								<a href="module/ref/eksport_lap_peminjaman.php?awal=<?php echo $tgl1 ?>&akhir=<?php echo $tgl2 ?>" target="_blank" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Eksport Laporan ke EXCEL</a>
								<a title="Klik Untuk Mencetak" onclick="pop_up('module/pop_up_cetak_lap_peminjaman.php?awal=<?php echo $tgl1 ?>&akhir=<?php echo $tgl2 ?>','','1200','700','yes');" class="btn btn-success"><i class="fa fa-print"></i> Cetak Laporan </a>
							</td>
						</tr>
						<tr>
							<th>No </th>
							<th>Tanggal Peminjamanm</th>
							<th>Kode Pinjam </th>
							<th>ID Anggota</th>
							<th>Nama</th>
							<th>Jumlah Pinjam</th>
							<th>#</th>
						</tr>
						<?php  	
							$no = 1;
							while ($fetch_tampil = mysql_fetch_array($query_tampil)) {
								?>
								<tr>
									<td width="20"><?php echo $no++ ?></td>
									<td width="50"><?php echo tgl_db($fetch_tampil['tgl_pinjam']) ?></td>
									<td><?php echo $fetch_tampil['kd_pinjam'] ?></td>
									<td><?php echo $fetch_tampil['id_anggota'] ?></td>
									<td><?php echo $fetch_tampil['nama'] ?></td>
									<td>
										<?php  
											$param = $fetch_tampil['kd_pinjam'];
											$query = mysql_query("SELECT * FROM t_peminjaman JOIN det_pinjam ON t_peminjaman.kd_pinjam = det_pinjam.kd_pinjam 
																  WHERE t_peminjaman.kd_pinjam = '$param'");

											$count = mysql_num_rows($query);
											echo $count." Buku";
										?>
									</td>
									<td>
										<a href="?module=peminjaman&ref=det_pinjam&id=<?php echo $fetch_tampil['kd_pinjam'] ?>" class="btn btn-default btn-flat"><i class="fa fa-search"></i> Lihat Detail</a>										
									</td>
								</tr>
								<?php
							}
						?>
					</table>
					<?php
				}

			?>
		</div>
	</div>
</div> <!-- end panel default -->

