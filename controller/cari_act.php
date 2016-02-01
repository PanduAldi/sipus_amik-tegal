<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "utiliti/koneksi.php";

	if (isset($_GET['cari'])) {
		#deklarasi variable
		$judul 		= isset($_GET['judul'])?$_GET['judul']:null;
		$penerbit 	= isset($_GET['penerbit'])?$_GET['judul']:null;
		$pengarang  = isset($_GET['pengarang'])?$_GET['pengarang']:null;
		$isbn 		= isset($_GET['isbn'])?$_GET['isbn']:null;
		$kategori 	= isset($_GET['kategori'])?$_GET['kategori']:null;
	}
?>	