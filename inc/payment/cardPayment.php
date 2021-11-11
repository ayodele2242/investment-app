<?php
header('Access-Control-Allow-Origin: *');

require_once("../functions.php");


$id      = safe_input($mysqli,$_POST['id']);
$name    = safe_input($mysqli,$_POST['name']);
$plan    = safe_input($mysqli,$_POST['plan']);
$email   = safe_input($mysqli,$_POST['email']);
$amt     = safe_input($mysqli,$_POST['amount']);
$duration = safe_input($mysqli,$_POST['duration']);

$atp = $amt*100;

$mdate = date("Y-m-d");
$mtdate = date("m:s");
$ref = genTranxRef(15).$mtdate;

 

//get user card details
$mcquery = mysqli_query($mysqli, "select authorization_code, signature from card_details WHERE email='$email'");
$row = mysqli_fetch_array($mcquery);

$authCode = $row['authorization_code'];


$url = "https://api.paystack.co/transaction/charge_authorization";
  
  $fields = [
    'authorization_code' => "$authCode",
    'email' => "$email",
    'amount' => "$atp"
  ];
  $fields_string = http_build_query($fields);
  //open connection
  $ch = curl_init();
  
  //set the url, number of POST vars, POST data
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer sk_live_f8fe0d61cf966bf3f09fbdf2a72c074417333ea5",
    "Cache-Control: no-cache",
  ));
  
  //So that curl_exec returns the contents of the cURL; rather than echoing it
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
  
  //execute post
  $result = curl_exec($ch);
  //echo $result;

/*if ($result) {
  $results = json_decode($result, true);
}*/

if ($result) {
 $results = json_decode($result, true);
 if($results['data']['status'] == 'success' && $results['data']['amount'] > 0){
 
  $ref = $results['data']['reference'];
  $iemail = $results['data']['customer']['email'];
  $mdate = $results['data']['transaction_date'];
  $amtReceived = $results['data']['amount'] / 100;
  $status = $results['data']['status'];
  
  $person = array( 
    "id"     => $id,
    "name"   => $name, 
    "plan"   => $plan,
    "amount" => $amtReceived,
    "email"  => $email,
    "date"   => $mdate,
    "ref"    => $ref,
    "status" => $results['data']['status']
);
  
  
  //check if this user has saved before
$checkSel = mysqli_query($mysqli,"SELECT * FROM saving_plans WHERE email='$email' AND saving_category='$plan' ");

$countC = mysqli_num_rows($checkSel);
if($countC > 0){
//This user has already subscriped before, save details and accumuate savings

  $isql = mysqli_query($mysqli,"insert into saving_plans(email,amount_saved,saving_category,saving_package_id,ref,status , created_date)
  values('$email','$amtReceived','$plan','$id', '$ref', 'paid','$mdate')");

//check if plan exist before
$query = mysqli_query($mysqli,"SELECT * FROM savings_history WHERE email='$email' AND saving_pid = '$id' AND status='active'") or die($mysqli->error);

$cout = mysqli_num_rows($query);



if($cout > 0){
  mysqli_query($mysqli,"UPDATE savings_history SET amount_saved = amount_saved + $amtReceived where email = '$email' and saving_pid = '$id'") or die($mysqli->error);
}else{
  mysqli_query($mysqli,"insert into savings_history(saving_pid,amount_saved,email,status, plan, ref, sdate)
  values('$id','$amtReceived','$email','active','$plan','$ref', '$mdate')") or die($mysqli->error);;
}

 



if($isql){
  //echo 1;
  $return["json"] = json_encode($person);
  echo json_encode($person);
 
}else{
    $person = array( 
    "message" => "Error occured:". $mysqli->error
);

$return["json"] = json_encode($person);
 echo json_encode($person);
  //echo "Error occured: ". $mysqli->error;
}

}else{
  //This is a new user, don't save his first savings. Saved it to saving history

    $isql = mysqli_query($mysqli,"insert into saving_plans(email,amount_saved,saving_category,saving_package_id,ref,status , created_date)
  values('$email','$amtReceived','$plan','$id', '$ref', 'paid','$mdate')");

//check if plan exist before


  mysqli_query($mysqli,"insert into savings_history(saving_pid,amount_saved,email,status, plan, ref, sdate)
  values('$id','0','$email','active','$plan','$ref', '$mdate')") or die($mysqli->error);
  
   //mysqli_query($mysqli,"insert into savings_total(total_saved,email)values('0','$email')") or die($mysqli->error);
   
    
  
 

if($isql){
 $return["json"] = json_encode($person);
 echo json_encode($person);
 //echo 1;
}else{
  //echo "Error occured: ". $mysqli->error;
$person = array( 
    "message" => "Error occured:". $mysqli->error
);

$return["json"] = json_encode($person);
 echo json_encode($person);
 
}


}
   
}else{

$person = array( 
    "message" => "Payment failed"
);

$return["json"] = json_encode($person);
 echo json_encode($person);
  
}
   
}else{

$person = array( 
    "message" => "Payment was Unsuccessful"
);

$return["json"] = json_encode($person);
 echo json_encode($person);
//echo "Payment was Unsuccessful.";

}





?>