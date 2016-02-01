<?php  
error_reporting(E_ALL^E_NOTICE);
session_start();
include "../utiliti/koneksi.php";

	if (!$_SESSION['username'] || !$_SESSION['password'] || !$_SESSION['level']) {
		?>
			<script type="text/javascript">
				alert("Maaf !!! Anda Harus Login Dulu");
				location.href="login.php";
			</script>
		<?php
	} else{
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>
			<?php  
				if (empty($_GET['ref'])) {
					echo ucwords($_GET['module']);
				} 
				elseif(isset($_GET['module']) && isset($_GET['ref'])) {
					echo ucwords($_GET['module'])." | ".ucwords($_GET['ref']);
				} 
				else{
					echo "Panel Admin";
				}
			?>
		</title>
		<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
		<!-- Bootstrap CSS -->
		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">		<!-- font awesome -->
	    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<!-- ionicon -->
		<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" /> 		
 		<!-- datepicker -->
 		<link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css">
 		<!-- date range picker -->
 		<link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker-bs3.css">
	    <!-- iCheck for checkboxes and radio inputs -->
	    <link href="assets/plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
 		<!-- data tables -->
  		 <link href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

 		<!-- adminLTE --> 
		<link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
		<!-- warna latar -->
		<link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">



		    <!-- jQuery 2.1.4 -->
	    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	    <!-- jQuery UI 1.11.2 -->	
	    <script src="assets/plugins/jQueryUI/jquery-ui-1.10.3.min.js"></script>
	    <!-- Bootstrap 3.3.2 JS -->
	    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	
		<script type='text/javascript'>
		$(document).ready(function () {
		 $('body').hide().fadeIn(1000).delay(100)
		});
		</script>
	


	</head>
	<body class="skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<a href="home.php" class="logo">
					<span class="logo-mini"><b>SPS</b></span>
					<span class="logo-lg">Panel<b>SIPUS</b></span>
				</a>
				<nav class="navbar navbar-static-top">
					<!-- navbar tombol responsive -->
					<a href="#" class="sidebar-toggle" role="button" data-toggle="offcanvas">
						<span class="sr-only">Toggle Navi</span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<!-- user -->
						 	<li class="dropdown user user-menu">
				                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				                	<?php  
				                		if ($_SESSION['level'] == "admin") {
				                			echo '  <img src="assets/dist/img/avatar5.png" class="user-image" alt="User Image"/>';
				                		} else{
				                			echo '  <img src="assets/dist/img/avatar.png" class="user-image" alt="User Image"/>';
				                		}
				                	?>
				                  <span class="hidden-xs"><?php echo ucwords($_SESSION['username']) ?></span>
				                </a>
				                <ul class="dropdown-menu">
				                  <!-- User image -->
				                  <li class="user-header">
				                	<?php  
				                		if ($_SESSION['level'] == "admin") {
				                			echo '  <img src="assets/dist/img/avatar5.png" class="img-circle" alt="User Image"/>';
				                		} else{
				                			echo '  <img src="assets/dist/img/avatar.png" class="img-circle" alt="User Image"/>';
				                		}
				                	?> 
				                	 <p>
				                      <?php echo ucwords($_SESSION['username'])." - ".ucwords($_SESSION['level']) ?>
				                      <small>
				                      	IP Address : <?php echo $_SERVER['REMOTE_ADDR'] ?> 
				                      </small>
				                    </p>
				                  </li>
				                  <li class="user-body">
								  </li>
				                  <li class="user-footer">
				                    <div class="pull-left">
				                      <a href="#" class="btn btn-default btn-flat"><span class="glyphicon glyphicon-lock"></span> Ubah Password</a>
				                    </div>
				                    <div class="pull-right">
				                      <button type="button" data-target="#mod_logout" data-toggle="modal" class="btn btn-default btn-flat">Keluar</button>
				                    </div>
				                  </li>
				                </ul>	
			              </li>

			              <li>
			                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
			              </li>
						</ul>
					</div>
				</nav> <!-- end navbar -->
			</header> <!-- end header -->
			
			<?php  
				//menu list
				$masteradmin 	= array("buku", "anggota", "info", "petugas");
				$masterpetugas	= array("buku","anggota");
				$transaksi 		= array("peminjaman", "pengembalian");
				$laporan 		= array("laporan data_buku","laporan data_anggota","laporan data_peminjaman");
				$Statistik 		= array("statistik");
 
			?>
			<!-- sidebar nav -->
			<aside class="main-sidebar">
				<section class="sidebar">
					<ul class="sidebar-menu">
						<li class="header">MENU UTAMA</li>
						<li class="active treeview"> <a href="?module=dashboard"><i class="fa fa-dashboard"></i> <span>Dasboard</span></a></li>
						<li class="treeview"> 
							<a href="#">
								<i class="fa fa-book"></i><span>Master Data</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<?php  
									// memulai kondisi jika level berbeda
									if ($_SESSION['level'] == "admin") {
										for ($i=0; $i < count($masteradmin); $i++) { 
											echo '<li><a href="?module='.$masteradmin[$i].'"><i class="fa fa-circle-o"></i>'.ucwords($masteradmin[$i]).'</a> </li>';
										}
									} else {
										for ($i=0; $i < count($masterpetugas); $i++) { 
											echo '<li><a href="?module='.$masterpetugas[$i].'"><i class="fa fa-circle-o"></i>'.ucwords($masterpetugas[$i]).'</a> </li>';
										}
									}
								?>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar"></i> 
								<span>Transaksi</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<?php  
									for ($i=0; $i < count($transaksi); $i++) { 
										echo '<li>
												<a href="?module='.$transaksi[$i].'"><i class="fa fa-circle-o"></i>'.ucwords($transaksi[$i]).'</a>
											  </li>';
									}
								?>
							</ul>
						</li>
						<?php if ($_SESSION['level'] == "admin") { ?>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-file-text-o"></i> 
								<span>Laporan</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<?php  
									for ($i=0; $i < count($laporan); $i++) { 
										echo '<li>
												<a href="?module='.$laporan[$i].'"><i class="fa fa-circle-o"></i>'.ucwords($laporan[$i]).'</a>
											  </li>';
									}
								?>
							</ul>
						</li> <?php } ?>
						<li class="treeview">
							<?php  
								$date = date("Y-m-d");
								$usulan_query = mysql_query("SELECT * FROM t_usulan_buku WHERE baca ='N'") or die(mysql_error());
								$query_chat   = mysql_query("SELECT * FROM t_chat WHERE tgl LIKE '%$date%'");

								$cek_usulan = mysql_num_rows($usulan_query);
								$cek_chat   = mysql_num_rows($query_chat);

								$badges_pesan = $cek_usulan + $cek_chat;

								if ($badges_pesan == 0) {
									?>
									<a href="#">
										<i class="fa fa-envelope"></i> 
										<span>Pesan</span>
										<i class="fa fa-angle-left pull-right"></i>
									</a>
									<?php
								} else {
									?>
									<a href="#">
										<i class="fa fa-envelope"></i> 
										<span>Pesan</span> 
										<span class="label pull-right bg-yellow"><?php echo $badges_pesan ?></span>
									</a>
									<?php
								}
							?>
							<ul class="treeview-menu">
								<li>
									<?php  
										if ($cek_usulan > 0) {
											?>
											<a href="?module=usulan"> <i class="fa fa-circle-o"></i>
												<span>Usulan Buku</span>
												<span class="label pull-right bg-blue"><?php echo $cek_usulan ?></span>
											</a>
											<?php
										} else {
											?>
											<a href="?module=usulan"><i class="fa fa-circle-o"></i>
												<span>Usulan Buku</span>
											</a>
											<?php											
										}
									?>
								</li>
								<li>
									<?php  
										if ($cek_chat > 0) {
											?>
											<a href="?module=chat"> <i class="fa fa-circle-o"></i>
												<span>Komentar Pengunjung</span>
												<span class="label pull-right bg-blue"><?php echo $cek_chat ?></span>
											</a>
											<?php
										} else {
											?>
											<a href="?module=chat"><i class="fa fa-circle-o"></i>
												<span>Komentar Pengunjung</span>
											</a>
											<?php											
										}
									?>
								</li>
							</ul>
						</li>
						<?php  
							if ($_SESSION['level'] == "admin") {
								echo '<li class="treeview"> <a href="?module=statistik"><i class="fa fa-pie-chart"></i> <span>Statistik</span></a></li>';
							} 
						?>
					</ul>
				</section>	
			</aside>			
			<!-- end sidebar -->
			<div class="content-wrapper">
				<section class="content-header">
					<h1><?php echo ucwords($_GET['module']) ?> <small>Control Panel</small></h1> 
				</section>

				<section class="content">
					<?php  
						$module = $_GET['module'];
						switch ($module) {
							default:
								include "module/dashboard.php";
								break;

							case 'buku':
								include "module/buku.php";
								break;

							case 'anggota':
								include "module/anggota.php";
								break;

							case 'info':
								include "module/info.php";
								break;

							case 'petugas':
								include "module/petugas.php";
								break;

							case 'peminjaman':
								include "module/peminjaman.php";
								break;

							case 'pengembalian':
								include "module/pengembalian.php";
								break;

							case 'laporan data_buku':
								include "module/lap_buku.php";
								break;

							case 'laporan data_anggota':
								include "module/lap_anggota.php";
								break;

							case 'laporan data_peminjaman':
								include "module/lap_peminjaman.php";
								break;

							case 'statistik':
								include "module/statistik.php";
								break;

							case 'usulan':
								include "module/usulan.php";
								break;

							case 'chat':
								include "module/chat.php";
								break;

						}
					?>
				</section>
			</div>
			<!-- end content wraper -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Developed by:</b> Pandu Aldi P.
				</div>
				Copyright&copy;<?php echo date("Y") ?><b> IT TEAM AMIK YMI TEGAL</b>. All rights reserved.
			</footer>

		</div> <!--  end wrapper -->
						                    
		<!-- mod muncul -->
		<div id="mod_logout" class="modal fade" tabindex="-1" role="dialog" arialabelledby="modal-logout" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<b>KELUAR</b>
					</div>
					<div class="modal-body">
						<h5>Yakin Ingin Keluar</h5>
					</div>	
					<div class="modal-footer">
						<a href="logout.php" class="btn btn-primary btn-flat">YA</a>
						<button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">TIDAK</button>
					</div>									
				</div>
			</div>
		</div>

 
	    <!-- daterangepicker -->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
	    
	    <!-- jquery datatables -->
    	<script src="assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    	<script src="assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

	    <script src="assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
	    <!-- datepicker -->
	    <script src="assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
		  <!-- Slimscroll -->
	    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	    <!-- FastClick -->
	    <script src='assets/plugins/fastclick/fastclick.min.js'></script>
		<!-- file style -->
		<script type="text/javascript" src="assets/plugins/filestyle/bootstrap-filestyle.js"></script>
	    <!-- AdminLTE App -->
	    <script src="assets/dist/js/app.min.js" type="text/javascript"></script>    
	    <!-- iCheck 1.0.1 -->
	    <script src="assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
	    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	    <script src="assets/dist/js/pages/dashboard.js" type="text/javascript"></script>    
	    
	    <!-- AdminLTE for demo purposes -->
	    <script src="assets/dist/js/demo.js" type="text/javascript"></script>
	      		<!-- jquery validasi -->
		<script type="text/javascript" src="assets/plugins/validasi/jquery.validate.min.js"></script>
		<!-- CKEDITOR -->
		<script src="assets/plugins/ckeditor/ckeditor.js"></script>

		<script type="text/javascript">

			//vaslidasi buku
			$(document).ready(function() {
				$("#buku_val").validator();
			});

			//form filestyle
			$(document).ready(function() {
				$(":file").filestyle();
			});

		</script>

	</body>
	</html>
<?php		
	}
?>