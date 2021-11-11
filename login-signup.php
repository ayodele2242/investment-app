
<?php 
include("header.php"); 

if(isset($_GET['ref'])){
  $ref = $_GET['ref'];
 $script = <<< JS

$(document).ready(function() {
   $(".registerTab").addClass("authentication-tab-active");
   $(".loginTab").removeClass("authentication-tab-active");
   $(".loginItem").removeClass("authentication-tab-details-active");
   $(".registerItem").addClass("authentication-tab-details-active");
   
 });

JS;
}else{
  $ref = "";  
}

?>


<?php //include("header-bottom.php");  ?>
<script><?= $script ?></script>

<section class="home-facility-sections p-tb-60 overflow-x-hidden" >
<div class="" id="msgs"></div>

        <div class="header-right-widget">
                    <ul>
                       
                        <li class="language-switcher">
                            <div class="dropdown">
                                <button type="button" class="dropdown-toggle" data-toggle="dropdown" style="color: #000;">
                                    En
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="ct-language__dropdown">
                                        <li><a href="#googtrans(en|en)" class="lang-en lang-select" data-lang="en"><span class="flag-icon flag-icon-us"></span> English</a></li>
                                        <li><a href="#googtrans(en|pt)" class="lang-es lang-select" data-lang="pt"><span class="flag-icon flag-icon-pt"></span> Portugal</a></li>
                                        
                                        <li><a href="#googtrans(en|es)" class="lang-es lang-select" data-lang="es"><span class="flag-icon flag-icon-es"></span> Mexico</a></li>
                                        <li><a href="#googtrans(en|fr)" class="lang-es lang-select" data-lang="fr"><span class="flag-icon flag-icon-fr"></span> France</a></li>
                                        <li><a href="#googtrans(en|zh-CN)" class="lang-es lang-select" data-lang="zh-CN"><span class="flag-icon flag-icon-cn"></span> China</a></li>
                                        <li><a href="#googtrans(en|de)" class="lang-es lang-select" data-lang="de"><span class="flag-icon flag-icon-de"></span> German</a></li>
                                        <li><a href="#googtrans(en|hi)" class="lang-es lang-select" data-lang="hi"><span class="flag-icon flag-icon-in"></span> Hindi</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        
                    </ul>
                </div> <!-- /.header-right-widget -->


<div class="authentication-section">
<div class="authentication-grid">
<div class="authentication-item authentication-img-bg" style="background: #0D47A1 url(front/images/security_on.svg); background-repeat: no-repeat; background-size: 700px 300px; background-position: center left;">
	
	<!--<div class="" style="position: absolute; top: 40%; margin-left: auto; margin-right: auto; "></div>-->


</div>
<div class="authentication-item bg-white pl-15 pr-15">

<div class="authentication-user-panel">

<div class="authentication-user-header">
<h1>Login</h1>
  
</div>
<div class="authentication-user-body">
<div class="authentication-tab">
<div class="authentication-tab-item loginTab authentication-tab-active" data-authentcation-tab="1">
<img src="front/images/login.png" alt="icon">
Login
</div>
<div class="authentication-tab-item registerTab" data-authentcation-tab="2">
<img src="front/images/register.png" alt="icon">
Register
</div>
</div>
<div class="authentication-tab-details">
<div class="authentication-tab-details-item loginItem authentication-tab-details-active" data-authentcation-details="1">
<div class="authentication-form">
<form id="loginform">

<div class="row">

<div class="col-sm-12 col-md-12 col-lg-12">
<div class="form-group mb-15">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fa fa-user"></i></span>
</div>
<input type="text" class="form-control" placeholder="Email Address *" name="email" id="lemail" />
</div>
</div>
</div>
<div class="col-sm-12 col-md-12 col-lg-12">
<div class="form-group mb-15">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fa fa-lock"></i></span>
</div>
<input type="password" class="form-control" placeholder="Password" id="lpassword" name="password" />
</div>
</div>
</div>
<div class="col-sm-12 col-md-12 col-lg-12">
<button class="btn1 orange-gradient full-width" style="background: #0D47A1; color: #fff;">Login</button>
</div>
</div>
<div class="authentication-account-access mt-20">
<div class="authentication-account-access-item">
<div class="authentication-checkbox">
<input type="checkbox" id="remember">
<label for="remember">Remember me</label>
</div>
</div>
<div class="authentication-account-access-item">
<div class="authentication-link">
<a href="forget-password">Forget password?</a>
</div>
</div>
</div>
</form>
</div>


</div>
<div class="authentication-tab-details-item registerItem" data-authentcation-details="2">
<div class="authentication-form regForm">
<form id="registerform" class="">
<div class="row">

<div class="col-sm-12 col-lg-6">
<div class="form-group mb-15">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fa fa-user"></i></span>
</div>
<input type="text" class="form-control" placeholder="Last Name*" name="lname" id="lame" />
</div>
</div>
</div>

<div class="col-sm-12 col-lg-6">
<div class="form-group mb-15">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fa fa-user"></i></span>
</div>
<input type="text" class="form-control" placeholder="First Name*" name="fname" id="fname" />
</div>
</div>
</div>



<div class="col-sm-12 col-md-12 col-lg-12">
<div class="form-group mb-15">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fa fa-calendar"></i></span>
</div>
<input type="text" class="form-control" id="date" placeholder="Date of Birth*" name="dob"/>
</div>
</div>
</div>

<div class="col-sm-12 col-md-12 col-lg-12">
<div class="form-group mb-15">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fa fa-code-fork"></i></span>
</div>
<input type="text" class="form-control" placeholder="Enter referral code"  name="ref" value="<?php if(isset($ref)) { echo $ref; } ?>"/>
</div>
<span class="col-red text-danger">If no one refers you enter Akawo, else enter referral's code</span>
</div>
</div>


<div class="col-sm-12 col-md-12 col-lg-12">
<div class="form-group mb-15">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fa fa-envelope"></i></span>
</div>
<input type="email" class="form-control" placeholder="Email Address *" name="email" />
</div>
</div>
</div>
<div class="col-sm-12  col-lg-6">
<div class="form-group mb-15">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fa fa-lock"></i></span>
</div>
<input type="password" class="form-control" placeholder="Password *" name="password"/>
</div>
</div>
</div>
<div class="col-sm-12  col-lg-6">
<div class="form-group mb-15">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fa fa-lock"></i></span>
</div>
<input type="password" class="form-control" placeholder="Confirm Password *" name="password2" />
</div>
</div>
</div>
<div class="col-sm-12 col-md-12 col-lg-12">

<button class="btn1 orange-gradient full-width" style="background: #0D47A1; color: #fff;">Sign Up</button>
</div>



</div>

</form>
</div>



</div>
</div>
</div>

<div class="row mt-20">

<div class="col-sm-12  col-lg-12">
<a href="hello"><i class="fa fa-long-arrow-left"></i> Back Home</a>
</div>

</div>
</div>
	

</div>
</div>
</div>


</section>







<?php 
include("language.php"); 
include("footer.php"); 

 ?>
