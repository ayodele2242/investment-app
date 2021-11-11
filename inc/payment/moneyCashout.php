<?php
header('Access-Control-Allow-Origin: *');
require_once("../functions.php");

$amt = $_POST['cashoutAmt'];
$email = $_POST['email'];
$refcode = $_POST['refCode'];
$date = date("Y-m-d H:m:s");


$queryi = mysqli_query($mysqli,"INSERT INTO pending_withdrawal(email,amount,status,widrawal_type,wdate)VALUES('$email','$amt','Pending','Referred Cashout','$date') ");
if($queryi){
    echo 1;
    
    mysqli_query($mysqli,"UPDATE referral SET payment_status='withdraw' WHERE referred_by='$refcode'");
}else{
    echo "Error occured. try again later";
}
    



?>