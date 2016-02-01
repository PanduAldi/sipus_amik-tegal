<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	$tanggal_sekarang = date("Y-m-d");
	$query_cek_tgl_usulan = mysql_query("SELECT tanggal FROM t_usulan_buku WHERE tanggal='$tanggal_sekarang'") or die(mysql_error());
	$cek_query_usulan     = mysql_num_rows($query_cek_tgl_usulan);

	if ($cek_query_usulan > 0) {
		
		mysql_query("UPDATE t_usulan_buku SET baca='Y' WHERE tanggal='$date'");

	}
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
				<h4><i class="fa fa-book"></i> Daftar Usulan Buku</h4>
				<div class="box box-info">
					<div class="box-body">
						<table class="table table-bordered table-hover" id="tabel_data">
							<thead>
								<tr>
									<th width="10">No</th><th>Nama dan Status</th><th>Judul Buku</th><th>Penerbit</th><th>Pengarang</th><th>Tanggal Pengusulan</th><th>#</th>
								</tr>
							</thead>
							<tbody>
								<?php  
									$no = 1;
									$query_usulan = mysql_query("SELECT * FROM t_usulan_buku ORDER BY tanggal");
									while ($fetch_usulan = mysql_fetch_array($query_usulan)) {
										?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td>
												<p><?php echo $fetch_usulan['nama'] ?></p>
												<p><?php echo $fetch_usulan['status'] ?></p>
											</td>
											<td><?php echo $fetch_usulan['judul'] ?></td>
											<td><?php echo $fetch_usulan['penerbit'] ?></td>
											<td><?php echo $fetch_usulan['pengarang'] ?></td>
											<td><?php echo $fetch_usulan['tanggal'] ?></td>
											<td><a href="?module=usulan&ref=hapus&id=<?php echo $fetch_usulan[0] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
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
					include "controller/act_hapus_usulan.php";
					break;
		}
	?>

	</div>
</div>