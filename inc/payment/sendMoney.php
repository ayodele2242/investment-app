<?php
require_once("../functions.php");

$id = $_POST['pid'];
$amount = $_POST['amount'];
$email = $_POST['email'];
$acno = $_POST['acno'];
$bankcode = $_POST['bankcode'];
$recipientCode = $_POST['recipientCode'];
$totAmt = $amount*100;

  $url = "https://api.paystack.co/transfer";
  $fields = [
    'source' => "balance",
    'amount' => $totAmt,
    'recipient' => "$recipientCode",
    'reason' => "Emergency Cashout"
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
    $ref = $results['data']['reference'];
    $transferCode = $results['data']['transfer_code'];
    $date = $results['data']['createdAt'];
    
$query = mysqli_query($mysqli,"UPDATE emergency_cashout SET status='Transfer has been queued', cashout_date='$date', ref='$ref', transfer_code='$transferCode' WHERE id='$id'");   

    
    if($query){
    $dataM = array( 
    "success" => true,
    "transfercode" => $transferCode,
    "ref" => $ref
    );
    
     $return["json"] = json_encode($dataM);
     echo json_encode($dataM);
     
    }else{
            
    $dataM = array( 
    "success" => false,
    "message" => "Error occured: ".$mysqli->error
    );
    
     $return["json"] = json_encode($dataM);
     echo json_encode($dataM);
     
        
    }
    
    
    
}else{
     $dataM = array( 
    "success" => false,
    "message" => $resul['message']
    );
    
     $return["json"] = json_encode($dataM);
     echo json_encode($dataM);
    
}
  
  
?>