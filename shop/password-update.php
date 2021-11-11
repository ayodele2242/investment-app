<?php
include("header.php");
?>
<div class="appHeader">
        <div class="left">
        <a href="#" class="headerButton goBack bolder" onclick="goBack()">
                <i class="material-icons icon">arrow_back_ios</i> 
            </a>
        </div>
         <div class="pageTitle">
           Password Updated
        </div>
</div>        


 <!-- App Capsule -->
    <div id="appCapsule">

     <!-- Categories -->
     <div class="section full mt-2 p-2">
       <form id="profileForm">
                <div class="card">
                    <div class="card-body">
                       
                       <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Enter Old Password</label>
                                <input type="password" class="form-control" id="password1" name="old_password" placeholder="Your old password">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
        
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">New Password</label>
                                <input type="password" class="form-control" id="password1" name="new_password" placeholder="New password">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
        
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password2">Confirm New Password</label>
                                <input type="password" class="form-control" id="password2" name="con_password" placeholder="Type password again">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        
        
                    </div>
                </div>



                <div class="form-button-group transparent">
                    <input type="hidden" value="<?php if(isset($urow['email'])){ echo $urow['email']; }  ?>" class="form-control" id="email1" name="email" placeholder="Your e-mail" readonly>
                    <button type="submit" class="btn btn-primary btn-block btn-lg" id="formBtn">Update Password</button>
                </div>

            </form>
    </div>
    </div>



 <!-- Alert Success Action Sheet -->
        <div class="modal fade action-sheet" id="actionSheetAlertSuccess" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <div class="iconbox text-success">
                                <ion-icon name="checkmark-circle"></ion-icon>
                            </div>
                            <div class="text-center p-2">
                                <h3>Success</h3>
                                <p>Successfuly updated...</p>
                            </div>
                            <a href="#" class="btn btn-primary btn-lg btn-block" data-dismiss="modal">Done</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Alert Success Action Sheet -->


<?php
include("footer.php");
?>


 <script type="text/javascript">

$(document).ready(function(){
 
$('#formBtn').click(function(e){ 
e.preventDefault(); 

$('#formBtn').html("Updating..");

$.ajax({  
  url:"updatePassword.php",  
  method:"POST",  
  data: $("#profileForm").serialize(), 
  success:function(data)  
  {  
    $('#formBtn').html("Update Password");

        if(data.trim() == 1){

          $("#actionSheetAlertSuccess").modal("show");

         //$('#reviewForm')[0].reset();  
         //setTimeout(' window.location.href = document.location.href; ',2000);
   //location.href = 'checkout';
    //document.location.href = document.location.href;
   
    }else{
       $('#formBtn').html("Update Password");
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
       //alert(data);  
       
  }  
}); 


}); 


});


</script>