<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	$id 			= isset($_GET['id'])?$_GET['id']:null;
	$query_det		= mysql_query("Select * from t_info where id='$id'") or die(mysql_error());
	$fetch_det 		= mysql_fetch_array($query_det);

	include "controller/act_edit_artikel.php";
?>

<script>
	$(document).ready(function() {
		CKEDITOR.replace('editor');
	});
</script>

<div class="callout callout-info">
	<h4>Form Edit Artikel / Berita</h4>
</div>		

<div class="box box-default">
	<div class="box-body">
		<form action="" method="post" class="form-horizontal" enctype="multipart/form-data" accept-charset="utf-8">
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Judul Artikel</label>
				<div class="col-sm-4">
					<input type="text" name="judul" class="form-control" required placeholder="Masukan Judul Artikel / berita" value="<?php echo $fetch_det['judul'] ?>" />
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Deskripsi</label>
				<div class="col-sm-8">
					<textarea name="desk" id="editor" cols="80" rows="10"><?php echo $fetch_det['deskripsi'] ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Cover Berita : </label>
				<div class="col-sm-5">
					<img src="image/berita/<?php echo $fetch_det['cover'] ?>" alt="">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"></label>
				<div class="col-sm-5">
					<input type="file" accept="image/*" name="cover" class="filestyle">
					<p>Silahkan pilih gambar jika ingin dirubah</p>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"></label>
				<div class="col-sm-5">
					<button type="submit" class="btn btn-primary btn-flat" name="simpan">Simpan Artikel</button>
					<a href="?module=info&page=artikel" class="btn btn-danger btn-flat">Batal</a>
				</div>
			</div>
		</form>
	</div>
</div>