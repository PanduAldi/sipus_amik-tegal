<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../../../utiliti/koneksi.php";
	include "../../../utiliti/tgl_db.php";

	$tgl1 = isset($_GET['awal'])?$_GET['awal']:null;
	$tgl2 = isset($_GET['akhir'])?$_GET['akhir']:null;

	$judul = "<strong><h3>Laporan Data Anggota Terdaftar Periode ".tgl_db($tgl1)." s/d ".tgl_db($tgl2)."</h3></strong>
			 <p>Sistem Informasi perpustakaan AMIK YMI Tegal</p>";

	$header = "<table>
				<tr>
					<th>ID Anggota</th>
					<th>NIM</th>
					<th>Nama</th>
					<th>Email</th>
					<th>Tanggal Terdaftar</th>
				</tr>";

	$query_tampil = mysql_query("SELECT * FROM t_anggota WHERE tanggal BETWEEN '$tgl1' AND '$tgl2'");

	$content_dalam = "";
	while ($fetch_data = mysql_fetch_array($query_tampil)) {
		
		$content = "<tr>
						<td>".$fetch_data['id_anggota']."</td>
						<td width='300'>".$fetch_data['nim']."</td>
						<td width='100'>".$fetch_data['nama']."</td>
						<td width='100'>".$fetch_data['email']."</td>
						<td>".tgl_db($fetch_data['tanggal'])."</td>
					</tr>";
		$content_dalam = $content_dalam."".$content;
	}

	$footer = "</table>";
	$print_sheet = $judul."<br>".$header."\n".$content_dalam."\n".$footer;

	$tgl_sekarang = date("Ymd");

	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=".$tgl_sekarang."Lap_anggota.xls");
	header("Pragma: no-cache");
	header("Expires : 0");

	print $print_sheet;
?>	

<script>
	self.close();
</script>

