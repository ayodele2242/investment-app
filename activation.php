<?php 
include("header-main.php");
require_once "inc/functions.php";
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
    <div class="breadcumb-area">
        <!-- breadcumb content -->
        <div class="breadcumb-content">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="breadcumb--con text-center">
                            <h2 class="w-text title wow fadeInUp" data-wow-delay="0.2s">Account Activation</h2>
                           
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <section class="section-padding-100 contact_us_area" id="contact">
        <div class="container">
        

<?php 
if (!empty($_GET['key']) && isset($_GET['key'])) {
  $id = safe_input($mysqli,$_GET['key']);

  $query = mysqli_query($mysqli,"select token from customer_login where token='$id'");
  $count =mysqli_num_rows($query);
  $row = mysqli_fetch_array($query);
    if ($count > 0) {
 
        // activate user
        $aquery = mysqli_query($mysqli,"UPDATE customer_login SET status = 1, token = '' WHERE token = '$id'");
      if($aquery){
          ?>
          
        
   <div class="empty-results text-center justify-content-center wow fadeInUp" data-wow-delay="0.3s">
      
        <div class="circle-loader">
        <div class="checkmark draw"></div>
        </div>
        <p><strong>Account successfully activated.</strong></p>
        <p></p>
  </div>
        
        <?php
      }else{
        echo '<div class="alert alert-danger justify-content-center wow fadeInUp" data-wow-delay="0.3s">Account activation failed, please try again.</div>';
      }
 
    } else {
        echo '<div class="alert alert-danger justify-content-center wow fadeInUp" data-wow-delay="0.3s">Invalid activation key!</div>';
    }
 
} else {
   echo '<div class="alert alert-danger">Invalid activation key!</div>';
}
 
?>

</div>
</section>

<?php  
include("footer-main.php");
?> 

<script>
    $(document).ready(function(){
        $('.circle-loader').toggleClass('load-complete');
        $('.checkmark').toggle();
    });
</script>

