
<?php
include("header.php");
include("header-body.php");
if(!isset($_SESSION['email'])){
  header("Location: index");
}
?>

        
<main id="content" role="main" class="checkout-page" style="background: #f0f0f0;">
               <div id="main-content">
                  <div class="main-content">
                     <div id="home-main-content" class="">
                       
                        <!-- BEGIN content_for_index -->
                       
                        <div id="shopify-section-1558341502241" class="shopify-section pl-5 pr-5">
                           <div class="section-separator section-separator-1558341502241 section-separator-margin-top section-separator-margin-bottom"> <h5>My Details</h5>
                           </div>
                        </div>

   <div class="section full mt-2 p-5 container row">

    <div class="col-lg-6 col-sm-12 mb-4 mr-3">
    <form id="profileForm">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="email1">E-mail</label>
                                <input type="email" value="<?php if(isset($urow['email'])){ echo $urow['email']; }  ?>" class="form-control" id="email1" name="email" placeholder="Your e-mail" readonly>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
        
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Last Name</label>
                                <input type="text" class="form-control" name="lname" placeholder="Your Last Name" value="<?php if(isset($urow['last_name'])){ echo $urow['last_name']; }  ?>">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                          <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Last Name</label>
                                <input type="text" class="form-control" name="fname" placeholder="Your First Name" value="<?php if(isset($urow['first_name'])){ echo $urow['first_name']; }  ?>">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
        
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="select4b">Gender</label>
                                <select class="form-control custom-select" id="select4b" name="gender">
                                    <option value=""></option>
                                    <option value="Male" <?php if(isset($urow['gender']) && $urow['gender'] == "Male"){ echo "selected"; }  ?>>Male</option>
                                    <option value="Female" <?php if(isset($urow['gender']) && $urow['gender'] == "Female"){ echo "selected"; }  ?>>Female</option>
                                   
                                </select>
                            </div>
                        </div>

                        
        
                    </div>
                </div>



                <div class="form-button-group transparent mt-3">
                  <div align="center">
                    <button type="submit" class="btn btn-primary btn-sm" id="formBtn">Update Profile</button>
                  </div>
                </div>

            </form>

    </div>

     <div class="col-lg-5 col-sm-12 mb-4 ml-2">
        
      <form id="pwdForm">
                <div class="card mb-5">
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



                <div class="form-button-group transparent mt-5">
                    <input type="hidden" value="<?php if(isset($urow['email'])){ echo $urow['email']; }  ?>" class="form-control" id="email1" name="email" placeholder="Your e-mail" readonly>
                    <div align="center">
                    <button type="submit" class="btn btn-primary btn-sm" id="pwdformBtn">Update Password</button>
                  </div>
                </div>

            </form>


     	</div>
        <!-- * Categories -->
    </div>







</div>
</div>
</div>
</main>


<?php
include("footer.php");
?>
<script type="text/javascript">

$(document).ready(function(){
 
$('#pwdformBtn').click(function(e){ 
e.preventDefault(); 

$('#pwdformBtn').html("Updating..");

$.ajax({  
  url:"updatePassword.php",  
  method:"POST",  
  data: $("#pwdForm").serialize(), 
  success:function(data)  
  {  
    $('#pwdformBtn').html("Update Password");

        if(data.trim() == 1){

          $('#pwdForm')[0].reset();

        $.toast({ 
        text : '<b>Password updated successfully</b>', 
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
   
    }else{
       $('#pwdformBtn').html("Update Password");
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

 <script type="text/javascript">

$(document).ready(function(){
 
$('#formBtn').click(function(e){ 
e.preventDefault(); 

$('#formBtn').html("Updating..");

$.ajax({  
  url:"profileUpdate.php",  
  method:"POST",  
  data: $("#profileForm").serialize(), 
  success:function(data)  
  {  
    $('#formBtn').html("Update Profile");

        if(data.trim() == 1){

             $.toast({ 
        text : '<b>Profile updated successfully</b>', 
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
   
    }else{
       $('#formBtn').html("Update Profile");
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