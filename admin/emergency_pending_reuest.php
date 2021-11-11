<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["EMERGENCY WITHDRAWAL"]["PENDING REQUEST"]["create"]) || 
authorize($_SESSION["access"]["EMERGENCY WITHDRAWAL"]["PENDING REQUEST"]["edit"]) || 
authorize($_SESSION["access"]["EMERGENCY WITHDRAWAL"]["PENDING REQUEST"]["view"]) || 
authorize($_SESSION["access"]["EMERGENCY WITHDRAWAL"]["PENDING REQUEST"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

include("left_nav.php");
?>


    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-blue-grey-blue gradient-shadow"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">people</i> EMERGENCY WITHDRAWALs</h4>
              </div>
             
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
      <div class="card-content gradient-shadow">
            
    <div class="row">
        <div class="col s12 refresh">

           <div class="switch" style="padding: 10px; margin-bottom: 10px;"> 
            Account Status Indicator: 
    <label>
       <i class="text-green">Activated</i>
      <input type="checkbox" checked disabled>
      <span class="lever"></span>
    </label>
     <label>
     De-activated
      <input disabled type="checkbox">
      <span class="lever"></span>
  
    </label>

  </div>

     <table class="table_view">
       <thead>
       <th>Name</th>
       <th>Email</th>
       <th>Phone</th>
       <th>Amount</th>
       <th>Status</th>
        <th></th>
       </thead>
       <tbody class="refresh">
       <?php  
       $row = getPendingEmergency();
       foreach($row as $rows){
        $name = $rows['last_name']. ' '.$rows['first_name'];
        ?> 
        <tr class="animated fadeIn">

        <td><?php echo ucwords($rows['last_name']. ' '.$rows['first_name']); ?></td>
        <td><?php echo ucwords($rows['email']); ?></td>
        <td><?php echo $rows['phone']; ?></td>
        <td><?php echo number_format($rows['amount']); ?></td>
        <td><?php echo $rows['estatus']; ?></td>
      
        <td class="tbtn"> 
          <!--<button id="<?php //echo  $rows['u_rolecode']; ?>" class="btn btn-floating uwithdrawal btn-small waves-effect waves-light orange z-depth-3"  ><i class="material-icons left">supervisor_account</i></button>-->
           <?php 
           if (authorize($_SESSION["access"]["EMERGENCY WITHDRAWAL"]["PENDING REQUEST"]["edit"])) {
           if($rows['estatus'] == "Pending"){
           ?>
          <a href="#Withdraw-modal" data-email="<?php echo $rows['email']; ?>" data-bankCode="<?php echo $rows['bank_code']; ?>" data-acname="<?php echo $rows['account_name']; ?>" data-acNo="<?php echo $rows['account_number']; ?>" data-name="<?php echo $name; ?>" data-amt="<?php echo $rows['amount']; ?>" id="<?php echo $rows['wid']; ?>" class="btn btn-small waves-effect waves-light green z-depth-3 btn-small WLmodal modal-trigger " type="button" title="Send Money"><i class="material-icons left">send</i> Send Money</a>
        <?php 
           }else{
               ?>
               <a href="#otp-modal" data-ref="<?php echo $rows['ref']; ?>" data-transcode="<?php echo $rows['transfer_code']; ?>"  class=" otPmodal modal-trigger " title="Validate Otp"><i class="material-icons left">pin</i> Go to paystack dashboard to confirm otp </a>
       
               
               <?php
           }
        } 
        
        ?>
         
        </td>
        </tr>

        <?php
        }
        ?>
       </tbody>


     </table>       
            
                   
        </div>
    </div>

                        
</div>
</div>
</div>
</div>
</div>
</div>


<?php include("right_menu.php"); ?>
         
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

  

 <div id="Withdraw-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header" id="tite-info"></div>
           <!-- mysql data will be load here -->                          
           <div id="contents">
               <div class="row roe-ibody">
                   <div class="col l12" id="amtDetail"></div>
                   <div class="col l12 mt-2" id="toAc"></div>
                   <div class="col l12  " id="bankname"></div>
                   <div class="col l12  mb-3" id="repCode"></div>
                   
                   
                   
               </div>
               <form id="paymentForm">
                   <input type="hidden" name="rname" value="" id="rname">
                   <input type="hidden" name="pid" value="" id="pid">
                   <input type="hidden" name="amount" value="" id="amount">
                   <input type="hidden" name="email" value="" id="iemail">
                   <input type="hidden" name="acno" value="" id="acno">
                   <input type="hidden" name="bankcode" value="" id="bankcode">
                   <input type="hidden" name="recipientCode" value="" id="recipientCode" readonly>
                   <div align="center" class="mt-5">
                   <button class="btn btn-block" id="sendMoney">Process</button>
                   <button class="btn btn-block" id="tranferMoney">Send Money</button>
                   
                   </div>
                   
               </form>
               
                 <form id="otpForm">
                   <input type="text" placeholder="Enter otp" name="otp" value="" id="otp" >
                   
                   <input type="hidden" name="transfer_code" value="" id="itransfer_code">
                   <input type="hidden" name="ref" value="" id="iref">
                   
                   <div align="center" class="mt-5">
                   
                   <button class="btn btn-block" id="confirmOPT">Confirm OTP</button>
                   
                   </div>
                   
               </form>
                <div class="row">
               <div class="col l12 mt-4 mb-3" id="resp"></div>
               </div>
               
           </div>
    </div>
    
  </div>
  
   <!--<div id="otp-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header" id="itite-info"></div>
                                  
           <div id="contents">
              
               <form id="paymentForm">
                   <input type="text" placeholder="Enter otp" name="otp" value="" id="otp" >
                   
                   <input type="text" name="transfer_code" value="" id="itransfer_code">
                   <input type="text" name="ref" value="" id="iref">
                   
                   <div align="center" class="mt-5">
                   
                   <button class="btn btn-block" id="tranferMoney">Confirm OTP</button>
                   
                   </div>
                   
               </form>
                <div class="row">
               <div class="col l12 mt-4 mb-3" id="resp"></div>
               </div>
               
           </div>
    </div>
    
  </div>-->
    


<?php
include("footer.php");
?>

<script type="text/javascript">
//Get EMERGENCY WITHDRAWAL's details and update data
$(document).ready(function(){
    $("#tranferMoney").hide();
    $("#otpForm").hide();
    $(".WLmodal").click(function() {
     
     var id = $(this).attr('id');
     var amt = $(this).attr('data-amt');
     var email = $(this).attr('data-email');
     var name = $(this).attr('data-acname');
     var ac_no = $(this).attr('data-acNo');
      var backcode = $(this).attr('data-bankCode');
     
     $("#amount").val(amt);
     $("#iemail").val(email);
     $("#acno").val(ac_no);
     $("#bankcode").val(backcode);
     $("#rname").val(name);
      $("#pid").val(id);
     
     
     
    $("#tite-info").html('<div class="card alert-default pl-3"><h6>You are about to send money to <b>'+name+'</b></h6></div>');
    $("#amtDetail").html('Amount Sending: <b>'+amt+'</b></div>');
    
    
    
   
 
    });

});

$(document).ready(function(){
    
    $("#sendMoney").click(function(e) {
        e.preventDefault();
     
    $("#sendMoney").html("Creating Recipient");
    $("#sendMoney").prop("disabled",true);
    var serializedData = $("#paymentForm").serialize();
    
          $.ajax({
            type : 'POST',
            url  : '../inc/payment/transfer_recipient.php',
            data : serializedData,
            success: function (data) {
             
            var datas = JSON.parse(data);

            if(datas.success == true){
                

              //document.location.href="payment_done?reference="+datas.ref+"&transId="+datas.transId+"&email="+datas.email;
                var acno = $("#acno").val();
                
                $("#recipientCode").val(datas.recipient_code);
                
                $('#repCode').html('<h6>Recipient Code: <b class="text-info">'+datas.recipient_code+'</b></h6>');
                $('#toAc').html('<h6>Account Number: <b class="text-info">'+acno+'</b></h6>');
                 $('#bankname').html('<h6>Bank Name: <b class="text-info">'+datas.bank_name+'</b></h6>');
                $('#resp').html('<h6><strong class="text-success">Transfer recipient created, you can now transfer money to this account</strong></h6>');
                
               //$('#CardPayment').html("Send Money");
                //$("#CardPayment").prop("disabled",false);
                
                $("#tranferMoney").addClass("btn-success").show();
                $("#sendMoney").hide();

            }else{
              $('#sendMoney').html("Try Again");
               $("#sendMoney").prop("disabled",false);
               $('#resp').html('<h6><strong class="text-danger">Error creating transfer recipient</strong></h6>');
         
            }


            }
        });
        return false;
    
   

    });
    
    
        $("#tranferMoney").click(function(e) {
        e.preventDefault();
     
    $("#tranferMoney").html("Processing");
    $("#tranferMoney").prop("disabled",true);
    var serializedData = $("#paymentForm").serialize();
    
          $.ajax({
            type : 'POST',
            url  : '../inc/payment/sendMoney.php',
            data : serializedData,
            success: function (data) {
             
            var datas = JSON.parse(data);

            if(datas.success == true){
                $(".roe-ibody").hide();
              	$("#resp").html('<div class="card card-success pr-3">Transfer has been queued.<br/>Please go to paystack dashboard and enter otp or enter here...</div>').show();
                $("#tite-info").html('<div class="card alert-default pl-3"><h6>Processing transaction</b></h6></div>');    
             // setTimeout(' window.location.href = "emergency_pending_reuest"; ',30000);
             $("#itransfer_code").val(datas.transfercode);
              $("#iref").val(datas.ref);
              
               $("#otpForm").show();
               $("#paymentForm").hide();
             

            }else{
              $('#tranferMoney').html("Try Again");
               $("#tranferMoney").prop("disabled",false);
               $('#resp').html('<h6><strong class="text-danger">'+datas.message+'</strong></h6>');
         
            }


            }
        });
        return false;
    
   

    });

});



$(document).ready(function(){
   
        $("#confirmOPT").click(function(e) {
        e.preventDefault();
     
    $("#confirmOPT").html("Confirming OTP");
    //$("#confirmOPT").prop("disabled",true);
    var serializedData = $("#otpForm").serialize();
    
          $.ajax({
            type : 'POST',
            url  : '../inc/payment/otpConfirm.php',
            data : serializedData,
            success: function (data) {
             
            var datas = JSON.parse(data);

            if(datas.success == true){
            
              
               $("#otpForm").hide();
               $("#paymentForm").hide();
                $("#tite-info").hide();   
               $('#resp').html('<h4 class="col-green"><span class="material-icons">check_circle_outline</span> Money sent</h4> <br/>Please wait while we close the transaction.');
               
               setTimeout(' window.location.href = "emergency_pending_reuest"; ',20000);
             

            }else{
              $('#tranferMoney').html("Try Again");
               //$("#tranferMoney").prop("disabled",false);
               $('#resp').html('<h6><strong class="col-green">'+datas.message+'</strong></h6>');
         
            }


            }
        });
        return false;
    
   

    });

});


</script>

