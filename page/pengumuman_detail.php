<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "utiliti/koneksi.php";

	$id  = isset($_GET['id'])?$_GET['id']:null;
	$query  = mysql_query("SELECT * FROM t_info WHERE id = '$id'");
	$fecth  = mysql_fetch_array($query);

?>
<div class="panel panel-primary">
	<div class="panel-body">
		<h3><i class="fa fa-bullhorn"></i> <?php echo $fecth['judul'] ?></h3>
		<p style="font-size:11px"><i class="fa fa-calendar"></i> <?php echo tgl_db($fecth['tgl_publish'])." ".jam_db($fecth['tgl_publish']) ?></p>
		<?php echo $fecth['deskripsi'] ?>
	</div>
</div>