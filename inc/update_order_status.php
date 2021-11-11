<?php
require 'functions.php';


$date    = $_POST['delivery_date'];
$status = $_POST['delivery_status'];
$id     = $_POST['id'];

$udate = date("Y-m-d H:i:s");

$query = mysqli_query($mysqli,"update customer_order set delivery_status = '$status', delivery_date = '$date', updated_date = '$udate' where id = '$id' ");

if($query){
	echo 1;

if($status == "Delivered"){
	mysqli_query($mysqli,"update customer_order set  status = 'Paid' where status = 'Pending' and id = '$id' ");
}else if($status == "Returned"){
	mysqli_query($mysqli,"update customer_order set  status = 'Refunded' where id = '$id' ");
}

}else{
	echo "Error occured: ".$mysqli->error;
}


?>





