<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	$id 			= isset($_GET['id'])?$_GET['id']:null;
	$query_det		= mysql_query("Select * from t_buku join t_penerbit on t_buku.kd_penerbit = t_penerbit.kd_penerbit
								   join t_pengarang on t_buku.kd_pengarang=t_pengarang.kd_pengarang join t_kategori on t_buku.kd_kategori = t_kategori.kd_kategori where kd_buku = '$id'") or die(mysql_error());
	$fetch_det 		= mysql_fetch_array($query_det);

?>

<div class="row">
	<div class="col-lg-6 col-xs-6">
		<h3><span class="glyphicon glyphicon-book"></span> Detail Buku</h3>  
	</div>
	<div class="col-lg-6 col-xs-6" valign="center"  align="right">
		<h3><a href="?module=buku"/> &lt;&lt;Kembali </a></h3>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-lg-5 col-xs-12" align="center">
		<?php  
			if ($fetch_det['cover'] != null) {
				?>
				<img class="img-thumbnail" src="image/buku/<?php echo $fetch_det['cover'] ?>" alt="" width="200" height="300">
				<?php
			} else {
				?>
				<img class="img-thumbnail" src="image/buku/Logo.png" alt="" width="200" height="300">
				<?php
			}
		?>
	</div>
	<div class="col-lg-7 col-xs-12">
		<table class="table table-striped">
			<tbody>				
				<tr>
					<td colspan="3" align="right"><a href="?module=buku" >&lt;&lt; Kembali ke menu utama</a></td>
				</tr>
				<tr>
					<td width="30"><b>Kode Buku</b></td>
					<td width="10">:</td>
					<td width="200"><?php echo strtoupper($fetch_det['kd_buku']) ?></td>
				</tr>
				<tr>
					<td width="30"><b>Judul Buku</b></td>
					<td width="10">:</td>
					<td width="200"><?php echo $fetch_det['judul'] ?></td>
				</tr>
				<tr>
					<td width="30"><b>Penerbit</b></td>
					<td width="10">:</td>
					<td width="200"><?php echo $fetch_det['penerbit'] ?></td>
				</tr>
				<tr>
					<td width="30"><b>Pengarang</b></td>
					<td width="10">:</td>
					<td width="200"><?php echo $fetch_det['pengarang'] ?></td>
				</tr>
				<tr>
					<td width="30"><b>Tahun Terbit</b></td>
					<td width="10">:</td>
					<td width="200"><?php echo $fetch_det['tahun'] ?></td>
				</tr>
				<tr>
					<td width="30"><b>Kategori</b></td>
					<td width="10">:</td>
					<td width="200"><?php echo $fetch_det['kategori'] ?></td>
				</tr>
				<tr>
					<td width="30"><b>Tanggal Perolehan</b></td>
					<td width="10">:</td>
					<td width="200">
						<?php  
							include "../utiliti/tgl_db.php";
							echo tgl_db($fetch_det['tgl_perolehan']);
						?>
					</td>
				</tr>
				<tr>
					<td width="30"><b>DDC</b></td>
					<td width="10">:</td>
					<td width="200"><?php echo $fetch_det['ddc'] ?></td>
				</tr>
				<tr>
					<td width="30"><b>RAK</b></td>
					<td width="10">:</td>
					<td width="200"><?php echo $fetch_det['rak'] ?></td>
				</tr>
				<tr>
					<td width="30"><b>ISBN</b></td>
					<td width="10">:</td>
					<td width="200"><?php echo $fetch_det['isbn'] ?></td>
				</tr>
				<tr>
					<td width="30"><b>Keteranangan</b></td>
					<td width="10">:</td>
					<td width="200"><?php echo $fetch_det['ket'] ?></td>
				</tr>
				<tr>
					<td width="30"><b>Jumlah Halaman</b></td>
					<td width="10">:</td>
					<td width="200"><?php echo $fetch_det['jum_hal'] ?></td>
				</tr>
				<tr>
					<td width="30"><b>Status</b></td>
					<td width="10">:</td>
					<td width="200"><?php echo $fetch_det['status'] ?></td>
				</tr>
				<tr>
					<td width="30"><b>Most New</b></td>
					<td width="10">:</td>
					<td width="200"><?php echo $fetch_det['most_new'] ?></td>
				</tr>
				<?php  
					if ($fetch_det['abstraksi']) {
						echo '	<tr>
									<td width="30"><b>Abstraksi</b></td>
									<td width="10">:</td>
									<td width="200" class="text-justify">'.$fetch_det['abstraksi'].'</td>
								</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
</div>