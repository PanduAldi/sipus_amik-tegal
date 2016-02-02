<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	# var post
	$kd_buku 		= isset($_POST['kd_buku'])?$_POST['kd_buku']:null;
	$judul 			= isset($_POST['judul'])?$_POST['judul']:null;
	$penerbit 		= isset($_POST['penerbit'])?$_POST['penerbit']:null;
	$pengarang 		= isset($_POST['pengarang'])?$_POST['pengarang']:null;
	$tahun 			= isset($_POST['tahun'])?$_POST['tahun']:null;
	$kategori 		= isset($_POST['kategori'])?$_POST['kategori']:null;
	$jum_buku		= isset($_POST['jum_buku'])?$_POST['jum_buku']:null;
	$ddc			= isset($_POST['ddc'])?$_POST['ddc']:null;
	$rak 			= isset($_POST['rak'])?$_POST['rak']:null;
	$isbn 			= isset($_POST['isbn'])?$_POST['isbn']:null;
	$ket 			= isset($_POST['ket'])?$_POST['ket']:null;
	$new 			= isset($_POST['new'])?$_POST['new']:null;
	$jum_hal 		= isset($_POST['jumlah'])?$_POST['jumlah']:null;
	$status 		= "tersedia";
	$abstraksi 		= isset($_POST['abstraksi'])?$_POST['abstraksi']:null;
	
	$tgl 	 		= explode("/", $_POST['tgl_perolehan']);
	$tgl_perolehan  = $tgl[2]."-".$tgl[1]."-".$tgl[0];

	if (isset($_POST['simpan'])) {
			// Ambil gambar
			$temp 	= $_FILES['cover']['tmp_name'];
			$format = $_FILES['cover']['type'];
			$cover  = $_FILES['cover']['name'];
			$dir 	= "image/buku/$cover";
			//file yang akan dihapus
			$dir_hapus = "image/buku/$data_det[cover]";

			if (((!$kd_buku) || (!$temp))) {
				
				$query_update1 = mysql_query("update t_buku set judul='$judul',kd_penerbit='$penerbit',kd_pengarang='$pengarang', kd_kategori='$kategori',
											 				   tahun='$tahun',jumlah_buku='$jum_buku',ddc='$ddc',rak='$rak',isbn='$isbn', tgl_perolehan='$tgl_perolehan',
											 				   ket='$ket',most_new='$new',abstraksi='$abstraksi',jum_hal='$jum_hal',status='$status' where kd_buku='$kd_buku'");

				if ($query_update1) {
					?>
						<div class="alert alert-success">
								<strong>Berhasil!</strong>
								<p>Data Berhasil di Edit klik <a href="?module=buku">Disini</a> Untuk Kemali ke halaman Buku</p> 
						</div>
					<?php		
				}		

			} else{
				if ($format == "image/jpeg" || $format == "image/jpg" || $format == "image/png" || $format == "image/JPG") {
					if (move_uploaded_file($temp, $dir) && unlink($dir_hapus)) {
										$query_update2 = mysql_query("update t_buku set judul='$judul',kd_penerbit='$penerbit',kd_pengarang='$pengarang', kd_kategori='$kategori',
											 						  tahun='$tahun',jumlah_buku='$jum_buku',ddc='$ddc',rak='$rak',isbn='$isbn', tgl_perolehan='$tgl_perolehan',
											 				  		  ket='$ket',most_new='$new',abstraksi='$abstraksi',jum_hal='$jum_hal',status='$status',cover='$cover' where kd_buku='$kd_buku'");
						
						if ($query_update2) {
						?>
						<div class="alert alert-success">
								<strong>Berhasil!</strong>
								<p>Data Berhasil di Edit klik <a href="?module=buku">Disini</a> Untuk Kemali ke halaman Buku</p> 
						</div>
						<?php							
						}
					} else {
					?>
						<div class="alert alert-success">
								<strong>GAGAL!</strong>
						</div>
					<?php							
					}
				}
			}
		}	
?>