<?php
require 'inc/config.php';


   $query = mysqli_query($mysqli,"SELECT DISTINCT c.*, ld.amt_borrowed, ld.interest,ld.total, ld.id as aloan_id, m.name, m.phone, l.name as loan_type,l.duration FROM loan_disburse ld INNER JOIN members m ON m.email = ld.email INNER JOIN loans_packages l ON l.id = ld.loan_id INNER JOIN loans_payment_schedule c ON c.loan_id =ld.loan_id INNER JOIN ( SELECT MIN(payment_schedule) maxDate FROM loans_payment_schedule WHERE status='unpaid' ) b ON c.payment_schedule = b.maxDate WHERE ld.status = 'active'");



    $count = mysqli_num_rows($query);


    if($count < 1){
    	while( $row = mysqli_fet_array($query)){
         $email = $row['email'];
         $loan_id = $row['loan_id'];

    	mysqli_query($mysqli,"UPDATE loan_disburse SET status = 'paid' WHERE email = '$email' and loan_id = '$loan_id' and status='active' ");

    }

    }


?>