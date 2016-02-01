<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

?>

<script>	
	//dungsi pop_up
	function pop_up(){
		var targetitem 	= document.fpinjam.id_anggota;
		var width 	= 900;
		var height 	= 100;
		var left 	= (screen.width - width) /2;
		var top 	= (screen.height - height) /2;
		var param 	= 'width='+width+', height'+height+', scrollbar=yes';
		param +=', top'+top+', left='+left;

		var dataitem = window.open('module/pop_up_anggota.php',"dataitem", param);
		dataitem.targetitem = targetitem;

	}
</script>

<div class="row">
	<div class="col-sm-6 col-xs-6">
		<h4>Form Transaksi Peminjaman</h4>
	</div>
	<div class="col-sm-6 col-xs-6">
		<h4 align="right">
			<a class="btn btn-warning btn-flat" data-toggle="modal" href='#modal-id'><i class="fa fa-bell"></i> Petunjuk Penggunaan</a>
			<a href="?module=peminjaman" class="btn btn-default btn-flat"><i class="fa fa-angle-double-left"></i> Kembali </a>
		</h4>
	</div>
</div> 


<form action="" method="post" name="fpinjam" class="form-horizontal">
	<div class="box box-success">
		<div class="box-body">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="" class="col-sm-4 control-label">Kode Peminjaman</label>
						<div class="col-sm-4">
							<?php  
								include "../utiliti/autonumber.php";
								$awal 	= date("dmy");
							?>
							<input type="text" class="form-control" readonly="readonly" name="kd_pinjam" value="<?=id("t_peminjaman","kd_pinjam",3,"$awal") ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-4 control-label">Id Anggota</label>
						<div class="col-sm-4">
							<?php 
								$id_booking = isset($_GET['id_booking'])?$_GET['id_booking']:null;
								$query_anggota = mysql_query("SELECT id_anggota FROM t_anggota WHERE id_anggota='$id_booking'");
								$data_anggota  = mysql_fetch_array($query_anggota);
								if (!$_SESSION['id_anggota']) {
									# input dengan id yang di booking
									?><input type="text" name="id_anggota" readonly="readonly" value="<?php echo $data_anggota[0] ?>" class="form-control" /><?php
								} else {
									?><input type="text" name="id_anggota" readonly="readonly" value="<?php echo $_SESSION['id_anggota'] ?>" class="form-control" /><?php
								}
							?>
						</div>
						<div class="col-sm-4">
							<input type="button" onclick="pop_up()" value="Cari Anggota" class="btn btn-default btn-flat">
						</div>
					</div>
				</div> <!-- end col 6 -->
				
				<div class="col-sm-6 col-xs-6">
					<div class="form-group">
						<label for="" class="col-sm-4 control-label">Tanggal Peminjaman</label>
						<div class="col-sm-4">
							<?php  
								include "../utiliti/tgl_db.php";
								$tanggal_sekarang = date("Y-m-d");

							?>
							<input type="text" readonly name="tgl_pinjam" value="<?php echo tgl_db($tanggal_sekarang)?>" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-4 control-label">Tgl Harus kembali </label>
						<div class="col-sm-4">
							<?php  
								$seminggu = date("Y-m-d", strtotime('+7 day'));
							?>
							<input type="text" readonly value="<?php echo tgl_db($seminggu) ?>" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-4 control-label">Keterangan</label>
						<div class="col-sm-4">
							<textarea name="ket" id="" cols="22" rows="1"><?php echo $_POST['ket'] ?></textarea>
						</div>
					</div>
				</div> <!-- end col 6 2 -->
			</div> <!-- ecn row -->

			<div class="box box-warning">
				<div class="box-body">
					<div class="col-sm-offset-6">
						<form action="" method="post" name="ftambah_buku" id="ftambah_buku">
							<p align="right">
								<b>Masukan Kode Buku :</b> 
								<input type="text" name="kd_buku_temp"> <input type="submit" name="tambah_buku" value="Tambahkan" class="btn btn-success btn-flat">
							</p>
						</form>
					</div>
					<div class="container-fluid">
						<div class="table-resposive">
					 <table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th width="20">No</th>
										<th width="70">Kode Buku</th>
										<th width="180">Judul Buku</th>
										<th width="5">Pilihan</th>

									</tr>
								</thead>
								<tbody>
									<?php  
										$no = 1;
										$query_temp = mysql_query("Select * from t_trans_buku_temp join t_buku on t_trans_buku_temp.kd_buku = t_buku.kd_buku order by t_trans_buku_temp.id") or die(mysql_error());
										$cek 		= mysql_num_rows($query_temp);

										if ($cek > 0) {
											while ($data_temp = mysql_fetch_array($query_temp)) {
												?>
													<tr>
														<td><?php echo $no++ ?></td>
														<td><input type="text" name="kd_buku[]" class="form-control" value="<?php echo $data_temp['kd_buku'] ?>" readonly></td>
														<td><?php echo $data_temp['judul'] ?></td>
														<td align="center"><a href="?module=peminjaman&ref=tambah_peminjaman&id_batal=<?php echo $data_temp[0] ?>" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</a></td>

													</tr>
												<?php
											}
										} else {
											?>
											<tr>
												<td colspan="3" align="center"><b>Buku Yang Akan Di Pinjam Belum Di Input!!</b></td>
											</tr>
											<?php
										}
									?>
								</tbody>
							</table>
						</div> <!-- end table responsive -->
					</div> <!-- container-fluid end -->
				</div>
			</div> <!-- end box-warning -->

			<div class="col-sm-12">
				<button type="submit" onclick="return confirm('Lanjutkan Transaksi Peminjaman')" name="simpan_transaksi" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan Transaksi Peminjaman</button>
				<a href="module/batal_trans.php" class="btn btn-default btn-flat">Batalkan Transaksi Peminjaman</a>
			</div>
		</div>
	</div> <!-- end box-success -->
</form>

<?php  
	include "controller/act_transaksi_peminjaman.php";
?>



<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Petunjuk Penggunaan Transaksi Peminjaman</h4>
			</div>
			<div class="modal-body">
				<ol>
					<li>Cari anggota dengan tombol yang ada di samping form id anggota untuk memilih Anggota yang akan meminjam buku.</li>
					<li>Cek terlebih dahulu ketersediaan buku apakah sudah di booking oleh Anggota lain.</li>
					<li>Masukan kode buku di form yang sudah dsediakan. Masukan sesuai dengan kode yang ada pada buku. kemudian klik tombol Tambahkan.</li>
					<li>Jika ada pembatalan dalam peminjaman salah satu buku pilih hapus.</li>
					<li>Jika pada tabel buku yang akan di pinjam tidak muncul judul buku. Cek kembali kode buku atau buku belum di input dalam sistem.</li>
					<li>Simpan Transaksi Peminjaman jika selesai melakukan transaksi.</li>
				</ol>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>