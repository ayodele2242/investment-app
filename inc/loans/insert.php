<?php
	require_once('../functions.php');




if(!empty($_POST['name']) && !empty($_POST['interest_rate']) && !empty($_POST['duration']) && !empty($_POST['amount']) && !empty($_POST['late_interest'])){
	$name=$mysqli->real_escape_string($_POST['name']);
	$percent=$mysqli->real_escape_string($_POST['interest_rate']);
	$late=$mysqli->real_escape_string($_POST['late_interest']);
	$duration=$mysqli->real_escape_string($_POST['duration']);
	$amt=$mysqli->real_escape_string($_POST['amount']);
	$descr = $mysqli->real_escape_string($_POST['info']);

	$b = str_replace( ',', '', $amt );

	if( is_numeric( $b ) ) {
	    $a = $b;
	}



	

	
    	$sql = "INSERT INTO loans_packages(name,interest,duration,amount,late_interest,details)values('$name','$percent','$duration','$a','$late','$descr')";
	$done =	mysqli_query($mysqli, $sql);

	if($done){
		echo "done";
	}else{
		echo $mysqli->error;
	}

    
}else{
	echo "Check for empty values";
}
?>