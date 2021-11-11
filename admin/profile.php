<?php
include("header.php");
include("header_bottom.php");
include("left_nav.php");
?>


    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="col s12">
          <div class="container">
            <!--card stats start-->
<div id="card-stats">
   <div class="row">
      <div class="col">

        <div class="cardss">

          <h3>Set a new password</h3>

        <div>
          <?php
          
          if (count($_POST) > 0) {
              
       $oldpass = encryptIt($_POST['old_password']);
        $newPass = stripslashes($_POST['new_password']);
        $confirmPass = stripslashes($_POST['con_password']);
        
        $pass = encryptIt($newPass);
        
        if($newPass != $confirmPass){
        	echo '<div class="alert alert-danger">Your new and confirm password are not equal</div>';
        }else if(empty($_POST['old_password']) || empty($_POST['new_password']) || empty($_POST['con_password'])){
        	echo '<div class="alert alert-danger">Check for empty input values</div>';
        }
        else{
        $sel = mysqli_query($mysqli, "SELECT u_password FROM system_users WHERE u_password = '$oldpass' and email='$email'");
        $count = mysqli_num_rows($sel);
        
        if($count == 0){
        echo '<div class="alert alert-danger">Your old password is wrong. Please check and try again.</div>';
        }else if($oldpass == $pass){
        echo '<div class="alert alert-danger">You can not update to your old password. Try another one.</div>';
        }else{
        $sql = "UPDATE system_users SET u_password = '$pass' WHERE email='$email'";
        
        if ($mysqli->query($sql) === TRUE) {
        echo '<div class="alert alert-success">You have successfully updated password.</div>';
        } else {
         echo '<div class="alert alert-danger">Error occured: ' . $mysqli->error .'</div>';
        }
        
        }
        
        
        }
}

?>
          <div align="center">
             <div class="message"><?php if(isset($message)) { echo $message; } ?></div>

            <form action="" method="post">
              <div class=" md-outline">
                <label data-error="wrong" data-success="right" for="newPass">Current password</label>
                <input type="password" name="old_password" id="oldPass" class="form-control" required="">
                
              </div>
              <div class=" md-outline">
                <label data-error="wrong" data-success="right" for="newPass">New password</label>
                <input type="password" id="newPass" name="new_password" class="form-control" required="">
                
              </div>

              <div class=" md-outline">
                 <label data-error="wrong" data-success="right" for="newPassConfirm">Confirm password</label>
                <input type="password" id="newPassConfirm" name="con_password" class="form-control" required="">
               
              </div>
<div align="right">
              <button type="submit" class="btn btn-primary mb-4" name="s">Change password</button>
</div>
            </form>
          </div>


        </div>
        
      </div>
   </div>
</div>
<!--card stats end-->

<?php include("right_menu.php"); ?>
         
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

  

    
 

<?php
include("footer.php");
?>