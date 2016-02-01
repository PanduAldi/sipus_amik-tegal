<?php  
 	error_reporting(E_ALL^E_NOTICE);
 	include "../utiliti/koneksi.php";
 	include "../utiliti/excel_reader.php";



	if (isset($_POST['simpan'])) {
		
		$target = basename($_FILES['import']['name']);
		move_uploaded_file($_FILES['import']['tmp_name'], $target);

		#menginisialisasikan object
		$data = new Spreadsheet_Excel_Reader($_FILES['import']['name'], false);

		#menghitung jumlah baris data di excel
		$count = $data->rowcount($sheet_index=0);


		#valid jika checkbox di centang
		if ($_POST['drop'] == 1) {
			#query hapus semua
			mysql_query("truncate table t_buku");
		}

		#import data excel dari mulai baris kedua
		for ($i=2; $i < $count ; $i++) { 
			#membaca dan deklarasi variable data
			$kd_buku 		= $data->val($i, 1);
			$judul 			= $data->val($i, 2);
			$penerbit 		= $data->val($i, 3);
			$pengarang 		= $data->val($i, 4);
			$kategori 		= $data->val($i, 5);
			$tahun 			= $data->val($i, 6);
			$tgl_perolehan 	= $data->val($i, 7);
			$jum_buku 		= $data->val($i, 8);
			$ket 			= $data->val($i, 9);
			$isbn 			= $data->val($i, 10);
			$ddc 			= $data->val($i, 11);
			$rak 			= $data->val($i, 12);
			$jum_hal 		= $data->val($i, 13);
			$status 		= $data->val($i, 14);
			$new 			= $data->val($i, 15);
			#query tambah
			$query = mysql_query("insert into t_buku(kd_buku,judul,kd_penerbit,kd_pengarang,kd_kategori,tahun,
								  tgl_perolehan,jumlah_buku,ket,isbn,ddc,rak,jum_hal,status,most_new) 
								  values('$kd_buku','$judul','$penerbit','$pengarang','$kategori','$tahun','$tgl_perolehan',
								  		 '$jum_buku','$ket','$isbn','$ddc','$rak','$jum_hal','$status','$new')") or die(mysql_error());

		}

		if ($query) {
			?>
			<script>
				alert("Data Berhasil di Import");
				location.href="?module=buku"
			</script>
			<?php
		} 

		unlink($_FILES['import']['name']);
	}

?>
<script>
	function validasifile(){
		function hasExtension(inputID, exts) {
			var filename = document.getElementById(inputID).value;
			return (new RegExp('('+exts.join('|').replace(/\./g, '\\.')+')$')).test(filename);
		}

		if (!hasExtension('import', ['.xls'])) {
			alert("Type file yang di gunakan .xls (Excel 2003)");
			return false;	
		}
	}
</script>

<div class="row">
	<div class="col-lg-6 col-xs-12">
		<div class="callout callout-success">
			<h4>Import Dari Excel</h4>
			<form action="" method="post" onsubmit="return validasifile()" enctype="multipart/form-data">
				<input type="file" name="import" id="import" class="filestyle">
				<label><input type="checkbox" class="minimal" name="drop" value="1" /> <u>Centang jika ingin mengosongkan keseluruhan data buku dari database.</u> </label>	
		</div>	

		<button type="submit" name="simpan" class="btn btn-primary btn-flat" ><i class="fa fa-save"></i> Simpan</button>
		<a href="?module=buku&ref=tambah_buku" class="btn btn-default btn-flat">Batal / Kembali ke Tambah Buku</a>
		</form>	
	</div>	

	<div class="col-lg-6 col-xs-12">
		<h4>Petunjuk Penggunaan</h4><hr>
		<ol>
			<li>File harus berupa excel dengan format .xls atau excel 2003.</li>
			<li>Untuk penyesuaian nama kolom bisa dilihat dari contoh di bawah.</li>
			<li>Nama kolom harus di mulai dari cell A1, A2, dst.</li>
		</ol>
	</div>
</div>
<br>
<br>
<h5><b> * Contoh nama kolom yang harus di gunakan</b></h5>
<div class="table-responsive">
	<table class="table-bordered">
		<thead>
			<tr>
				<?php 
					$nama_kolom  = array("Kode Buku","judul","kd penerbit","kd pengarang","kd kategori","tahun terbit","tgl perolehan","jumlah buku", "ket","isbn","ddc","rak","jumlah halaman","status","most_new");
					for ($i=0; $i < count($nama_kolom) ; $i++) { 
						echo '<th width="100" align="center">'.$nama_kolom[$i].'</th>';
					}
				?>
			</tr>
		</thead>
		<tbody>
			<tr>
			<?php  
				$record = 1;
				while ($record <= 15) {
					echo '<td>contoh</td>';
					$record++;
				}
			?>
			</tr>
		</tbody>	
	</table>
</div>	
<br>


<ul>
	<li>Penerbit, Pengarang/Penulis, Kategori harus menggunakan kode yang sudah di inputkan pada database. Silahkan lihat terlebih dahulu kode dari masing-masing penerbit, pengarang, kategori</li>
	<li>Jangan menginput abstraksi,photo. Abstraksi dan foto di input manual ketika data sudah masuk ke database. </li>
	<li>Tanggal Perolehan harus dengan format YYYY-MM-DD (Contoh: 2015-06-29)</li>
	<li>Most new di isi dengan karakter Y (jika buku baru) atau N (bukan buku baru tetapi belum di input)</li>

</ul>