<?php
require_once('../functions.php');



/*if(!empty($_POST['email']) && !empty($_POST['interest_rate']) && !empty($_POST['loantype']) && !empty($_POST['amount']) && !empty($_POST['status']) && !empty($_POST['frequency'])){*/

//check if email exist for member





	$id = $_POST['loan_id'];

	$query = mysqli_query($mysqli,"select * from loans_packages where id='$id'");
	$row = mysqli_fetch_array($query);

	$amount = $_POST['amount'];
	$interest = $_POST['interest_rate'];
    $months = $_POST['duration'];
    $frequency = $_POST['frequency'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $freq = $_POST['frequency'];
//divisor
		switch ($_POST['frequency']) {
			case 'Monthly':
				$divisor = 1;
				$days = 30;
				break;
			case '2 Weeks':
				$divisor = 2;
				$days = 15;
				break;
			case 'Weekly':
				$divisor = 4;
				$days = 7;
				break;
		}



		$chec = mysqli_query($mysqli,"select email from members WHERE email='$email'");
		$countMe = mysqli_num_rows($chec);
		if($countMe > 0){

	//interest
		//$amount_interest = $amount * ($interest/100)/$divisor;
		$amount_interest = round($amount / 100 * $interest)/$divisor;
//$totalAmt = $amt + $interestdue;
		
		//total payments applying interest
		$amount_total = $amount + $amount_interest * $divisor;
		
		//payment per term
		$amount_term = number_format(round($amount_total / ($months * $divisor), 2));
		
		$date = date("Y-m-d");
		


      $query = "";

      //check if borrower haven't finished paying loan for this category

      $mque = mysqli_query($mysqli,"select * from loan_disburse where email = '$email' and loan_id='$id' and status='active'");
      $count = mysqli_num_rows($mque);
      if($count > 0){
      	echo "Loan can not be granted for this customer on this loan category. The customer is yet to pay up";
      }else{
        

		for ($i = 1; $i <= $months * $divisor; $i++)
		{
			$frequency = $days * $i;
			$newdate = strtotime ('+'.$frequency.' day', strtotime($date)) ;
			//check if payment date landed on weekend
			//if Sunday, make it Monday. If Saturday, make it Friday
			if(date('D', $newdate) == 'Sun') {
				$newdate = strtotime('+1 day', $newdate) ;
			} elseif(date ('D' , $newdate) == 'Sat') {
				$newdate = strtotime('-1 day', $newdate) ;
			}
			
			$newdate = date('Y-m-d', $newdate);

			$dateArr[] =  $newdate;
			//$table = $table . '<tr><td>'.$i.'</td><td>'.$amount_term.'</td><td>'.$newdate.'</td></tr>';

		$query = mysqli_query($mysqli, "insert into loans_payment_schedule(email,loan_id,payment_schedule,amount)values('$email','$id','$newdate','$amount_term')");
		}
		//$table = $table . '</table></div>';
		
		//echo $table;
if($query){ 
       //echo   
      //get next payment id
      $qg = mysqli_query($mysqli,"select id from loans_payment_schedule where loan_id ='$id' and email ='$email' and status ='unpaid' and payment_schedule = (SELECT MIN(payment_schedule) FROM loans_payment_schedule) "); 

      $idget = mysqli_fetch_array($qg);
      $next_payment_id = $idget['id'];

    $max = min(array_map('strtotime', $dateArr));
    $next_payment_date = date('Y-m-d', $max);

	$iquery = mysqli_query($mysqli,"insert into loan_disburse(email,loan_id,amt_borrowed,interest,total,loan_amount_term,frequency,next_payment_id,status)values('$email','$id','$amount','$amount_interest','$amount_total','$months','$freq','$next_payment_id','$status')");
    
	if($iquery){
		echo "done";
		//update loan schedule
		$getid = mysqli_insert_id($mysqli);

		mysqli_query($mysqli,"update loans_payment_schedule set loan_disburse_id = '$getid' WHERE email='$email' and loan_id = '$id' and status = 'unpaid'");
	}else{
		echo "Error occured while disbursing : ".$mysqli->error;
	}

}else{
	echo "Error occured: ".$mysqli->error;
}

/*}else{
	echo "Check for empty values";
}*/

//print_r($dateArr);

}

}else{
	echo "That email does not exist in the database. Please add member details before issuing loan.";
}

?>
