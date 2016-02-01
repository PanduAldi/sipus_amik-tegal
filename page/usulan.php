<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "utiliti/koneksi.php";
	include "controller/usulan_act.php";

?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h4><i class="fa fa-envelope"></i> Usulan Pengadaan Buku</h4>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-body">
		<h4><b><i class="fa fa-book"></i> Formulir Usulan Pengadaan Buku</b></h4>
		<div class="panel panel-primary">
			<div class="panel-body">
				<form action="" class="form-horizontal" method="POST">
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Kategori :</label>
						<div class="col-sm-4">
							<select name="kategori" class="form-control text-capitalize" required>
								<option value="">-- --</option>
								<option value="dosen">Dosen</option>
								<option value="mahasiswa">Mahasiswa</option>
								<option value="civitas akademik">Civitas Akademik </option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Nama Lengkap :</label>
						<div class="col-sm-5">
							<input type="text" required class="form-control text-capitalize" name="nama" placeholder="Masukan Nama Lengkap Anda" value="<?php echo $_POST['nama'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Judul Buku :</label>
						<div class="col-sm-5">
							<input type="text" required class="form-control text-capitalize" name="judul" placeholder="Masukan Judul Buku yang di usulkan" value="<?php echo $_POST['judul'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Penerbit :</label>
						<div class="col-sm-4">
							<input type="text" required class="form-control text-capitalize" name="penerbit" placeholder="Masukan Penerbit" value="<?php echo $_POST['penerbit'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Pengarang / Penulis :</label>
						<div class="col-sm-4">
							<input type="text" required class="form-control text-capitalize" name="pengarang" placeholder="Masukan Pengarang" value="<?php echo $_POST['pengarang'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Tahun terbit :</label>
						<div class="col-sm-2">
							<input type="text" required maxlength="4" class="form-control text-capitalize" name="tahun" placeholder="tahun" value="<?php echo $_POST['tahun'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label"></label>
						<div class="col-sm-4">
							<button type="submit" name="simpan_usulan" class="btn btn-success"><i class="fa fa-book"></i> Usulkan Buku</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-body">
				<p class="text-justify" style="font-size:14px;"><strong>
					Perpustakaan AMIK Tegal Menerima usulan pengadaan buku baru untuk meningkatkan jumlah koleksi. Berkenaan dengan
					hal tersebut kami menghimbau kepada Dosen, Mahasiswa & Civitas Akademik AMIK YMI Tegal untuk mengusulkan judul
					buku yang anti akan menjadi acuan dalam pengadaan buku baru.</strong>
				</p>
			</div>
		</div>	

	</div>
</div>