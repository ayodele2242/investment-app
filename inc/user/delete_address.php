<?php

require_once("../functions.php");

if(isset($_POST['id'])){

	$id= $_POST['id'];

	$query = mysqli_query($mysqli,"delete from customer_address where user_id='$id'");

	if($query){
		echo 1;
	}else{
		echo "Error occured while deleting. Please try again.";
	}
}








?>