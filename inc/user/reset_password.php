<?php 

require_once("../../config/config.php");
require_once("../functions.php");
  
  if($_POST['email']!=""){

    $email=safe_input($mysqli,$_POST['email']);
      $db_check=$mysqli->query("SELECT * FROM customer_login WHERE email='$email'");
      $count=mysqli_num_rows($db_check);

      if($count==1){
         $row=mysqli_fetch_array($db_check);

         $yourPass = decryptIt($row['password']);
         $name = $row['last_name']. ' ' . $row['first_name'];
                
         $to="$email"; //mail address
         $strSubject="Buildit | Password Recovery Link";
         $message = '<p>Hello '. $name.'</p>' ;  
         $message = '<p>You requested for your password. Please find it below.</p>' ;  
         $message = '<p>Password '. $yourPass.'</p>' ;   
         $message = '<p></p>';
         $message = '<p></p>' ;
         $message = '<p></p>' ;
         $message = '<p>Buildit Security Team.</p>' ;          
         $headers = 'MIME-Version: 1.0'."\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
         $headers .= "From: security@buildit.com.ng";            
         $mail_sent=mail($to, $strSubject, $message, $headers);  
          if($mail_sent) { 
            echo 1; 
          }else{
           echo  "Email failed to send. Please try again.";  
          }
          
       }else{
        echo 'Invalid email id. Please check your email id.';
       }



  }else{
    echo "Please enter your email.";
  }

?>

