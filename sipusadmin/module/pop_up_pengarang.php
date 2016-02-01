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
				<h3 align="Pilih Pengarang">Pilih Sesuai Nama Pengarang</h3>
				<div class="table-responsive" align="center">
					<table id="tabel" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Kd</th><th>Pengarang</th><th>#</th>
							</tr>
						</thead>
						<tbody>
							<?php  
								$query = mysql_query("select * from t_pengarang order by kd_pengarang");
								while ($data = mysql_fetch_array($query)) {
									?>
									<tr>
										<td><?php echo $data[0] ?></td>
										<td><?php echo $data[1] ?></td>
										<td><input type="button" onclick='return ambil("<?php echo $data[0] ?>")' value="Pilih" class="btn btn-success btn-flat"></td>
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