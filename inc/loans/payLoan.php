
<?php
 require_once '../config.php';

 
 if (isset($_REQUEST['id'])) {
   
 $id = intval($_REQUEST['id']);
 $loanid = $_REQUEST['loanid'];
 $email = $_REQUEST['email'];
 $date = date("Y-m-d");

 $query = mysqli_query($mysqli,"UPDATE loans_payment_schedule SET payment_date='$date', status = 'paid' WHERE id='$id'");
 
  if($query){
  	echo 1;

  	$query = mysqli_query($mysqli,"SELECT DISTINCT c.*,  ld.amt_borrowed, ld.interest,ld.total, ld.id as aloan_id,
    m.name, m.phone, l.name as loan_type,l.duration 
    FROM loan_disburse ld
    INNER JOIN members m ON m.email = ld.email
    INNER JOIN loans_packages l ON l.id = ld.loan_id
    INNER JOIN loans_payment_schedule c ON c.loan_id =ld.loan_id
      INNER JOIN
    (
        SELECT  MIN(payment_schedule) maxDate
        FROM loans_payment_schedule WHERE status='unpaid'
        
    ) b ON 
            c.payment_schedule = b.maxDate
    WHERE ld.status = 'active' and c.loan_id='$loanid' and c.email='$email'");

    $count = mysqli_num_rows($query);
    if($count < 1){
    	mysqli_query($mysqli,"UPDATE loan_disburse SET status = 'paid' WHERE email = '$email' and loan_id = '$loanid' and status='active' ");
    }



  }else{
  	echo "Error occured: ".$mysqli->error;
  }
}



 ?>