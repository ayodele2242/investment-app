<?php

require_once("../../inc/config.php");

$setSql = "SELECT * FROM store_setting";
    $setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
    $set = mysqli_fetch_array($setRes);

 
 if(!empty($_POST['name']) && !empty($_POST['duration']) && !empty($_POST['amount'])){
	$name=$mysqli->real_escape_string($_POST['name']);
	$duration=$mysqli->real_escape_string($_POST['duration']);
	$amt=$mysqli->real_escape_string($_POST['amount']);

	$id = $mysqli->real_escape_string($_POST['id']);


	

	/*$sql2 = "SELECT * FROM saving_plans WHERE saving_package_id = '$id'";
    $result = mysqli_query($mysqli,$sql2) or die($mysqli->error);
    $count = mysqli_num_rows($result);
    if ($count == 0) {*/
    	$sql = "UPDATE saving_packages SET category='$name',duration='$duration',amount='$amt' WHERE id='$id'";
	$done =	mysqli_query($mysqli, $sql);

	if($done){
		echo 1;
	}else{
		echo $mysqli->error;
	}

    /*}else{
		echo "You can not update saving package. Members are already on it";
    }*/
}else{
	echo "Check for empty values";
}


?>
 