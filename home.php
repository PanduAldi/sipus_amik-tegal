<?php  
	error_reporting(E_ALL^E_NOTICE);
	session_start();
	include "utiliti/koneksi.php";
	include "utiliti/tgl_db.php";
	include "utiliti/jam_db.php";

	if (isset($_POST['login'])) {
		
		$nim  = isset($_POST['nim'])?$_POST['nim']:null;
		$pass = md5($_POST['pass']);

		$query_login = mysql_query("SELECT * FROM t_anggota WHERE nim='$nim' AND pass = '$pass'");
		$query_cek   = mysql_num_rows($query_login);
		$fetch_login = mysql_fetch_array($query_login);

		if ($query_cek > 0) {
			if ($fetch_login['aktif'] == "N") {
				echo "Akun anda belum diaktivasi oleh kami. Jika aktivasi belum di lakukan selama 1 x 24 jam. Hubungi pustakawan atau komentar di kolom komentar.";
			} else {
				$_SESSION['nim'] = $nim;
				$_SESSION['pass'] = $pass;

				?>
					<script>
						alert("login Anggota berhasil !!!")
					</script>
				<?php
			}
		} else {
				?>
					<script>
						alert("Login Gagal, NIM atau Password Salah !!!")
					</script>
				<?php			
		}
	}

