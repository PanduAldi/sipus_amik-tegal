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
		$temp 	= $_FILES['cover']['tmp_name'];
		$format = $_FILES['cover']['type'];
		$cover	 = $_FILES['cover']['name'];
		$dir	 = "image/buku/$cover";
		

		if ($temp == "") {
						$query 	 = mysql_query("insert into t_buku(kd_buku,judul,kd_penerbit,kd_pengarang,tahun,
												kd_kategori, tgl_perolehan,jumlah_buku,ddc,rak,isbn,ket,
												jum_hal,status,most_new,abstraksi) 
												values('$kd_buku','$judul','$penerbit','$pengarang','$tahun',
												   	   '$kategori','$tgl_perolehan','$jum_buku','$ddc','$rak',
												   	   '$isbn','$ket','$jum_hal','$status','$new','$abstraksi')"); 

						if ($query) {
							?>
							<div class="alert alert-success">
									<strong>Berhasil!</strong>
									<p>Data Berhasil disimpan klik <a href="?module=buku">Disini</a> Untuk Kemali ke halaman Buku</p> 
							</div>
							<?php	
						}
		} else {

			if ($format == "image/jpeg" || $format == "image/jpg" || $format == "image/png" || $format == "image/JPG) {
				if (move_uploaded_file($temp, $dir)) {
						$query 	 = mysql_query("insert into t_buku(kd_buku,judul,kd_penerbit,kd_pengarang,tahun,
												kd_kategori, tgl_perolehan,jumlah_buku,ddc,rak,isbn,ket,cover,
												jum_hal,status,most_new,abstraksi) 
												values('$kd_buku','$judul','$penerbit','$pengarang','$tahun',
												   	   '$kategori','$tgl_perolehan','$jum_buku','$ddc','$rak',
												   	   '$isbn','$ket','$cover','$jum_hal','$status','$new','$abstraksi')"); 

						if ($query) {
							?>
							<div class="alert alert-success">
									<strong>Berhasil!</strong>
									<p>Data Berhasil disimpan klik <a href="?module=buku">Disini</a> Untuk Kemali ke halaman Buku</p> 
							</div>
							<?php	
						}
				} 
			}
		}
	}
?>