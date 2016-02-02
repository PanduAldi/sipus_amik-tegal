<?php 
	session_start(); 
	include "../../utiliti/koneksi.php";
	$query_hapus_temp = mysql_query("TRUNCATE TABLE t_trans_buku_temp");
	unset($_SESSION['id_anggota']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Redirect Batal Transaksi</title>
	<script>
		function kembali() {
			location.href = "../home.php?module=peminjaman";
		}
	</script>
</head>
<body>
	<center>
		<h1>Transaksi Peminjaman di Batalkan</h1>
		<p>Kembali ke Halaman Peminjaman dalam</p>
		<h4><input type="button" onclick="kembali()" value="Klik Tombol Ini Untuk Kembali"></h4>
	</center>
</body>
</html>