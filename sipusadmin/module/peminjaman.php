<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

?>

<script>
	//data tabel
	$(document).ready(function() {
		$('#tabel').dataTable();
	});
</script>

<div class="box box-default">
	<div class="box-body">
		<?php  
			$ref	= isset($_GET['ref'])?$_GET['ref']:null;
			switch ($ref) {
				default:
					?>
					<div class="row">
						<?php  
							#prototype box small
							$namabox 	= array("Tambah Transaksi Peminjaman","Data Booking");
							$nama_inner = array("Peminjaman", "Booking");
							$nama_link 	= array("tambah_peminjaman", "data_booking");
							$warna		= array("aqua","green");
							$icon 		= array("fa fa-cart-plus", "fa fa-bookmark-o");

							for ($i=0; $i < count($namabox) ; $i++) { 
								#menampilkan small box
								echo '<div class="col-lg-6 col-xs-6">
									  <div class="small-box bg-'.$warna[$i].'">
										<div class="inner">
											<h3>'.$nama_inner[$i].'</h3>
											<p>'.$namabox[$i].'</p>														
										</div>
										<div class="icon">
											<i class="fa fa-'.$icon[$i].'"></i>
										</div>
										<a href="?module=peminjaman&ref='.$nama_link[$i].'" class="small-box-footer">
											'.$namabox[$i].' <i class="fa fa-arrow-circle-right"></i>
										</a>							
								      </div>
								      </div>';
							}
						?>
					</div> <!--  end row -->
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<div class="box box-success">
								<div class="box-body">
									<?php  
										$query_set = mysql_query("Select * from set_pinjam");
										$data_set  = mysql_fetch_array($query_set);

										// controller untuk set peminjaman.
										include "controller/act_set_pinjam.php";
									?>
									<h3>Set Maksimal Peminjaman</h3><hr>
									<form action="" method="post" class="form-horizontal">
										<div class="form-group">
											<div class="col-sm-2">
												<input type="text" name="set" class="form-control" value="<?php echo $data_set[1] ?>">
											</div>
											<div class="col-sm-6">
												* Setting maksimal jumlah peminjaman
											</div>											
										</div>
										<div class="form-group">
											<div class="col-sm-3">
												<input type="submit" name="ubah" value="Ubah Maksimal" class="btn btn-primary btn-flat">
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-xs-12">
							<div class="callout callout-warning">
								<h3>Petunjuk</h3><hr>
								<ul>
									<li>Transaksi Peminjaman harus di lakukan secara manual lewat menu Tambah Transaksi Peminjaman.</li>
									<li>Data Booking berisi Data Anggota yang telah mem-Booking Buku.</li>
									<li>Pilih tombol pengembalian untuk transaksi pengembalian</li>
								</ul>
							</div>			
						</div>			
					</div>
					<div class="box box-warning">
						<div class="box-body">
							<div class="table-responsive" id="load_tabel">
								<table class="table-bordered table-hover" id="tabel">
									<thead>
										<tr>
											<?php  
												$nama_kolom = array("Kode Peminjaman", "Nama_peminjam","Tanggal Pinjam","Aksi");
												$ukuran		= array(15,20,20,40);
												for ($i=0; $i < count($nama_kolom) ; $i++) { 
													echo '<th align="center" style="width:'.$ukuran[$i].'%">'.$nama_kolom[$i].'</th>';
												}
											?>
										</tr>
									</thead>
									<tbody>
										<?php  
											$query_tampil = mysql_query('Select t_peminjaman.kd_pinjam, t_anggota.nama, t_peminjaman.tgl_pinjam	from t_peminjaman join t_anggota on t_peminjaman.id_anggota=t_anggota.id_anggota');
											
											while ($data = mysql_fetch_array($query_tampil)) {
												if (!$data[0]) {
													echo "";
												} else{
												?>
												<tr>
													<td align="center"><?php echo $data['kd_pinjam'] ?></td>
													<td><?php echo $data['nama'] ?></td>
													<td align="center"><?php echo $data['tgl_pinjam'] ?></td>
													<td align="center">
														<a href="?module=peminjaman&ref=det_pinjam&id=<?php echo $data[0] ?>" class="btn btn-default btn-flat"><i class="fa fa-search"></i> Detail Peminjaman</a>
														<a href="?module=peminjaman&ref=pengembalian&id=<?php echo $data[0] ?>" class="btn btn-primary btn-flat"><i class="fa fa-reply"></i> Pengembalian Buku</a>
													</td>
												</tr>
												<?php
												}
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<?php
					break;

					case 'tambah_peminjaman':
						include "module/ref/tambah_peminjaman.php";
						break;

					case 'det_pinjam':
						include "module/detail/det_peminjaman.php";
						break;

					case 'pengembalian':
						include "module/ref/form_pengembalian.php";
						break;

					case 'data_booking':
						include "module/data_booking.php";
						break;
			}
		?>

	</div>
</div> <!-- end box default -->
