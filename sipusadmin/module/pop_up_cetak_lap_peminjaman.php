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
					<p align="center" class="teks1"> <strong>Laporan Data Transaksi Peminjaman Per- <?php echo $awal." s/d ".$akhir ?></strong> </p>
					<p align="center" class="teks2"><strong>AMIK YMI TEGAL </strong></p>
					<p align="center" style="font-size:12px">Jl. Raya Dampyak KM.4 Kab. Tegal, Telp : (0283) 614-7140</p>
				</td>
			</tr>
		</table>
<div class="garis"></div> <br>	
					<table class="table table-bordered">				
						<tr>
							<th>No </th>
							<th>Tanggal Peminjamanm</th>
							<th>Kode Pinjam </th>
							<th>ID Anggota</th>
							<th>Nama</th>
							<th>Jumlah Pinjam</th>
						</tr>
						<?php
							$query_tampil = mysql_query("SELECT * FROM t_peminjaman JOIN t_anggota ON t_peminjaman.id_anggota = t_anggota.id_anggota
												 		 WHERE tgl_pinjam BETWEEN '$awal' AND '$akhir'") 
														 or die(mysql_error()); 

							//mencari jumlah buku
							function jum_buk($param) {
								$query = mysql_query("SELECT * FROM t_peminjaman JOIN det_pinjam ON t_peminjaman.kd_pinjam = det_pinjam.kd_pinjam 
														  WHERE t_peminjaman.kd_pinjam = '$param'");

								$count = mysql_num_rows($query);
								return $count." Buku";
							}

							include "../../utiliti/tgl_db.php"; 
							$no = 1;	
							while ($fetch_tampil = mysql_fetch_array($query_tampil)) {
								?>
								<tr>
									<td width="20"><?php echo $no++ ?></td>
									<td width="50"><?php echo tgl_db($fetch_tampil['tgl_pinjam']) ?></td>
									<td><?php echo $fetch_tampil['kd_pinjam'] ?></td>
									<td><?php echo $fetch_tampil['id_anggota'] ?></td>
									<td><?php echo $fetch_tampil['nama'] ?></td>
									<td><?php echo jum_buk($fetch_tampil['kd_pinjam']) ?></td>
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