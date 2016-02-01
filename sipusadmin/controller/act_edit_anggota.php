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
		$query_edit = mysql_query("update t_anggota set nim='$nim',nama='$nama',email='$email',
								   telp='$telp',alamat='$alamat',tanggal='$tanggal' where id_anggota='$id_anggota'");

		if ($query_edit) {
		# jika berhasil di input
			echo '<div class="alert alert-success">
					<strong>Berhasil !!</strong> Data berhasil di Ubah klik <a href="?module=anggota" title="">Disini</a> Untuk kembali ke menu utama...
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