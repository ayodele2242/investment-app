<?php
header('Access-Control-Allow-Origin: *');

require_once("../functions.php");
//get refferal percentage
$fquery = mysqli_query($mysqli,"SELECT ref_percent FROM store_setting");
$frow = mysqli_fetch_array($fquery);


$id      = safe_input($mysqli,$_POST['id']);
$name    = safe_input($mysqli,$_POST['name']);
$plan    = safe_input($mysqli,$_POST['plan']);
$email   = safe_input($mysqli,$_POST['email']);
$amt     = safe_input($mysqli,$_POST['amount']);
$duration = safe_input($mysqli,$_POST['duration']);
//$expdate = 


$mdate = date("Y-m-d");
$mtdate = date("m:s");
$ref = genTranxRef(15).$mtdate;


$person = array( 
    "id"     => $id,
    "name"   => $name, 
    "plan"   => $plan,
    "amount" => $amt,
    "email"  => $email,
    "date"   => $mdate,
    "ref"    => $ref
); 


//check if this user has saved before
$checkSel = mysqli_query($mysqli,"SELECT * FROM saving_plans WHERE email='$email' AND saving_package_id ='$id' ");

$countC = mysqli_num_rows($checkSel);
if($countC > 0){
//This user has already subscriped before, save details and accumuate savings

  $isql = mysqli_query($mysqli,"insert into saving_plans(email,amount_saved,saving_category,saving_package_id,ref,status , created_date)
  values('$email','$amt','$plan','$id', '$ref', 'pending','$mdate')");

//check if plan exist before
$query = mysqli_query($mysqli,"select * from savings_history where email='$email' and saving_pid = '$id' and status='active'") or die($mysqli->error);;
$cout = mysqli_num_rows($query);
if($cout > 0){
  mysqli_query($mysqli,"UPDATE savings_history SET amount_saved = amount_saved + $amt where email = '$email' and saving_pid = '$id'") or die($mysqli->error);
}else{
  mysqli_query($mysqli,"insert into savings_history(saving_pid,amount_saved,email,status, plan, ref, sdate)
  values('$id','$amt','$email','failed','$plan','$ref', '$mdate')") or die($mysqli->error);;
}

 


if($isql){
  //echo 1;
  $return["json"] = json_encode($person);
 echo json_encode($person);

}else{
  echo "Error occured: ". $mysqli->error;
}

}else{
  //This is a new user, don't save his first savings. Saved it to saving history

    $isql = mysqli_query($mysqli,"insert into saving_plans(email,amount_saved,saving_category,saving_package_id,ref,status , created_date)
  values('$email','$amt','$plan','$id', '$ref', 'pending','$mdate')");

//check if plan exist before


  mysqli_query($mysqli,"insert into savings_history(saving_pid,amount_saved,email,status, plan, ref, sdate)
  values('$id','0','$email','failed','$plan','$ref', '$mdate')") or die($mysqli->error);
  
   //mysqli_query($mysqli,"insert into savings_total(total_saved,email)values('0','$email')") or die($mysqli->error);
  
 

if($isql){
 $return["json"] = json_encode($person);
 echo json_encode($person);
 
 
     //check if this user has a referral
  $refferal = mysqli_query($mysqli,"SELECT * FROM referral WHERE user='$email' AND amt='' AND payment_status='' ") or die($mysqli->error);
  $refCount = mysqli_num_rows($refferal);
  if($refCount > 0){
     $percentage = $frow['ref_percent'];
     $interestdue = round($amt / 100 * $percentage);
     mysqli_query($mysqli,"UPDATE referral SET amt='$interestdue', payment_status='unpaid', user_made_pament=0 WHERE user='$email' AND amt='' AND payment_status='' ") or die($mysqli->error);
  }
    
    
  //echo 1;


}else{
  echo "Error occured: ". $mysqli->error;
}


}








?>