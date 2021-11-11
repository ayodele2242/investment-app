<?php 

require 'config.php';
require '../config/function.php';
require '../class/database.php';
require '../class/product.php';
$product = new Product();

if($_POST['cat_type'] == "single"){
$color           = $_POST['color'];
if(!empty($_POST['product_size'])){
$product_size    = str_replace("+", " ", $_POST['product_size']);
}else{
$product_size    = $_POST['size'];	
}
if(!empty($_POST['sprice'])){
$amount           = $_POST['sprice'];
}else{
$amount           = $_POST['price'];	
}
if(!empty($_POST['sseller'])){
$vendor          = $_POST['sseller'];
}else{
$vendor          = $_POST['seller'];	
}
//$quantity        = $_POST['quantity'];
$product_id      = (int)$_POST['product_id'];
$img             = "";
$cat             = $_POST['cat_type'];


$product_info = $product->getProductById($product_id);
$title =  $product_info[0]->title;

$cart = array();


if(isset($_SESSION['__cart'])){
		$cart  = $_SESSION['__cart'];
}

$current_item = array();
$current_item['image'] = $product_info[0]->images;
$current_item['pimage'] = $img;
$current_item['title'] = $product_info[0]->title;
$current_item['price'] = $amount;
$current_item['id'] = $product_id;
$current_item['vendor'] = $vendor;
$current_item['color'] = $color;
$current_item['size'] = $product_size;
$current_item['name'] = $title;
$current_item['category'] = $cat;



$qty = 1;

// Define search list with multiple key=>value pair 
$search_items = array('color'=>$color, 'size'=>$product_size,  'id'=>$product_id); 

if (isset($_POST['quantity'])) {
		$qty = $_POST['quantity'];
}else{
	$qty = $_POST['qty'];
}

	if(!empty($cart)){
		//var_dump($cart);
		//$search_result = searchArray($cart, 'color', $color, 'size', $product_size, 'id', $product_id);

		// Call search and pass the array and 
      // the search list 
     $search_result = search($cart, $search_items); 

		$index = 0;
		if($search_result){
			foreach($cart as $key=>$value){
				//var_dump($value);
				if($value['color'] == $color && $value['size'] == $product_size && $value['id'] == $product_id){
					$index = $key;
					break;
				}
			}


			$cart[$index]['quantity'] += $qty;
			$cart[$index]['amount'] += $amount*$qty;
			} else {
			$current_item['amount'] = $amount*$qty;
			$current_item['quantity'] = $qty;
			
			$cart[] = $current_item;
		}
	} else {
		$current_item['amount'] = $amount*$qty;
		$current_item['quantity'] = $qty;
		
		$cart[] = $current_item;
	}
	
	$_SESSION['__cart'] = $cart;
	echo "1";
	exit;

}

if($_POST['cat_type'] == "different"){


$color	 = $_POST['color'];
if(!empty($_POST['dprice'])){
$price	 = $_POST['dprice'];
}else{
$price	 = $_POST['price'];	
}
if(!empty($_POST['dproduct_id'])){
$product_id	= (int)$_POST['dproduct_id'];
}else{
$product_id	= (int)$_POST['product_id'];	
}

$product_info = $product->getProductById($product_id);
$amount = ($price)-(($price*$product_info[0]->discount)/100);
$title =  $product_info[0]->title;
if(!empty($_POST['dsize'])){
$product_size    = str_replace("+", " ", $_POST['dsize']);
}else{
$product_size    = $_POST['size'];
}
if(!empty($_POST['dseller'])){
$vendor          = $_POST['dseller'];
}else{
$vendor          = $_POST['seller'];
}
$img             = $_POST['img'];

$cat             = $_POST['cat_type'];

$cart = array();


if(isset($_SESSION['__cart'])){
		$cart  = $_SESSION['__cart'];
}

$current_item = array();
$current_item['image'] = $product_info[0]->images;
$current_item['pimage'] = $img;
$current_item['title'] = $product_info[0]->title;
$current_item['price'] = $amount;
$current_item['id'] = $product_id;
$current_item['vendor'] = $vendor;
$current_item['color'] = $color;
$current_item['size'] = $product_size;
$current_item['name'] = $title;
$current_item['category'] = $cat;
$qty = 1;

if (isset($_POST['quantity'])) {
		$qty = $_POST['quantity'];
}else{
	$qty = $_POST['qty'];
}

// Define search list with multiple key=>value pair 
$search_items = array('color'=>$color, 'size'=>$product_size,  'id'=>$product_id); 

	if(!empty($cart)){
		
		//$search_result = searchArray($cart, 'color', $color, 'size', $product_size, $product_size, 'id', $product_id);
		$search_result = search($cart, $search_items); 

		$index = 0;
		if($search_result){
			foreach($cart as $key=>$value){
				//var_dump($value);
				if($value['color'] == $color && $value['size'] == $product_size && $value['id'] == $product_id){
					$index = $key;
					break;
				}
			}

			$cart[$index]['quantity'] += $qty;
			$cart[$index]['amount'] += $amount*$qty;
			//$cart[$index]['color'] += $color;
			//$cart[$index]['size'] += $product_size;

		} else {
			$current_item['amount'] = $amount*$qty;
			$current_item['quantity'] = $qty;
			//$current_item['category'] = $cat_type;
			
			
			$cart[] = $current_item;
		}
	} else {
		$current_item['amount'] = $amount*$qty;
		$current_item['quantity'] = $qty;
		//$current_item['category'] = $cat_type;
		
		$cart[] = $current_item;
	}
	
	$_SESSION['__cart'] = $cart;
	echo "1";
	exit;





}





























?>