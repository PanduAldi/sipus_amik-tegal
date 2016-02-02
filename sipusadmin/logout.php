<?php 
	session_start();

	unset($_SESSION['username']);
	unset($_SESSION['password']);
	unset($_SESSION['level']);
	header("location:index.php");

?>