<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	$id 		  = isset($_GET['id'])?$_GET['id']:null;
	$query_select = mysql_query("select cover from t_info where id ='$id'");
	$fetch_query  = mysql_fetch_array($query_select);
	$dir		  = "image/berita/$fetch_query[cover]";
	unlink($dir);

		$query_hapus 	=  mysql_query("delete from t_info where id='$id'");

		if($query_hapus){
			?>
				<div class="alert alert-danger">
					<p>Suksess !!! Data Berhasil di Hapus . . .</p>
				</div>
				<script>
					location.href = "?module=info&page=artikel";
				</script>
			<?php
		}
?>