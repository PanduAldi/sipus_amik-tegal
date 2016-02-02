<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";



	if (isset($_POST['simpan'])) {

		$id_anggota 	= isset($_POST['id_anggota'])?$_POST['id_anggota']:null;
		$nim		 	= isset($_POST['nim'])?$_POST['nim']:null;
		$nama		 	= isset($_POST['nama'])?$_POST['nama']:null;
		$email		 	= isset($_POST['email'])?$_POST['email']:null;
		$telp		 	= isset($_POST['telp'])?$_POST['telp']:null;
		$alamat		 	= isset($_POST['alamat'])?$_POST['alamat']:null;
		$tanggal 		= date("Y-m-d");
		$aktif 			= "Y";
		#password anggota
		$pass = md5($nim);

		$query_add 	= mysql_query("Insert into t_anggota(id_anggota,nim,nama,email,telp,alamat,pass,tanggal,aktif)
								   values('$id_anggota','$nim','$nama','$email','$telp','$alamat','$pass','$tanggal','$aktif') ");

		if ($query_add) {
			# jika berhasil di input
			echo '<div class="alert alert-success">
					<strong>Berhasil !!</strong> Data berhasil di input klik <a href="?module=anggota" title="">Disini</a> Untuk kembali ke menu utama...
				</div>';
		} else {
			?>
			<script>
				alert('gagal input');
			</script>
			<?php
		} 
	}
?>
