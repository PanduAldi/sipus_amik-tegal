<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "../../koneksi.php";

	if(isset($_POST['id'])){

		$id = isset($_POST['id'])?$_POST['id']:null;
		$sql = "DELETE FROM t_trans_buku_temp WHERE id='$id'";
		mysql_query( $sql);
		if( mysql_affected_rows())
		{
			echo json_encode(array('result'=>'success'));
		}
		else
		{
			echo json_encode(array('result'=>'fail'));
		}
	}


?>