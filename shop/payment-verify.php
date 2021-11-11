<?php
// Include Database Configuration
include ("../inc/config.php");

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
    'Authorization: Bearer sk_test_ffc7333ca80038a2b9f3ccfabbb81d7168a95484']
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

    $dataM = array( 
    "success" => true,
    "transId" => $transId,
    "email" => $email,
    "ref" => $reference
    );
    
    
mysqli_query($mysqli,"UPDATE transactions SET payment_trans_id = '$reference', payment_status = 'Paid' where txn_id = '$transId' AND payer_email='$email'");
$upMe = mysqli_query($mysqli,"update customer_order set payment_trans_id = '$reference', status = 'Paid' where transId = '$transId' AND c_email='$email'");

$qua = mysqli_query($mysqli,"SELECT SUM(quantity) as tot_quantity, product_id FROM customer_order WHERE c_email = '$email' and transId='$transId' GROUP BY product_id");
while($get = mysqli_fetch_array($qua)){
$quan = $get['tot_quantity'];
$pid =  $get['product_id'];
//update product
mysqli_query($mysqli, "UPDATE product set quantity = quantity-$quan WHERE id = '$pid' ");
}

//Check if authorization exist before
$cquery = mysqli_query($mysqli,"select authorization_code from card_details where email='$email'");
$ccount = mysqli_num_rows($cquery);
if($ccount < 1){
$cque =  mysqli_query($mysqli,"insert into card_details(email, authorization_code, card_type, last4, exp_month, exp_year, bank, signature, reusable)
values('$email','$authoriza_cde','$brand','$last_four','$exp_month','$exp_year','$bank','$signature','$reusable')") or die($mysqli->error); 
}


if($upMe){
$return["json"] = json_encode($dataM);
echo json_encode($dataM);
}else{
  echo  $mysqli->error;
}

}else{
    echo "Payment was Unsuccessful.";

}
