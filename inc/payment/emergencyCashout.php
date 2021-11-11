<?php
header('Access-Control-Allow-Origin: *');
require_once("../functions.php");

$amt = $_POST['cashoutAmt'];
$email = $_POST['email'];



//Check if this user already cashout on emergency

$query = mysqli_query($mysqli,"SELECT * FROM emergency_cashout WHERE email='$email' ");
$count = mysqli_num_rows($query);

if($count > 0){
    echo "You have already done emergency cashout. You can not cashout twice.";
}else{
$querys = "
SELECT total_saved as savings FROM savings_total where email='$email'";
$getifs = mysqli_query ($mysqli, $querys);
$srow = mysqli_fetch_array($getifs);
    
$amtSaved = $srow['total_saved'];

//subtract amount from main savigng
$amtRemaining = $amtSaved - $amt;

$queryi = mysqli_query($mysqli,"INSERT INTO emergency_cashout(amount,email,status)VALUES('$amt','$email','Pending') ");
if($queryi){
    echo 1;
    
    mysqli_query($mysqli,"UPDATE total_saved SET total_saved='$amtRemaining' WHERE email='$email'");
}else{
    echo "Error occured. try again later";
}
    
}


?>