<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	$id 			= isset($_GET['id'])?$_GET['id']:null;
	$query_det		= mysql_query("Select * from t_info where id='$id'") or die(mysql_error());
	$fetch_det 		= mysql_fetch_array($query_det);


?>
<div class="callout callout-info">
	<h4>Detail Artikel / Berita</h4>
</div>
<hr>
<div class="row">
	<div class="col-lg-5 col-xs-12" align="center">
		<img class="img-thumbnail" src="image/berita/<?php echo $fetch_det['cover'] ?>" alt="" width="200" height="300">
	</div>
	<div class="col-lg-7 col-xs-12">
		<table class="table table-striped">
			<tbody>
				<tr>
					<td></td>
					<td></td>
					<td align="right"><a href="?module=info&page=artikel">Kembali Ke Halaman Berita</a></td>
				</tr>
				<tr>
					<td width="30"><b>Judul Artikel</b></td>
					<td width="10">:</td>
					<td width="200"><?php echo $fetch_det['judul'] ?></td>
				</tr>
				<tr>
					<td width="30"><b>Tanggal Publish</b></td>
					<td width="10">:</td>
					<td width="200">
						<?php  
							include "../utiliti/tgl_db.php";
							echo tgl_db($fetch_det['tgl_publish']);
						?>
					</td>
				</tr>
				<tr>
					<td width="30"><b>Jam</b></td>
					<td width="10">:</td>
					<td width="200">
						<?php 
							include "../utiliti/jam_db.php";
							echo jam_db($fetch_det['tgl_publish']);
						 ?>
					</td>
				</tr>
				<tr>
					<td width="30"><b>Deskripsi</b></td>
					<td width="10">:</td>
					<td width="200"><?php echo $fetch_det['deskripsi'] ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>