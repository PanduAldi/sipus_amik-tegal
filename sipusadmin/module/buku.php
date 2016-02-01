<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	//box
	$nama_box 	= array("Buku","Kategori","Penerbit","Pengarang");
	$link_box 	= array("tambah_buku","tambah_kategori","tambah_penerbit","tambah_pengarang");
	$logo_box 	= array("book","server","users","pencil-square-o");
	$warna_box	= array("aqua","green","yellow","red");
	$tabel_box  = array("t_buku","t_kategori","t_penerbit","t_pengarang");

?>

		<script>
			$(document).ready(function() {
				$('#datatables').dataTable();
			});
		</script>


<div class="row">
<div class="col-xs-12">
	<div class="box box-default">
		<div class="box-body">
		<?php  
			$ref = isset($_GET['ref'])?$_GET['ref']:null;
			switch ($ref) {
				default:
					?>
						<div class="row">
						<?php  
							for ($i=0; $i < count($nama_box); $i++) { 
								$query 			= mysql_query("Select * from ".$tabel_box[$i]);
								$jumlah_data	= mysql_num_rows($query);

								echo '<div class="col-lg-3 col-xs-6">
									  <div class="small-box bg-'.$warna_box[$i].'">
										<div class="inner">
											<h3>'.$jumlah_data.'</h3>
											<p>'.$nama_box[$i].'</p>														
										</div>
										<div class="icon">
											<i class="fa fa-'.$logo_box[$i].'"></i>
										</div>
										<a href="?module=buku&ref='.$link_box[$i].'" class="small-box-footer">
											'.ucwords($link_box[$i]).' <i class="fa fa-arrow-circle-right"></i>
										</a>							
								      </div>
								      </div>';
							}
						?>
						</div>
						<!-- end box kecil -->
						
						<div class="table-responsive">
							<table id="datatables" class="table table-bordered table-hover">
								<thead>
									<tr>
													<?php  
														$kolom_tabel = array("Kode Buku","Judul Buku", "Cover", "Status", "Aksi");
														$ukuran_kolom = array(30,60,20,25,10);
														for ($i=0; $i < count($kolom_tabel) ; $i++) { 
															echo '<th width="'.$ukuran_kolom[$i].'">'.$kolom_tabel[$i].'</th>';
														}
													?>

									</tr>
								</thead>
								<tbody>
									<?php  
										$query = mysql_query("select * from t_buku");
										while ($data = mysql_fetch_array($query)) {
											?>
												<tr> 
													<td><?php echo $data['kd_buku'] ?></td>
													<td><?php echo $data['judul'] ?></td>
													<td align='center'>
														<?php  
															if ($data['cover'] == "") {
																echo '<img src="image/buku/Logo.png" alt="" width="110" height="135">';
															} else {
																echo '<img src="image/buku/'.$data['cover'].'" alt="" width="110" height="135">';
															}
														?>
													</td>
													<td><?php echo $data['status'] ?></td>
													<td>
														<?php
															if ($data['cover'] == "") {
																?>
																<a href='?module=buku&ref=det_buku&id=<?php echo $data[0] ?>' class='btn btn-default btn-flat'><i class='fa fa-search'></i><a>
																<a href='?module=buku&ref=edit_buku&id=<?php echo $data[0] ?>' class='btn btn-primary btn-flat'><i class='fa fa-edit'></i><a>
																<a href='?module=buku&ref=hapus_buku&id=<?php echo $data[0] ?>' class='btn btn-danger btn-flat'><i class='fa fa-trash'></i><a><br><br>
																<a href="?module=buku&ref=tambah_cover&id=<?php echo $data[0] ?>" class="btn btn-warning btn-flat"><i class="fa fa-plus"></i> Add Cover</a>
																<?php
															} else {
																?>
																<a href='?module=buku&ref=det_buku&id=<?php echo $data[0] ?>' class='btn btn-default btn-flat'><i class='fa fa-search'></i><a>
																<a href='?module=buku&ref=edit_buku&id=<?php echo $data[0] ?>' class='btn btn-primary btn-flat'><i class='fa fa-edit'></i><a>
																<a href='?module=buku&ref=hapus_buku&id=<?php echo $data[0] ?>' class='btn btn-danger btn-flat'><i class='fa fa-trash'></i><a>
																<?php
															}															
														?>
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

					case 'tambah_buku':
						include "module/ref/tambah_buku.php";
						break;

					case 'tambah_kategori':
						include "module/ref/tambah_kategori.php";
						break;

					case 'tambah_penerbit':
						include "module/ref/tambah_penerbit.php";
						break;

					case 'tambah_pengarang':
						include "module/ref/tambah_pengarang.php";
						break;

					case 'det_buku':
						include "module/detail/det_buku.php";
						break;

					case 'edit_buku':
						include "module/ref/edit_buku.php";
						break;

					case 'hapus_buku':
						include "controller/act_hapus_buku.php";
						break;

					case 'tambah_cover':
						include "module/ref/tambah_cover.php";
						break;

					case 'import_buku':
						include "module/ref/import_buku.php";
						break;
			}
			

		?>			
		</div>
	</div>
</div>
</div>