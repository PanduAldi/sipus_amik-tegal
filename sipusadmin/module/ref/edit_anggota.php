<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	#menampilkann data 
	$id 	= isset($_GET['id'])?$_GET['id']:null;
	$query 	= mysql_query("select * from t_anggota where id_anggota = '$id'");
	$data 	= mysql_fetch_array($query);

	include "controller/act_edit_anggota.php";
?>
<script>
	function angka(e) {
	   if (!/^[0-9]+$/.test(e.value)) {
	      e.value = e.value.substring(0,e.value.length-10);
	   }
	}
</script>

<div class="row">
	<div class="col-lg-6 col-xs-6">
		<h4><i class="fa fa-edit"></i> Edit Data Anggota</h4>
	</div>	
	<diiv class="col-lg-6 col-xs-6" >
		<h4 align="right"><a href="?module=anggota" > &lt;&lt; Kembali </a></h4>
	</diiv>
</div>
<div class="col-lg-12">
	<div class="box box-success">
		<div class="box-body">
			<form action="" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Id Anggota</label>
					<div class="col-sm-2">
						<input type="text" readonly="readonly" name="id_anggota" class="form-control" value="<?php echo $data['id_anggota'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">NIM</label>
					<div class="col-sm-3">
						<input type="text" onkeyup="angka(this)" placeholder="NIM" maxlength="8" name="nim" class="form-control" value="<?php echo $data['nim'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Nama</label>
					<div class="col-sm-5">
						<input type="text" name="nama" placeholder="Masukan Nama Lengkap" class="form-control" value="<?php echo $data['nama'] ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Email</label>
					<div class="col-sm-4">
						<input type="email" name="email" placeholder="Masukan Email" class="form-control" value="<?php echo $data['email'] ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">No Telp / HP</label>
					<div class="col-sm-3">
						<input type="text" onkeyup="angka(this)" maxlength="12" name="telp" placeholder="contoh : 085693041111" class="form-control" value="<?php echo $data['telp'] ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Alamat</label>
					<div class="col-sm-5">
						<textarea name="alamat" id="" cols="35" rows="5"><?php echo $data['alamat'] ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label"></label>
					<div class="col-sm-5">
						<button type="submit" name="simpan" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan Anggota</button>
						<a href="?module=anggota" class="btn btn-danger btn-flat"> Batal</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>