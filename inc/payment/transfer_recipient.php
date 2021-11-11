<?php

//if(isset($_POST['rname']) && isset($_POST['amount']) && isset($_POST['email'])){

$name = $_POST['rname'];
$amount = $_POST['amount'];
$email = $_POST['email'];
$acno = $_POST['acno'];
$bankcode = $_POST['bankcode'];

$response = array();

  $url = "https://api.paystack.co/transferrecipient";
  $fields = [
    'type' => "nuban",
    'name' => "$name",
    'account_number' => "$acno",
    'bank_code' => "$bankcode",
    'currency' => "NGN"
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
  
 // print("<pre>".print_r($results,true)."</pre>");
}

//echo $results['status']

if (($results['status'] == 1)) {
    $recipient_code = $results['data']['recipient_code'];
    $bank = $results['data']['details']['bank_name'];
    $dataM = array( 
    "success" => true,
    "recipient_code" => $recipient_code,
    "bank_name" => $bank
    );
    
     $return["json"] = json_encode($dataM);
     echo json_encode($dataM);
    
    
    
}else{
     $dataM = array( 
    "success" => false
    );
    
     $return["json"] = json_encode($dataM);
     echo json_encode($dataM);
    
}
  
  
//}
?>