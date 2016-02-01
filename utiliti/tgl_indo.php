<?php  
	error_reporting(E_ALL^E_NOTICE);

	function tgl_now(){

		$tanggal = date("j");

		$array_bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$bulan = $array_bulan[date("n")];

		$tahun = date("Y");

		echo $tanggal." ".$bulan." ".$tahun;
	}
?>