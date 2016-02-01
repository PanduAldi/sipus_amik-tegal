<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	$id = isset($_GET['id'])?$_GET['id']:null;
	$query_aktivasi = mysql_query("UPDATE t_anggota SET aktif='Y' WHERE id_anggota = '$id'");

	if ($query_aktivasi) {
		?>
			<script>
				alert("Anggota dengan ID <?php echo $id ?> Berhasil di aktivasi");
				location.href = "?module=anggota";
			</script>
		<?php
	}
?>