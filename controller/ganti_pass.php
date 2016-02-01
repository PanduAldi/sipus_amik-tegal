<?php 
	error_reporting(E_ALL^E_NOTICE);
	include "utiliti/koneksi.php";

	if (isset($_POST['simpan_pass'])) {
		

		$id = $_GET['id'];
		$utama = md5($_POST['utama']);
		$baru  = md5($_POST['baru']);
		$lagi  = md5($_POST['lagi']);



		$query_cek_anggt = mysql_query("SELECT pass FROM t_anggota WHERE nim='$id'");
		$cek = mysql_fetch_array($query_cek_anggt);

		if ($cek['pass'] == $utama) {
			if ($baru == $lagi) {
				$query_update = mysql_query("UPDATE t_anggota SET pass = '$baru' WHERE nim = '$id'");
				if ($query_update) {
					?>
					<script>
						alert("Ubah passsword berhasil.");
						location.href = "?page=home";
					</script>
					<?php
				}
			} else {
				?>
					<script> alert("Kombinasi Password tidak cocok. Silahkan ulangi kembali") </script>
				<?php
			}			

		} else {
			?>
				<script>
					alert("Password utama Salah");
				</script>
			<?php
		
		}


	}
?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h4><i class="fa fa-lock"></i> Ganti Password</h4>
		<div class="panel panel-primary">
			<div class="panel-body">
				<form action="" name="fganti" method="POST">
			
						<input type="password" name="utama" class="form-control" placeholder="Masukan Password Anda" />
					<br>
						<input type="password" name="baru" class="form-control" placeholder="Masukan Password Baru" />
					<br>	
						<input type="password" name="lagi" class="form-control" placeholder="Masukan Password Kembali" />
					<br>

					<p align="right">
						<button type="submit" name="simpan_pass" class="btn btn-primary">Simpan Password</button>
						<a href="?page=home" class="btn btn-danger"> Batalkan</a>
					</p>
				</form>
			</div>
		</div>
	</div>
</div>