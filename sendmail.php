<?php

// getting variables from form

if(empty($_POST['title']) && empty($_POST['name']) && empty($_POST['mail']) && empty($_POST['message']) ){
	echo 'All inputs are required';
}else{

$emailTo = "info@akawocommunity.com";
$subject = trim($_POST['title']);;
$name = trim($_POST['name']);
$emailFrom = trim($_POST['mail']);
$message = $_POST['message'];

// prepare email body text

$Body = "You have a message from: ";
$Body .= $name;
$Body .= "\n";
$Body .= "\n";
$Body .= $message;

// send prepared message

$sent = mail($emailTo, $subject, $Body);

//callback for jQuery AJAX

if ($sent){
  echo 'sent';
}
else{
	echo 'Error sending mail. Please try again';
}

}
?>