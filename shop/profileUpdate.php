<?php

require("../inc/config.php");

if(!empty($_POST['lname']) && !empty($_POST['fname'])){

$email = $mysqli->real_escape_string($_POST['email']);
$lname = $mysqli->real_escape_string($_POST['lname']);
$fname = $mysqli->real_escape_string($_POST['fname']);
$gender =  $mysqli->real_escape_string($_POST['gender']);


$query = mysqli_query($mysqli,"UPDATE customer_login SET first_name='$fname', last_name='$lname', gender='$gender' WHERE email='$email'");
if($query){
	echo 1;
}else{
	echo "Error occured while updating your details. Try again later.";
}

}else{
	echo "Check for empty values in your input";
}

?>