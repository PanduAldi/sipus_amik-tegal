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
		if(document.lapBuku.tanggal1.value == "" || document.lapBuku.tanggal2.value == "") {
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
					<td colspan="3"><h4><strong><i class="fa fa-calendar"></i> Periode Input Buku</strong></h4></td>
				</tr>
				<form action="" method="POST" name="lapBuku" />
					<tr>
						<td><input type="text" class="form-control" name="tanggal1" id="tanggal1" /></td>
						<td>s/d</td>
						<td><input type="text" class="form-control" name="tanggal2" id="tanggal2" /></td>
					</tr>
					<tr>
						<td colspan="1">
							Masukan range periode Buku.
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

					$query_tampil = mysql_query("SELECT * FROM t_buku JOIN t_pengarang ON t_buku.kd_pengarang = t_pengarang.kd_pengarang
										 		JOIN t_penerbit ON t_buku.kd_penerbit = t_penerbit.kd_penerbit  
												WHERE t_buku.tgl_perolehan BETWEEN '$tgl1' AND '$tgl2'");						
					?>
					<hr />
					<table class="table table-bordered">
						<tr>
							<td colspan="2" align="left">
								<?php  
									$tgl_periode1 = $tanggal1[1]."-".$tanggal1[0]."-".$tanggal1[2];
									$tgl_periode2 = $tanggal2[1]."-".$tanggal2[0]."-".$tanggal2[2];
									
									$jum = mysql_num_rows($query_tampil);

									echo "Jumlah Buku Dalam Periode $tgl_periode1 s/d $tgl_periode2 = <strong> $jum Buku</strong>";
								?>
							</td>
							<td colspan="5" align="right">
								<a href="module/ref/eksport_lap_buku.php?awal=<?php echo $tgl1 ?>&akhir=<?php echo $tgl2 ?>" target="_blank" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Eksport Laporan ke EXCEL</a>
								<a title="Klik Untuk Mencetak" onclick="pop_up('module/pop_up_cetak_lap_buku.php?awal=<?php echo $tgl1 ?>&akhir=<?php echo $tgl2 ?>','','1200','700','yes');" class="btn btn-success"><i class="fa fa-print"></i> Cetak Laporan </a>
							</td>
						</tr>
						<tr>
							<th>ID Buku</th>
							<th>Judul</th>
							<th>Penerbit</th>
							<th>Pengarang</th>
							<th>Tahun Terbit</th>
							<th>ISBN</th>
							<th>Tanggal Perolehan</th>
						</tr>
						<?php  	
							while ($fetch_tampil = mysql_fetch_array($query_tampil)) {
								?>
								<tr>
									<td><?php echo $fetch_tampil['kd_buku'] ?></td>
									<td><?php echo $fetch_tampil['judul'] ?></td>
									<td><?php echo $fetch_tampil['penerbit'] ?></td>
									<td><?php echo $fetch_tampil['pengarang'] ?></td>
									<td><?php echo $fetch_tampil['tahun'] ?></td>
									<td><?php echo $fetch_tampil['isbn'] ?></td>
									<td><?php echo tgl_db($fetch_tampil['tgl_perolehan']) ?></td>
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

