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
		if(document.lapAng.tanggal1.value == "" || document.lapAng.tanggal2.value == "") {
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
					<td colspan="3"><h4><strong><i class="fa fa-calendar"></i> Periode Anggota Terdaftar</strong></h4></td>
				</tr>
				<form action="" method="POST" name="lapAng" />
					<tr>
						<td><input type="text" class="form-control" name="tanggal1" id="tanggal1" /></td>
						<td>s/d</td>
						<td><input type="text" class="form-control" name="tanggal2" id="tanggal2" /></td>
					</tr>
					<tr>
						<td colspan="1">
							Masukan range periode Anggota Yang Terdaftar.
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

					$query_tampil = mysql_query("SELECT * FROM t_anggota WHERE tanggal BETWEEN '$tgl1' AND '$tgl2'") 
												 or die(mysql_error());

					?>
					<hr />
					<table class="table table-bordered">
						<tr>
							<td colspan="3" align="left">
								<?php  
									$tgl_periode1 = $tanggal1[1]."-".$tanggal1[0]."-".$tanggal1[2];
									$tgl_periode2 = $tanggal2[1]."-".$tanggal2[0]."-".$tanggal2[2];
									
									$jum = mysql_num_rows($query_tampil);

									echo "Jumlah Anggota Terdaftar Periode $tgl_periode1 s/d $tgl_periode2 = <strong> $jum Mahasiswa</strong>";
								?>
							</td>
							<td colspan="5" align="right">
								<a href="module/ref/eksport_lap_anggota.php?awal=<?php echo $tgl1 ?>&akhir=<?php echo $tgl2 ?>" target="_blank" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Eksport Laporan ke EXCEL</a>
								<a title="Klik Untuk Mencetak" onclick="pop_up('module/pop_up_cetak_lap_anggota.php?awal=<?php echo $tgl1 ?>&akhir=<?php echo $tgl2 ?>','','1200','700','yes');" class="btn btn-success"><i class="fa fa-print"></i> Cetak Laporan </a>
							</td>
						</tr>
						<tr>
							<th>ID Anggota</th>
							<th>NIM</th>
							<th>Nama</th>
							<th>Email</th>
							<th>Tanggal Terdaftar</th>
						</tr>
						<?php  	
							while ($fetch_tampil = mysql_fetch_array($query_tampil)) {
								?>
								<tr>
									<td width="40"><?php echo $fetch_tampil['id_anggota'] ?></td>
									<td width="40"><?php echo $fetch_tampil['nim'] ?></td>
									<td><?php echo $fetch_tampil['nama'] ?></td>
									<td><?php echo $fetch_tampil['email'] ?></td>
									<td><?php echo tgl_db($fetch_tampil['tanggal']) ?></td>
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

