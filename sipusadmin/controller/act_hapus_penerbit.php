<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	$id = isset($_GET['id'])?$_GET['id']:null;
	$query_del = mysql_query("delete from t_penerbit where kd_penerbit='$id'");

		if ($query_del) {
				?>
					<script type="text/javascript">
						location.href = "?module=buku&ref=tambah_penerbit";
					</script>
				<?php
			}	
?>