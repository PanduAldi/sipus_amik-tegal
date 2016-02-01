<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../../../utiliti/koneksi.php";
	include "../../../utiliti/tgl_db.php";

	$tgl1 = isset($_GET['awal'])?$_GET['awal']:null;
	$tgl2 = isset($_GET['akhir'])?$_GET['akhir']:null;

	$judul = "<strong><h3>Laporan Data Buku Periode ".tgl_db($tgl1)." s/d ".tgl_db($tgl2)."</h3></strong>
			 <p>Sisitem Informasi perpustakaan AMIK YMI Tegal</p>";

	$header = "<table>
				<tr>
					<th>ID Buku</th>
					<th>Judul</th>
					<th>Penerbit</th>
					<th>Pengarang</th>
					<th>Tahun Terbit</th>
					<th>ISBN</th>
					<th>Tanggal Perolehan</th>
				</tr>";

	$query_tampil = mysql_query("SELECT * FROM t_buku JOIN t_pengarang ON t_buku.kd_pengarang = t_pengarang.kd_pengarang
						 		JOIN t_penerbit ON t_buku.kd_penerbit = t_penerbit.kd_penerbit  
								WHERE t_buku.tgl_perolehan BETWEEN '$tgl1' AND '$tgl2'");

	$content_dalam = "";
	while ($fetch_data = mysql_fetch_array($query_tampil)) {
		
		$content = "<tr>
						<td>".$fetch_data['kd_buku']."</td>
						<td width='300'>".$fetch_data['judul']."</td>
						<td width='100'>".$fetch_data['penerbit']."</td>
						<td width='100'>".$fetch_data['pengarang']."</td>
						<td>".$fetch_data['tahun']."</td>
						<td>".$fetch_data['isbn']."</td>
						<td>".tgl_db($fetch_data['tgl_perolehan'])."</td>
					</tr>";
		$content_dalam = $content_dalam."".$content;
	}

	$footer = "</table>";
	$print_sheet = $judul."<br>".$header."\n".$content_dalam."\n".$footer;

	$tgl_sekarang = date("Ymd");

	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=".$tgl_sekarang."Lap_buku.xls");
	header("Pragma: no-cache");
	header("Expires : 0");

	print $print_sheet;
?>	

<script>
	self.close();
</script>

