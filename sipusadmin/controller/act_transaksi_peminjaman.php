<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	$kd_pinjam 		= isset($_POST['kd_pinjam'])?$_POST['kd_pinjam']:null;
	$id_anggota		= isset($_POST['id_anggota'])?$_POST['id_anggota']:null;
	$kd_buku_temp 	= isset($_POST['kd_buku_temp'])?$_POST['kd_buku_temp']:null;
	$kd_buku 		= isset($_POST['kd_buku'])?$_POST['kd_buku']:null;


	#tambah temporary buku
	if (isset($_POST['tambah_buku'])) {

		$_SESSION['id_anggota'] = $id_anggota;
		#query set pinjam
		$query_set_pinjam = mysql_query("Select set_maks from set_pinjam where id='1'");
		$fetch_set 		  = mysql_fetch_array($query_set_pinjam);

		#query temp
		$query_temp 	= mysql_query("Select * from t_trans_buku_temp");
		$cek_temp 		= mysql_num_rows($query_temp);

			if($cek_temp == $fetch_set['set_maks']) {
			?>
				<script>
			 		alert("Pinjaman Mencapai Maksimal");
				</script>
			<?php
			} else {

				$query_tambah_temp = mysql_query("insert into t_trans_buku_temp(id,kd_buku) values('','$kd_buku_temp')");

				if ($query_tambah_temp) {
					
					echo '<script> location.href ="?module=peminjaman&ref=tambah_peminjaman"; </script>';
				}
				
			}
	}

	#aksi hapus temporary buku
	if (isset($_GET['id_batal'])) {
		
		$id_batal 		  = isset($_GET['id_batal'])?$_GET['id_batal']:null;
		$query_hapus_temp = mysql_query("DELETE FROM t_trans_buku_temp WHERE id='$id_batal'") or die(mysql_error());

		if($query_hapus_temp) {
			?>
			<script>
				location.href = "?module=peminjaman&ref=tambah_peminjaman";
			</script>
			<?php
		}
	}

	#aksi transaksi peminjaman
	if(isset($_POST['simpan_transaksi'])){

		$kd_buku = isset($_POST['kd_buku'])?$_POST['kd_buku']:null;

		$query_transaksi = mysql_query("INSERT INTO t_peminjaman(kd_pinjam,id_anggota,tgl_pinjam,tgl_hrskembali,ket) 
										VALUES('$kd_pinjam','$id_anggota','$tanggal_sekarang','$seminggu','$ket')");

		if ($query_transaksi) {
			# input det peminjaman
			$status_pinjam = "belum dikembalikan";
			for ($i=0; $i < count($kd_buku); $i++) { 
				#query insert 
				mysql_query("INSERT INTO det_pinjam(id,kd_pinjam,kd_buku,status) VALUES('','$kd_pinjam','$kd_buku[$i]','$status_pinjam')");

				#update buku yang telah di pinjam 
				mysql_query("update t_buku set status='sedang dipinjam' where kd_buku='$kd_buku[$i]'");
			}

			mysql_query("DELETE FROM t_booking WHERE id_anggota='$id_anggota'");

			#hapus_temp_buku
			mysql_query("TRUNCATE TABLE t_trans_buku_temp");

			#hapus sesi
			unset($_SESSION['id_anggota']);

			?>
				<script>
					alert("Transaksi Peminjaman Berhasil");
					location.href = "?module=peminjaman";
				</script>
			<?php
		}
	}
?>