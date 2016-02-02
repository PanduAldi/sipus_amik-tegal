<?php  
 	error_reporting(E_ALL^E_NOTICE);
 	include "controller/act_tambah_cover.php";


?>
<script>
	$(document).ready(function() {
		$(':file').filestyle();
	});
</script>
<div class="col-sm-6">
	<div class="callout callout-success">
		<h4>Tambah Cover</h4>
		<form action="" method="post" enctype="multipart/form-data">
			<input type="file" name="cover" class="filestyle">	
	</div>	

	<button type="submit" name="simpan" class="btn btn-primary btn-flat" ><i class="fa fa-save"></i> Simpan</button>
	<a href="?module=buku" class="btn btn-default btn-flat">Batal / Kembali ke Utama</a>
	* Maksimal ukuran cover 2 MB
	</form>	
</div>