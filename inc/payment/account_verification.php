<?php

if(isset($_POST['account_number']) && $_POST['bank_code']){

$ac_no    = $_POST['account_number'];
$banlCode = $_POST['bank_code'];
$result = array();

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number=$ac_no&bank_code=$banlCode",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer sk_live_f8fe0d61cf966bf3f09fbdf2a72c074417333ea5",
    "Cache-Control: no-cache",
    ),
));

$request = curl_exec($curl);
if(curl_error($curl)){
 echo 'error:' . curl_error($curl);
 }
curl_close($curl);


if ($request) {
   
  $result = json_decode($request, true);
  
 // print("<pre>".print_r($result,true)."</pre>");
}

if (($result['status'] === true)) {
    
    $ac_name = $result['data']['account_name'];
    $msg = $result['message'];
    
     $dataM = array( 
    "success" => true,
    "message" => $msg,
    "ac_name" => $ac_name
    );
    
    $return["json"] = json_encode($dataM);
   echo json_encode($dataM);
    
    
}else{
    
     $msg = $result['message'];
    
     $dataM = array( 
    "success" => false,
    "message" => $msg
    );
    
    $return["json"] = json_encode($dataM);
    echo json_encode($dataM);
}


/*$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);



if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}*/



}
?>