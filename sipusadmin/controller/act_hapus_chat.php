<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	$id = isset($_GET['id'])?$_GET['id']:null;
	$query_hapus = mysql_query("DELETE FROM t_chat WHERE id = '$id'");

	if ($query_hapus) {
		?>
			<script>
				location.href = "?module=chat";
			</script>
		<?php
	}
?>