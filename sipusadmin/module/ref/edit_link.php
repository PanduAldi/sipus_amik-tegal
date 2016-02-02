<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	#fetch link
	$id 	= isset($_GET['id'])?$_GET['id']:null;
	$query	= mysql_query("Select * from t_info where id = '$id'");
	$data1	= mysql_fetch_array($query);

	include "controller/act_edit_link.php";
?>


<div class="callout callout-info">
	<h4>Form Edit LINK</h4>
</div>		

<div class="box box-default">
	<div class="box-body">
		<form action="" method="post" class="form-horizontal" enctype="multipart/form-data" accept-charset="utf-8">
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Nama Link</label>
				<div class="col-sm-4">
					<input type="text" name="judul" class="form-control" required placeholder="Masukan Nama Link" value="<?php echo $data1['judul'] ?>" />
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Deskripsi</label>
				<div class="col-sm-5">
					<input type="text" name="url" placeholder="Masukan Url Link Contoh : http://www.amiktegal.ac.id/" class="form-control" value="<?php echo $data1['deskripsi'] ?>">
				</div>
			</div>
			<div class="form-group">
			 	<label for="" class="col-sm-3 control-label">Cover Link</label>
				<div class="col-sm-4">
					<img src="image/info/<?php echo $data1['cover'] ?>" alt="Gambar" width="200" height="80" />
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"></label>
				<div class="col-sm-5">
					<input type="file" accept="image/*" name="cover" class="filestyle">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"></label>
				<div class="col-sm-5">
					<button type="submit" class="btn btn-primary btn-flat" name="simpan">Simpan Link</button>
					<a href="?module=info&page=link" class="btn btn-danger btn-flat">Batal</a>
				</div>
			</div>
		</form>
	</div>
</div>