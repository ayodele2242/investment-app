<?php
include("inc/config.php");

$data = array();
$dataset = array();

$url = "https://api.paystack.co/transaction/charge_authorization";
$fields = "";
$query = mysqli_query($mysqli,"SELECT s.*, c.authorization_code, p.duration, p.amount 
FROM savings_history s 
INNER JOIN saving_packages p ON s.saving_pid = p.id  
INNER JOIN card_details c ON c.email = s.email
WHERE s.status = 'active' AND p.duration='daily' 
");

$totalCount = mysqli_num_rows($query);
$successCount = 0;

if($totalCount > 0){

while ($row = mysqli_fetch_array($query))
{
//$dataset[] = $row;

$email = $row['email'];
$amt = $row['amount'];
$authCode = $row['authorization_code'];
$atp = $amt * 100;
$id = $row['saving_pid'];
$plan = $row['plan'];
///echo $email .' &nbsp;&nbsp; '.$authCode."<br>"; 

$fields = [
    'authorization_code' => "$authCode",
    'email' => "$email",
    'amount' => "$atp"
  ];
 
//print_r($fields); 
  
$fields_string = http_build_query($fields);


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


if ($result) {
   
  //$data[] = json_decode($result, true);
  $results = json_decode($result, true);
  //print("<pre>".print_r($results,true)."</pre>");
  //echo $results['data']['customer']['email'].' - ref -'.$results['data']['reference'].' - '.$results['data']['transaction_date'].'<br/>';
  $ref = $results['data']['reference'];
  $iemail = $results['data']['customer']['email'];
  $mdate = $results['data']['transaction_date'];
  $amtReceived = $results['data']['amount'] / 100;
  //echo  $iemail.' - '.  $amtReceived.'<br><br>';
  $status = $results['data']['status'];
  
  if($results['data']['amount'] >= $amt && $status == 'success'){
 $isql = mysqli_query($mysqli,"insert into saving_plans(email,amount_saved,saving_category,saving_package_id,transId,ref,status , created_date, trasaction_status)
  values('$email','$amtReceived','$plan','$id', '$ref', '$ref', 'paid','$mdate','successful')");
   
  mysqli_query($mysqli,"UPDATE savings_history SET amount_saved = amount_saved + $amtReceived where email = '$email' and saving_pid = '$id' and status='active'");
  
  mysqli_query($mysqli,"UPDATE savings_total SET total_saved = total_saved + $amtReceived WHERE email = '$email'");
  
  }else{
       mysqli_query($mysqli,"insert into saving_error_tracker(plan,amount,status,email, reference,transaction_date)values('$plan','$amtReceived','$status','$email','$ref','$mdate')");
  }
  
   
}


/*foreach($data as $value) {
  echo $custCode = $value["data"]["customer"]["customer_code"].'<br/>';
  echo $custEmail = $value["data"]["customer"]["email"].'<br/>';

 }*/


}


}else{
    echo $mysqli->error;
}



 /*foreach($dataset as $row){
     
     
     
 }*/
 
/*foreach($data as $value) {
 $custCode = $value["data"]["customer"]["customer_code"].'<br/>';
 $custEmail = $value["data"]["customer"]["email"].'<br/>';
    
   
        echo $custEmail.' - '.$plan.' - '.$amount.'<br/>';
    
    
   $isql = mysqli_query($mysqli,"insert into saving_plans(email,amount_saved,saving_category,saving_package_id,ref,status , created_date, trasaction_status)
  values('$email','$amt','$plan','$id', '$ref', 'paid','$mdate','successful')");

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
      echo 1;
    }else{
      echo "Error occured: ". $mysqli->error;
    }
    
    
}*/

?>