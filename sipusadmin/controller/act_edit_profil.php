<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	//definisi variabel
	$kd		= $data[0];
	$judul	= isset($_POST['judul'])?$_POST['judul']:null;
	$desk	= isset($_POST['desk'])?$_POST['desk']:null;
	
	date_default_timezone_get("Asia/Jakarta");
	$date 	= date("Y-m-d H:i:s");

	if (isset($_POST['simpan'])) {
	 	
	 	$temp	= $_FILES['cover']['tmp_name'];
	 	$format = $_FILES['cover']['type'];
	 	$cover 	= $_FILES['cover']['name'];
	 	$dir 	= "image/info/$cover";

	 		//file dari direktori yang akan di hapus
	 		$dir_hapus = "image/info/$data[cover]";

	 	if (((!$kd) || (!$temp)))  {
	 		//query update
	 		$query_update1 = mysql_query("update t_info set judul='$judul',deskripsi='$desk',
	 															 tgl_publish='$date' where id='$kd'");

	 		if ($query_update1) {
	 			?>
	 			<script>
	 				alert("Update Profil Berhasil");
	 				location.href = "?module=info&page=profil";
	 			</script>
	 			<?php
	 		}
	 	} else {
	 		if ($format == "image/jpeg" || $format == "image/jpg" || $format == "image/png" || $format == "image/JPG") {
	 			#eksekusi
	 			if (move_uploaded_file($temp, $dir) && unlink($dir_hapus)) {
	 				#query update 2
	 				$query_update2 = mysql_query("update t_info set judul='$judul',deskripsi='$desk',
	 														tgl_publish='$date',cover='$cover' where id='$kd'");

	 				if ($query_update2) {
	 					?>
	 						<script>
	 							alert("Update Profil Berhasil");
	 							location.href = "?module=info&page=profil";
	 						</script>
	 					<?php
	 				}

	 			} else { 
	 				?>
	 					<script>
	 						alert("Upload gagal");
	 					</script>
	 				<?php
	 			}
	 		} else {
	 			?>
	 				<script>
	 					alert("Format salah");
	 				</script>
	 			<?php
	 		}
	 	}
	 } 
?>