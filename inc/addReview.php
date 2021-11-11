<?php
require_once('config.php');

if(empty($_POST['rate'])){
	echo "Select product rating";
}else if(empty($_POST['comment'])){
	echo "Your comment is required for this product";
}else{

$rate = $mysqli->real_escape_string($_POST['rate']);
$comment = $mysqli->real_escape_string($_POST['comment']);

$email = $mysqli->real_escape_string($_POST['email']);
$product_id = $_POST['product_id'];

//get user name

$sql = mysqli_query($mysqli,"SELECT last_name, first_name FROM customer_login WHERE email='$email' ");
$uget = mysqli_fetch_array($sql);

$name = ucwords($uget['last_name']).' '.ucwords($uget['first_name']);

//insert

$query = mysqli_query($mysqli,"INSERT INTO review_rating(product_id,name,email,review,rating)VALUES('$product_id','$name','$email','$comment','$rate')");

if($query){
	echo 1;
}else{
	echo "Server error: ".$mysqli->error. ". Try again later.";
}


}



?>