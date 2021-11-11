<!--Load user info-->
<div class="modal fade zoom" tabindex="-1" id="profile-edit">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Personal Information</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <ion-icon name="close"></ion-icon>
                </a>
            </div>
            <div class="modal-body">
               <div id="contents"></div>
            </div>
            
        </div>
    </div>
</div>


<!--Load Next of kin info-->
<div class="modal fade zoom" tabindex="-1" id="nextofkin">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Next of Kin's Information</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <ion-icon name="close"></ion-icon>
                </a>
            </div>
            <div class="modal-body">
               <div id="nokcontents"></div>
            </div>
            
        </div>
    </div>
</div>


<!--Password update-->
<div class="modal fade zoom" tabindex="-1" id="modalPass">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><ion-icon class="icon" name="lock-closed"></ion-icon> Password Update</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <ion-icon name="close"></ion-icon>
                </a>
            </div>
            <div class="modal-body" id="pass-con">
              <form id="updatePassForm">
               <table class="table table-ulogs table-borderless">
              <tbody>
               <tr>
               <th>Old Password</th>
               <td><input type="password" class="form-control" name="old_password" value="" ></td>
               </tr>
               <tr>
               <th>New Password</th>
               <td><input type="password" class="form-control" name="new_password"></td>
               </tr>
               <tr>
               <th>Confirm Password</th>
               <td>
                <input type="password" class="form-control" name="con_password">
              </td>
               </tr>
               
               <tr>
              <td colspan="10"><div align="center"><button type="button" id="iupdateIt" class="btn btn-default btn-sm col-white">Update</button> </div></td>
               </tr>
               </tbody> 
               </table>
              <input type="hidden" name="pass_id" id="pass_id" value="<?php if(!empty($row['id'])){ echo $row['id']; } ?>">
              </form>
               
            </div>
            
        </div>
    </div>
</div>





 
<div class="nk-footer nk-footer-fluid bg-lighter">
                    <div class="container-xl wide-lg">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright">
                                &copy;<?php echo date("Y"). ' '. ucwords($set['storeName']); ?>
                            </div>
                            <div class="nk-footer-links">
                               <!-- <ul class="nav nav-sm">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Terms</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Privacy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Help</a>
                                    </li>
                                </ul>-->
                            </div>
                        </div>
                    </div>
                </div>

    </dv><!--nk-wrap end-->
 </dv><!--App root end-->
        <!-- jquery, popper and bootstrap js -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    
    <script src="assets/js/popper.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="vendor/bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <script src="vendor/swiper/js/swiper.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/datepicker.js"></script>

    <script type="text/javascript" src="assets/js/jquery.toast.js"></script>
    <!-- Ionicons -->
    <script type="module" src="node_modules/ionicons/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="node_modules/ionicons/dist/ionicons/ionicons.js"></script>
     <script src="../assets/default/main/js/dropify.min.js"></script>
      <script src="../assets/default/main/js/form-file-uploads.js"></script>
    <script src="../assets/default/main/js/fileinput.min.js"></script>
     <script src="https://js.paystack.co/v1/inline.js"></script>
    
     <!-- template custom js -->
    <script src="assets/js/scripts.js"></script>
     <script src="index.js"></script>

    <script type="text/javascript">
    
    $(document).ready( function () {
    $('.table').DataTable();
   });

