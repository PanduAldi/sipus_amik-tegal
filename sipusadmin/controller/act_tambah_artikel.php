<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	#definisi variable
	$judul	= isset($_POST['judul'])?$_POST['judul']:null;
	$desk	= isset($_POST['desk'])?$_POST['desk']:null;
	$tgl	= date("Y-m-d H:i:s");

	#def var upload 
	$temp	= $_FILES['cover']['tmp_name'];
	$format	= $_FILES['cover']['type'];
	$cover	= $_FILES['cover']['name'];
	$dir	= "image/berita/$cover";

	if (isset($_POST['simpan'])) {
		if ($format == "image/jpeg" || $format == "image/jpg" || $format == "image/png" || $format == "image/JPG") {
			if (move_uploaded_file($temp, $dir)) {
				#query tambah
				$query_add = mysql_query("Insert into t_info(id,judul,deskripsi,cover,tgl_publish,label) 
										  values('','$judul','$desk','$cover','$tgl','artikel')");

				if ($query_add) {
					?>
					<div class="alert alert-success">
						<strong>Berhasil!</strong> Data berhasil di input klik <a href="?module=info&page=artikel">disini</a> untuk kembali ke Data Artikel / Berita...
					</div>
					<?php
				}

			} else{
				echo '<script>
						alert("Upload gambar gagal");
					  </script>';
			}
		} else {
			echo '<script>
					alert("Format salah");
				  </script>';		
		}
	}
?>

