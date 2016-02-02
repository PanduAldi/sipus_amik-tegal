<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	#definisi variable
	$id 	= $data1[0];
	$judul	= strtolower(isset($_POST['judul'])?$_POST['judul']:null);
	$desk	= isset($_POST['desk'])?$_POST['desk']:null;
	$tgl	= date("Y-m-d H:i:s");

	#def var upload 
	$temp	= $_FILES['cover']['tmp_name'];
	$format	= $_FILES['cover']['type'];
	$cover	= $_FILES['cover']['name'];
	$dir	= "image/info/$cover";

	if (isset($_POST['simpan'])) {
		//file dari direktori yang akan di hapus
	 	$dir_hapus = "image/info/$fetch_det[cover]";

	 	if (((!$id) || (!$temp)))  {
	 		//query update
	 		$query_update1 = mysql_query("update t_info set judul='$judul',deskripsi='$desk',
	 															 tgl_publish='$tgl' where id='$id'");

	 		if ($query_update1) {
	 			?>
	 				<script>
	 					alert("Update Berhasil");
	 					location.href = "?module=info&page=lain";
	 				</script>
	 			<?php
	 		}
	 	} else {
	 		if ($format == "image/jpeg" || $format == "image/jpg" || $format == "image/png" || $format == "image/JPG") {
	 			#eksekusi
	 			if (move_uploaded_file($temp, $dir) && unlink($dir_hapus)) {
	 				#query update 2
	 				$query_update2 = mysql_query("update t_info set judul='$judul',deskripsi='$desk',
	 														tgl_publish='$tgl',cover='$cover' where id='$id'");

	 				if ($query_update2) {
	 					?>
	 						<script>
	 							alert("Update Berhasil");
	 							location.href = "?module=info&page=lain";
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

