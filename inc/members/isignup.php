<?php
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json');
require_once '../functions.php';

// Get Settings Data
        $setSql = "SELECT * FROM store_setting";
        $setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
        $set = mysqli_fetch_array($setRes);


if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])){


$name = safe_input($mysqli,$_POST['name']);
$uname = safe_input($mysqli,$_POST['Username']);
$phone = safe_input($mysqli,$_POST['phone']);
$pass = encryptIt($_POST['password']);
$dob  = safe_input($mysqli,$_POST['dob']);
$ac_no = "";
$acname = "";
$bank = "";

$mtdate = date("m:s");
$ref = genTranxRef(15);

if($_POST['password'] != $_POST['cpassword']){
    $response = array('success' => false, 'message' => 'Password and confirm password are not equal');
}


//Check for valid email
$email = safe_input($mysqli, $_POST['email']);
$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
if (filter_var($emailB, FILTER_VALIDATE_EMAIL) === false ||
    $emailB != $email
) {
 $response = array('success' => false, 'message' => 'This email adress isn\'t valid');
}



//get if email already exist in db
$getU = "SELECT email from members WHERE email ='$email'";

$ok = mysqli_query($mysqli, $getU);
$countIt = mysqli_num_rows($ok);

if($countIt > 0){
     $response = array('success' => false, 'message' => 'That email address already exist. If it belongs to you please log in.');
}else{
if ($_POST['password'] == $_POST['cpassword']) {
	# code...

//$email_activation_key = md5($email . $name);

    $person = array(    
    "status" => "success",    
    "name"   => $name, 
    "phone"   => $phone,
    "email"  => $email,
    "ref"    => $ref
); 


$sql = mysqli_query($mysqli,"insert into members(name,email,username,phone,dob,password,account_name,account_number,bank_name,status,payment_status)values('$name','$email','$uname','$phone','$dob','$pass','$acname','$ac_no','$bank',0,'unpaid')");


if($sql){
$response=array(                
                'success'=>true,
                "data"=>array(
                "name"   => $name, 
                "phone"   => $phone,
                "email"  => $email,
                "ref"    => $ref

                )

            );

}else{
    $response = array('success' => false, 'message' => 'Error occured: '.$mysqli->error);
}

}
}


}else{
	//echo "Check for empty values in your inputs.";
    $response = array('success' => false, 'message' => 'Check for empty values in your inputs.');
}

echo json_encode($response);
?>