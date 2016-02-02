<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	//tampil data 
	$query = mysql_query("Select * from t_info where label='profil'") or die(mysql_error());
	$data  = mysql_fetch_array($query); 

	include "controller/act_edit_profil.php";

?>
<script>
	$(function(){
		CKEDITOR.replace('editor1')
	})

</script>

<div class="row">
	<div class="col-lg-6 col-xs-6">
		<h3><i class="fa fa-home"></i> Profil</h3>  
	</div>
	<div class="col-lg-6 col-xs-6" valign="center"  align="right">
		<h3><a href="?module=info"/> &lt;&lt;Kembali </a></h3>
	</div>
</div>

<div class="box box-default">
	<div class="box-body">
		<div class="col-lg-12">
		<?php  
			include "../utiliti/tgl_db.php";
			include "../utiliti/jam_db.php";
		?>
			<div class="alert alert-warning">
				<p>Update Terakhir : <?php echo tgl_db($data['tgl_publish']) ?>, Jam : <?php echo jam_db($data['tgl_publish']) ?></p>
			</div>
			<form action="" method="post" class="form-horizontal" enctype="multipart/form-data" accept-charset="utf-8">
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Nama profil</label>
					<div class="col-sm-4">
						<input type="text" name="judul" id="" readonly="" class="form-control" value="<?php echo $data['judul'] ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Deskripsi</label>
					<div class="col-sm-8">
						<textarea name="desk" id="editor1" cols="80" rows="10"><?php echo $data['deskripsi'] ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Gambar : </label>
					<div class="col-sm-5">
						<img src="image/info/<?php echo $data['cover'] ?>" width="300" height="200" alt="gambar">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"></label>
					<div class="col-sm-4">
						<input type="file" accept="image/*" name="cover" class="filestyle">
						<p>Silahkan pilih gambar jika ingin dirubah</p>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"></label>
					<div class="col-sm-5">
						<button type="submit" class="btn btn-primary btn-flat" name="simpan">Simpan Perubahan</button>
						<a href="?module=info" class="btn btn-danger btn-flat">Kembali ke menu utama</a>
					</div>
				</div>
			</form>
		</div>		
	</div>
</div>
