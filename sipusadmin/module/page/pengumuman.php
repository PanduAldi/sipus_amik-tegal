<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

?>

<div class="row">
	<div class="col-lg-6 col-xs-6">
		<h3><i class="fa fa-bullhorn"></i> Pengumuman</h3>  
	</div>
	<div class="col-lg-6 col-xs-6" valign="center"  align="right">
		<h3><a href="?module=info"/> &lt;&lt;Kembali </a></h3>
	</div>
</div>

<div class="box box-default">
	<div class="box-body">
	<?php  
		$ref = isset($_GET['ref'])?$_GET['ref']:null;
		switch ($ref) {
			default:
			?>
				<a class="btn btn-primary btn-flat" href="?module=info&page=pengumuman&ref=tambah_pengumuman"><i class="fa fa-pencil"></i> Tambah Pengumuman</a> <br><br>
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="tabel">
						<thead>
							<tr>
								<?php  
									$nama_kolom = array("No","Nama Pengumuman","Deskripsi","Tanggal Publish","Aksi");
									$ukuran 	= array(10,60,100,50,20);
									for ($i=0; $i < count($nama_kolom); $i++) { 
										echo '<th width="'.$ukuran[$i].'">'.$nama_kolom[$i].'</th>';
									}
								?>
							</tr>
						</thead>
						<tbody>
							<?php  
								include "../utiliti/tgl_db.php";
								$no  = 1;
								$query = mysql_query("select * from t_info where label='pengumuman'");
								while ($data=mysql_fetch_array($query)) {
									?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td><?php echo $data['judul'] ?></td>
											<td><?php echo $data['deskripsi'] ?></td>
											<td><?php echo tgl_db($data['tgl_publish']) ?></td>
											<td>
												<a href="?module=info&page=pengumuman&ref=edit_pengumuman&id=<?php echo $data[0] ?>" class="btn btn-primary btn-flat"><i class="fa fa-edit"></i> Edit Pengumuman</a>
												<a onclick="return confirm('Hapus data ini ?')" href="?module=info&page=pengumuman&ref=hapus_pengumuman&id=<?php echo $data[0] ?>" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</a>
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

				case 'tambah_pengumuman':
					include "module/ref/tambah_pengumuman.php";
					break;

				case 'edit_pengumuman':
					include "module/ref/edit_pengumuman.php";
					break;

				case 'hapus_pengumuman':
					include "controller/act_hapus_pengumuman.php";
					break;
		}
	?>

	</div>	
</div>
