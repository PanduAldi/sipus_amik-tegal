<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "utiliti/koneksi.php";

	if (isset($_POST['simpan_usulan'])) {
		# deklarasi var
		$kategori 	= isset($_POST['kategori'])?$_POST['kategori']:null;
		$nama		= isset($_POST['nama'])?$_POST['nama']:null;
		$judul 		= isset($_POST['judul'])?$_POST['judul']:null;
		$penerbit 	= isset($_POST['penerbit'])?$_POST['penerbit']:null;
		$pengarang	= isset($_POST['pengarang'])?$_POST['pengarang']:null;
		$tahun 		= isset($_POST['tahun'])?$_POST['tahun']:null;		
		$tgl 		= date("Y-m-d");
		
		$query_add_usulan = mysql_query("INSERT INTO t_usulan_buku(id,kategori,nama,judul,penerbit,pengarang,tahun,tanggal,baca)
										 VALUES('','$kategori','$nama','$judul','penerbit','$pengarang','$tahun','$tgl','N')") or die(mysql_error());

		if ($query_add_usulan) {
			?>
			<div class="alert alert-success">
				<strong>Sukses !!</strong> Usulan akan kami tinjau ... Terima kasih telah menggunakan fasilitas ini.
			</div>
			<?php
		}
	}
?>