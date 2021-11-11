<?php 

require 'config.php';



//if(isset($_POST)){

$id  = $_POST['id'];
$qty = $_POST['qty'];

if($qty == '0' || $qty == ''){
	$qty = "Please enter item quantity";
}else{

$update = mysqli_query($mysqli,"UPDATE cart SET quantity = $qty WHERE id = '$id'");

if($update){
echo 1;
}else{
	echo "Error updating cart: ".$mysqli->error;
}



}

//}

?>