<?php  

	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

#cari id 
	$id = isset($_GET['id'])?$_GET['id']:null;

		#definisi file variabel
		$temp 	= $_FILES['cover']['tmp_name'];
		$format	= $_FILES['cover']['type'];
		$cover	= $_FILES['cover']['name'];
		$dir	= "image/buku/$cover";


if (isset($_POST['simpan'])) {

	if ($format == "image/jpeg" || $format == "image/jpg" || $format == "image/png" || $format == "image/JPG") {
		if (move_uploaded_file($temp, $dir)) {
			#query add
			$query_add = mysql_query("update t_buku set cover='$cover' where kd_buku='$id'");

			if ($query_add) {
				?>
					<script>
						alert("Cover Berhasil di tambahkan");
						location.href = "?module=buku";
					</script>
				<?php
			}
		} else {
			echo '<script>alert("Upload gagal")</script>';
		}
	} else {
		echo '<script> alert("Format salah") </script>';
	}
}

?>