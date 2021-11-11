<?php
require_once("../functions.php");

//if(isset($_POST)){
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

if(!empty($_POST['country'])){
$country     = safe_input($mysqli,$_POST['country']);
}else{
	echo "Select your country<br/>";
}

if(!empty($_POST['state'])){
$state  = safe_input($mysqli,$_POST['state']);
}else{
$state  = "";
}


if(!empty($_POST['city'])){
$city = safe_input($mysqli,$_POST['city']);
}else{
echo "Please enter your city.<br/>";
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

if(!empty($_POST['password'])){
$pass = easy_crypt($_POST['password']);
}else{
	echo "Enter password<br/>";
}
if(!empty($_POST['password2'])){
$pass2 = easy_crypt($_POST['password2']);
}else{
	echo "Enter confirm password<br/>";
}

if($pass != $pass2){
	echo "Password and confirm password are not the same<br/>";
}

if(!empty($_POST['default-address'])){
$daddr = $_POST['default-address'];
}else{
	$daddr = "";
}







//get if email already exist in db
$getU = "SELECT email from customer_login WHERE email ='$email'";

   $ok = mysqli_query($mysqli, $getU);
   $countIt = mysqli_num_rows($ok);
   
if($countIt == 1){
	echo "That email address already exist. If it belong to you please log in.";
}else{

if(!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['address1']) && !empty($_POST['city']) && !empty($_POST['password'])  && $_POST['password'] == $_POST['password2']){

//$referral_code = 'user-'.genTranxRef(6);
$name = $lname.$fname;
$String = $email.$name;
$referralCode = substr(md5($String), 0, 12);
$referral_code = strtoupper($referralCode);




//insert into db
$query = mysqli_query($mysqli,"insert into customer_login(first_name,last_name,email,password,status,referral_code)values('$fname','$lname','$email','$pass',1, '$referral_code')");
if($query === true){

	echo 1;
	
	$udi = mysqli_insert_id($mysqli);

mysqli_query($mysqli, "insert into customer_address(
	uid,mobile,address1,address2,company,state,country,city,zip,default_address)
	values('$udi','$phone','$address1','$address2','$company','$state','$country','$city','$zip','$daddr'
)") or die(mysqli_error($mysqli));

$_SESSION['email'] = $email;
/*if(!empty($_POST['coupon-price'])){
	$_SESSION['coupon-price'] = $_POST['coupon-price'];
}else{
	$_SESSION['coupon-price'] = "";
}*/

}else{
	echo "Error occured ". $mysqli->error;
}


}



}



//}


?>