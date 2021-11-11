<?php
require_once("../../config/config.php");
require_once("../functions.php");


if(!empty($_POST['fname'])){
$fname = safe_input($mysqli,$_POST['fname']);
}else{
	echo "First name is required<br/>";
}

if(!empty($_POST['lname'])){
$lname = safe_input($mysqli,$_POST['lname']);
}else{
	echo "Last name is required<br/>";
}

if(!empty($_POST['dob'])){
$dob = safe_input($mysqli,$_POST['dob']);
}else{
	$dob = "";
}

if(!empty($_POST['gender'])){
$gender = safe_input($mysqli,$_POST['gender']);
}else{
	$gender = "";
}


$email = safe_input($mysqli, $_POST['email']);
//Let's get passowrd from db
$query = mysqli_query($mysqli,"select password from customer_login where email='$email'");
$row = mysqli_fetch_array($query);

$mypass = $row['password'];

if(!empty($_POST['password'])){
$oldPwd = encryptIt($_POST['password']);

if(!empty($_POST['new_password'])){
$password = encryptIt($_POST['new_password']);
}else{
	echo "Enter your new password.";
}
//check if old password and db password are equal
if($mypass != $oldPwd){
	echo "Your old password is wrong. Please try again.";
}

}else{
$password = $mypass;
}





//Update db
$iquery = mysqli_query($mysqli,"update customer_login set first_name = '$fname', last_name = '$lname', password = '$password', gender = '$gender', dob='$dob' where email = '$email'");

if($iquery){
	echo 1;
}else{
	echo "Error occured while updating. Please try again.". $mysqli->error;
}












?>