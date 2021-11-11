<?php
	require_once('../functions.php');

	
if(!empty($_POST['name']) && !empty($_POST['duration']) && !empty($_POST['amount'])){
	$name=$mysqli->real_escape_string($_POST['name']);
	$duration=$mysqli->real_escape_string($_POST['duration']);
	$amt=$mysqli->real_escape_string($_POST['amount']);
	$descr = $mysqli->real_escape_string($_POST['info']);




	

	$sql2 = "SELECT * FROM saving_packagess WHERE category = '$name' and duration = '$duration'";
    $result = mysqli_query($mysqli,$sql2) or die($mysqli->error);
    $count = mysqli_num_rows($result);
    if ($count < 1) {
    	$sql = "INSERT INTO saving_packagess(category,duration,amount,details)values('$name','$duration','$amt','$descr')";
	$done =	mysqli_query($mysqli, $sql);

	if($done){
		echo "done";
	}else{
		echo $mysqli->error;
	}

    }else{
		echo "Saving plan already exist";
    }
}else{
	echo "Check for empty values";
}
?>