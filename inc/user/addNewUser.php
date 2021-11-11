<?php
require_once("../../config/config.php");
require_once("../functions.php");

if(isset($_POST)){
error_reporting(0);
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
if(!empty($_POST['email'])){
$email = safe_input($mysqli, $_POST['email']);
$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
if (filter_var($emailB, FILTER_VALIDATE_EMAIL) === false ||
    $emailB != $email
) {
    echo "This email adress isn't valid<br/>";
}

}else{
	echo "Email address is required<br/>";
}


if(!empty($_POST['gender'])){
$gender = safe_input($mysqli,$_POST['gender']);
}



if(!empty($_POST['password'])){
$pass = encryptIt($_POST['password']);
}else{
	echo "Enter password<br/>";
}
if(!empty($_POST['password2'])){
$pass2 = encryptIt($_POST['password2']);
}else{
	echo "Enter confirm password<br/>";
}

if($pass != $pass2){
	echo "Password and confirm password are not the same<br/>";
}


if(!empty($_POST['lname']) && !empty($_POST['fname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password2']) && $_POST['password'] == $_POST['password2'] ){

//get if email already exist in db
$getU = "SELECT email from customer_login WHERE email ='$email'";

   $ok = mysqli_query($mysqli, $getU);
   $countIt = mysqli_num_rows($ok);
   
if($countIt == 1){
	echo "That email address already exist. If it belong to you please log in.";
}else{
//insert into db
$query = mysqli_query($mysqli,"insert into customer_login(first_name,last_name,email,password,gender)values('$fname','$lname','$email','$pass','$gender')");
if($query === true){

	echo 1;
	
	$udi = mysqli_insert_id($mysqli);

    $_SESSION['email'] = $email;


}else{
	echo "Error occured ". $mysqli->error;
}


}

}


}


?>