/*      const textInput = document.querySelector('.text-input');
const dateInput = document.querySelector('.datepicker-input');
dateInput.addEventListener('change', event => {
  textInput.value = event.target.value;
  event.target.value = '';
});*/

    
    String.prototype.trim = function() {
    try {
        return this.replace(/^\s+|\s+$/g, "");
    } catch(e) {
        return this;
    }
}

      $(document).ready(function() {

        function format(n, sep, decimals) {
        sep = sep || "."; // Default to period as decimal separator
        decimals = decimals || 2; // Default to 2 decimals

        return n.toLocaleString().split(sep)[0]
            + sep
            + n.toFixed(decimals).split(sep)[1];
       }

   $(".invest").click(function(e) {
      e.preventDefault();

      $('#delivery_btn').html("Requesting");

      
       var id              = $("#id").val();
       var name            = $("#name").val();
       var cat             = $("#plan").val();
       var email           = $("#email").val();
       var duration        = $("#duration").val(); 
       var amttoInvest     = $("#mainAmt").val();
       var trackamount     = $("#trackamount").val();
       var expDate         = $("#expDate").val();


   if(amttoInvest == ""){
        $.toast({ 
            text : 'Amount to Save can not be empty.', 
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

        $('#delivery_btn').html("Use New Card");

   }else if(parseInt($("#mainAmt").val()) < parseInt($("#trackamount").val())){
      $.toast({ 
            text : 'Amount to save can not be less than the minimum amount set for this plan.', 
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
      $('#delivery_btn').html("Use New Card");

   }else{

    $('#delivery_btn').html("Initiating Payment");
    
  var globalData;
//var email;


var orderObj = {
    id: id,
    name: name,
    plan: cat,
    email: email,
    amount: amttoInvest,
    duration: duration

  };
    // Send the data to save using post
    var posting = $.post( '../inc/payment/pay_with_card.php', orderObj );

 posting.done(function( data ) {
     var datas = JSON.parse(data);
     console.log("email Address "+datas.email);
     $('#delivery_btn').html("Processing Payment");
     
      var email = datas.email;
      var handler = PaystackPop.setup({
      key: 'pk_live_d84031a0dc03f24b7a267761cc836431d26ea5e8',


      name: datas.name,
      email: datas.email,
      amount: datas.amount*100,
      



      metadata: {
        cartid: datas.transId,
        orderid: datas.transId,
        custom_fields: [
        {
            display_name: "Customer Name",
            variable_name: "customer_name",
            value: datas.name
          },
           {
            display_name: "Plan Name",
            variable_name: "plan_name",
            value: datas.plan
          },
          {
            display_name: "Paid on",
            variable_name: "paid_on",
            value: 'App'
          },
          {
            display_name: "Paid via",
            variable_name: "paid_via",
            value: 'Inline Popup'
          }
        ]
      },
      callback: function(response){
         var pay_res = response.reference;
         var amt = data.amount*100;
         $('#delivery_btn').html("Please wait...");
         
        jQuery.ajax({
            url: 'payment_verify.php',
            method: 'post',
            async:false,
            data:{reference: pay_res, email: datas.email, transId: datas.ref, amount: datas.amount, plan: datas.plan, id: datas.id},
            success: function (data) {
             
             var datas = JSON.parse(data);

                if(datas.success == true){

              document.location.href="payment_success?reference="+datas.ref+"&transId="+datas.transId+"&email="+datas.email;

               $('#delivery_btn').html("Finalizing Payment");

            }else{
              $('#delivery_btn').html("Use New Card");
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
          
      },
      onClose: function(){
        
         var amt = datas.amount*100;
         $('#delivery_btn').html("Use New Card");

         //document.location.href="payment_failed.php?reference="+pay_res+"&transId="+jresponse.id+"&email="+jresponse.email;

       /*jQuery.ajax({
            url: 'payment_failed.php',
            method: 'post',
            async:false,
            data:{transId: data.id, email: data.email, date: data.date, ref: data.ref},
            success: function (data) {
              if(data == "done"){

               

              jQuery("#btn").click();

              }else{
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
          });*/




      }
    });
    handler.openIframe();
       
       
     // console.log(response[0].email);
    });
    posting.fail(function( data ) { /* and if it failed... */ });


   }//else ends


    });

 });

 


//Update store setting table
$(document).ready(function() {
    $("#iupdateIt").click(function() {
        // using serialize function of jQuery to get all values of form
        var serializedData = $("#updatePassForm").serialize();
        //var loader='<img src="../assets/img/loading.gif" width="40" height="40"/>';
                 
       $.ajax({

            type : 'POST',
            url  : '../inc/members/updatePassword.php',
            data : serializedData,
            success :  function(data)
            {
                if(data == 1)
                {

                   $.toast({ 
                      text : 'Update was Successful', 
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
                   window.location="profile";
                  // M.toast({html: '<i class="material-icons">done</i> Update was Successful'});
                  
                }else{

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
});




    </script>

     
    </body>
</html>
