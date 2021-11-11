<?php 

require 'config.php';
require '../config/function.php';
require '../class/database.php';
require '../class/product.php';
$product = new Product();

if($_POST['cat_type'] == "single"){

if(empty($_POST['color'])){
	echo "Select the color for this product";
}else if(empty($_POST['product_size'])){
	echo "You need to select size for this product";
}else{

$color           = $_POST['color'];

$product_size    = str_replace("+", " ", $_POST['product_size']);
$amount          = $_POST['sprice'];
$vendor          = $_POST['sseller'];
$product_id      = (int)$_POST['product_id'];

$cat             = $_POST['cat_type'];

$qty = 1;

if (isset($_POST['quantity'])) {
  $qty = $_POST['quantity'];
}

$product_info = $product->getProductById($product_id);
$title        = $product_info[0]->title;
$img          = $product_info[0]->images;;
//insert into cart
//if(!empty($_POST['mysession'])){
$isessionId = $_POST['mysession'];
//}else{
//$isessionId = session_id();
//}
//check if product exist in the database, if it does, update it

$get = mysqli_query($mysqli,"select * from cart where product_id = '$product_id' AND color = '$color' AND size = '$product_size' AND sessionId = '$isessionId'");
$count = mysqli_num_rows($get);
if($count > 0){
	$update = mysqli_query($mysqli,"UPDATE cart SET quantity = quantity+$qty WHERE product_id = '$product_id' AND color = '$color' AND size = '$product_size' AND sessionId = '$isessionId' ");

if($update){
echo 1;
}else{
	echo "Error adding product to cart: ".$mysqli->error;
}

}else{

$query = mysqli_query($mysqli, "insert into cart(product_id,title,cat_type,color,size,price,vendor,image,sessionId,quantity)
values('$product_id','$title','$cat','$color','$product_size','$amount','$vendor','$img','$isessionId','$qty') ");

if($query){
	echo 1;
}else{
	echo "Error adding product to cart: ".$mysqli->error;
}



}//else


}
}



if($_POST['cat_type'] == "different"){
$color           = $_POST['color'];

$product_size    = str_replace("+", " ", $_POST['dsize']);
$price           = $_POST['dprice'];



$vendor          = $_POST['dseller'];
$product_id      = (int)$_POST['dproduct_id'];

$cat             = $_POST['cat_type'];

$qty = 1;

if (isset($_POST['quantity'])) {
  $qty = $_POST['quantity'];
}

$product_info = $product->getProductById($product_id);
$title        = $product_info[0]->title;
$img          = $_POST['img'];
if(!empty($product_info[0]->discount)){
$amount = ($price)-(($price*$product_info[0]->discount)/100);
}else{
$amount = $price;	
}
//insert into cart
if(!empty($_POST['mysession'])){
$isessionId = $_POST['mysession'];
}else{
$isessionId = session_id();
}

//check if product exist in the database, if it does, update it

$get = mysqli_query($mysqli,"select * from cart where product_id = '$product_id' AND color = '$color' AND size = '$product_size' AND sessionId = '$isessionId'");
$count = mysqli_num_rows($get);
if($count > 0){
	$update = mysqli_query($mysqli,"UPDATE cart SET quantity = quantity+$qty WHERE product_id = '$product_id' AND color = '$color' AND size = '$product_size' AND sessionId = '$isessionId' ");

if($update){
echo 1;
}else{
	echo "Error adding product to cart: ".$mysqli->error;
}

}else{

$query = mysqli_query($mysqli, "insert into cart(product_id,title,cat_type,color,size,price,vendor,image,sessionId,quantity)
values('$product_id','$title','$cat','$color','$product_size','$amount','$vendor','$img','$isessionId','$qty') ");

if($query){
	echo 1;
}else{
	echo "Error adding product to cart: ".$mysqli->error;
}



}//else



}



