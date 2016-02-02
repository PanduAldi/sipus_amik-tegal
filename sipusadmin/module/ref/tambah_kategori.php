<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	include "controller/act_tambah_kategori.php";

?>

<div class="row">
	<div class="col-lg-6 col-xs-6">
		<h3><span class="glyphicon glyphicon-book"></span> Kategori / Rak Buku</h3>  
	</div>
	<div class="col-lg-6 col-xs-6" valign="center"  align="right">
		<h3><a href="?module=buku"/> &lt;&lt;Kembali </a></h3>
	</div>
</div>
<hr>

<div class="row">
	<div class="col-lg-6 col-xs-12">
		<div class="box box-primary">
			<div class="box-header">				
				<h1><small>Tambah Kategori</small></h1>
			</div>
			<div class="box-body">
				<form action="" method="post" name="fkategori" class="form-horizontal">
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Kategori</label>
						<div class="col-sm-9">
							<input type="text" name="kategori" autofocus class="form-control" placeholder="Masukan Nama kategori" required />
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label"></label>
						<div class="col-sm-7">
							<button type="submit" name="simpan" class="btn btn-primary btn-flat">Simpan Kategori</button>
							<input type="reset" name="reset" class="btn btn-danger btn-flat" value="Ulangi">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-xs-12">
	<?php  
		$aksi = isset($_GET['aksi'])?$_GET['aksi']:null;
		switch ($aksi) {
			case 'hapus':
				include "controller/act_hapus_kategori.php";
				break;
		}
	?>
		<div class="table-responsive">
			<table id="datatables" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th width="10">No</th>
						<th>Kategori / Rak</th>
						<th width="20">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php  
						$no = 1;
						$query_data = mysql_query("Select * from t_kategori order by kd_kategori");
						while ($data = mysql_fetch_array($query_data)) {
							?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo ucwords($data['kategori']) ?></td>
								<td><a onclick="return confirm('Hapus Kategori <?php echo ucwords($data[1]) ?> ?')" class="btn btn-danger btn-flat" href="?module=buku&ref=tambah_kategori&aksi=hapus&id=<?php echo $data[0]; ?>"><i class="fa fa-trash"></i> Hapus Kategori</a></td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>