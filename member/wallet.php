<?php
include("header.php");
include("top-header.php");


?>

<div class="nk-content nk-content-lg nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-inner">
                            <div class="nk-content-bodys">
                                <div class="nk-block-head text-center">
                                    <div class="nk-block-head-content">
                                        
                                        <div class="nk-block-head-content">
                                            <h2 class="nk-block-title fw-normal">My Wallet</h2>
                                            <div class="nk-block-des">
                                                <!--<p>You can cashout from your wallet whenever you wish.</p>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-block row">
                                    
<?php

//$plans = getPlans()
//DO NOT limit this query with LIMIT keyword, or...things will break!
$querys = "
SELECT total_saved as savings FROM savings_total where email='$email'";
$getifs = mysqli_query ($mysqli, $querys);
$srow = mysqli_fetch_array($getifs);

$lquerys = mysqli_query ($mysqli,"SELECT sum(amt) as refAmt FROM referral WHERE referred_by='$refCode' AND user_made_pament='1' AND payment_status = 'unpaid'");
$lrow =   mysqli_fetch_array($lquerys);   

$date = $get['lock_period'];
//$date1 = strtr($date, '/', '-');
$mainDate = date('Y-m-d H:i', strtotime($date));


$today = date("Y-m-d H:i"); 

$startdate = $mainDate;   
$offset = strtotime("+1 day");
$enddate = date($startdate, $offset);    
$today_date = new DateTime($today);
$expiry_date = new DateTime($enddate);



$now = time(); // or your date as well
$your_date = strtotime($date);
$datediff = $your_date-$now;

$gdate =  round($datediff / (60 * 60 * 24));

//$currentgrowthrate = $get['Amt_to_get']/$gdate;


?>


<div class="col-lg-6 mb-3 animated fadeIn border-radius">

 <div class="card shadow">
    <div class="plan-item-head">
        <div class="plan-item-heading">
            <h2 class="plan-item-title card-title title">Savings</h2>
        </div>
        <div class="plan-item-summary card-text">
            <div class="row">
                <div class="col-12">
                  <h3>
                    <?php
                    if($srow['savings'] == ""){
                      echo "0 ₦ ";
                    }else{
                     echo number_format($srow['savings'],2) .' ₦ ';
                     }  

                     ?>
                   </h3>
                    <span class="sub-text">Total savings</span>
                </div>
                
               
            </div>
        </div>
        <div class="card-action align-item-right mt-3"> 
            <?php
            if ($expiry_date > $today_date) { 
            ?>
            <!--<a href="#" class="waves-effect waves-light btn btn-default btn-success-inactive disabled col-white">Cashout</a>-->
           
          <?php } ?>
             

          </div>
    </div>
   
</div>


</div>

<div class="col-lg-6 mb-3 animated fadeIn border-radius">
 <div class="card shadow">
    <div class="plan-item-head">
        <div class="plan-item-heading">
            <h2 class="plan-item-title card-title title">Referral Balance</h2>
        </div>
        <div class="plan-item-summary card-text">
            <div class="row">
                <div class="col-12">
                  <h3>
                    <?php
                    if($lrow['refAmt'] == "" || $lrow['refAmt'] == "0"){
                      echo "0 ₦ ";
                    }else{
                     echo number_format($lrow['refAmt']) .' ₦ ';
                     }
                    
                     ?>
                   </h3>
                   <span class="sub-text">Total referred amount earned</span>
                   <?php  
                   if($lrow['refAmt'] != "" && $lrow['refAmt'] != "0"){
                   ?>
                     <a href="#" data-toggle="modal" data-target="#modalWithdraw" class="btn btn-white btn-warning">Cashout &nbsp;<ion-icon class="icon" name="cash-outline"></ion-icon></a>
                  <?php } ?>     
                </div>
                
               
            </div>
        </div>
        <div class="card-action align-item-right mt-3"> 
           
          </div>
    </div>  
</div>
</div>
                          


                </div>
            </div>
        </div>
    </div>
</div>

  

<div class="modal fade zoom" tabindex="-1" id="modalWithdraw">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                <ion-icon class="icon" name="wallet"></ion-icon> Referred Amount Cashout</h5>
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <ion-icon name="close"></ion-icon>
            </a>
        </div>
        <div class="modal-body" id="pass-con">
            <div class="alert alert-warning">
              You can withdraw your referred cash or move it to your wallet
             </div>
          <form id="cashOutForm">
           
            <div class="col-lg-12">
                
                <?php  
                $querys = "
                SELECT SUM(amt) as amount FROM referral WHERE referred_by = '$refCode' AND user_made_pament='1' AND payment_status = 'unpaid'";
                $getifs = mysqli_query ($mysqli, $querys);
                $srow = mysqli_fetch_array($getifs);
                $myamt = $srow['amount'];
                
                ?>

                 <p>You are about to cashout   <b><?php echo number_format($myamt);  ?></b></p> 
                 <input type="hidden" name="cashoutAmt" value="<?php echo $myamt;  ?>">
                 <input type="hidden" name="email" value="<?php echo $email;  ?>">
                 <input type="hidden" name="refCode" value="<?php echo $refCode;  ?>">
                     
           </div>
            <div class="col-lg-12">
                <div class="row">
                <?php if($myamt > 0){ ?>
                <div class="col-lg-12">
                <div align="center">
                <button class="btn btn-sm btn-warning" id="cashOutBtn">Cashout</button>
                <!--<button class="btn btn-sm btn-info" id="walletBtn">Send to Wallet</button>-->
                </div>
                </div>
                <?php }else{ ?>
                <div align="center" class="alert alert-danger">You do not have enough cash to be able to cashout</div>
                <?php } ?>
                </div>
            </div>
         
          </form>
           
        </div>
        
    </div>
</div>
</div>



<?php
include("footer.php");
?>

<script type="text/javascript">
 $("#cashOutBtn").click(function(e) {
      e.preventDefault();
      $("#cashOutBtn").html("Processing");
       var serializedData = $("#cashOutForm").serialize();
       $.ajax({
            type : 'POST',
            url  : '../inc/payment/moneyCashout.php',
            data : serializedData,
            success :  function(data)
            {
                if(data == 1)
                {

                   $.toast({ 
                      text : 'We have received your request. We will get back to you.', 
                      showHideTransition : 'fade',
                      bgColor : 'green',            
                      textColor : '#fff',
                      allowToastClose : false,
                      hideAfter : 4000,
                      loader: false,            
                      stack : 5,                     
                      textAlign : 'center', 
                      position : 'top-right'  
                  });
                  $("#cashOutBtn").html("Cashout");
                  location.reload();
                  
                }else{
                    
                  $("#cashOutBtn").html("Cashout");
                  $.toast({ 
                      text : data, 
                      showHideTransition : 'fade',
                      bgColor : 'red',            
                      textColor : '#fff',
                      allowToastClose : false,
                      hideAfter : 4000,
                      loader: false,            
                      stack : 5,                     
                      textAlign : 'center', 
                      position : 'top-right'  
                  });

                  
                    

                }
            }
        });
        return false;
      
      
 });
     
    </script>

