<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	$id = isset($_GET['id'])?$_GET['id']:null;
	$query_det 	= mysql_query("select * from t_buku where kd_buku='$id'");
	$data_det	= mysql_fetch_array($query_det);

	include "controller/act_edit_buku.php";

?>

<script>

	function pop_up(){

		var targetitem 	= document.fbuku.pengarang;
		var width 	= 500;
		var height 	= 300;
		var left 	= (screen.width - width) /2;
		var top 	= (screen.height - height) /2;
		var param 	= 'width='+width+', height'+height+', scrollbar=yes';
		param +=', top'+top+', left='+left;

		var dataitem = window.open('module/pop_up_pengarang.php',"dataitem", param);
		dataitem.targetitem = targetitem;
	}

	$(document).ready(function() {
		$(".tanggal").datepicker();
	});

	$(document).ready(function() {
		CKEDITOR.replace('editor');
	});
</script>


<div class="row">
	<div class="col-lg-6 col-xs-6">
		<h3><span class="glyphicon glyphicon-book"></span> Edit Buku</h3>  
	</div>
	<div class="col-lg-6 col-xs-6" valign="center"  align="right">
		<h3><a href="?module=buku"/> &lt;&lt;Kembali </a></h3>
	</div>
</div>
<hr>
<div class="row">
	<form action="" class="form-horizontal" name="fbuku" method="post" role="form" id="buku_val" enctype="multipart/form-data">
		<div class="col-md-6 col-xs-12	">
			<div class="form-group">
				<label for="kodebuku" class="col-sm-3 control-label">Kode Buku</label>
					<div class="col-sm-6">
						<input type="text" autofocus  class="form-control text-uppercase" name="kd_buku" id="" value="<?php echo $data_det['kd_buku'] ?>"  placeholder="Kode Buku" required />
					</div>
			</div>
		
			<div class="form-group"> 
				<label for="" class="col-sm-3 control-label">Judul</label>
				<div class="col-sm-9">
					<input type="text" required class="form-control" name="judul" value="<?php echo $data_det['judul'] ?>"  placeholder= "judul" />
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Penerbit</label>
				<div class="col-sm-5">
					<select id="input" class="form-control" name="penerbit" required>
						<option value=""> -- Pilih Penerbit --</option>
						<?php  
							$query_penerbit = mysql_query("Select * from t_penerbit order by penerbit asc");
							while ($data = mysql_fetch_array($query_penerbit)) {
								$select = ($data_det['kd_penerbit'] == $data[0])?"selected":"";
								echo '<option value="'.$data[0].'" '.$select.'>'.$data[1].'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Kode Pengarang</label>
				<div class="col-sm-3">
				<?php 
					$id 		= $data_det['kd_pengarang']; 
					$query_peng = mysql_query("Select * from t_pengarang where kd_pengarang='$id'");
					$data 		= mysql_fetch_array($query_peng);
				?>
					<input type="text" readonly="readonly" required class="form-control" value="<?php echo $data_det['kd_pengarang'] ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $data[1] ?>" name="pengarang" />
				</div>
				<div class="4">
					<input type="button" onclick="pop_up()" class="btn btn-default btn-flat" value="Cari Pengarang">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Tahun Terbit</label>
				<div class="col-sm-2 col-xs-2">
					<input type="text" required class="form-control" name="tahun" value="<?php echo $data_det['tahun'] ?>"  placeholder="" maxlength="4" />
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Kategori</label>
				<div class="col-sm-5">
					<select id="input" class="form-control" name="kategori" required="required">
						<option value=""> -- Pilih Kategori / Rak --</option>
						<?php  
							$query_kategori = mysql_query("Select * from t_kategori order by kategori asc");
							while ($data = mysql_fetch_array($query_kategori)) {
								$select  = ($data[0] == $data_det['kd_kategori'])?"selected":null;
								echo '<option value="'.$data[0].'" '.$select.'>'.$data[1].'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Tgl. Perolehan</label>
				<div class="col-sm-5">
				<?php  
					$pecah = explode("-", $data_det['tgl_perolehan']);
					$tgl_perolehan = $pecah[2]."/".$pecah[1]."/".$pecah[0];
				?>
					<input type="text" required class="form-control tanggal" name="tgl_perolehan" value="<?php echo $tgl_perolehan ?>"  placeholder="Tanggal Perolehan" />
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Jumlah Buku</label>
				<div class="col-sm-2">
					<input type="text" maxlength="4" required class="form-control" value="<?php echo $data_det['jumlah_buku'] ?>"  name="jum_buku" placeholder="0" />
				</div>
			</div>
		</div>

		<div class="col-lg-6 col-xs-12">
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">DDC</label>
				<div class="col-sm-2">
					<input type="text" maxlength="4" required class="form-control" value="<?php echo $data_det['ddc'] ?>"  name="ddc" placeholder="0" />
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">RAK</label>
				<div class="col-sm-2">
					<input type="text" maxlength="4" required class="form-control" value="<?php echo $data_det['rak'] ?>"  name="rak" placeholder="0" />
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">ISBN</label>
				<div class="col-sm-5">
					<input type="text" maxlength="13" required class="form-control" name="isbn" value="<?php echo $data_det['isbn'] ?>"  placeholder="isbn" />
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Keterangan</label>
				<div class="col-sm-5">
					<textarea name="ket" id="" cols="30" rows="3"><?php echo $data_det['ket'] ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Cover</label>
				<div class="col-sm-7">
					<?php  
						if ($data_det['cover'] == "") {
							?>
							<img src="image/buku/Logo.png" alt="gambar" class="img img-thumbnail" width="200" height="250">
							<?php
						} else {
							?>
							<img src="image/buku/<?php echo $data_det['cover'] ?>" alt="gambar" class="img img-thumbnail" width="200" height="250">
							<?php
						}
					?>
				</div>	
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"></label>
				<div class="col-sm-7">
					<input type="file" name="cover" accept="image/*" class="filestyle"/>
					* Pilih jika ingin mengganti cover
				</div>
			</div>	
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Jumlah Hal</label>
				<div class="col-sm-2">
					<input type="text" maxlength="4" required class="form-control" value="<?php echo $data_det['jum_hal'] ?>"  name="jumlah" placeholder="0" />
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Baru/Tidak :</label>
				<div class="col-sm-3">
					<select name="new" class="form-control">
						<option value="">pilih</option>
						<?php  
							$option = array("Y","N");
							for ($i=0; $i < count($option) ; $i++) { 
								$select = ($data_det['most_new'] == $option[$i])?"selected":null;
								echo '<option value="'.$option[$i].'" '.$select.'>'.$option[$i].'</option>';
							}
						?>
					</select>
				</div>
			</div>	
			<div class="form-group">
				<label for="" class="col-sm-3"></label>
				<div class="col-sm-9">
					<button type="submit" name="simpan" class="btn btn-primary btn-flat">Simpan Buku</button>
					<a href="?module=buku" class="btn btn-danger btn-flat">Batal</a>					
				</div>
			</div>

		</div>
</div> <!-- end row -->
<label for="" class="control-label">Abstraksi : </label> * Abstraksi di isi jika data input berupa Jurnal / Laporan PKL / Tugas Akhir (TA)
<textarea name="abstraksi" id="editor" cols="30" rows="40"><?php echo $data_det['abstraksi'] ?></textarea>
</form>
