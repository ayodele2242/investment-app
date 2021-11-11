<?php
// Include Database Configuration
include ("../inc/config.php");

// Get Payment Reference and other variables from confirm_payment.php page
$reference = $_POST['reference'];
$email = $_POST['email'];
$transId = $_POST['transId'];
$amount = $_POST['amount'];
$plan = $_POST['plan'];
$id = $_POST['id'];

$date = date("m/d/y G.i:s", time());


$result = array();
//The parameter after verify/ is the transaction reference to be verified
$url = 'https://api.paystack.co/transaction/verify/'."$reference";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
  $ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer sk_live_f8fe0d61cf966bf3f09fbdf2a72c074417333ea5']
);
$request = curl_exec($ch);
if(curl_error($ch)){
 echo 'error:' . curl_error($ch);
 }
curl_close($ch);

if ($request) {
   
  $result = json_decode($request, true);
  
  //print("<pre>".print_r($result,true)."</pre>");
}

if ($result['data']['status'] === 'success' && $result['data']['amount'] > 0 ) {
    
    $authoriza_cde = $result['data']['authorization']['authorization_code'];
    $last_four = $result['data']['authorization']['last4'];
    $exp_month = $result['data']['authorization']['exp_month'];
    $exp_year = $result['data']['authorization']['exp_year'];
    $bank = $result['data']['authorization']['bank'];
    $brand = $result['data']['authorization']['brand'];
    $reusable = $result['data']['authorization']['reusable'];
    $signature = $result['data']['authorization']['signature'];
    $ramt = $result['data']['amount'] / 100;

     $dataM = array( 
    "success" => true,
    "transId" => $transId,
    "email" => $email,
    "ref" => $reference
    );


     $mquery = mysqli_query($mysqli,"UPDATE saving_plans SET transId = '$reference', status='paid', trasaction_status='successful' where  email='$email' AND  ref='$transId'");

      mysqli_query($mysqli,"UPDATE savings_history SET status='active' WHERE email = '$email' AND ref = '$transId'");
      
      
      //Referral update
      $rquery = mysqli_query($mysqli,"SELECT * FROM referral WHERE payment_status='unpaid' AND user='$email' AND user_made_pament='0' ");
      $rcount = mysqli_num_rows($rquery);
      if($rcount > 0){
       mysqli_query($mysqli,"UPDATE referral SET user_made_pament='1' WHERE user='$email' AND payment_status='unpaid' ") or die($mysqli->error);
      }
      
      //check if amount in history is not 0
      $ahist = mysqli_query($mysqli,"select amount_saved FROM savings_history WHERE email = '$email' AND saving_pid = '$id'");
      $row = mysqli_fetch_array($ahist);
      
      if($row['amount_saved'] > 0){
      $tquery = mysqli_query($mysqli,"SELECT * FROM savings_total WHERE email='$email'");
      $tcount = mysqli_num_rows($tquery);
      if($tcount > 0){
           mysqli_query($mysqli,"UPDATE savings_total SET total_saved = total_saved + $ramt WHERE email = '$email'") or die($mysqli->error);
      }
      }else{
     $tquery = mysqli_query($mysqli,"SELECT * FROM savings_total WHERE email='$email'");
      $tcount = mysqli_num_rows($tquery);
      if($tcount > 0){
           mysqli_query($mysqli,"UPDATE savings_total SET total_saved = total_saved + 0 WHERE email = '$email'") or die($mysqli->error);
      }else{
           mysqli_query($mysqli,"insert into savings_total(total_saved,email)values('0','$email')") or die($mysqli->error);
      }
      }
      
    
    
if($mquery){
$return["json"] = json_encode($dataM);
echo json_encode($dataM);
}else{
  echo  $mysqli->error;
}

    //Check if authorization exist before
    $cquery = mysqli_query($mysqli,"select email from card_details where email='$email'");
    $ccount = mysqli_num_rows($cquery);
    if($ccount < 1){
      $cque =  mysqli_query($mysqli,"insert into card_details(email, authorization_code, card_type, last4, exp_month, exp_year, bank, signature, reusable)
        values('$email','$authoriza_cde','$brand','$last_four','$exp_month','$exp_year','$bank','$signature','$reusable')") or die($mysqli->error);
        
        }


    
    
}else{
    echo "Payment was Unsuccessful.";

}
