<?php

// Get Settings Data
$setSql = "SELECT * FROM store_setting";
$setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
$set = mysqli_fetch_array($setRes);


//get currency symbol/layout
$csql = mysqli_query($mysqli, "select * from currency_setting");
$aget = mysqli_fetch_array($csql);
if($aget['currency_position'] == "right"){
	$right_currency = $aget['currency'];
}else if($aget['currency_position'] == "right-space"){
	$right_currency = ' '.$aget['currency'];
}
else{
	$right_currency = "";
}


if($aget['currency_position'] == "left"){
	$left_currency = $aget['currency'];
}else if($aget['currency_position'] == "left-space"){
	$left_currency = $aget['currency'] .' ';
}else{
	$left_currency = "";
}


//get min and max price from products

$am = mysqli_query($mysqli, "SELECT MIN(  `price` ) AS  `lowest` , MAX(  `price` ) AS  `highest` FROM  `product`");

$getamt = mysqli_fetch_array($am);

if($getamt['highest'] != ""){
	$maxamt = $getamt['highest'];
}else{
	$maxamt = "";
}

if($getamt['lowest'] != ""){
	$lowamt = $getamt['lowest'];
}else{
	$lowamt = "";
}



			
?>