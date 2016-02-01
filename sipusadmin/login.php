<?php
	session_start();
	error_reporting(E_ALL^E_NOTICE);
	  
	  include "../utiliti/koneksi.php";

	if (isset($_POST['submit'])) {
		
		$user = isset($_POST['user'])?$_POST['user']:null;
		$pass = md5($_POST['pass']);

			$query = mysql_query("Select * from user where username='$user' and pass = '$pass'") or die(mysql_error());
			$cek   = mysql_num_rows($query);
			$data  = mysql_fetch_array($query);

			if ($cek > 0 ) {
				
				$_SESSION['username'] = $user;
				$_SESSION['password'] = $pass;
				$_SESSION['level']	  = $data['level'];

				if ($data['level'] == "admin") {
					echo "<script> 
							alert('Login Berhasil !! Anda Masuk Sebagai ".$_SESSION['level']."');
							location.href='home.php'; 
						  </script>";
				}
				elseif ($data['level'] == "petugas") {
					echo "<script> 
							alert('Login Berhasil !! Anda Masuk Sebagai ".$_SESSION['level']."');
							location.href='home.php'; 
						  </script>";					
				}
				else {
					$pesan = "<div class='alert alert-danger' role='alert'> Maaf!! User $ </div>";
				}	

			} else { 
				$pesan = "<div class='alert alert-danger' role='alert'> <i class='fa fa-ban'></i> Maaf!! Username atau Password salah </div> ";
			}
	}

?>

<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>Login Panel</title>

		<!-- Bootstrap CSS -->
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
		<!-- font awesome -->
	    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
 		<!-- adminLTE --> 
		<link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">

	</head>
	<body class="login-page">
		<div class="login-box">			
			<div class="login-box-body">
				<div class="login-logo">
					<img src="amik_logo.png" style="width:50%" alt="">
					PanelAdmin <b>SIPUS</b>
					<br>AMIK YMI TEGAL
				</div>
				<!-- form login -->
				<form action="" method="post" role="form">
				<?php echo $pesan; ?>
					<div class="form-group has-feedback">
						<input type="text" name="user" autofocus placeholder="Username" class="form-control" required>
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" name="pass" placeholder="Password" class="form-control" required>
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div align="right">
						<button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Login</button>
						<a href="#" class="btn btn-danger btn-block btn-flat">Batal</a>
					</div><br>
					<a href="#">Lupa password</a>
				</form>	
				<!-- end form -->
			</div>
			<!-- end box body -->
			<footer style="color:white">Copyright&copy<?php echo date("Y") ?> <b>IT TEAM AMIK YMI TEGAL</b>
			</footer>
		</div> <!--  end login box -->

		
		<!-- jQuery -->
		<script src="../assets/jquery-1.11.3.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="../assets/js/bootstrap.min.js"></script>
	</body>
</html>
