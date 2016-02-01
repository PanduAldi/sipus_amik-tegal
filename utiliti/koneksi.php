<?php  

	$host = "localhost";
	#$user = "amiktega_rahasia";
	#$pass = "bismillah221994";
	#$db   = "amiktega_sipus";

	$user = "root";
	$pass = "";
	$db   = "sipus";

		mysql_connect($host, $user, $pass);
		mysql_select_db($db) or die(mysql_error());
		
?>