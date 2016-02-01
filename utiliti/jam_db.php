<?php  
	
	// fungsi manipulasi jam 
	function jam_db($jam){

		$time 	= substr($jam, 11,2);
		$menit	= substr($jam, 14,2);
		$detik 	= substr($jam, 17,2);

		return $time.":".$menit.":".$detik; 
	}
?>