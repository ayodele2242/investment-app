<?php
require_once("../functions.php");
$tv     =    time();
$iname  =    $_SESSION['name'];
$uname  =    $_SESSION['uid'];



$cust_no = $mysqli->real_escape_string($_POST['account_no']); 
$id = $mysqli->real_escape_string($_POST['cid']);

$cust_name =  $mysqli->real_escape_string($_POST['cust_name']); 
$cust_phone =  $mysqli->real_escape_string($_POST['cust_phone']); 
$cust_address = $mysqli->real_escape_string($_POST['cust_address']);  
$custsex_id = $mysqli->real_escape_string($_POST['custsex_id']);  
$cust_email = $mysqli->real_escape_string($_POST['cust_email']);  
$cust_dob  = $mysqli->real_escape_string($_POST['cust_dob']); 
$cust_occup = $mysqli->real_escape_string($_POST['cust_occup']);  
$custmarried_id = $mysqli->real_escape_string($_POST['custmarried_id']);  
$kin_name = $mysqli->real_escape_string($_POST['kin_name']);  
$kin_phone = $mysqli->real_escape_string($_POST['kin_phone']);  
$kin_relationship = $mysqli->real_escape_string($_POST['cust_nokrelationship']);  
$kin_address = $mysqli->real_escape_string($_POST['kin_address']);  
$branch = $mysqli->real_escape_string($_POST['branch']);  
$date = date("Y-m-d");

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
	$pictures = $_POST['pictures'];

}


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
                VALUES('$gname', '$gphone','$gaddr','$cust_no','$grelation','$goccupation')")  or die(mysqli_error($mysqli));

              //$suc =  mysqli_query($mysqli, $sql);  
            
 }
}

$sqli = mysqli_query($mysqli,"UPDATE customer SET
	
	cust_name = '$cust_name', 
	cust_dob = '$cust_dob', 
	custsex_id = '$custsex_id', 
	cust_address = '$cust_address', 
	cust_phone = '$cust_phone', 
	cust_email = '$cust_email', 
	cust_occup = '$cust_occup', 
	custmarried_id = '$custmarried_id', 
	cust_lastupd = '$date',
	cust_pic = '$pictures', 
	kin_name = '$kin_name', 
	kin_phone = '$kin_phone', 
	kin_relationship = '$kin_relationship', 
	kin_address = '$kin_address',  
	branch = '$branch'
	WHERE cust_id = '$id'
	");

if($sqli){
	echo 1;

mysqli_query($mysqli, "insert into logs(uid,name,action,ipAddress,etime)values('$uname','$iname','$uname updated account details for  $cust_name with account number $cust_no', '', '$tv')") or die(mysqli_error($mysqli));

}else{
	$error = $mysqli->error;
	echo "Error occured: ".$error;

mysqli_query($mysqli, "insert into logs(uid,name,action,ipAddress,etime)values('$uname','$iname','$error', '', '$tv')") or die(mysqli_error($mysqli));
}







?>