<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

?>

<div class="row">
	<div class="col-lg-6 col-xs-6">
		<h3><i class="fa fa-newspaper-o"></i> Link </h3>  
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
					<a href="?module=info&page=link&ref=tambah_link" class="btn btn-primary btn-flat"><i class="fa fa-pencil"></i> Tambah Link</a>
					<br><br>
					<div class="table-responsive"> 
						<table class="table table-bordered table-hover" id="tabel">
							<thead>
								<tr>
								<?php  
									$nama_kolom = array("No","Nama Link","Link","Cover Link","Aksi");
									$ukuran		= array(10,90,100,90,20);
								
									for ($i=0; $i < count($nama_kolom); $i++) { 
										echo '<th width="'.$ukuran[$i].'">'.$nama_kolom[$i].'</th>';
									}
								?>
								</tr>
							</thead>
							<tbody>
								<?php  
									$no = 1;
									$query = mysql_query("Select * from t_info where label='link'");
									while ($data1 = mysql_fetch_array($query)) {
										?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td><?php echo $data1['judul'] ?></td>
											<td><a href="<?php echo $data1['deskripsi'] ?>" target="_blank" title="<?php echo $data1['judul'] ?>"><?php echo $data1['deskripsi'] ?></a></td>
											<td align="center"><img src="image/info/<?php echo $data1['cover'] ?>" width="250" height="80" alt="Logo"></td>
											<td>
												<a href="?module=info&page=link&ref=edit_link&id=<?php echo $data1[0] ?>" class="btn btn-primary btn-flat"><i class="fa fa-edit"></i> Edit</a>
												<a href="?module=info&page=link&ref=hapus_link&id=<?php echo $data1[0] ?>" onclick="return confirm('Hapus Link Ini ???')" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</a>
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

					case 'tambah_link':
						include "module/ref/tambah_link.php";
						break;

					case 'edit_link':
						include "module/ref/edit_link.php";
						break;

					case 'hapus_link':
						include "controller/act_hapus_link.php";
						break;
			}
		?>
	</div>
</div>
