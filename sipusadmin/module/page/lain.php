<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

?>
<div class="row">
	<div class="col-lg-6 col-xs-6">
		<h3><i class="fa fa-server"></i> Info Lainnya</h3>
	</div>
	<div class="col-lg-6 col-lg-12">
		<h3 class="text-right"><a href="?module=info">&lt;&lt; Kembali</a> </h3>
	</div>
</div>

<div class="box box-warning">
	<div class="box-body">
	<?php  
		$ref = isset($_GET['ref'])?$_GET['ref']:null;
		switch ($ref) {
			default:
				?>
				<div class="tombol">
					<a href="?module=info&page=lain&ref=tambah_lain" class="btn btn-primary btn-flat"><i class="fa fa-pencil"></i> | Tambah Lain</a>
				</div>
				<br>
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="tabel">
						<thead>
							<?php 
								$nama_kolom = array("No","Judul","Tgl_publish","Aksi");
								$ukuran		= array(10,100,20,20);

								for ($i=0; $i < count($nama_kolom) ; $i++) { 
									echo '<th width="'.$ukuran[$i].'">'.$nama_kolom[$i].'</th>';
								}
							?>
						</thead>
						<tbody>
							<?php  
								$no = 1;
								$query = mysql_query("Select * from t_info where label='lain'");
								
								while ($fetch = mysql_fetch_array($query)) {
									?>
									<tr>
										<td><?php echo $no++ ?></td>
										<td><?php echo $fetch['judul'] ?></td>
										<td>
											<?php
												include "../utiliti/tgl_db.php";
												echo tgl_db($fetch['tgl_publish']); 
											?>
										</td>
										<td>
											<a href="?module=info&page=lain&ref=det_lain&id=<?php echo $fetch[0] ?>" class="btn btn-default btn-flat"><i class="fa fa-search"></i></a>
											<a href="?module=info&page=lain&ref=edit_lain&id=<?php echo $fetch[0] ?>" class="btn btn-primary btn-flat"><i class="fa fa-edit"></i></a>
											<a href="?module=info&page=lain&ref=hapus_lain&id=<?php echo $fetch[0] ?>" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				</div>
				<?php
				break;

				case 'tambah_lain':
					include "module/ref/tambah_lain.php";
					break;

				case 'edit_lain':
					include "module/ref/edit_lain.php";
					break;

				case 'det_lain':
					include "module/detail/det_lain.php";
					break;

				case 'hapus_lain':
					include "controller/hapus_lain.php";
					break;
		}
	?>
	</div>
</div>