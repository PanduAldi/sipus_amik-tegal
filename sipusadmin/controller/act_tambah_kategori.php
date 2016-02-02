<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	$kategori = isset($_POST['kategori'])?$_POST['kategori']:null;

	if (isset($_POST['simpan'])) {
		
		$query_tambah = mysql_query("insert into t_kategori values('','$kategori')");

		if($query_tambah){
			?>
			<script type="text/javascript">
				location.href="?module=buku&ref=tambah_kategori";
			</script>
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Berhasil !!</strong> Kategori di simpan ...
			</div>
			<?php
		} else {
			?>
				<script>
					alert("Simpan Gagal <?php echo mysql_error(); ?>");
				</script>
			<?php
		}
	}
?>