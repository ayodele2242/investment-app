<?php
// Include Database Configuration
include ("inc/config.php");

// Get Payment Reference and other variables from confirm_payment.php page
$reference = $_POST['reference'];
$email = $_POST['email'];
$date = date("m/d/y G.i:s", time());
$transId = $_POST['transId'];

$result = array();
//The parameter after verify/ is the transaction reference to be verified
$url = 'https://api.paystack.co/transaction/verify/'."$reference";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
  $ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer sk_test_b1acf4c6db9df3dc822e6fa3afd9ba8f4f5bbc2d']
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

if (($result['data']['status'] === 'success')) {
    
    $authoriza_cde = $result['data']['authorization']['authorization_code'];
    $last_four = $result['data']['authorization']['last4'];
    $exp_month = $result['data']['authorization']['exp_month'];
    $exp_year = $result['data']['authorization']['exp_year'];
    $bank = $result['data']['authorization']['bank'];
    $brand = $result['data']['authorization']['brand'];
    $reusable = $result['data']['authorization']['reusable'];
    $signature = $result['data']['authorization']['signature'];
    
    
    
    //Update member table
    $mquery = "UPDATE members SET status = '1', payment_status='paid', payment_ref = '$reference' WHERE  email='$email' ";
    if(mysqli_query($mysqli, $mquery)){
            echo 1;
        }else{
            echo "Error occured: ".$mysqli->error;
        }
    
    //Check if authorization exist before
    $cquery = mysqli_query($mysqli,"select authorization_code from card_details where authorization_code='$authoriza_cde' and email='$email'");
    $ccount = mysqli_num_rows($cquery);
    if($ccount < 1){
      $cque =  mysqli_query($mysqli,"insert into card_details(email, authorization_code, card_type, last4, exp_month, exp_year, bank, signature, reusable)
        values('$email','$authoriza_cde','$brand','$last_four','$exp_month','$exp_year','$bank','$signature','$reusable')") or die($mysqli->error);
        
        
    }
    
    
}else{
    echo "Payment was Unsuccessful.";

}
