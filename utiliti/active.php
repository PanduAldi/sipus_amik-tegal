<?php  
	error_reporting(E_ALL^E_NOTICE);

	$active_menu = isset($_GET['page'])?$_GET['page']:null;
	switch ($active_menu) {
		case 'home':
			$home = 'active';
			break;

		case 'anggota':
			$anggota = 'active';
			break;

		case 'pengumuman':
			$pengumuman = 'active';
			break;

		case 'usulan':
			$usulan = 'active';
			break;
		
	}

?>