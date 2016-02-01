<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "utiliti/koneksi.php";

?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h4><i class="fa fa-bullhorn"></i> Pengumuman</h4>
	</div>
</div>

<?php  

	#paging
	$per_hal		= 5;
	$jumlah_record	= mysql_query("SELECT COUNT(*) from t_info WHERE label='pengumuman'");
	$jum 			= mysql_result($jumlah_record, 0);
	$halaman 		= ceil($jum / $per_hal);
	$page 			= (isset($_GET['halaman'])) ? (int)$_GET['halaman'] : 1;
	$start			= ($page - 1) * $per_hal;

	$query_pengumuman = mysql_query("SELECT * FROM t_info WHERE label='pengumuman' ORDER BY tgl_publish DESC LIMIT $start, $per_hal");
	while ($data_pengumuman = mysql_fetch_array($query_pengumuman)) {
		?>
		<div class="panel panel-primary">
			<div class="panel-body">
				<h4><i class="fa fa-bullhorn"></i> <?php echo $data_pengumuman['judul'] ?></h4>
				<p style="font-size:10px"> <i class="fa fa-calendar"></i> <?php echo tgl_db($data_pengumuman['tgl_publish'])." ".jam_db($data_pengumuman['tgl_publish']) ?> </p>
				<?php echo $data_pengumuman['deskripsi'] ?>
			</div>
		</div>		
		<?php
	}
?>
<ul class="pagination">
	<li>
		<a href="?page=pengumuman&halaman=<?php echo $page -1 ?>"> <i class="fa fa-angle-double-left"></i></a>
	</li>
	<li>
		<?php 
		 
		for($x=1;$x<=$halaman;$x++){
			?>
			<a href="?page=pengumuman&halaman=<?php echo $x ?>"><?php echo $x ?></a>
			<?php
		}
		?>		
	</li>
	<li>
		 <a class="" href="?page=pengumuman&halaman=<?php echo $page +1 ?>"> <i class="fa fa-angle-double-right"></i></a>
	</li>
</ul>





