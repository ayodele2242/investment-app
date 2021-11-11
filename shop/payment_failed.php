 <?php
include("header.php");
//include("navs.php");
 ob_start();
//smtp detail start

?>
<style type="text/css">
	.fa-large{
		font-size: 100px;
		font-weight: bolder;
	}
</style>



<?php
if(isset($_GET['transId'])){
 if(!empty($_GET['transId'])){ 
$transId   = safe_input($mysqli,$_GET['transId']);
}else{
  $transId   = "";
}
$reference = safe_input($mysqli,$_GET['reference']);
$email     = safe_input($mysqli,$_GET['email']);
//get buys details


mysqli_query($mysqli,"update transactions set payment_trans_id = '$reference', payment_status = 'failed' where txn_id = '$transId'");
mysqli_query($mysqli,"update customer_order set payment_trans_id = '$reference', status = 'failed' where transId = '$transId'");


$bquery = mysqli_query($mysqli,"select last_name,first_name from customer_login where email = '$email'");
$erow = mysqli_fetch_array($bquery);
$name = $erow['last_name'] ." " .$erow['first_name'];
//sending email

$to      = $email;
$from = 'buildit@buildit.com.ng'; 
$fromName = 'Buildit'; 
 
$subject = "Your Buildit Order ". $transId . " was cancelled due to failed payment.";

$htmlContent = '
<html> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
          <title>Order Details</title> 
    </head> 
    <body> 
<p>Hello ' .$name. '</p>
<p>Thank you for shopping on Buildit! But unfortunate your order '.$transId.' was not successfully confirmed due to failed payment. </p>
<p>
Please try again to place your orders once again.
</p>

<table class="table table-striped"  width="100%" cellpadding="0" cellspacing="0">
<thead>
<th>Image</th><th>Product Name</th><th>Size</th><th>Variant</th><th>Qty</th><th>Price</th><th>Total Amt.</th>

</thead>
<tbody>
';

    $query = mysqli_query ($mysqli, "SELECT * FROM customer_order WHERE transId = '$transId'" );
    while($order = mysqli_fetch_array($query))
        {    
        	 if($order['product_image'] != "" && file_exists(UPLOAD_DIR.'/product/'.$order['product_image'])){
                    $thumbnail = UPLOAD_URL.'product/'.$order['product_image'];
                  }
                  else {
                    $thumbnail = FRONT_IMAGES.'no-image.png';
                  }

        $strMessage = "<tr>
        <td class=rightstyle><img src=".UPLOAD_URL.'product/'.$order['product_image'];"/></td>
        <td class=leftstyle>".$order['product_name']."</td>
        <td class=rightstyle>".$order['size']."</td>
        <td class=rightstyle>".$order['color']."</td>
        <td class=rightstyle>".$order['quantity']."</td>
        <td class=rightstyle>".$order['product_price']."</td>
        <td class=rightstyle>".$order['total_amount']."</td>
      </tr>";
    }

$htmlContent = '</tbody></<table>
<p>Thank you for shopping on Buildit.</p>
<p></p>
<p></p>
<p></p>
<p>Buildit Team.</p>
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

mail($to, $subject, $htmlContent, $headers);    
    

?>
<div class="container pb-5 mb-sm-4">
      <div class="pt-5">
        <div class="card py-3 mt-sm-3">
        	 
          <div class="card-body text-center">
          	<i class="fa fa-sad-o fa-large col-blue"></i>
            <h2 class="h4 pb-3 col-blue">Thank you for your order!</h2>
            <p class="font-size-sm mb-2">Your order was not placed, your payment failed. Please try again.</p>
            
            
          </div>
        </div>
      </div>
    </div>
<?php
}else{
	header("Location: new");
}

?>











<?php 
include("footer.php");
 ?>