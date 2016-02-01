<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	$ambil = isset($_GET['q'])?$_GET['q']:null;
	$ambil_data = mysql_real_escape_string($ambil);
	$query = mysql_query("Select * from t_pengarang where pengarang like '%$ambil_data%' order by kd_pengarang");

	if ($query) {
		
		while ($data = mysql_fetch_array($query)) {
			echo $data[0]." ".$data[2]."\n";
		}
	}

?>