<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	include "controller/act_tambah_penerbit.php";

?>

<div class="row">
	<div class="col-lg-6 col-xs-6">
		<h3><span class="glyphicon glyphicon-book"></span> PenerbitBuku</h3>  
	</div>
	<div class="col-lg-6 col-xs-6" valign="center"  align="right">
		<h3><a href="?module=buku"/> &lt;&lt;Kembali </a></h3>
	</div>
</div>
<hr>

<div class="row">
	<div class="col-lg-5 col-xs-12">
		<div class="box box-danger">
			<div class="box-header">				
				<h1><small>Tambah Penerbit</small></h1>
			</div>
			<div class="box-body">
				<form action="" method="post" name="fkategori" class="form-horizontal">
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Penerbit</label>
						<div class="col-sm-9">
							<input type="text" name="penerbit" autofocus class="form-control" placeholder="Masukan Nama penerbit" required />
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label"></label>
						<div class="col-sm-7">
							<button type="submit" name="simpan" class="btn btn-primary btn-flat">Simpan Penerbit</button>
							<input type="reset" name="reset" class="btn btn-danger btn-flat" value="Ulangi">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-lg-7 col-xs-12">
	<?php  
		$aksi = isset($_GET['aksi'])?$_GET['aksi']:null;
		switch ($aksi) {
			case 'hapus':
				include "controller/act_hapus_penerbit.php";
				break;
		}
	?>
		<div class="table-responsive">
			<table id="datatables" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th width="10">No</th>
						<th>Nama Penerbit</th>
						<th width="20">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php  
						$no = 1;
						$query_data = mysql_query("Select * from t_penerbit order by kd_penerbit");
						while ($data = mysql_fetch_array($query_data)) {
							?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo ucwords($data['penerbit']) ?></td>
								<td><a onclick="return confirm('Hapus Penerbit <?php echo ucwords($data[1]) ?> ?')" class="btn btn-danger btn-flat" href="?module=buku&ref=tambah_penerbit&aksi=hapus&id=<?php echo $data[0]; ?>"><i class="fa fa-trash"></i> Hapus Penerbit</a></td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>