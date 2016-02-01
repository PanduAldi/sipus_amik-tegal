<?php  

session_start();

if ($_SESSION['username'] and $_SESSION['level']) {
	header("location:home.php");
} else{
	header("location:login.php");
}
?>