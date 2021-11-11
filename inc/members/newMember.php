<?php
require_once("../functions.php");
$tv     =    time();
$iname  =    $_SESSION['name'];
$uname  =    $_SESSION['uid'];



$cust_name = $mysqli->real_escape_string($_POST['cust_name']); 
$username =  $mysqli->real_escape_string($_POST['username']); 
$cust_phone =  $mysqli->real_escape_string($_POST['cust_phone']); 
$cust_address = $mysqli->real_escape_string($_POST['cust_address']);  
$biz_address = $mysqli->real_escape_string($_POST['biz_address']);
$custsex_id = $mysqli->real_escape_string($_POST['custsex_id']);  
$cust_email = $mysqli->real_escape_string($_POST['cust_email']);  
$cust_dob  = $mysqli->real_escape_string($_POST['cust_dob']); 
$cust_occup = $mysqli->real_escape_string($_POST['cust_occup']);  
$cust_since = date("Y-m-d");  
$custmarried_id = $mysqli->real_escape_string($_POST['custmarried_id']);  
$kin_name = $mysqli->real_escape_string($_POST['kin_name']);  
$kin_phone = $mysqli->real_escape_string($_POST['kin_phone']);  
$kin_relationship = $mysqli->real_escape_string($_POST['cust_nokrelationship']);  
$kin_address = $mysqli->real_escape_string($_POST['kin_address']);  
$branch = $mysqli->real_escape_string($_POST['branch']);
$pass = easy_crypt($_POST['password']); 
$ac_name = $mysqli->real_escape_string($_POST['ac_name']);  
$ac_no = $mysqli->real_escape_string($_POST['account_number']);
$bankname = $mysqli->real_escape_string($_POST['bankname']);

$image = $_FILES['photoimg']['name'];
$tmp_dir = $_FILES['photoimg']['tmp_name'];
// image file directory
//$target = "../../assets/images/".basename($image);
$upload_dir = '../../assets/images/'; // upload directory

$imgExt = strtolower(pathinfo($image,PATHINFO_EXTENSION)); // get image extension

// valid image extensions
$valid_extensions = array('jpeg', 'jpg', 'png'); // image extensions

 $userpic = rand(1000,1000000).".".$imgExt;

if(!empty($image) && in_array($imgExt, $valid_extensions)){
	$pictures    = $userpic;
	move_uploaded_file($tmp_dir,$upload_dir.$pictures);
}else if(!empty($image) && !in_array($imgExt, $valid_extensions)){
	echo "Invalid image uploaded. Only jpeg, jpg, png are allowed ";
}else{
	$pictures = "";

}


$sqli = mysqli_query($mysqli,"INSERT INTO members (
	 name, email, username, phone, dob, password, gender, house_address, business_address, account_name, account_number,
    bank_code, status, occupation, img, kin_name, kin_phone, kin_address, kin_relationship, branch
	)
	VALUES(
	'$cust_name', '$cust_email', '$username', '$cust_phone', '$cust_dob', '$pass', '$custsex_id', '$cust_address', '$biz_address','$ac_name','$ac_no','$bankname','1','$cust_occup','$pictures','$kin_name','$kin_phone','$kin_address', '$kin_relationship', '$branch')");

if($sqli){
	echo 1;

if(!empty($_POST['gua_name'])){
$rowCount = count($_POST['gua_name']);

for($i = 0; $i < $rowCount; $i++)
 { 		
$gname = $_POST['gua_name'][$i];
$gphone = $_POST['gua_phone'][$i];
$gaddr = $_POST['gua_addr'][$i];
$grelation = $_POST['gua_relationship'][$i];
$goccupation = $_POST['gua_occupation'][$i];

 
                mysqli_query($mysqli,"INSERT INTO guarantors(name,phone,address,cust_id,relationship,occupation) 
                VALUES('$gname', '$gphone','$gaddr','$cust_email','$grelation','$goccupation')")  or die(mysqli_error($mysqli));

              //$suc =  mysqli_query($mysqli, $sql);  
            
 }
}

mysqli_query($mysqli, "insert into logs(uid,name,action,ipAddress,etime)values('$uname','$iname','Created account details for $cust_name with phone number $cust_phone', '', '$tv')") or die(mysqli_error($mysqli));

}else{
	$error = $mysqli->error;
	echo "Error occured: ".$error;

mysqli_query($mysqli, "insert into logs(uid,name,action,ipAddress,etime)values('$uname','$iname','$error', '', '$tv')") or die(mysqli_error($mysqli));
}







?>