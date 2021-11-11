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
                                            <h2 class="nk-block-title fw-normal">Savings Plans</h2>
                                             <?php if($acno == ""){ ?>
                                <div class="nk-block">
                                    <div class="nk-news card card-bordered alert alert-danger">
                                        <div class="card-inner">
                                            <div class="nk-news-list">
                                                <a class="nk-news-item" href="#">
                                                    <div class="nk-news-icon">
                                                        <ion-icon class="icons" name="information-circle-outline"></ion-icon>
                                                    </div>
                                                   
                                                    <div class="nk-news-text">
                                                        
                                                           Your bank info need to be updated before you can use this platform. Go to your profile page to update your info.
                                                      
                                                        
                                                    </div>
                                                

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                            <div class="nk-block-des nk-news card card-bordered alert alert-default">
                                                <p>Here are list of our savings plans. Select your preferred plans and start saving. We will automatically deduct the money from your account based on the plan you subscribe to.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-block row">

                                    
                                 <?php

//$plans = getPlans()
//DO NOT limit this query with LIMIT keyword, or...things will break!
$querys = "SELECT * FROM saving_packages where status='active' order by id desc";
$getifs = mysqli_query ($mysqli, $querys);

if(mysqli_num_rows($getifs) < 1){
   echo '<div class="col-lg-12 col-md-6 s12 alert alert-danger" style="text-align:center; padding: 7px; font-weight:bolder;">Nothing here at the moment. Please check back later.</div>';
}else{

 //these variables are passed via URL
$limits = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 6; //list per page
$pages = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1; //starting page
$links2 = 10;

$paginators = new Paginator($mysqli, $querys ); //__constructor is called
$results2 = $paginators->getData( $limits, $pages );
     
for ($ps = 0; $ps < count($results2->data); $ps++):
//store in $get variable for easier reading
$get = $results2->data[$ps]; 




$myimg  = $set['installUrl'].'assets/img/farm.png';

?>

<div class="col-lg-4 mb-3 animated fadeIn border-radius">

 <div class="card shadow">
   <!-- <img src="<?php //echo $myimg; ?>" class="card-img-top" alt="">-->
    <div class="plan-item-head">
        <div class="plan-item-heading">
            <h4 class="plan-item-title card-title title"><?php echo $get['category'];  ?></h4>
            <h3 class="text-info text-bolder"><?php echo '₦'.number_format($get['amount']);  ?></h3>
        </div>
        <div class="plan-item-summary card-text">
            <div class="row">
                <div class="col-lg-12"><strong><?php echo ucwords($get['duration']);  ?></strong> Contribution</div>
                
            </div>
        </div>
        <div class="card-action align-item-right mt-3">

            <?php if($acno != ""){ ?>

           <a href="#" data-toggle="modal" data-target="#mymodal" id="<?php echo $get['id']; ?>" data-email="<?php echo $email; ?>" data-duration="<?php echo $get['duration']; ?>"  data-amt="<?php echo $get['amount']; ?>" data-track-amt="<?php echo $get['amount']; ?>" data-cat="<?php echo $get['category']; ?>" data-name="<?php echo $name; ?>"  class="waves-effect waves-light btn btn-info col-white investme modal-trigger">Save</a>

         <?php } ?>

          </div>
    </div>
   
</div>


</div>
<?php
 endfor;
//} 
 echo '<div class="col-lg-12 l12 mt-5">';
echo $paginators->createLinks( $links2, 'pagination pagination-lg justify-content-center' );
echo '</div>';
}
?>
                                   


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

  


   <div class="modal fade zoom" tabindex="-1" id="mymodal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title bidtitle"></h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <ion-icon class="icon" name="close"></ion-icon>
                        </a>
                    </div>
                     <form id="reinvestForm">
                    <div class="modal-body">
                 <div class="row">
                  <div class="col-lg-12 alert alert-info mb-3 text-bolder">
                    You can increase the amount to save on this plan but can't go below this amount.
                    </div>
                    <div class="col-lg-12 mt-2 mb-2" id="msgs"></div>
                  <div class="input-field row">
                  <div for="first_name" class="col-lg-6 col-sm-12">
                  Minimum Amount to save
                  </div>
                  <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <div class="form-text-hint">
                                <span class="overline-title">₦</span>
                            </div>
                            <input type="text" class="form-control" id="mainAmt" name="amount" placeholder="Minimum Amount to Invest">
                        </div>
                    </div>
                </div>

                 </div>

                


                      <div class="col s12">
                         <input type="hidden" id="id" name="id">
                         <input type="hidden" id="name" readonly="" name="name">
                         <input type="hidden" id="plan" readonly="" name="plan">
                         <input type="hidden" id="email" readonly="" name="email">
                         <input type="hidden" id="duration" name="duration">
                         <input type="hidden" id="trackamount" >
                      </div>
                    </div>
                    </div>

                    <div class="col-lg-12 mt-2 mb-4">
                   <div class="col-lg-12 col-sm-12">
                     <div class="form-group">
                      <div class="datepicker-toggle">
                      <!--<span class="datepicker-toggle-button"></span>-->
                      <!--<input type="date" class="datepicker-input form-control">-->
                    </div>
                     
                      <!--<input type="date" class="form-control" id="expDates" placeholder="Target Period (Date you wish to withdraw your savings)" name="saving_perios" >-->
                    </div>
                </div>
               </div>
                <div class="col-lg-12 mt-2 mb-4"></div>

                   <div class="col s12">

                  <div style="clear:both;"></div>

                  <p class="col-grey pl-3 mt-3"><h5>Select your payment method.</h5></p>

                  <div class="row bg-white col-grey pt-1 pb-1 mb-1">
                  <div class="col-1 mr-1">
                  <div class="radio  iradio-pay" style="border: solid 1px #0099CC;" data-toggle="tooltip" data-placement="top" title="">
                  <label class="checkLabel" >
                  <input type="radio" name="payment_method" class="colors" style="background: #9933CC"   value="pay_on_delivery" onclick="show1();"/>
                  <span class="text">
                        
                  </span>
                  </label>
                  </div> 
                  </div>

                  <div class="col-10">     
                  <h6>Pay with New Card</h6>
                  </div>
                  </div><!--On delivery #end-->
                 <?php if(!empty($card['last4'])){ ?>
                  <div class="row bg-white col-grey pt-1 pb-1 mb-3">
                  <div class="col-1 mr-1">
                  <div class="radio  iradio-pay" style="border: solid 1px #0099CC;" data-toggle="tooltip" data-placement="top" title="">
                  <label class="checkLabel" >
                  <input type="radio" name="payment_method" class="colors" style="background: #9933CC"   value="credit_card" onclick="cardPay();"/>
                  <span class="text">
                        
                  </span>
                  </label>
                  </div> 
                  </div>

                  <div class="col-6">     
                   <div class="credit-card visa selectable">
                      <div class="credit-card-last4">
                          <?php if(!empty($card['last4'])){ echo $card['last4']; }  ?>
                      </div>
                      <!--<div class="credit-card-expiry">
                          <?php //if(!empty($card['exp_year'])){ echo $card['exp_year']; }  ?>/<?php //if(!empty($card['exp_month'])){ echo $card['exp_month']; }  ?>
                      </div>-->
                  </div>
                  </div>

                  </div>
                  <?php } ?>

                  <div id="cardPay" class="hide col-grey">

                  </div>

                  
                  <!--<div class="form-group justify-content-between align-items-center col-grey">
                  <img src="<?php //echo $set['installUrl'] ?>assets/img/paystack-wc.png">
                  </div>-->
                    
                                  
                  </div>


                    <div class="modal-footer bg-light">
                      <div class="form-group justify-content-between align-items-center">
                      <button id="delivery_btn" class="btn btn-info hide invest">Use New Card</button>
                      <button id="pay-now" class="btn btn-info hide">Debit My Card</button>
                    </div>

                        <!--<button class="btn btn-info col-white waves-effect waves-light right invest" type="submit">Start Saving</button>-->
                    </div>
                    </form>
                </div>
            </div>
        </div> 

<?php
include("footer.php");
?>

<script type="text/javascript">

      $(".investme").click(function(e) {
      e.preventDefault();

       var id              = $(this).attr('id'); // get id of clicked row 
       var email           = $(this).attr("data-email"); 
       var duration        = $(this).attr("data-duration"); 
       var amt             = $(this).attr("data-amt"); 
       var totAmt          = $(this).attr("data-total");  
       var cat             = $(this).attr("data-cat");
       var name            = $(this).attr("data-name");
       var track_amt       = $(this).attr("data-track-amt");
       
//alert(totAmt);



       $("#id").val(id);
       $(".bidtitle").html("You are about to subscribe to <b>"+cat+"</b>");
       $("#name").val(name);
       $("#plan").val(cat);
       $("#email").val(email);
       $("#duration").val(duration);
       $("#amt").val(totAmt);
       $("#mainAmt").val(amt);
       $("#trackamount").val(track_amt);




  $( ".iradio-pay input:radio" ).on( "change", function() {
  $('.iradio-pay input:not(:checked)').parent().removeClass("color-active");
  $('.iradio-pay input:checked').parent().addClass("color-active");
 });
    });



  function show1(){
  document.getElementById('cardPay').style.display ='block';
  $("#pay-now").hide();
  $("#delivery_btn").show();
  $("#default_btn").hide();
}
function cardPay(){
  document.getElementById('cardPay').style.display = 'block';
  $("#pay-now").show();
  $("#delivery_btn").hide();
  $("#default_btn").hide();
}




 $("#pay-now").click(function(e) {
      e.preventDefault();
      $("#pay-now").html("Processing payment");
       var serializedData = $("#reinvestForm").serialize();
       $.ajax({
            type : 'POST',
            url  : '../inc/payment/cardPayment.php',
            data : serializedData,
            success :  function(data)
            {
                var datas = JSON.parse(data);
                $('#pay-now').html("Finalizing Payment");
                if(datas.status == 'success' ){
                    
            $.ajax({
            url: 'cardpayment_success.php',
            method: 'post',
            async:false,
            data:{reference: datas.ref, email: datas.email, amount: datas.amount, plan: datas.plan, id: datas.id},
            success: function (data) {
             
                if(data == 1){
                    $.toast({ 
                      text : 'Payment successful', 
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

             
                $('#pay-now').html("Debit My Card");
                setTimeout(' location.reload(); ',600);

            }else{
              $('#pay-now').html("Debit My Card");
               $.toast({ 
              text : '<b><ion-icon name="sad"></ion-icon> &nbsp;'+data+'</b>', 
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

                }else{
                 $("#pay-now").html("Debit My Card");
                  $.toast({ 
                      text : datas.message, 
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







const myDatePicker = MCDatepicker.create({ 
      el: '#expDate',
      dateFormat: 'MMM-DD-YYYY',
})
    </script>