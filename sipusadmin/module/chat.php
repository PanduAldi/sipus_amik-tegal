<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

?>
<script>
	$(document).ready(function() {
		$('#tabel_data').dataTable();
	});
</script>
<div class="box box-default">
	<div class="box-body">
	<?php  
		$ref = isset($_GET['ref'])?$_GET['ref']:null;
		switch ($ref) {
			default:
				?>
				<h4><i class="fa fa-book"></i> Daftar Komentar Pengunjung</h4>
				<div class="box box-info">
					<div class="box-body">
						<table class="table table-bordered table-hover" id="tabel_data">
							<thead>
								<tr>
									<th width="10">No</th><th>Nama </th><th>Komentar</th><th>#</th>
								</tr>
							</thead>
							<tbody>
								<?php  
									$no = 1;
									$query_chat = mysql_query("SELECT * FROM t_chat ORDER BY tgl");
									while ($fetch_chat = mysql_fetch_array($query_chat)) {
										?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td><?php echo $fetch_chat['nama'] ?></td>
											<td><?php echo $fetch_chat['chat'] ?></td>
											<td><a href="?module=chat&ref=hapus&id=<?php echo $fetch_chat[0] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
										</tr>
										<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<?php
				break;

				case 'hapus':
					include "controller/act_hapus_chat.php";
					break;
		}
	?>

	</div>
</div>