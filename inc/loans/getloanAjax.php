<?php
require_once '../config.php';

header('Content-type: application/json; charset=utf-8');




if($_REQUEST['id']) {
	$sql = "SELECT id, name, interest, duration, amount, late_interest FROM loans_packages WHERE id='".$_REQUEST['id']."'";
	$resultset = mysqli_query($mysqli, $sql) or die("database error:". mysqli_error($mysqli));	
	$data = array();
	while( $rows = mysqli_fetch_assoc($resultset) ) {
		$data = $rows;
	}
	echo json_encode($data);
} else {
	echo 0;	
}




?>