<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";
	include "controller/act_tambah_lain.php";
?>

<script>
	$(document).ready(function() {
		CKEDITOR.replace('editor');
	});
</script>

<div class="callout callout-info">
	<h4>Form Tambah Lain-lain</h4>
</div>		

<div class="box box-default">
	<div class="box-body">
		<form action="" method="post" class="form-horizontal" enctype="multipart/form-data" accept-charset="utf-8">
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Judul</label>
				<div class="col-sm-4">
					<input type="text" name="judul" class="form-control" required placeholder="Masukan Judul" />
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Deskripsi</label>
				<div class="col-sm-8">
					<textarea name="desk" id="editor" cols="80" rows="10"></textarea>	
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Cover : </label>
				<div class="col-sm-5">
					<input type="file" accept="image/*" name="cover" class="filestyle">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"></label>
				<div class="col-sm-5">
					<button type="submit" class="btn btn-primary btn-flat" name="simpan">Simpan</button>
					<a href="?module=info&page=link" class="btn btn-danger btn-flat">Batal</a>
				</div>
			</div>
		</form>
	</div>
</div>