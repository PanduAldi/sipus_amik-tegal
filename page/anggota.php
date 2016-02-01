<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "utiliti/koneksi.php";

	include "controller/register_act.php";
?>
<script>
	function angka(e) {
	   if (!/^[0-9]+$/.test(e.value)) {
	      e.value = e.value.substring(0,e.value.length-10);
	   }
	}
</script>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h4><i class="fa fa-pencil-square-o"></i> Formulir Pendaftaran Online Anggota Perpustakaan AMIK YMI Tegal</h4>
	</div>
	<div class="panel-body">
		<form action="" name="fdaftar" method="POST" class="form-horizontal">
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Id Anggota :</label>
				<div class="col-sm-3">
					<?php include "utiliti/autonumber.php";
						  $awal = date("Ym");
					?>
					<input type="text" readonly=""  name="id_anggota" class="form-control" value="<?=id("t_anggota","id_anggota",3,"$awal")?>">
					* Id Otomatis ter-input.
				</div>
			</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">NIM :</label>
					<div class="col-sm-3">
						<input type="text" onkeyup="angka(this)" placeholder="NIM" maxlength="8" name="nim" class="form-control" value="<?php echo $_POST['nim'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Nama Lengkap :</label>
					<div class="col-sm-5">
						<input type="text" name="nama" placeholder="Masukan Nama Lengkap" class="form-control text-capitalize" value="<?php echo $_POST['nama'] ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Email :</label>
					<div class="col-sm-4">
						<input type="email" name="email" placeholder="Masukan Email" class="form-control" value="<?php echo $_POST['email'] ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">No Telp / HP :</label>
					<div class="col-sm-3">
						<input type="text" onkeyup="angka(this)" name="telp" maxlength="12" placeholder="contoh : 085693041111" class="form-control" value="<?php echo $_POST['telp'] ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Alamat :</label>
					<div class="col-sm-5">
						<textarea name="alamat" id="" cols="35" placeholder="Masukan ALamat lengkap Anda" rows="5"><?php echo $_POST['alamat'] ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Password :</label>
					<div class="col-sm-5">
						<input type="password" name="pass_satu" placeholder="Masukan Password Anda" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Retype Password :</label>
					<div class="col-sm-5">
						<input type="password" name="pass_dua" placeholder="Masukan Password  Yang Sama" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"></label>
					<div class="col-sm-5">
						<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> Registrasi</button>
						<a href="?page=home" class="btn btn-danger">Batal Registrasi</a>
					</div>
				</div>
		</form>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-body">
		<div>

		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Persyaratan dan Ketentuan</a></li>
		    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Hak dan Kewajiban</a></li>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="home">
		    	<br>
		    	<ol>
		    		<li> Anggota adalah Mahasiswa aktif AMIK YMI Tegal.</li>
		    		<li> Isi data dengan lengkap pada form diatas.</li>
		    		<li> Setelah pendaftaran. Akun tidak lagsung aktif dan bisa digunakan.</li>
		    		<li> Kami akan meninjau akun yang telah anda daftarkan. kemudian kami akan kirim Aktivasi ke E-mail anda</li>

		    	</ol>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="profile">
		    	<br>
		    	Anggota Perpustakaan terdaftar akan mendapatkan fasilitas sebgai berikut :
		    	<ul>
		    		<li>Pencarian katalog</li>
		    		<li>Memesan atau mem-Booking buku yang akan di pinjam.</li>
		    		<li>Mengirim pesan kepada pustakawan terkait perpustakaan.</li>
		    	</ul>
		    </div>
		  </div>

		</div>
	</div>
</div>