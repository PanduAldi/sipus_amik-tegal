<?php 
	error_reporting(E_ALL^E_NOTICE);
	include "utiliti/koneksi.php";

	$nama 		= isset($_POST['nama'])?$_POST['nama']:null;
	$komentar 	= isset($_POST['komentar'])?$_POST['komentar']:null;
	$tanggal 	= date("Y-m-d H:i:s");

	if(isset($_POST['simpan_chat'])) {
		$query_add_chat = mysql_query("INSERT INTO t_chat(id,nama,chat,tgl) VALUES('','$nama','$komentar','$tanggal')");
		if ($query_add_chat) {
			?>
			<script>
				alert("Komentar Berhasil di Tambahkan");
				location.href = "home.php";
			</script>
			<?php
		}
	}
?>