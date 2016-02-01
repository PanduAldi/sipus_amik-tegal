<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../../utiliti/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Pilih Pengarang</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
 		<!-- data tables -->
  		<link href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />		
		<script>
			function ambil(item){
				targetitem.value = item;
				top.close();
				return false;
			}

			$(document).ready(function() {
				$("#tabel").dataTable();
			});
		</script>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<div class="container-fluid">
				<h4>Pilih Buku Yang Akan Di Pinjam</h4>
				<p><b>Catatan : </b> Buku dapat dicari dengan mengetikkan Kode Buku atau Judul di form Cari Data </p><br>
				<div class="table-responsive" align="center">
					<table id="tabel" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Kode Buku</th><th>Judul Buku</th><th>Penerbit</th><th>Penagarang</th><th>#</th>
							</tr>
						</thead>
						<tbody>
							<?php  
								$query = mysql_query("select t_buku.kd_buku, t_buku.judul, t_penerbit.nama_penerbit, t_pengarang.nama_pengarang from t_buku join t_penerbit on t_buku.kd_penerbit = t_penerbit.kd_penerbit join t_pengarang on t_buku.kd_pengarang = t_pengarang.kd_pengarang order by  kd_buku");
								while ($data = mysql_fetch_array($query)) {
									?>
									<tr>
										<td><?php echo $data['kd_buku'] ?></td>
										<td><?php echo $data['judul'] ?></td>
										<td><?php echo $data['nama_penerbit'] ?></td>
										<td><?php echo $data['nama_pengarang'] ?></td>
										<td><input type="button" onclick='return ambil("<?php echo $data['kd_buku'] ?>")' value="Pilih" class="btn btn-success btn-flat"></td>
									</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				</div>				
			</div>
		</div>

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