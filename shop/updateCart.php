<?php 

require '../inc/config.php';
require '../config/function.php';
require '../class/database.php';
require '../class/product.php';


if(isset($_POST['cat']) && $_POST['cat'] == 'minus'){

$id  = $_POST['id'];
$qty = $_POST['qty'];

if($qty > 1){
	$update = mysqli_query($mysqli,"UPDATE cart SET quantity = quantity-1 WHERE id = '$id'");

if($update){
echo 1;
}else{
	echo "Error updating cart: ".$mysqli->error;
}
}else{
	echo 2;
}

}

else if(isset($_POST['cat']) && $_POST['cat'] == 'plus'){

$id  = $_POST['id'];
$qty = $_POST['qty'];

if($qty > 1){
	$update = mysqli_query($mysqli,"UPDATE cart SET quantity = quantity+1 WHERE id = '$id'");

if($update){
echo 1;
}else{
	echo "Error updating cart: ".$mysqli->error;
}
}else{
	echo 2;
}

}

?>