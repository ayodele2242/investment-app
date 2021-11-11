<?php
require_once('config.php');

if(empty($_POST['comment'])){
	echo "Your comment is required for this product";
}else{


$comment = $mysqli->real_escape_string($_POST['comment']);

$email = $mysqli->real_escape_string($_POST['email']);
$id = $_POST['id'];



//insert

$query = mysqli_query($mysqli,"UPDATE customer_order SET return_status = 'Returned', return_reason = '$comment' WHERE id = '$id'");

if($query){
	echo 1;
}else{
	echo "Server error: ".$mysqli->error. ". Try again later.";
}


}



?>