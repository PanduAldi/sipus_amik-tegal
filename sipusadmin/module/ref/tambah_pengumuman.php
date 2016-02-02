<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";
	include "../utiliti/tgl_indo.php";

	include "controller/act_tambah_pengumuman.php";
?>

<script>
	$(document).ready(function() {
		CKEDITOR.replace('editor');
	});
</script>

<div class="row">
	<div class="col-lg-6 col-xs-6">
		<p style="font-size : 20px;">Form Tambah Pengumuman</p>
	</div>
	<div class="col-lg-6 col-sm-6">
		<p class="text-right" valign="center" style="font-size : 20px;">Tanggal : <?php tgl_now() ?></p>
	</div>
</div>
<hr>

<form action="" method="post" class="form-horizontal">
	<div class="form-group">
		<label for="" class="col-sm-3 control-label">Nama Pengumuman</label>
		<div class="col-sm-7">
			<input type="text" name="nama" placeholder="Masukan Nama Pengumuman " class="form-control" required>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-sm-3 control-label">Deskripsi Pengumuman</label>
		<div class="col-sm-7">
			<textarea name="desk" id="editor" cols="100" rows="10"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-sm-3 control-label"></label>
		<div class="col-sm-7">
			<button type="submit" name="simpan" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan Pengumuman</button>
			<a href="?module=info&page=pengumuman" class="btn btn-danger btn-flat">Batal</a>
		</div>
	</div>
</form>


