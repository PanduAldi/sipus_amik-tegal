<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	#definisi variable
	$kd 	  = $data[0];
	$nama 	  = isset($_POST['nama'])?$_POST['nama']:null;
	$desk 	  = isset($_POST['desk'])?$_POST['desk']:null;
	$datetime = date("Y-m-d H:i:s");

	if (isset($_POST['simpan'])) {
	 	#query tambah
	 	$query_edit = mysql_query("update t_info set judul='$nama', deskripsi='$desk', tgl_publish='$datetime'
	 								where id='$kd'");
		
		if ($query_edit) {
			?>
				<div class="alert alert-warning">
					<strong>Berhasil!</strong> Data berhasil di edit. Klik <a href="?module=info&page=pengumuman">disini</a> untuk kembali ke Data Pengumuman...
				</div>
			<?php
		} else {
			echo "<script> alert('Proses Edit Gagal')</script>";
		}
	} 
?>		