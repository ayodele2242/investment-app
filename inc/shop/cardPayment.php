<?php
header('Access-Control-Allow-Origin: *');
require_once("../functions.php");


//empty variables
$msg = '';
$reference = '';
$response = array();

$tot_amt      = $_POST['total_amt_to_pay'];
$myList        = $_POST['items_bought'];
$email        = $_POST['cust_email'];
$shipping     = $_POST['shipping'];
$coupon_code  = $_POST['coupon_code'];
$transId      = $_POST['trx_id'];

$bamt = str_replace( ',', '', $tot_amt );
if( is_numeric( $bamt ) ) {
    $aamt = $bamt;
}

$samt = str_replace( ',', '', $shipping );
if( is_numeric( $shipping ) ) {
    $ship = $shipping;
}

$overall_amt = $aamt + $ship;



$myList = unserialize($myList);
$myitems = $mysqli->real_escape_string(json_encode($myList));

//$trxId = date("dmYHms").'-'.$transId;

$query = mysqli_query($mysqli, "select id, first_name, last_name from customer_login where email = '$email'");
$get = mysqli_fetch_array($query);
$lname = $get['last_name'];
$fname = $get['first_name'];
$uid   = $get['id']; 

$name = $lname .' '. $fname;
$atp = $overall_amt*100;

//get address

$aquery = mysqli_query($mysqli, "select * from customer_address where user_id = '$uid' and default_address='1'");
$aget = mysqli_fetch_array($aquery);

$addr = $aget['address1'];
$city = $aget['city'];
$state = $aget['state'];
$country = $aget['country'];
$zip    = $aget['zip'];



$mdate = date("Y-m-d");
$mtdate = date("m:s");
$trxId = genTranxRef(15);

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

if ($result) {
   
  $results = json_decode($result, true);
  
  //print("<pre>".print_r($results,true)."</pre>");
}

if (($results['data']['status'] === 'success')) {
   echo $results['data']['gateway_response'];
  $reference = $results['data']['reference'];

$dataM = array( 
    "success" => true,
    "transId" => $transId,
    "email" => $email,
    "ref" => $reference
    );


  $iquery = mysqli_query($mysqli, "insert into transactions(product_id_array, payer_email, first_name, last_name, txn_id, receiver_email, payment_type, payment_status, address_street, address_city, address_state, address_zip, address_country,total_amt,  coupon_code,shipping_fee)values('$myitems', '$email','$fname','$lname','$trxId','$email','Credit Card','Paid','$addr','$city','$state','$zip','$country','$tot_amt','$coupon_code','$shipping')");


  if($iquery){

  // echo 1;
 

  $udi = mysqli_insert_id($mysqli);

//insert coupon 
if(!empty($coupon_code)){
mysqli_query($mysqli,"insert into used_coupon(email,email)values('$coupon_code','$email')");  
}

// Check if $myList is indeed an array or an object.
if (is_array($myList) || is_object($myList))
{
  // If yes, then foreach() will iterate over it.
  foreach($myList as $arrayItem){
      //Do database insertion for each items
$amt = $arrayItem['quantity'] * $arrayItem['price']  ;
$queryme = mysqli_query($mysqli,"insert into customer_order(
  c_email,product_id,product_name,product_image,product_price,quantity,color,size,vendor,total_amount,payment,status,transId,payment_trans_id)
  values('$email', '".$arrayItem['product_id']."', '".$arrayItem['title']."', '".$arrayItem['image']."', '".$arrayItem['price']."', '".$arrayItem['quantity']."', '".$arrayItem['color']."', '".$mysqli->real_escape_string($arrayItem['size'])."', '".$arrayItem['vendor']."','$amt','Credit Card','Paid','transId','$reference')") or die(mysqli_error($mysqli));

mysqli_query($mysqli, "UPDATE product set quantity = quantity-'".$arrayItem['quantity']."' WHERE id = '".$arrayItem['product_id']."' ");

//Delete items from cart
if($queryme){
  $msg = "ok";
mysqli_query($mysqli,"delete from cart where sessionId = '".$arrayItem['sessionId']."'");
}

    
  }
}
else // If $myList was not an array, then this block is executed. 
{
  $response=array("response"=>"Unfortunately, an error occured.");
}


}else{
  $response=array("response"=>"Error occured while processing cart items. Please try again.");
  //echo "Error occured while processing cart items. Please try again. ".$mysqli->error;
}
  }else{
    $response=array("response"=>"Payment was Unsuccessful.");
   // echo "Payment was Unsuccessful.";

}


if($msg == "ok"){
   $return["json"] = json_encode($dataM);
  echo json_encode($dataM);
}else{
  echo json_encode($response);
}


?>