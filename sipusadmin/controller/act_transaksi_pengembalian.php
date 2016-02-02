<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	if (isset($_POST['simpan_pengembalian'])) {

		$kd_pengembalian = isset($_POST['kd_pengembalian'])?$_POST['kd_pengembalian']:null;
		$kd_pinjam 		 = isset($_POST['kd_pinjam'])?$_POST['kd_pinjam']:null;
		$tgl_kembali 	 = date("Y-m-d");
		$kd_buku         = isset($_POST['kd_buku'])?$_POST['kd_buku']:null;
		$kondisi 		 = isset($_POST['kondisi'])?$_POST['kondisi']:null;
		$denda  		 = isset($_POST['denda'])?$_POST['denda']:null;

		$status_pinjam	= "sudah dikembalikan";
		$status_buku    = "tersedia";

	 	for ($i=0; $i < count($kd_buku); $i++) { 
	 		$query_transaksi = mysql_query("INSERT INTO t_pengembalian(kd_pengembalian,kd_pinjam,tgl_kembali,kd_buku,denda,kondisi)
	 			                            VALUES('$kd_pengembalian','$kd_pinjam','$tgl_kembali','$kd_buku[$i]','$denda','$kondisi')");
	 	
	 		if ($query_transaksi) {
	 			mysql_query("UPDATE det_pinjam SET status='$status_pinjam' WHERE kd_buku='$kd_buku[$i]'");
	 			mysql_query("UPDATE t_buku SET status='$status_buku' WHERE kd_buku='$kd_buku[$i]'");
	 		} else{
	 			?><script> alert("Gagal") </script><?php
	 		}
	 	}

	 	?>
	 	<script>
	 		alert("Transaksi Pengembalian Berhasil");
	 		location.href = "?module=pengembalian";
	 	</script>
	 	<?php
	 } 
?>