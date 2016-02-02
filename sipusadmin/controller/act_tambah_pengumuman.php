<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	#definisi variable
	$nama 	  = isset($_POST['nama'])?$_POST['nama']:null;
	$desk 	  = isset($_POST['desk'])?$_POST['desk']:null;
	$datetime = date("Y-m-d H:i:s");

	if (isset($_POST['simpan'])) {
	 	#query tambah
	 	$query_add = mysql_query("insert into t_info(id,judul,deskripsi,tgl_publish,label) values('','$nama','$desk','$datetime','pengumuman')");
		
		if ($query_add) {
			?>
				<div class="alert alert-success">
					<strong>Berhasil!</strong> Data berhasil di input klik <a href="?module=info&page=pengumuman">disini</a> untuk kembali ke Data Pengumuman...
				</div>
			<?php
		} else {
			echo "<script> alert('Proses Tambah Gagal')</script>";
		}
	} 
?>		