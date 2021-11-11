<?php
require_once("functions.php");

//if(isset($_POST)){
//error_reporting(0);



if(!empty($_POST['phone'])){
$phone = safe_input($mysqli,$_POST['phone']);
}else{
	echo "Contact number is required<br/>";
}
if(!empty($_POST['company'])){
$company = safe_input($mysqli,$_POST['company']);
}else{
	$company = "";
}

if(!empty($_POST['zip'])){
$zip = safe_input($mysqli,$_POST['zip']);
}else{
$zip = "";
}

if(!empty($_POST['city'])){
$city = safe_input($mysqli,$_POST['city']);
}else{
$city = "Please enter city";
}

if(!empty($_POST['state'])){
$state  = safe_input($mysqli,$_POST['state']);
}else{
$state  = "";
}

if(!empty($_POST['country'])){
$country     = safe_input($mysqli,$_POST['country']);
}else{
	echo "Select your country<br/>";
}
if(!empty($_POST['address1'])){
$address1     = safe_input($mysqli,$_POST['address1']);
}else{
	echo "Please enter your address<br/>";
}
if(!empty($_POST['address2'])){
$address2     = safe_input($mysqli,$_POST['address2']);
}else{
	$address2 = "";
}



if(!empty($_POST['default-address'])){
$daddr = $_POST['default-address'];
}else{
	$daddr = "";
}



$email = safe_input($mysqli, $_POST['email']);

$user_id = $_POST['user_id'];



if(!empty($_POST['phone']) && !empty($_POST['address1']) && !empty($_POST['city']) ){

//get if email already exist in db
$getU = "SELECT uid, default_address, user_id from customer_address WHERE uid ='$user_id' and default_address = 1";

   $ok = mysqli_query($mysqli, $getU);
   $countIt = mysqli_num_rows($ok);
   $row = mysqli_fetch_array($ok);

if($countIt > 0){
	//update and insert
$id =   $row['user_id'];
$query = 	mysqli_query($mysqli, "insert into customer_address(
	uid,mobile,address1,address2,company,state,country,city,zip,default_address)
	values('$user_id','$phone','$address1','$address2','$company','$state','$country','$city','$zip','$daddr'
)");

mysqli_query($mysqli,"update customer_address set default_address = '0' where user_id = '$id'");

if($query){
	echo 1;
}else{
	echo "Error occured. Please try again on insert. ".$mysqli->error;
}

}else{

$query = mysqli_query($mysqli, "insert into customer_address(
	uid,mobile,address1,address2,company,state,country,city,zip,default_address)
	values('$user_id','$phone','$address1','$address2','$company','$state','$country','$city','$zip','$daddr'
)");

if($query){
	echo 1;
}else{
	echo "Error occured. Please try again. ".$mysqli->error;
}

}


}



?>