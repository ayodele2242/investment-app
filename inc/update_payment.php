<?php
require 'functions.php';



if(isset($_POST['amount_paying']) && $_POST['amount_paying'] !=""){
$amount = $_POST['amount_paying'];
$id = $_POST['id'];

$query = mysqli_query($mysqli,"update customer_order set amount_issued = '$amount', vendor_payment_status = 'Settled' where id ='$id' ");

if($query){
	echo 1;
}else{
	echo "Error occured: ". $mysqli->error;
}





}







?>