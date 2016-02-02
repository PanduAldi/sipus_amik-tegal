<?php  
	include "../../utiliti/koneksi.php";

	$awal 	= isset($_GET['awal'])?$_GET['awal']:null;
	$akhir	= isset($_GET['akhir'])?$_GET['akhir']:null;


?>	

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
	<style>
		.section {
			margin : 12px;
			text-align: center;
		}

		.teks1 {
			font-size: 18px;
			font-family: "Times New Roman";
		}

		.teks2 {
			font-size: 25px;
		}
		
		.garis {
			height: 4px; 
		    background-color: black;
		    border: 2px;
		}

	</style>
</head>
<body>
	<div class="container" style="margin : 5px;">
	<center>	
		<table>
			<tr>
				<td width="130"> <img src="../amik_logo.png" width="100" height="100" alt=""></td>
				<td>
					<p align="center" class="teks1"> <strong>Laporan Data Anggota Terdaftar Per- <?php echo $awal." s/d ".$akhir ?></strong> </p>
					<p align="center" class="teks2"><strong>AMIK YMI TEGAL </strong></p>
					<p align="center" style="font-size:12px">Jl. Raya Dampyak KM.4 Kab. Tegal, Telp : (0283) 614-7140</p>
				</td>
			</tr>
		</table>
<div class="garis"></div> <br>	
					<table class="table table-bordered">				
						<tr>
							<th>ID Anggota</th>
							<th>NIM</th>
							<th>Nama</th>
							<th>Email</th>
							<th>Tanggal Terdaftar</th>
						</tr>
						<?php
							$query_tampil = mysql_query("SELECT * FROM t_anggota WHERE tanggal BETWEEN '$awal' AND '$akhir'") 
														 or die(mysql_error()); 

							include "../../utiliti/tgl_db.php"; 	
							while ($fetch_tampil = mysql_fetch_array($query_tampil)) {
								?>
								<tr>
									<td><?php echo $fetch_tampil['id_anggota'] ?></td>
									<td><?php echo $fetch_tampil['nim'] ?></td>
									<td><?php echo $fetch_tampil['nama'] ?></td>
									<td><?php echo $fetch_tampil['email'] ?></td>
									<td><?php echo tgl_db($fetch_tampil['tanggal']) ?></td>
								</tr>
								<?php
							}
						?>
					</table>

			<button type="button" class="btn btn-success" onclick="window.print()"> <span class="glyphicon glyphicon-print"></span> Cetak Dokumen </button>
		</center>
	</div>
</body>
</html>