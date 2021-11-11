<?php
require_once("../functions.php");

// Get Settings Data
$setSql = "SELECT * FROM store_setting";
$setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
$set = mysqli_fetch_array($setRes);

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

if(!empty($_POST['dob'])){
$dob = safe_input($mysqli,$_POST['dob']);
}else{
   $dob = ""; 
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
    
    
$email_activation_key = md5($email . $lname);

$name = $lname.$fname;	
$String = $email.$name;
$referralCode = substr(md5($String), 0, 12);
$referral_code = strtoupper($referralCode);
	
//insert into db
$query = mysqli_query($mysqli,"insert into customer_login(first_name,last_name,email,password,dob,token,referral_code)values('$fname','$lname','$email','$pass','$dob','$email_activation_key','$referral_code')");
mysqli_query($mysqli,"INSERT INTO referral(user, referred_by)VALUES('$email','$ref')"); 
if($query === true){
echo 1;

if(!empty($_POST['ref'])){
    $ref = $_POST['ref'];
}
	
		// create account verification link
        $link = 'https://' . $_SERVER['SERVER_NAME'] . '/activation?key=' . $email_activation_key;
        $to      = $email;
        $from = 'security@akawocommunity.com'; 
        $fromName = 'AKAWO Community'; 
 
$subject = "Verify Your Email Address.";

$htmlContent = '
<html> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
          <title>Verify Your Email Address</title> 
    </head> 
    <body> 

<div style=" text-align:center"><img src="'.$set['installUrl'].'assets/logo/'.$set['logo']. '" style="width: 100%; max-width: 140px;  height: 100%; max-height: 70px;"/></div>    

<p>Hello ' .$lname.' ' .$fname. ' ,</p>
<p>Thank you for registering on AKAWO Community. To gain access to your account you need to verify your email address. </p>
<p>
Please follow the link below to verify your email address
</p>

<p></p>
<p></p>
<p></p>
<p>'.$link.'</p>
<p></p>
<p></p>
<p></p>
<p></p>
<p>AKAWO Community Team.</p>
</body> 
</html>';


// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 

//$headers  ="From: billing@homeawayfromhomelagos.com";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

if(mail($to, $subject, $htmlContent, $headers,'-fsecurity@akawocommunity.com')){
}  else{
    print_r(error_get_last());
}


}else{
	echo "Error occured ". $mysqli->error;
}


}

}


}


?>