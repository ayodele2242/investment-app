<?php
require_once("../functions.php");


$id      = safe_input($mysqli,$_POST['saving_id']);
$email   = safe_input($mysqli,$_POST['email']);
$amt     = (int)str_replace(',', '', $_POST['amount']);
$date    = safe_input($mysqli,$_POST['date']);

$mdate = date("Y-m-d");
$mtdate = date("m:s");
$ref = genTranxRef(15).$mtdate;


$newDate = date("Y-m-d", strtotime($date));

//withdraw
$query = mysqli_query($mysqli,"UPDATE savings_history SET amount_saved = amount_saved - $amt where email = '$email' and saving_pid = '$id'") or die($mysqli->error);

if($query){
	mysqli_query($mysqli,"insert into withdrawal_history(plan_id,amount,email,transid,wdate)values('$id','$amt','$email','$ref','$newDate')");
	echo "done";
}else{
  echo "Error occured: ". $mysqli->error;
}








?>