?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="keyword" content="sipus, perpustakaan kampus, perpustakaan amik tegal, perpustakaan amik ymi tegal, perpustkaan amik ymi tegal, opac amik tegal">
		<title><?php echo ucwords($_GET['page']) ?> | OPAC AMIK YMI Tegal</title>

		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<!-- Bootstrap CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/style.css">
		<!-- font awesome -->
	    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
 		<!-- data tables -->
  		 <link href="assets/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />


		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="assets/js/bootstrap.min.js"></script>
	
	<script>
		function pop_up(mypage,myname,w,h,scroll){

		  var winl = (screen.width-w)/2;

		  var wint = (screen.height-h)/2;

		  var settings  ='height='+h+',';

		      settings +='width='+w+',';

		      settings +='top='+wint+',';

		      settings +='left='+winl+',';

		      settings +='scrollbars='+scroll+',';

		      settings +='resizable=yes';

		  win=window.open(mypage,myname,settings);

		  if(parseInt(navigator.appVersion) >= 4){win.window.focus();}

		}	
		//contoh penggunaan pop_up('halaman','','ukuran width','height','yes') 
		
		function count(){
			var karater, maksimum;
			maksimum = 250;
			karakter = maksimum-(document.fchat.komentar.value.length);

			if (karakter < 0) {
				alert("Jumlah maksimum karakter:"+ maksimum +" ")
				document.fchat.komentar.value = document.fchat.komentar.substr(0, maksimum);
				karakter = maksimum-(document.fchat.komentar.value.length);
				document.fchat.counter.value = karakter;
			} else {
				document.fchat.counter.value = maksimum-(document.fchat.komentar.value.length);
			}
		}

			$(document).ready(function () {
			 $('body').hide().fadeIn(1000).delay(100)
			});

	</script>
	
	</head>
	<body>


	<div class="container">
			<div class="panel panel-info">
				<div class="panel-body">
					<div class="header">
						<div id="carousel-id" class="carousel slide" data-ride="carousel">
						    <ol class="carousel-indicators">
						        <li data-target="#carousel-id" data-slide-to="0" class=""></li>
						        <li data-target="#carousel-id" data-slide-to="1" class=""></li>
						        <li data-target="#carousel-id" data-slide-to="2" class="active"></li>
						    </ol>
						    <div class="carousel-inner">
						    	<?php  
						    		$gambar = array("header_opac.jpg","Pustaka.jpg","perpus.jpg");
						    		$active	= array("active","","");

						    		for ($i=0; $i < count($gambar); $i++) { 
						    			?>
								        <div class="item <?php echo $active[$i] ?>">
								            <img class="gambare" data-src="holder.js/900x500/auto/#777:#7a7a7a/text:First slide" alt="First slide" src="img/<?php echo $gambar[$i] ?>">
								        </div>
						    			<?php
						    		}
						    	?>
						    </div>
						    <a class="left carousel-control" href="#carousel-id" data-slide="prev"></a>
						    <a class="right carousel-control" href="#carousel-id" data-slide="next"></a>
						</div>

					</div> <br>
					<nav class="navbar navbar-default navbar-inverse" role="navigation">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex2-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
					
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse navbar-ex2-collapse">
							<?php include "utiliti/active.php" ?>
							<ul class="nav navbar-nav font">
								<li class="<?php echo $home ?>"><a href="?page=home"><i class="fa fa-home"></i> Home </a></li>
								<li class="<?php echo $anggota ?>"><a href="?page=anggota"><i class="fa fa-users"></i> Keanggotaan</a> </li>
								<li class="<?php echo $pengumuman ?>">
									<a href="?page=pengumuman">
										<?php 
											$date_now = date("Y-m-d");
											$pengumuman_badges = mysql_query("SELECT tgl_publish FROM t_info WHERE label='pengumuman' AND tgl_publish LIKE '%$date_now%' ");
											$fetch_badges = mysql_fetch_array($pengumuman_badges);
											
											
											$date_mentah = explode(" ", $fetch_badges['tgl_publish']);
											$tanggal_badges = $date_mentah[0];


											if ($date_now == $tanggal_badges) {
												$cek_badges = mysql_num_rows($pengumuman_badges);
												?>
												<i class="fa fa-bullhorn"></i> Pengumuman / Informasi <span class="label label-warning"><?php echo $cek_badges ?></span>
												<?php
											} else {
												?>
												<i class="fa fa-bullhorn"></i> Pengumuman / Informasi
												<?php
											}
										?>
										
									</a>
								</li>
								<li class="<?php echo $usulan ?>"><a href="?page=usulan"><i class="fa fa-envelope-o"></i> Usulan Pengadaan Buku</a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<form class="navbar-form navbar-left" role="search">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Search">
									</div>
									<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
								</form>
							</ul>
						</div><!-- /.navbar-collapse -->
					</nav>				

					<!-- konten web -->
					<div class="row">
							<div class="col-lg-9 col-xs-12">
					<?php  
						$page = isset($_GET['page'])?$_GET['page']:null;
						switch ($page) {
							default:
									?> 
	
											<div class="breadcrumb">
												<div class="row">
													<div class="col-sm-2 col-xs-2"><button class="btn btn-primary">Pengumuman</button></div>
													<div class="col-sm-10 col-sm-10">
														<p valign="center">
															<marquee scrollamount="7" onmouseover="this.stop()" onmouseout="this.start()" width="100%" direction="">
																Selamat Datang Di OPAC (Online Public Access Catalog) Perpustaakan AMIK YMI Tegal <i class="fa fa-angle-double-right"></i>
																<?php  
																	$query_pengu = mysql_query("SELECT id,judul FROM t_info WHERE label='pengumuman'");
																	while ($data_pengu = mysql_fetch_array($query_pengu)) {
																		?>
																			<a href="?page=pengumuman_detail&id=<?php echo $data_pengu['id'] ?>"><?php echo $data_pengu['judul'] ?></a> <i class="fa fa-angle-double-right"></i>
																		<?php
																	}
																?>
															</marquee>
														</p>
													</div>
												</div>
											</div>
											
											<?php  
												if (isset($_SESSION['nim'])) {
													?>
														<div class="panel panel-primary">
															<div class="panel-heading">
																<h4><i class="fa fa-clock-o"></i> Log Aktifitas Anda</h4>
															</div>
														</div>
														<div class="panel panel-primary">
															<div class="panel-body">
																<?php  
																	$booking_cek = mysql_query("SELECT * FROM t_booking JOIN t_anggota ON t_booking.id_anggota = t_anggota.id_anggota JOIN t_buku ON t_booking.kd_buku = t_buku.kd_buku WHERE t_anggota.nim = '".$_SESSION['nim']."'");
																	$fetch_booking_cek = mysql_fetch_array($booking_cek);

																	if (empty($fetch_booking_cek['id_anggota'])) {
																		echo "";
																	} else {
																		?>
																		<div class="alert alert-success">
																			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
																			<?php
																				$id_anggota_booking = $fetch_booking_cek['id_anggota'];
																				$tempo_id = $fetch_booking_cek['tempo'];
																				#tanggal tempo  
																				$tempo 	 = explode("-", $fetch_booking_cek['tempo']);
																				$tgl1 	 = $tempo[2];
																				$bulan1	 = $tempo[1];
																				$tahun1  = $tempo[0];

																				#tanggal skearang
																				$sekarang 	= explode("-", date("Y-m-d"));
																				$tgl2		= $sekarang[2];
																				$bulan2 	= $sekarang[1];
																				$tahun2 	= $sekarang[0];

																				#transfomasi JD
																				$jd1 = GregorianToJD($bulan1, $tgl1, $tahun1);
																				$jd2 = GregorianToJD($bulan2, $tgl2, $tahun2);

																				#menghitung selisih
																				$selisih  = $jd1 - $jd2;
																				echo '<p>Buku yang anda booking adalah '.$fetch_booking_cek['judul'].'</p>';
																				echo 'Sisa Tempo buku yang anda booking adalah '.$selisih.' Hari. Segera menghubungi petugas. Booking akan terhapus otomatis jika tempo telah selesai';
																				if ($selisih <= 0 ) {
																					?>
																						<script>
																							alert("Jatuh Tempo Booking telah selesai. Kami akan menghapus data buku yang anda booking");
																						</script>
																					<?php
																					mysql_query("DELETE FROM t_booking WHERE id_anggota='$id_anggota_booking' AND tempo = '$tempo_id'");
																					mysql_query("UPDATE t_buku SET status='tersedia' WHERE kd_buku = '".$fetch_booking_cek['kd_buku']."'");	

																					?>
																						<script>
																							location.href = "home.php";
																						</script>																					
																					<?php
																																									
																				}
																			?>
																		</div>																
																		<?php
																	}
																?>
															</div>
															<?php  
																$status_peminjaman = mysql_query("SELECT * FROM t_peminjaman JOIN t_anggota ON t_peminjaman.id_anggota = t_anggota.id_anggota 
																								  JOIN det_pinjam ON t_peminjaman.kd_pinjam = det_pinjam.kd_pinjam
																								  JOIN t_buku ON det_pinjam.kd_buku = t_buku.kd_buku
																								  WHERE t_anggota.nim = '".$_SESSION['nim']."' AND det_pinjam.status = 'belum dikembalikan'");

																$cek_status_pinjam = mysql_num_rows($status_peminjaman);

																if ($cek_status_pinjam > 0 ) {
																	?>
																	<div class="container-fluid">
																		<div class="alert alert-info">
																			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
																			<strong>Daftar Buku yang anda Pinjam : </strong>
																			<?php
																				while ($fetch_status = mysql_fetch_array($status_peminjaman)) {
																					echo '<p>Judul Buku : '.$fetch_status['judul'].'</p>
																						  <p>Harus Kembali Pada Tanggal : '.tgl_db($fetch_status['tgl_hrskembali']).'</p>
																						  <p>-----------------------------------------------------------------------</p>';
																				}
																			?>
																		</div>
																	</div>
																	<?php
																}
															?>
														</div>
													<?php
												}
											?>


												<div class="panel panel-primary">
													<div class="panel-body">
														<div class="panel-body">
															<div class="jumbotron">
															  <h2>Selamat Datang di OPAC AMIK YMI Tegal</h2>
															  <p>Online Public Access Catalog (OPAC) AMIK YMI Tegal merupakan sistem katalog terpasang yang
															  	 dapat diakses secara umum atau online dan dapat dipakai Pengguna untuk menelusuri Koleksi buku AMIK Tegal. </p>
															  <p><a class="btn btn-primary btn-lg" href="?page=about_opac" role="button">Lihat Selengkapnya</a></p>
															</div>
														</div>
													</div>
												</div>

													<div class="panel panel-primary">
														<div class="panel-heading"><h4><b><i class="fa fa-bookmark"></i> Koleksi Buku Terbaru</b></h4></div>
													</div>
													<div class="panel panel-primary">
														<div class="panel-body">
															<marquee scrollamount="6">
															<div class="row">
															<?php 
															 	#query tampil
																$query_tampil = mysql_query("SELECT * FROM t_buku WHERE most_new='Y'");
																while ($data=mysql_fetch_array($query_tampil)) {
																
																		?>
																		<div class="col-sm-3 col-xs-6">
																			<div class="panel panel-default">
																				<div class="panel-body">
																					<?php  
																						if (empty($data['cover'])) {
																							echo '<center><img src="sipusadmin/image/buku/Logo.png" class="img-thumbnail" width="105" height="100"  alt=""></center> <br>';
																						} else {
																							echo '<center><img src="sipusadmin/image/buku/'.$data['cover'].'" class="img-thumbnail" width="105" height="100"  alt=""></center> <br>';
																						}
																					?>
																					<p align="center"><a title="Klik Untuk Melihat Detail" onclick="pop_up('page/det_buku.php?id=<?php echo $data[0] ?>','','800','450','yes')"><?php echo $data['judul'] ?></a></p>
																				</div>
																			</div>
																		</div>
																		<?php
																	
																}
															?>
															</div>
															</marquee>	
														</div>
													</div> <!-- end koleksi buku baru -->
													
													<!-- katalog buku -->
													<div class="panel panel-primary">
														<div class="panel-heading"><h4><i class="fa fa-book"></i> <b>Katalog Buku</b></h4></div>
													</div>
													
													<div class="panel panel-primary">
														<div class="panel-body">
															<table class="table table-bordered table-striped" id="tabel_data">
																<thead>
																	<tr><th>Cover</th><th>Deskripsi</th></tr>
																</thead>
																<tbody>
																	<?php  
																		$query_buku = mysql_query("SELECT * FROM t_buku JOIN t_penerbit ON t_buku.kd_penerbit=t_penerbit.kd_penerbit JOIN t_pengarang ON t_buku.kd_pengarang=t_pengarang.kd_pengarang ORDER BY t_buku.kd_buku") or die(mysql_error());
																		while ($data_buku = mysql_fetch_array($query_buku)) {
																			?>
																			<tr>
																				<td>
																					<?php  
																						if (empty($data_buku['cover'])) {
																						   echo '<img src="sipusadmin/image/buku/Logo.png" class="img-thumbnail" width="150" height="130"  alt="">';
																						} else {
																							echo '<img src="sipusadmin/image/buku/'.$data_buku['cover'].'" class="img-thumbnail" width="150" height="130"  alt="">';
																						}
																					?>
																				</td>
																				<td>
																					Kode Buku : <?php echo $data_buku['kd_buku'] ?> <br>
																					Judul Buku : <?php echo $data_buku['judul'] ?> <br>
																					Pengarang  : <?php echo $data_buku['penerbit'] ?><br>
																					Penerbit   : <?php echo $data_buku['pengarang'] ?><br>
																					<br>
																					<a title="Klik Untuk Melihat Detail" onclick="pop_up('page/det_buku.php?id=<?php echo $data_buku[0] ?>','','800','450','yes')">Detail Selengkapnya</a> 
																					<?php  
																						if (!$_SESSION['nim']) {
																							echo "";
																						} else {
																							if ($data_buku['status'] == "sudah dibooking" || $data_buku['status'] == "sedang dipinjam") {
																								echo ' | Sudah dibooking';
																							} else {
																								?>
																								| <a title="Klik Untuk Melihat Detail" onclick="pop_up('page/proses_booking.php?id=<?php echo $data_buku[0] ?>','','800','450','yes')">Booking buku</a>
																								<?php
																							}																						
																						}
																					?>
																				</td>
																			</tr>
																			<?php
																		}
																	?>														
																</tbody>
															</table>

														</div>
													</div>

						<?php
						break;

						case 'anggota':
							include  "page/anggota.php";
							break;

						case 'pengumuman':
							include "page/pengumuman.php";
							break;

						case 'usulan':
							include "page/usulan.php";
							break;

						case 'buku':
							include "page/buku_spesifik.php";
							break;
						
						case 'about_opac':
							if (isset($_GET['about_opac'])) {
								include "page/about_opac.php";
							} else {
								echo "<h2 align='center'>Halaman Masih Dalam Perbaikan</h2>";
							}							
							break;

						case 'ganti_pass':
							include "controller/ganti_pass.php";
							break;

						case 'pengumuman_detail':
							include "page/pengumuman_detail.php";
							break;

						}
					?>
										</div>
										<!-- end content -->


										<!-- sidebar -->
										<!-- Login Anggota -->
										<div class="col-lg-3 col-xs-12">
											<div class="panel panel-primary">
												<?php  
													if (!$_SESSION['nim']) {
														?>
														<div class="panel-heading">
															<i class="fa fa-sign-in"></i> Login Anggota Perpustakaan
														</div>
														<div class="panel-body">
															<form action="" method="POST" />
																<input type="text" class="form-control" name="nim" placeholder="Masukan NIM" /><br>
																<input type="password" name="pass" class="form-control" placeholder="Password" /> <br>
																<button type="submit" name="login" class="btn btn-success"><i class="fa fa-sign-in"></i> Login</button>
																<input type="reset" value="Reset" class="btn btn-default"> 
															</form> <br>
															<a href="#"><i class="fa fa-key"></i> Lupa Password</a> <br>
															<a href="?page=anggota"><i class="fa fa-pencil-square-o"></i> Register Anggota</a>
														</div>
														<?php
													} else {
														?>
														<div class="panel-heading">
															<i class="fa fa-user"> Profil Anggota</i> 
														</div>
														<div class="panel-body">
														<?php  
															$query_anggota_log = mysql_query("SELECT * FROM t_anggota WHERE nim = '".$_SESSION['nim']."'");
															$data_log 		   = mysql_fetch_array($query_anggota_log);
															include "utiliti/platform_detect.php";
															$detect = getBrowser();
														?>
															<p><b>Id Angg. :</b> <?php echo $data_log['id_anggota'] ?></p>
															<p><b>Nama </b> : <?php echo ucwords($data_log['nama']) ?></p>
															<p><b>IP Anda : </b> <?php echo $_SERVER['REMOTE_ADDR'] ?></p>
															<p><b>Browser : </b> <?php echo $detect['name']." ".$detect['version'] ?></p>
															<p><b>OS : </b> <?php echo $detect['platform'] ?></p>
															<p>
																<a href="logout.php" onclick="return confirm('Yakin untu Logout')" class="btn btn-danger btn-block"><i class="fa fa-sign-out"></i> Log Out</a>
																<a class="btn btn-default btn-block" href="?page=ganti_pass&id=<?php echo $_SESSION['nim'] ?>"></i> Ganti Password</a>
															</p>
														</div>
														<?php
													}
												?>
											</div>

											<!-- Pnecarian Spesifik -->
											<div class="panel panel-primary">
												<div class="panel-heading">
													<i class="fa fa-search"></i> Pencarian Spesifik
												</div>
												<div class="panel-body">
													<form action="home.php?page=buku" method="POST">
														<input type="text" class="form-control" placeholder="Judul" name="judul" /><br>
														<select name="kd_penerbit" id="" class="form-control">
															<option value="">-- Penerbit --</option>
															<?php  
																$query_penerbit = mysql_query("SELECT * FROM t_penerbit order by penerbit");
																while ($data_penerbit = mysql_fetch_array($query_penerbit)) {
																	echo '<option value="'.$data_penerbit[0].'">'.$data_penerbit[1].'</option>';
																}
																
															?>
														</select> <br>
														<select name="kd_pengarang" id="" class="form-control">
															<option value="">-- Pengarang / penulis --</option>
															<?php  
																$query_pengarang = mysql_query("SELECT * FROM t_pengarang order by pengarang");
																while ($data_pengarang = mysql_fetch_array($query_pengarang)) {
																	echo '<option value="'.$data_pengarang[0].'">'.$data_pengarang[1].'</option>';
																}
																
															?>
														</select> <br>
														<input type="text" name="isbn" class="form-control" placeholder="ISBN" /><br>
														<select name="kd_kategori" id="" class="form-control">
															<option value="">-- Kategori --</option>
															<?php  
																$query_kat = mysql_query("SELECT * FROM t_kategori order by kategori");
																while ($data_kat = mysql_fetch_array($query_kat)) {
																	echo '<option value="'.$data_kat[0].'">'.$data_kat[1].'</option>';
																}
																
															?>
														</select> <br>	
														<button type="submit" class="btn btn-primary" name="cari"><i class="fa fa-search"></i> Pencarian</button>													
														<button type="reset" class="btn btn-default"><i class="fa fa-rotate-left"></i> Ulangi</button>
													</form>

												
												</div>
											</div> <!-- END panel primary -->
												
											<!-- Komentar Anda -->
											<div class="panel panel-primary">
												<div class="panel-heading"><i class="fa fa-wechat"></i> Komentar Anda</div>
												<div class="panel-body">
													<div class="container-fluid">
															<marquee direction="up" scrollamount="4">
																<?php  
																	$query_chat = mysql_query("SELECT * FROM t_chat order by id");
																	while ($data_chat = mysql_fetch_array($query_chat)) {
																?>														
																<div class="panel panel-success">
																	<div class="panel-body">
																		<?php  

																				echo '<p style="font-size:14px;"><strong><i class="fa fa-male"></i> '.ucwords($data_chat['nama']).'</strong></p>
																					  <p style="font-size:10px;"><i class="fa fa-calendar"></i>  '.tgl_db($data_chat['tgl']).' '.jam_db($data_chat['tgl']).'</p>
																					  <p style="font-size:12px;"><i class="fa fa-comment"></i> '.$data_chat['chat'].'</p>';
																		?>
																	</div>
																</div>													
																<?php } ?>
															</marquee>
														</div>

												</div>
												<div class="panel-footer">
													<?php include "controller/chat.php" ?>
													<form action="" name="fchat" method="post">
														<?php 
															$tempel_nama = mysql_query("SELECT nama FROM t_anggota WHERE nim = '".$_SESSION['nim']."'");
															$fetch_nama = mysql_fetch_array($tempel_nama);
															if (isset($_SESSION['nim'])) {
																echo '<input type="text" class="form-control" name="nama" size="20" placeholder="Nama" required value="'.$fetch_nama['nama'].'"><br>';
															} else {
																?><input type="text" class="form-control" name="nama" size="20" placeholder="Nama" required value="<?php echo $_POST['nama'] ?>"><br><?php
															}
														 ?>
														
														<textarea name="komentar" required class="form-control" placeholder="Komentar Anda" onclick="count()" onkeydown="count()" onchange="count()" onkeyup="count()" cols="20" rows="2"></textarea>	
														<input type="text" size="5" readonly="" align="right" name="counter" maxlength="5" value="250"> <br><br>
														<button type="submit" name="simpan_chat" class="btn btn-primary"><i class="fa fa-comment"></i> Komentar</button>
														<button type="reset" class="btn btn-danger"><i class="fa fa-rotate-left"></i> Ulangi</button>
													</form>
												</div>
											</div>

											<!-- LINK Terkait -->
											<div class="panel panel-primary">
												<div class="panel-heading">
													<i class="fa fa-external-link"></i> Link Terkait
												</div>
												<div class="panel-body">
													<?php  
														$query_link = mysql_query("SELECT * FROM t_info WHERE label='link' AND judul LIKE '%web%'");
														while ($data_link = mysql_fetch_array($query_link)) {
															?>
															<center>
																<a href="<?php echo $data_link['deskripsi'] ?>" target="_blank"><img width="200" height="65" src="sipusadmin/image/info/<?php echo $data_link['cover'] ?>" alt=""></a>
															</center><br>
															<?php
														}
													?>
												</div>
											</div>
											
											<!-- SITU ONE -->
											<div class="panel panel-primary">
												<div class="panel-heading">
													<i class="fa fa-sitemap"></i> SITU One
												</div>
												<div class="panel-body">
													<?php  
														$query_link = mysql_query("SELECT * FROM t_info WHERE label='link' AND judul LIKE '%situ%'");
														while ($data_link = mysql_fetch_array($query_link)) {
															?>
															<center>
																<a href="<?php echo $data_link['deskripsi'] ?>" target="_blank"><img width="200" height="65" src="sipusadmin/image/info/<?php echo $data_link['cover'] ?>" alt=""></a>
															</center><br>
															<?php
														}
													?>
												</div>
											</div>
											<!-- Kontak Kami -->
											<h4>Kontak Kami : </h4>
												<div class="panel panel-primary">
													<div class="panel-body">
														<img src="img/campus_icon.png" alt="">
														<address>
														  <strong>AMIK YMI Tegal.</strong><br>
														   	JL. Raya Dampyak KM 4 Tegal, Jawa Tengah<br>
														   Kode-Pos : 52181<br>
														  <abbr title="Phone">Telp:</abbr> (0283) 614-7140
														</address>

														<address>
														  <strong>Email Kami :</strong><br>
														  <a href="mailto:amiktegal.ymi@gmail.com">amiktegal.ymi@gmail.com</a>
														</address>					 					
													</div>
												</div>
										</div> <!-- end col-sm-4 -->
									</div>	
									<hr>
									<footer class="footer">
										<p class="text-right">Copyright &copy; 2014 - <?php echo date("Y") ?>. <b>AMIK YMI Tegal</b>. All Rights Reserved. Created by : <b>IT Team AMIK YMI Library</b></p>
									</footer>
								</div> <!-- panel utama -->
							</div>
						</div>								



	    <!-- jquery datatables -->
    	<script src="assets/datatables/jquery.dataTables.js" type="text/javascript"></script>
    	<script src="assets/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

    	<script>
	    	$(document).ready(function() {
	    		$("#tabel_data").dataTable({
	    			"info"	   : false

	    		});
	    	});



    	</script>
	</body>
</html>