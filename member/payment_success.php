<?php
include("header.php");
include("top-header.php");
?>
<style>

.circle-loader {
  margin-bottom: 3.5em;
  border: 3px solid rgba(0, 0, 0, 0.2);
  border-left-color: #5cb85c;
  animation: loader-spin 1.2s infinite linear;
  position: relative;
  display: inline-block;
  vertical-align: top;
  border-radius: 50%;
  width: 7em;
  height: 7em;
}

.load-complete {
  -webkit-animation: none;
  animation: none;
  border-color: #5cb85c;
  transition: border 500ms ease-out;
}

.checkmark {
  display: none;
}
.checkmark.draw:after {
  animation-duration: 800ms;
  animation-timing-function: ease;
  animation-name: checkmark;
  transform: scaleX(-1) rotate(135deg);
}
.checkmark:after {
  opacity: 1;
  height: 3.5em;
  width: 1.75em;
  transform-origin: left top;
  border-right: 3px solid #5cb85c;
  border-top: 3px solid #5cb85c;
  content: "";
  left: 1.75em;
  top: 3.5em;
  position: absolute;
}

@keyframes loader-spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
@keyframes checkmark {
  0% {
    height: 0;
    width: 0;
    opacity: 1;
  }
  20% {
    height: 0;
    width: 1.75em;
    opacity: 1;
  }
  40% {
    height: 3.5em;
    width: 1.75em;
    opacity: 1;
  }
  100% {
    height: 3.5em;
    width: 1.75em;
    opacity: 1;
  }
}    
</style>




   <div class="nk-content nk-content-lg nk-content-fluid ">
                    <div class="container-xl wide-lg ">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">

                              <div align="center" style="margin-top: 20%;">

                                <div class="circle-loader">
                                  <div class="checkmark draw"></div>
                                </div>

                                <p><strong>Thank you for being part of our family at Akawo Community. Your payment was successful.</strong></p>

                              </div>






</div>
</div>
</div>
</div>

<?php

//if(isset($_POST['transId']) && !empty($_POST['reference'])){
$ref   = safe_input($mysqli,$_POST['transId']);
$reference = safe_input($mysqli,$_POST['reference']);
$email     = safe_input($mysqli,$_POST['email']);

//get buys details



$bquery = mysqli_query($mysqli,"SELECT last_name, first_name FROM customer_login WHERE email = '$email'");
$erow = mysqli_fetch_array($bquery);
$name = $erow['last_name'] .' '.$erow['first_name'] ;
//sending email

$to      = $email;
$from = 'hello@akawocommunity.com'; 
$fromName = 'Akawo Community'; 
 
$subject = "Your saving has been confirmed.";

$htmlContent .= '
<html> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
          <title>Akawo Community Savings</title> 
    </head> 
    <body> 
<p>Hello ' .$name. '</p>
<p>Thank you for being part of our family at Akawo Community! Your saving has been successfully confirmed. </p>
<p>
Below is your saving details:
</p>

<table class="table table-striped"  width="100%" cellpadding="0" cellspacing="0">

<tbody>
';

    $query = mysqli_query ($mysqli, "SELECT distinct * FROM saving_plans WHERE  email='$email' AND ref='$ref'" );
    while($order = mysqli_fetch_array($query))
        {    
        	 
        $htmlContent .= "<tr>
        
        <td>Saving Package</td><td class=leftstyle>".$order['saving_category']."</td><tr>
        <tr><td>Amount Saved</td><td class=rightstyle>".$order['amount_saved']."</td></tr>
        <tr><td>Payment Date</td><td class=rightstyle>".$order['created_date']."</td>
        
      </tr>";
    }

$htmlContent .= '</tbody></<table>
<p>Thank you.</p>
<p></p>
<p></p>
<p></p>
<p>Akawo Community Team.</p>
</body> 
</html>';


// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 

//$headers  ="From: billing@homeawayfromhomelagos.com";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail($to, $subject, $htmlContent, $headers,'-fhello@akawocommunity.com'); 



?>

    


<?php
include("footer.php");
?>

<script>
    $(document).ready(function(){
        $('.circle-loader').toggleClass('load-complete');
        $('.checkmark').toggle();
    });
</script>
