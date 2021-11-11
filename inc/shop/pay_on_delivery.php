<?php
require_once("../config.php");




if( !empty($_POST['total_amt_to_pay']) && !empty($_POST['items_bought']) && !empty($_POST['shipping']) && !empty($_POST['cust_email'])){

$addr_id      = $_POST['addr_id'];
$tot_amt      = $_POST['total_amt_to_pay'];
$myList        = $_POST['items_bought'];
$email        = $_POST['cust_email'];
$shipping     = $_POST['shipping'];
$coupon_code  = $_POST['coupon_code'];
$transId      = $_POST['trx_id'];

$myList = unserialize($myList);
$myitems = print_r($myList, true);

$trxId = date("dmYHms").'-'.$transId;

$query = mysqli_query($mysqli, "select id, first_name, last_name from customer_login where email = '$email'");
$get = mysqli_fetch_array($query);
$lname = $get['last_name'];
$fname = $get['first_name'];
$uid   = $get['id']; 

//get address
if(isset($_POST['addr_id'])){
$addr_id      = $_POST['addr_id'];
$aquery = mysqli_query($mysqli, "select * from customer_address where user_id = '$addr_id'");
$aget = mysqli_fetch_array($aquery);

$addr = $aget['address1'];
$city = $aget['city'];
$state = $aget['state'];
$country = $aget['country'];
$zip    = $aget['zip'];

}



//insert into transaction table
$iquery = mysqli_query($mysqli, "insert into transactions(product_id_array, payer_email, first_name, last_name, txn_id, receiver_email, payment_type, payment_status, address_street, address_city, address_state, address_zip, address_country,total_amt, 	coupon_code,shipping_fee)values('$myitems', '$email','$fname','$lname','$trxId','$email','On Delivery','Pending','$addr','$city','$state','$zip','$country','$tot_amt','$coupon_code','$shipping')");


if($iquery){

   echo 1;
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
$amt = $arrayItem['quantity'] * $arrayItem['price'];
$queryme = mysqli_query($mysqli,"insert into customer_order(
	c_email,product_id,product_name,product_image,product_price,quantity,color,size,vendor,total_amount,payment,status,transId)
	values('$email', '".$arrayItem['product_id']."', '".$arrayItem['title']."', '".$arrayItem['image']."', '".$arrayItem['price']."', '".$arrayItem['quantity']."', '".$arrayItem['color']."', '".$arrayItem['size']."', '".$arrayItem['vendor']."','$amt','On Delivery','Pending','$trxId')") or die(mysqli_error($mysqli));


//Delete items from cart
if($queryme){
mysqli_query($mysqli,"delete from cart where sessionId = '".$arrayItem['sessionId']."'");
}

  	
  }
}
else // If $myList was not an array, then this block is executed. 
{
  echo "Unfortunately, an error occured.";
}


}else{
	echo "Error occured while processing cart items. Please try again. ".$mysqli->error;
}

}else{
  echo "Error occured while processing cart. Please try again. ";
}


?>