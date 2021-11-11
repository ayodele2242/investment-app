<?php

	require_once 'functions.php';



 if(isset($_POST['coupon'])){
   
   $coupon_code = $_POST['coupon'];
   $price = $_POST['price'];
	
    	
	$query = mysqli_query($mysqli, "SELECT * FROM coupon WHERE coupon_code = '$coupon_code' AND status = 'Valid'") or die(mysqli_error($mysqli));
	$count = mysqli_num_rows($query);
	$fetch = mysqli_fetch_array($query);

	$array = array();
	if($count > 0){
		$discount = $fetch['discount'] / 100;
		$total = $discount * $price;
		$get_Tot = $price - $total;

		$array['discount'] = $fetch['discount'];
		$array['price'] = number_format($get_Tot);
		
		echo json_encode($array);
		
	}else{
		echo "error";
	}

}
?>