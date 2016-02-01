<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

?>
<script>
	$(document).ready(function() {
			$('#tabel').dataTable();
		});	
</script>

	<div class="box box-default">
		<div class="box-body">
			<?php  

				#cek notifikasi
				$query_cek = mysql_query("SELECT * FROM t_anggota WHERE aktif = 'N'");
				$cek 	   = mysql_num_rows($query_cek);

				if ($query_cek > 0) {
					echo '<div class="alert alert-info">
								<strong>Notifikasi !!!</strong> '.$cek.' Anggota baru belum di aktivasi.
						  </div>';
				}

				$ref = isset($_GET['ref'])?$_GET['ref']:null;
				switch ($ref) {
					default:
						# tampil halaman pertaman
						?>
						<div class="col-sm-12">
							<h4><a href="?module=anggota&ref=tambah_anggota" class="btn btn-primary btn-flat"><i class="fa fa-pencil"></i>  | Tambah Anggota Manual</a></h4>
						</div>
						<div class="col-sm-12">
							<div class="box box-warning">
								<div class="box-body">
									<div class="table-responsive">
										<table id="tabel" class="table table-bordered table-hover">
											<thead>
												<tr>
													<?php  
														$nama_kolom	 = array("Id_Anggota","NIM","Nama","Email","No Telp", "Alamat","Tgl_Terdaftar","Aksi");
														$ukuran 	 = array(10,50,100,50,100,40,10);
														for ($i=0; $i < count($nama_kolom); $i++) { 
															echo '<th width="'.$ukuran[$i].'">'.$nama_kolom[$i].'</th>';
														}
													?>
												</tr>
											</thead>

											<tbody>
												<?php  
													include "../utiliti/tgl_db.php";
													$query_tampil = mysql_query("Select * from t_anggota order by id_anggota");
													while ($data = mysql_fetch_array($query_tampil)) {
														?>
														<tr>
															<td><?php echo $data['id_anggota'] ?></td>
															<td><?php echo $data['nim'] ?></td>
															<td><?php echo $data['nama'] ?></td>
															<td><?php echo $data['email'] ?></td>
															<td><?php echo $data['telp'] ?></td>
															<td><?php echo $data['alamat'] ?></td>
															<td>
																<?php 
																	echo tgl_db($data['tanggal']);
																?>
															</td>
															<td>
																<a href="?module=anggota&ref=edit_anggota&id=<?php echo $data[0] ?>" class="btn btn-primary btn-flat" title="Edit Data"><i class="fa fa-edit"></i> Edit</a>
																<a onclick="return confirm('Hapus Data Ini ??')" href="?module=anggota&ref=hapus_anggota&id=<?php echo $data[0] ?>" class="btn btn-danger btn-flat" title="Hapus Data"><i class="fa fa-trash"></i> Hapus</a>
																<?php  
																	if ($data['aktif'] == "N") {
																		?>
																			<a href="?module=anggota&ref=aktivasi&id=<?php echo $data[0] ?>" class="btn btn-primary btn-flat" ><i class="fa fa-check-square-o"></i> Aktivasi</a>
																		<?php
																	} else{
																		echo "";
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
								</div>
							</div>
						</div>
						<?php
						break;

						case 'tambah_anggota':
							include "module/ref/tambah_anggota.php";
							break;

						case 'edit_anggota':
							include "module/ref/edit_anggota.php";
							break;

						case 'hapus_anggota':
							include "controller/act_hapus_anggota.php";
							break;

						case 'aktivasi':
							include "controller/aktivasi.php";
							break;
				}
			?>

			<div class="col-sm-7">
				<label for=""><b>Catatan : </b></label>
				<ul>
					<li>Anggota dapat mendaftar secara Online Melalui : http://sipus.amiktegal.ac.id/home.php?page=anggota</li>
					<li>Password default untuk Input Manual Anggota adalah NIM dari Anggota yang telah di daftarkan. Kecuali Anggota yang telah mendaftar lewat online</li>
				</ul>
			</div>
		</div>
	</div>
