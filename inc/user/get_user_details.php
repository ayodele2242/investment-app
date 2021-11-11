<?php
require_once("../../config/config.php");
require_once("../functions.php");
require_once("../../config/function.php");

if(isset($_POST['id'])){

	$id= $_POST['id'];

	$query = mysqli_query($mysqli,"select * from customer_login where id='$id'");

    $row = mysqli_fetch_array($query);

?>

<form id="userUpdateForm">
         
<div class="mymsg"></div>
          <div class="row">
            
                <input class="form-control" type="hidden" id="email" value="<?php echo $_SESSION['email'];  ?>" name="email">
               
          </div>
         
         
          
         <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="checkout-fn">First Name</label>
                <input class="form-control" type="text" name="fname" id="fname" value="<?php echo $row['first_name'];  ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="checkout-ln">Last Name</label>
                <input class="form-control" type="text" id="lname" name="lname" value="<?php echo $row['last_name'];  ?>">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="checkout-fn">Gender</label>
                <select class="form-control" name="gender">
                	<option value="">Select Gender</option>
                	<option <?php if($row['gender'] == "Male") { echo "selected"; }  ?>  value="Male">Male</option>
                	<option <?php if($row['gender'] == "Female") { echo "selected"; }  ?> value="Female">Female</option>

                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="checkout-ln">D.O.B</label>
                <input class="form-control" id="datetimepicker4" type="date" name="dob" value="<?php echo $row['dob'];  ?>">
              </div>
            </div>
          </div>


          <div class="row">
          	<div class="col-lg-12">
          	<h4 class="text-info">Update Password</h4><small class="mb-4">(Leave empty if not updating)</small>
          </div>
          </div>

         <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="checkout-address-1">Old Password</label>
                <div class="input-group-overlay form-group">
                  
                  <div class="password-toggle">
                    <input class="form-control prepended-form-control" type="password" name="password" autocomplete="off" auto-complete="off">
                    <label class="password-toggle-btn">
                      <input class="custom-control-input" type="checkbox"><i class="fa fa-eye password-toggle-indicator"></i><span class="sr-only">Show password</span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="checkout-address-2">New Password</label>
                <div class="input-group-overlay form-group">
                  
                  <div class="password-toggle">
                    <input class="form-control prepended-form-control" type="password" id="password2" name="new_password" autocomplete="off" auto-complete="off">
                    <label class="password-toggle-btn">
                      <input class="custom-control-input" type="checkbox"><i class="fa fa-eye password-toggle-indicator"></i><span class="sr-only">Show password</span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>


           <div class="modal-footer">
                  <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary btn-shadow btn-sm" id="updateUserBtn" type="button">Update</button>
                </div>
         
           </form>






<script type="text/javascript">
	
$('#updateUserBtn').click(function(e){ 
e.preventDefault(); 

      var formElem = $("#userUpdateForm");
      var formdata = new FormData(formElem[0]);


           $.ajax({  
                url:"../inc/user/updateUserInfo.php",  
                method:"POST",  
                data: formdata, 
                processData: false,
                contentType: false, 
                success:function(data)  
                {  

                  if(data.trim() == 1){
                   $(".mymsg").html('<div class="alert alert-success">Successfully updated.</div>').show();
          setTimeout(function() {
              $(".mymsg").fadeOut(1500);
          }, 10000);
 
                 // $('#productForm')[0].reset();  
                 //location.href = 'checkout';
                  document.location.href = document.location.href;
                 
                  }else{
                    $(".mymsg").html('<div class="alert alert-danger text-left">'+data+'</div>').show();
          setTimeout(function() {
              $(".mymsg").fadeOut(1500);
          }, 10000);
                  }
                     //alert(data);  
                     
                }  
           }); 


      }); 
</script>


<?php
}
?>

