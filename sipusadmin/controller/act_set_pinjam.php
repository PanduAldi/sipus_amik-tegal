<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	if (isset($_POST['ubah'])) {
		# definisi var
		$set 	= isset($_POST['set'])?$_POST['set']:null;

		#query ubah
		$query_ubah = mysql_query("update set_pinjam set set_maks='$set' where id='$data_set[0]'");

		if ($query_ubah) {
			?>
			<script>
				alert("Maksimal peminjaman berhasil di edit menjadi <?php echo $set ?> Buku");
				location.href ="?module=peminjaman";
			</script>
			<?php
		}
	}
?>