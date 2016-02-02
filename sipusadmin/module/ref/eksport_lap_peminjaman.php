<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../../../utiliti/koneksi.php";
	include "../../../utiliti/tgl_db.php";

	$tgl1 = isset($_GET['awal'])?$_GET['awal']:null;
	$tgl2 = isset($_GET['akhir'])?$_GET['akhir']:null;

	$judul = "<strong><h3>Laporan Data Transaksi Peminjaman Per Periode ".tgl_db($tgl1)." s/d ".tgl_db($tgl2)."</h3></strong>
			 <p>Sistem Informasi perpustakaan AMIK YMI Tegal</p>";

	$header = "<table>
				<tr>
					<th>No </th>
					<th>Tanggal Peminjaman</th>
					<th>Kode Pinjam</th>
					<th>ID Anggota</th>
					<th>Nama</th>
					<th>Jumlah Pinjam</th>
				</tr>";

	$query_tampil = mysql_query("SELECT * FROM t_peminjaman JOIN t_anggota ON t_peminjaman.id_anggota = t_anggota.id_anggota
												 WHERE tgl_pinjam BETWEEN '$tgl1' AND '$tgl2'");


	//mencari jumlah buku 
	function jum_buk($param) {
		$query = mysql_query("SELECT * FROM t_peminjaman JOIN det_pinjam ON t_peminjaman.kd_pinjam = det_pinjam.kd_pinjam 
							  WHERE t_peminjaman.kd_pinjam = '$param'");

		$count = mysql_num_rows($query);
		return $count." Buku";
	}


	$content_dalam = "";
	$no = 1;
	while ($fetch_data = mysql_fetch_array($query_tampil)) {
		
		$content = "<tr>
						<td>".$no++."</td>
						<td>".tgl_db($fetch_data['tgl_pinjam'])."</td>
						<td>".$fetch_data['kd_pinjam']."</td>
						<td>".$fetch_data['id_anggota']."</td>
						<td>".$fetch_data['nama']."</td>
						<td>".jum_buk($fetch_data['kd_pinjam'])."</td>
					</tr>";
		$content_dalam = $content_dalam."".$content;
	}

	$footer = "</table>";
	$print_sheet = $judul."<br>".$header."\n".$content_dalam."\n".$footer;

	$tgl_sekarang = date("Ymd");

	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=".$tgl_sekarang."Lap_peminjaman.xls");
	header("Pragma: no-cache");
	header("Expires : 0");

	print $print_sheet;
?>	

<script>
	self.close();
</script>

