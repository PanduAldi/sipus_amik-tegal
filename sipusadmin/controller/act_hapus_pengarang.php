<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	$id = isset($_GET['id'])?$_GET['id']:null;
	$query_del = mysql_query("delete from t_pengarang where kd_pengarang='$id'");

		if ($query_del) {
				?>
					<script type="text/javascript">
						alert('hapus berhasil');
						location.href = "?module=buku&ref=tambah_pengarang";
					</script>
				<?php
			}	
?>