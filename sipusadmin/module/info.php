<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../utiliti/koneksi.php";

	//box info 


?>

<script type="text/javascript">
	$(document).ready(function() {
			$("#tabel").dataTable();
		});	

</script>

	<div class="box box-warning">
		<div class="box-body">
			<?php  
				$page = isset($_GET['page'])?$_GET['page']:null;
				switch ($page) {
					default:
						?>
						<div class="col-lg-12">
						<div class="callout callout-info">
							<h1>INFO TAB</h1>
							<p>Pengelolaan Berbagai Macam Informasi Perfpustakaan AMIK YMI TEGAL</p>
						</div>
						<div class="container-fluid">
							<h2>Silahkan pilih info yang akan di kelola :</h2>
							<h4>
							<ul>
								<li><a href="?module=info&page=profil">Profil</a></li>
								<li><a href="?module=info&page=pengumuman">Pengumuman</a></li>
								<li><a href="?module=info&page=artikel">Artikel / Berita</a></li>
								<li><a href="?module=info&page=link">LINK</a></li>
								<li><a href="?module=info&page=lain">Lain - Lain</a></li>
							</ul>
							</h4>
						</div>
						</div>
						<?php
						break;

						case 'profil':
							include "module/page/profil.php";
							break;

						case 'pengumuman':
							include "module/page/pengumuman.php";
							break;

						case 'artikel':
							include "module/page/artikel.php";
							break;

						case 'link':
							include "module/page/link.php";
							break;

						case 'lain':
							include "module/page/lain.php";
							break;
				}
			?>
		</div>
	</div>