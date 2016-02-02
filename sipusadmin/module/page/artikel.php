<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

?>

<div class="row">
	<div class="col-lg-6 col-xs-6">
		<h3><i class="fa fa-newspaper-o"></i> Artikel / Berita</h3>  
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
					<a href="?module=info&page=artikel&ref=tambah_artikel" class="btn btn-primary btn-flat"><i class="fa fa-pencil"></i> Tambah Artikel / Berita</a>
					<br><br>
					<div class="table-responsive"> 
						<table class="table table-bordered table-hover" id="tabel">
							<thead>
								<tr>
								<?php  
									$nama_kolom = array("No","Judul Artikel / Berita","aksi");
									$ukuran		= array(10,100,50);
								
									for ($i=0; $i < count($nama_kolom); $i++) { 
										echo '<th width="'.$ukuran[$i].'">'.$nama_kolom[$i].'</th>';
									}
								?>
								</tr>
							</thead>
							<tbody>
								<?php  
									$no = 1;
									$query = mysql_query("Select * from t_info where label='artikel'");
									while ($data1 = mysql_fetch_array($query)) {
										?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td><?php echo $data1['judul'] ?></td>
											<td>
												<a href="?module=info&page=artikel&ref=det_artikel&id=<?php echo $data1[0] ?>" class="btn btn-default btn-flat"><i class="fa fa-search"></i> Detail</a>
												<a href="?module=info&page=artikel&ref=edit_artikel&id=<?php echo $data1[0] ?>" class="btn btn-primary btn-flat"><i class="fa fa-edit"></i> Edit</a>
												<a href="?module=info&page=artikel&ref=hapus_artikel&id=<?php echo $data1[0] ?>" onclick="return confirm('Hapus Artikel Ini ???')" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</a>
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

					case 'tambah_artikel':
						include "module/ref/tambah_artikel.php";
						break;

					case 'edit_artikel':
						include "module/ref/edit_artikel.php";
						break;

					case 'hapus_artikel':
						include "controller/act_hapus_artikel.php";
						break;

					case 'det_artikel':
						include "module/detail/det_artikel.php";
						break;
			}
		?>
	</div>
</div>
