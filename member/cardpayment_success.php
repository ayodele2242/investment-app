<?php
// Include Database Configuration
require_once "../inc/config.php";

$ref = $_POST['reference'];
$email = $_POST['email'];
$transId = $_POST['transId'];
$amount = $_POST['amount'];
$plan = $_POST['plan'];
$id = $_POST['id'];



//check if amount in history is not 0
$ahist = mysqli_query($mysqli,"SELECT amount_saved FROM savings_history WHERE email = '$email' AND saving_pid = '$id' AND status='active' ");
$count = mysqli_num_rows($ahist);
$row = mysqli_fetch_array($ahist);

if($count > 0){
//echo $row['amount_saved'];

if($row['amount_saved'] > 0){
$tquery = mysqli_query($mysqli,"SELECT * FROM savings_total WHERE email='$email'");
$tcount = mysqli_num_rows($tquery);
if($tcount > 0){
    echo 1;
   mysqli_query($mysqli,"UPDATE savings_total SET total_saved = total_saved + $amount WHERE email = '$email'") or die($mysqli->error);
   
   
   $bquery = mysqli_query($mysqli,"SELECT last_name, first_name FROM customer_login WHERE email = '$email'");
$erow = mysqli_fetch_array($bquery);
$name = $erow['last_name'] .' '.$erow['first_name'] ;
//sending email

$to      = $email;
$from = 'hello@akawocommunity.com'; 
$fromName = 'Akawo Community'; 
 
$subject = "Your saving has been confirmed.";

$htmlContent .= '
<html> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
          <title>Akawo Community Savings</title> 
    </head> 
    <body> 
<p>Hello ' .$name. '</p>
<p>Thank you for being part of our family at Akawo Community! Your saving has been successfully confirmed. </p>
<p>
Below is your saving details:
</p>

<table class="table table-striped"  width="100%" cellpadding="0" cellspacing="0">

<tbody>';

    $query = mysqli_query ($mysqli, "SELECT distinct * FROM saving_plans WHERE  email='$email' AND ref='$ref'" );
    while($order = mysqli_fetch_array($query))
        {    
        	 
        $htmlContent .= "<tr>
        
        <td>Saving Package</td><td class=leftstyle>".$order['saving_category']."</td><tr>
        <tr><td>Amount Saved</td><td class=rightstyle>".$order['amount_saved']."</td></tr>
        <tr><td>Payment Date</td><td class=rightstyle>".$order['created_date']."</td>
        
      </tr>";
    }

$htmlContent .= '</tbody></table>
<p>Thank you.</p>
<p></p>
<p></p>
<p></p>
<p>Akawo Community Team.</p>
</body> 
</html>';


// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 

//$headers  ="From: billing@homeawayfromhomelagos.com";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail($to, $subject, $htmlContent, $headers,'-fhello@akawocommunity.com'); 
   
}
}else{
$tquery = mysqli_query($mysqli,"SELECT * FROM savings_total WHERE email='$email'");
$tcount = mysqli_num_rows($tquery);
if($tcount > 0){
    echo 1;
   mysqli_query($mysqli,"UPDATE savings_total SET total_saved = total_saved + 0 WHERE email = '$email'") or die($mysqli->error);
   
$bquery = mysqli_query($mysqli,"SELECT last_name, first_name FROM customer_login WHERE email = '$email'");
$erow = mysqli_fetch_array($bquery);
$name = $erow['last_name'] .' '.$erow['first_name'] ;
//sending email

$to      = $email;
$from = 'hello@akawocommunity.com'; 
$fromName = 'Akawo Community'; 
 
$subject = "Your saving has been confirmed.";

$htmlContent .= '
<html> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
          <title>Akawo Community Savings</title> 
    </head> 
    <body> 
<p>Hello ' .$name. '</p>
<p>Thank you for being part of our family at Akawo Community! Your saving has been successfully confirmed. </p>
<p>Your first payment on this plan belongs to Akawo Community. </p>
<p>
Please find more details on your dashboard.
</p>

<table class="table table-striped"  width="100%" cellpadding="0" cellspacing="0">

<tbody>
';

    $query = mysqli_query ($mysqli, "SELECT distinct * FROM saving_plans WHERE  email='$email' AND ref='$ref'" );
    while($order = mysqli_fetch_array($query))
        {    
        	 
       "<tr>
        
        <td>Saving Package</td><td class=leftstyle>".$order['saving_category']."</td><tr>
        <tr><td>Amount Saved</td><td class=rightstyle>".$amount."</td></tr>
        <tr><td>Deducted by platform</td><td class=rightstyle>".$amount."</td></tr>
        <tr><td>Wallet Total</td><td class=rightstyle>".$order['amount_saved']."</td></tr>
        <tr><td>Payment Date</td><td class=rightstyle>".$order['created_date']."</td>
        
      </tr>";
    }

$htmlContent .= '</tbody></table>
<p>Thank you.</p>
<p></p>
<p></p>
<p></p>
<p>Akawo Community Team.</p>
</body> 
</html>';


// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 

//$headers  ="From: billing@homeawayfromhomelagos.com";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to, $subject, $htmlContent, $headers,'-fhello@akawocommunity.com'); 

}else{
    echo 1;
   mysqli_query($mysqli,"insert into savings_total(total_saved,email)values('0','$email')") or die($mysqli->error);
   
   $bquery = mysqli_query($mysqli,"SELECT last_name, first_name FROM customer_login WHERE email = '$email'");
$erow = mysqli_fetch_array($bquery);
$name = $erow['last_name'] .' '.$erow['first_name'] ;
//sending email

$to      = $email;
$from = 'hello@akawocommunity.com'; 
$fromName = 'Akawo Community'; 
 
$subject = "Your saving has been confirmed.";

$htmlContent .= '
<html> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
          <title>Akawo Community Savings</title> 
    </head> 
    <body> 
<p>Hello ' .$name. '</p>
<p>Thank you for being part of our family at Akawo Community! Your saving has been successfully confirmed. </p>
<p>Your first payment on this plan belongs to Akawo Community. </p>
<p>
Please find more details on your dashboard.
</p>

<table class="table table-striped"  width="100%" cellpadding="0" cellspacing="0">

<tbody>
';

    $query = mysqli_query ($mysqli, "SELECT distinct * FROM saving_plans WHERE  email='$email' AND ref='$ref'" );
    while($order = mysqli_fetch_array($query))
        {    
        	 
        "<tr>
        
        <td>Saving Package</td><td class=leftstyle>".$order['saving_category']."</td><tr>
        <tr><td>Amount Saved</td><td class=rightstyle>".$amount."</td></tr>
        <tr><td>Deducted by platform</td><td class=rightstyle>".$amount."</td></tr>
        <tr><td>Wallet Total</td><td class=rightstyle>".$order['amount_saved']."</td></tr>
        <tr><td>Payment Date</td><td class=rightstyle>".$order['created_date']."</td>
        
      </tr>";
    }

$htmlContent .= '</tbody></table>
<p>Thank you.</p>
<p></p>
<p></p>
<p></p>
<p>Akawo Community Team.</p>
</body> 
</html>';


// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 

//$headers  ="From: billing@homeawayfromhomelagos.com";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to, $subject, $htmlContent, $headers,'-fhello@akawocommunity.com'); 
   
   
}
}

}else{
 echo $mysqli->error;   
}







?>


