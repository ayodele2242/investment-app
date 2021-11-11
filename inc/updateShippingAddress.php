<?php

require_once("functions.php");

//if(isset($_POST)){
error_reporting(0);



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
$city = "";
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
$uid = $_POST['uid'];



	//update and insert
$id =   $row['user_id'];
$query = 	mysqli_query($mysqli, "update customer_address set
	mobile = '$phone',address1='$address1',address2='$address2',company='$company',state='$state',country='$country',city='$city',zip='$zip',default_address='$daddr' where user_id = '$user_id'");


if($query){

if($_POST['default-address'] != ''){
	mysqli_query($mysqli,"update customer_address set default_address='' where user_id != '$user_id' and uid='$uid'");
}

	echo 1;
}else{
	echo "Error occured. Please try again on insert. ".$mysqli->error;
}






?>