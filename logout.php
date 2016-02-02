<?php 
	session_start();

	unset($_SESSION['nim']);
	unset($_SESSION['pass']);
	?> <script> 
		alert("Logout berhasil");
		location.href = "home.php"; 
	</script>	<?php

?>