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
		
hr {height: 4px; 
    background-color: black;
    border:none;
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
					<p align="center" class="teks1"> <strong>Laporan Data Buku Masuk Per- <?php echo $awal." s/d ".$akhir ?></strong> </p>
					<p align="center" class="teks2"><strong>AMIK YMI TEGAL </strong></p>
					<p align="center" style="font-size:12px">Jl. Raya Dampyak KM.4 Kab. Tegal, Telp : (0283) 614-7140</p>
				</td>
			</tr>
		</table>
<hr>	
					<table class="table table-bordered">				
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
							$query_tampil = mysql_query("SELECT * FROM t_buku JOIN t_pengarang ON t_buku.kd_pengarang = t_pengarang.kd_pengarang
												 		JOIN t_penerbit ON t_buku.kd_penerbit = t_penerbit.kd_penerbit  
														WHERE t_buku.tgl_perolehan BETWEEN '$awal' AND '$akhir'");

							include "../../utiliti/tgl_db.php";
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

			<button type="button" class="btn btn-success" onclick="window.print()"> <span class="glyphicon glyphicon-print"></span> Cetak Dokumen </button>
		</center>
	</div>
</body>
</html>