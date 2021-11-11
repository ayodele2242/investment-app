<?php 

require_once '../../inc/fetch.php';


if($_POST){

$name = $_POST['name'];
$addr = $_POST['email'];
$phone = $_POST['phone_number'];
$subject = $_POST['message'];
$msg = $_POST['msg_subject'];   
$site_name = $set['storeName'];
$link = $set['Email'];



$to = $link;	

        $message = "";
        $message .= '<html>
        <body>
        <div style="width:100%; background:rgba(255,0,0,0.1); padding:2px;">
		<p>Please attend to the following message from the member bellow.</p>
         <p>From ' .$name. '</p>
         <p>Email Address ' .$addr. '</p>
		<p>Phone Number: ' .$phone. '</p>
		<p></p>
		<p></p>
		<p></p>
		<p>'.$msg.'</p>
		<p></p>
		
		</div>
		</body>
		</html>';
		
		$from_mail = $name.'<'.$addr.'>';

       
		
		$from = $from_mail;
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Create email headers
		$headers .= 'From: '.$from."\r\n".
			'Reply-To: '.$from."\r\n" .
			'X-Mailer: PHP/' . phpversion();	
			
  
if(mail($to, $subject, $message, $headers)){
	echo "success";
}
else{
echo "Email sending failed. Try again.";	
}


 }


?>