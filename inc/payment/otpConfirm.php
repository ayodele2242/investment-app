<?php
require_once("../functions.php");

$opt = $_POST['otp'];
$transcode = $_POST['transfer_code'];

  $url = "https://api.paystack.co/transfer/finalize_transfer";
  $fields = [
    "transfer_code" => "$transcode", 
    "otp" => "$opt"
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
 // echo $result;
  
  
  if ($result) {
   
  $results = json_decode($result, true);
  
 //print("<pre>".print_r($results,true)."</pre>");
}



if ($results['status'] == 1) {
    
    
$query = mysqli_query($mysqli,"UPDATE emergency_cashout SET status='Transferred'  WHERE transfer_code='$transcode'");   

    
    if($query){
    $dataM = array( 
    "success" => true
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
    "message" => $results['message']
    );
    
     $return["json"] = json_encode($dataM);
     echo json_encode($dataM);
    
}
?>