<?php

require 'functions.php';

if(isset($_POST['id'])){
	$id = safe_input($mysqli,$_POST['id']);
	$sta = safe_input($mysqli,$_POST['delivery_status']);

$query = mysqli_query($mysqli,"update product set status = '$sta' where id='$id'");

if($query){
	echo 1;
}else{
	echo "Error occured: ".$mysqli->error;
}

}



?>
