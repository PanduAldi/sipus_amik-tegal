<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

		$id = isset($_GET['id'])?$_GET['id']:null;
		$query = mysql_query("select * from t_buku join t_penerbit on t_buku.kd_penerbit = t_penerbit.kd_penerbit join t_pengarang on t_buku.kd_pengarang = t_pengarang.kd_pengarang join t_kategori on t_buku.kd_kategori = t_kategori.kd_kategori where t_buku.kd_buku = '$id'");						
		$data = mysql_fetch_array($query);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Detail Buku <?php echo $_GET['id'] ?></title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
 		<!-- data tables -->
  		<link href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />		

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	
				<h4><b>Detail Buku <?php echo $_GET['id'] ?></b></h4>
				<br>
				<div class="row">
					<div class="col-sm-3 col-xs-6">
						<center>		
						<?php  
							if (empty($data['cover'])) {
								echo '<img src="../sipusadmin/image/buku/Logo.png" width="200" height="250" alt="" class="img-thumbnail">';
							} else{
								echo '<img src="../sipusadmin/image/buku/'.$data['cover'].'" width="200" height="250" alt="" class="img-thumbnail">';
							}
						?>
						</center>
					</div>
					<div class="col-sm-7 col-xs-6">
							<table id="tabel" class="table table-striped">
								<tbody>
									<tr>
										<td width="70"></td>
										<td></td>
										<td align="right"><button onclick="window.close()"><b>Tutup Window</b></button></td>										
									</tr>
									<tr>
										<td width="70">Kode Buku</td>
										<td>:</td>
										<td><?php echo $data['kd_buku'] ?></td>
									</tr>
									<tr>
										<td width="70">Judul Buku</td>
										<td>:</td>
										<td><?php echo $data['judul'] ?></td>
									</tr>
									<tr>
										<td width="70">Penerbit</td>
										<td>:</td>
										<td><?php echo $data['penerbit'] ?></td>
									</tr>
									<tr>
										<td width="70">Pengarang</td>
										<td>:</td>
										<td><?php echo $data['pengarang'] ?></td>
									</tr>
									<tr>
										<td width="70">Kategori</td>
										<td>:</td>
										<td><?php echo $data['kategori'] ?></td>
									</tr>
									<tr>
										<td width="70">Tahun Terbit</td>
										<td>:</td>
										<td><?php echo $data['tahun'] ?></td>
									</tr>
									<tr>
										<td width="70">Tanggal Perolehan</td>
										<td>:</td>
										<td><?php 
												include "../utiliti/tgl_db.php";
												echo tgl_db($data['tgl_perolehan']); 
											?>
										</td>
									</tr>
									<tr>
										<td width="70">Jumlah Buku</td>
										<td>:</td>
										<td><?php echo $data['jumlah_buku'] ?></td>
									</tr>
									<tr>
										<td width="70">ISBN</td>
										<td>:</td>
										<td><?php echo $data['isbn'] ?></td>
									</tr>
									<tr>
										<td width="70">DDC</td>
										<td>:</td>
										<td><?php echo $data['ddc'] ?></td>
									</tr>
									<tr>
										<td width="70">RAK</td>
										<td>:</td>
										<td><?php echo $data['rak'] ?></td>
									</tr>
									<tr>
										<td width="70">Jumlah Halaman</td>
										<td>:</td>
										<td><?php echo $data['jum_hal'] ?></td>
									</tr>
									<tr>
										<td width="70">Status</td>
										<td>:</td>
										<td><?php echo $data['status'] ?></td>
									</tr>
									<tr>
										<td width="70">Most New</td>
										<td>:</td>
										<td><?php echo $data['most_new'] ?></td>
									</tr>
									<tr>
										<td width="70">Ket</td>
										<td>:</td>
										<td><?php echo $data['ket'] ?></td>
									</tr>
								</tbody>
							</table>
					</div>
				</div> <br>
				<?php  
					if (empty($data['abstraksi'])) {
						echo "";
					} else {
						?>
						<div class="panel panel-default">
							<div class="panel-body">
								<p><b>Abstraksi</b></p>
								<?php echo $data['abstraksi'] ?>
							</div>
						</div>
						<?php
					}
				?>
				


		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
			  <!-- jquery datatables -->
    	<script src="../assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    	<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

		<script>
			$(document).ready(function() {
				$("#tabel").dataTable();
			});
		</script>
	</body>
</html>