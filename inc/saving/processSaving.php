<?php
require_once("../functions.php");
$fquery = mysqli_query($mysqli,"SELECT ref_percent FROM store_setting");
$frow = mysqli_fetch_array($fquery);




$id      = safe_input($mysqli,$_POST['saving_id']);
$email   = safe_input($mysqli,$_POST['email']);
$amt     = (int)str_replace(',', '', $_POST['amount']);
$date    = $_POST['date'];

$old_date = explode('/', $date); 
$newDate = $old_date[2].'-'.$old_date[1].'-'.$old_date[0];


//check if email exist before
$uquery = mysqli_query($mysqli,"SELECT email FROM customer_login WHERE email = '$email' ") or die($mysqli->error);
$ucount = mysqli_num_rows($uquery);
if($ucount > 0){


//get saving info

$sel = mysqli_query($mysqli,"select * from saving_packages where id='$id'");
$fet = mysqli_fetch_array($sel);

$plan    = $fet['category'];
$duration    = $fet['duration'];

//$newDate = date("Y-m-d", strtotime($date));


$mdate = $newDate;//date("Y-m-d");
$mtdate = date("m:s");
$ref = genTranxRef(15).$mtdate;




//check if this user has saved before
$checkSel = mysqli_query($mysqli,"SELECT * FROM saving_plans WHERE email='$email'");

$countC = mysqli_num_rows($checkSel);
if($countC > 0){
//This user has already subscriped before, save details and accumuate savings

  $isql = mysqli_query($mysqli,"insert into saving_plans(email,amount_saved,saving_category,saving_package_id,ref,status , created_date)
  values('$email','$amt','$plan','$id', '$ref', 'paid','$mdate')");
  
      $tquery = mysqli_query($mysqli,"SELECT * FROM savings_total WHERE email = '$email' ") or die($mysqli->error);
      $tcount = mysqli_num_rows($tquery);
      if($tcount > 0){
           mysqli_query($mysqli,"UPDATE savings_total SET total_saved = total_saved + $amt WHERE email = '$email' ") or die($mysqli->error);
      }else{
           mysqli_query($mysqli,"insert into savings_total(total_saved,email)values('0','$email')") or die($mysqli->error);
      }
      

//check if plan exist before
$query = mysqli_query($mysqli,"select * from savings_history where email='$email' and saving_pid = '$id' and status='active'") or die($mysqli->error);;
$cout = mysqli_num_rows($query);
if($cout > 0){
  mysqli_query($mysqli,"UPDATE savings_history SET amount_saved = amount_saved + $amt where email = '$email' and saving_pid = '$id'") or die($mysqli->error);
}else{
  mysqli_query($mysqli,"insert into savings_history(saving_pid,amount_saved,email,status, plan, ref, sdate)
  values('$id','$amt','$email','active','$plan','$ref', '$mdate')") or die($mysqli->error);;
}

 


if($isql){
   echo "done";

}else{
  echo "Error occured: ". $mysqli->error;
}

}else{
  //This is a new user, don't save his first savings. Saved it to saving history

    $isql = mysqli_query($mysqli,"insert into saving_plans(email,amount_saved,saving_category,saving_package_id,ref,status , created_date)
  values('$email','$amt','$plan','$id', '$ref', 'paid','$mdate')");

//check if plan exist before


  mysqli_query($mysqli,"insert into savings_history(saving_pid,amount_saved,email,status, plan, ref, sdate)
  values('$id','0','$email','active','$plan','$ref', '$mdate')") or die($mysqli->error);
  
   //mysqli_query($mysqli,"insert into savings_total(total_saved,email)values('0','$email')") or die($mysqli->error);
   
      $tquery = mysqli_query($mysqli,"SELECT * FROM savings_total WHERE email = '$email' ") or die($mysqli->error);
      $tcount = mysqli_num_rows($tquery);
      if($tcount > 0){
           mysqli_query($mysqli,"UPDATE savings_total SET total_saved = total_saved + $amt WHERE email = '$email' ") or die($mysqli->error);
      }else{
           mysqli_query($mysqli,"insert into savings_total(total_saved,email)values('0','$email')") or die($mysqli->error);
      }
      
  
 

if($isql){
  echo "done";
  
  
 
 if(!empty($_POST['ref'])){
     //check if this user has a referral
  $refferal = mysqli_query($mysqli,"SELECT * FROM referral WHERE user='$email' AND amt='' AND payment_status='' ") or die($mysqli->error);
  $refCount = mysqli_num_rows($refferal);
  if($refCount > 0){
      $ref = $_POST['ref'];
     $percentage = $frow['ref'];
     $interestdue = round($amt / 100 * $percentage);
     mysqli_query($mysqli,"INSERT INTO referral(user, referred_by, amt, payment_status, user_made_pamen )value('$email','$ref','$interestdue','unpaid','0')") or die($mysqli->error);
     //mysqli_query($mysqli,"UPDATE referral SET amt='$interestdue', payment_status='unpaid', user_made_pament=0 WHERE user='$email' AND amt='' AND payment_status='' ") or die($mysqli->error);
  }
    
 }   
  //echo 1;


}else{
  echo "Error occured: ". $mysqli->error;
}


}

/*$isql = mysqli_query($mysqli,"insert into saving_plans(email,amount_saved,saving_category,saving_package_id,ref,status , created_date)
  values('$email','$amt','$plan','$id', '$ref', 'paid','$newDate')");

//check if plan exist before
$query = mysqli_query($mysqli,"select * from savings_history where email='$email' and saving_pid = '$id' and status='active'") or die($mysqli->error);;
$cout = mysqli_num_rows($query);
if($cout > 0){
  mysqli_query($mysqli,"UPDATE savings_history SET amount_saved = amount_saved + $amt where email = '$email' and saving_pid = '$id'") or die($mysqli->error);
}else{
  mysqli_query($mysqli,"insert into savings_history(saving_pid,amount_saved,email,status, plan, ref, sdate)
  values('$id','$amt','$email','active','$plan','$ref', '$newDate')") or die($mysqli->error);;
}
 


if($isql){
  //echo 1;
  echo "done";

}else{
  echo "Error occured: ". $mysqli->error;
}
*/
}else{
    echo "Email address does not exist in the database";
}



?>