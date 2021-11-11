 <!-- ========== FOOTER ========== -->
        <footer>
            <!-- Footer-top-widget -->
           <?php include("footer-top.php"); ?>
            <!-- Footer-bottom-widgets -->
            <div class="pt-8 pb-4 bg-gray-13">
                <div class="container mt-1">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="mb-6">
                                <a href="#" class="d-inline-block">
                                   
                                </a>
                            </div>
                            <div class="mb-4">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <i class="ec ec-support text-primary font-size-56"></i>
                                    </div>
                                    <div class="col pl-3">
                                        <div class="font-size-13 font-weight-light">Got questions? Call us 24/7!</div>
                                        
                                        <a href="tel:<?php echo $set['contactNum']; ?>" class="font-size-20 text-gray-90"><?php echo $set['contactNum']; ?> </a>

                                       
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h6 class="mb-1 font-weight-bold">Contact info</h6>
                                <address class="">
                                    <?php echo $set['address']; ?>
                                </address>
                            </div>
                            <div class="my-4 my-md-4">
                                <ul class="list-inline mb-0 opacity-7">
                                    <li class="list-inline-item mr-0">
                                        <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="https://www.facebook.com/<?php echo $set['facebook']; ?>">
                                            <span class="fab fa-facebook-f btn-icon__inner"></span>
                                        </a>
                                    </li>
                                    
                                    <li class="list-inline-item mr-0">
                                        <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="https://www.twitter.com/<?php echo $set['twitter']; ?>">
                                            <span class="fab fa-twitter btn-icon__inner"></span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="https://www.instagram.com/<?php echo $set['instagram']; ?>">
                                            <span class="fab fa-instagram btn-icon__inner"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-12 col-md mb-4 mb-md-0">
                                    <h6 class="mb-3 font-weight-bold">Find it Fast</h6>
                                    <!-- List Group -->
                                    <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">

                                         <?php 
                                               if(isset($parent_cats) && !empty($parent_cats)){
                                               $i = 0;
                                               foreach (array_slice($parent_cats, 0, 6) as $parents ) {
                                               $child_cats = $category->getChildByParentId($parents->id);
                                                 
                                             ?>

                                              <li><a class="list-group-item list-group-item-action" href="category?cid=<?php echo $parents->id; ?>"><?php echo stripslashes($parents->title); ?></a></li>

                                             <?php 
                                             }
                                          }
                                          ?>

                                       
                                        
                                    </ul>
                                    <!-- End List Group -->
                                </div>

                               

                                <div class="col-12 col-md mb-4 mb-md-0">
                                    <h6 class="mb-3 font-weight-bold">Customer Care</h6>
                                    <!-- List Group -->
                                    <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                       
                                        <li><a class="list-group-item list-group-item-action" href="returns_and_exchanges">Help Center</a></li>
                                        <li><a class="list-group-item list-group-item-action" href="return-policy">Returns / Exchange</a></li>
                                        <!--<li><a class="list-group-item list-group-item-action" href="#faq">FAQs</a></li>-->
                                        
                                    </ul>
                                    <!-- End List Group -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Footer-bottom-widgets -->
            <!-- Footer-copy-right -->
            <div class="bg-gray-14 py-2">
                <div class="container">
                    <div class="flex-center-between d-block d-md-flex">
                        <div class="mb-3 mb-md-0">© <a href="#" class="font-weight-bold text-gray-90">Akawo Store</a> - All rights Reserved</div>
                        <div class="text-md-right">
                            <span class="d-inline-block p-1">
                                <img src="assets/img/paystack-i.png" style="max-width: 224px;" >
                            </span>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Footer-copy-right -->
        </footer>
        <!-- ========== END FOOTER ========== -->

        <!-- ========== SECONDARY CONTENTS ========== -->
        <!-- Account Sidebar Navigation -->
        <aside id="sidebarContent" class="u-sidebar u-sidebar__lg" aria-labelledby="sidebarNavToggler">
            <div class="u-sidebar__scroller">
                <div class="u-sidebar__container">
                    <div class="js-scrollbar u-header-sidebar__footer-offset pb-3">
                        <!-- Toggle Button -->
                        <div class="d-flex align-items-center pt-4 px-7">
                            <button type="button" class="close ml-auto"
                                aria-controls="sidebarContent"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-unfold-event="click"
                                data-unfold-hide-on-scroll="false"
                                data-unfold-target="#sidebarContent"
                                data-unfold-type="css-animation"
                                data-unfold-animation-in="fadeInRight"
                                data-unfold-animation-out="fadeOutRight"
                                data-unfold-duration="500">
                                <i class="ec ec-close-remove"></i>
                            </button>
                        </div>
                        <!-- End Toggle Button -->

                        <!-- Content -->
                        <div class="js-scrollbar u-sidebar__body">
                            <div class="u-sidebar__content u-header-sidebar__content">
                                
                                    <!-- Login -->
                                    <div id="login" data-target-group="idForm">
                                        <form class="js-validate" id="loginForms">
                                        <!-- Title -->
                                        <header class="text-center mb-7">
                                        <h2 class="h4 mb-0">Welcome Back!</h2>
                                        <p>Login to manage your account.</p>
                                        </header>
                                        <!-- End Title -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="signinEmail">Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signinEmailLabel">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email" id="logemail" placeholder="Email" aria-label="Email" aria-describedby="signinEmailLabel" required
                                                    data-msg="Please enter a valid email address."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Form Group -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                              <label class="sr-only" for="signinPassword">Password</label>
                                              <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signinPasswordLabel">
                                                        <span class="fas fa-lock"></span>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control" name="password" id="logpassword" placeholder="Password" aria-label="Password" aria-describedby="signinPasswordLabel" required
                                                   data-msg="Your password is invalid. Please try again."
                                                   data-error-class="u-has-error"
                                                   data-success-class="u-has-success">
                                              </div>
                                            </div>
                                        </div>
                                        <!-- End Form Group -->

                                        <div class="d-flex justify-content-end mb-4">
                                            <a class="js-animation-link small link-muted" href="javascript:;"
                                               data-target="#forgotPassword"
                                               data-link-group="idForm"
                                               data-animation-in="slideInUp">Forgot Password?</a>
                                        </div>

                                        <div class="mb-2">
                                            <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover" id="logFormBtns">Login</button>
                                        </div>

                                        <div class="text-center mb-4">
                                            <span class="small text-muted">Do not have an account?</span>
                                            <a class="js-animation-link small text-dark" href="javascript:;"
                                               data-target="#signup"
                                               data-link-group="idForm"
                                               data-animation-in="slideInUp">Signup
                                            </a>
                                        </div>
                                    </form>
                                    </div>

                                    <!-- Signup -->
                                    <div id="signup" style="display: none; opacity: 0;" data-target-group="idForm">
                                        <form class="js-validate" id="registerForm-2">
                                        <!-- Title -->
                                        <header class="text-center mb-7">
                                        <h2 class="h4 mb-0">Welcome.</h2>
                                        <p>Fill out the form to get started.</p>
                                        </header>
                                        <!-- End Title -->

                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="signupEmail">Last Name</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" aria-label="lname"
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>

                                           <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="signupEmail">First Name</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" aria-label="Email"
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                    <input type="hidden" class="form-control" name="dob" id="dob">
                                                </div>
                                            </div>
                                        </div>


                                           <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="signupEmail">Last Name</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" aria-label="lname"
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="signupEmail">Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signupEmailLabel">
                                                            <span class="fas fa-envelope"></span>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email" id="signupEmail" placeholder="Email" aria-label="Email"
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="signupPassword">Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signupPasswordLabel">
                                                            <span class="fas fa-lock"></span>
                                                        </span>
                                                    </div>
                                                    <input type="password" class="form-control" name="password" id="signupPassword" placeholder="Password" aria-label="Password" aria-describedby="signupPasswordLabel"
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signupConfirmPassword">Confirm Password</label>
                                                <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signupConfirmPasswordLabel">
                                                        <span class="fas fa-key"></span>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control" name="confirmPassword" id="signupConfirmPassword" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="signupConfirmPasswordLabel" 
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <div class="mb-2">
                                            <button type="submit" id="regBtn" class="btn btn-block btn-sm btn-primary transition-3d-hover">Get Started</button>
                                        </div>

                                        <div class="text-center mb-4">
                                            <span class="small text-dark">Already have an account?</span>
                                            <a class="js-animation-link small text-dark" href="javascript:;"
                                                data-target="#login"
                                                data-link-group="idForm"
                                                data-animation-in="slideInUp">Login
                                            </a>
                                        </div>

                                   
                                    </form>
                                    </div>
                                    <!-- End Signup -->

                                    <!-- Forgot Password -->
                                    <div id="forgotPassword" style="display: none; opacity: 0;" data-target-group="idForm">
                                        <form class="js-validates" id="forgotForm">
                                        <!-- Title -->
                                        <header class="text-center mb-7">
                                            <h2 class="h4 mb-0">Recover Password.</h2>
                                            <p>Enter your email address and an email with instructions will be sent to you.</p>
                                        </header>
                                        <!-- End Title -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="recoverEmail">Your email</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="recoverEmailLabel">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email" id="recoverEmail" placeholder="Your email" aria-label="Your email" aria-describedby="recoverEmailLabel" 
                                                    data-msg="Please enter a valid email address."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Form Group -->

                                        <div class="mb-2">
                                            <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover" id="forgotBtn">Recover Password</button>
                                        </div>

                                        <div class="text-center mb-4">
                                            <span class="small text-muted">Remember your password?</span>
                                            <a class="js-animation-link small" href="javascript:;"
                                               data-target="#login"
                                               data-link-group="idForm"
                                               data-animation-in="slideInUp">Login
                                            </a>
                                        </div>
                                    </form>
                                    </div>

                                    <!-- End Forgot Password -->

                               
                            </div>
                        </div>
                        <!-- End Content -->
                    </div>
                </div>
            </div>
        </aside>
        <!-- End Account Sidebar Navigation -->
        <!-- ========== END SECONDARY CONTENTS ========== -->

        <!-- Go to Top -->
        <a class="js-go-to u-go-to" href="#"
            data-position='{"bottom": 15, "right": 15 }'
            data-type="fixed"
            data-offset-top="400"
            data-compensation="#header"
            data-show-effect="slideInUp"
            data-hide-effect="slideOutDown">
            <span class="fas fa-arrow-up u-go-to__inner"></span>
        </a>
        <!-- End Go to Top -->

        <!-- JS Global Compulsory -->
        <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
        <script src="assets/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
        <script src="assets/vendor/popper.js/dist/umd/popper.min.js"></script>
        <script src="assets/vendor/bootstrap/bootstrap.min.js"></script>

        <!-- JS Implementing Plugins -->
        <script src="assets/vendor/jquery.countdown.min.js"></script>
        <script src="assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>
        <script src="assets/vendor/svg-injector/dist/svg-injector.min.js"></script>
        <script src="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="frontpage/jquery.toast.min.js"></script>
        <!--<script src="assets/vendor/fancybox/jquery.fancybox.min.js"></script>-->
         
        <script src="assets/vendor/typed.js/lib/typed.min.js"></script>
        <script src="assets/vendor/slick-carousel/slick/slick.js"></script>
        <script src="assets/vendor/appear.js"></script>
        <script src="assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
        <!-- JS Electro -->
        <script src="assets/js/hs.core.js"></script>
        <script src="assets/js/components/hs.countdown.js"></script>
        <script src="assets/js/components/hs.header.js"></script>
        <script src="assets/js/components/hs.hamburgers.js"></script>
        <script src="assets/js/components/hs.unfold.js"></script>
        <script src="assets/js/components/hs.focus-state.js"></script>
        <script src="assets/js/components/hs.malihu-scrollbar.js"></script>
        <script src="assets/js/components/hs.validation.js"></script>
        
        <script src="assets/js/components/hs.onscroll-animation.js"></script>
        <script src="assets/js/components/hs.slick-carousel.js"></script>
        <script src="assets/js/components/hs.quantity-counter.js"></script>
        <script src="assets/js/components/hs.range-slider.js"></script>
        <script src="assets/js/components/hs.show-animation.js"></script>
        <script src="assets/js/components/hs.svg-injector.js"></script>
        <script src="assets/js/components/hs.go-to.js"></script>
        <script src="assets/js/components/hs.selectpicker.js"></script>
         <script src="frontpage/jquery-ui.js"></script>
        <script src="https://js.paystack.co/v1/inline.js"></script>
         <script src="custom.js"></script>
         <script src="assets/js/components/hs.fancybox.js"></script>


        
        <!--<script type="text/javascript" src="assets/js/jquery.lazy.min.js"></script>-->

        <!-- JS Plugins Init. -->
        <script>
            $(window).on('load', function () {
                // initialization of HSMegaMenu component
                $('.js-mega-menu').HSMegaMenu({
                    event: 'hover',
                    direction: 'horizontal',
                    pageContainer: $('.container'),
                    breakpoint: 1199.98,
                    hideTimeOut: 0
                });

                // initialization of svg injector module
                $.HSCore.components.HSSVGIngector.init('.js-svg-injector');
            });

            $(document).on('ready', function () {
                // initialization of header
                $.HSCore.components.HSHeader.init($('#header'));

                // initialization of animation
                $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

                // initialization of unfold component
                $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                    afterOpen: function () {
                        $(this).find('input[type="search"]').focus();
                    }
                });

                // initialization of popups
                $.HSCore.components.HSFancyBox.init('.js-fancybox');

                // initialization of countdowns
                var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
                    yearsElSelector: '.js-cd-years',
                    monthsElSelector: '.js-cd-months',
                    daysElSelector: '.js-cd-days',
                    hoursElSelector: '.js-cd-hours',
                    minutesElSelector: '.js-cd-minutes',
                    secondsElSelector: '.js-cd-seconds'
                });

                // initialization of malihu scrollbar
                $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

                // initialization of forms
                $.HSCore.components.HSFocusState.init();

                // initialization of form validation
                $.HSCore.components.HSValidation.init('.js-validate', {
                    rules: {
                        confirmPassword: {
                            equalTo: '#signupPassword'
                        }
                    }
                });

                $.HSCore.components.HSRangeSlider.init('.js-range-slider');
                // initialization of show animations
                $.HSCore.components.HSShowAnimation.init('.js-animation-link');

                // initialization of fancybox
                $.HSCore.components.HSFancyBox.init('.js-fancybox');

                // initialization of slick carousel
                $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel',{
                    autoplay: true,
                    autoplaySpeed: 1500
                }
                );

                // initialization of go to
                $.HSCore.components.HSGoTo.init('.js-go-to');

                // initialization of hamburgers
                $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

                // initialization of unfold component
                $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                    beforeClose: function () {
                        $('#hamburgerTrigger').removeClass('is-active');
                    },
                    afterClose: function() {
                        $('#headerSidebarList .collapse.show').collapse('hide');
                    }
                });

                $('#headerSidebarList [data-toggle="collapse"]').on('click', function (e) {
                    e.preventDefault();

                    var target = $(this).data('target');

                    if($(this).attr('aria-expanded') === "true") {
                        $(target).collapse('hide');
                    } else {
                        $(target).collapse('show');
                    }
                });

                // initialization of unfold component
                $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

                // initialization of select picker
                $.HSCore.components.HSSelectPicker.init('.js-select');
            });
        </script>
<script type="text/javascript">
    $('#forgotBtn').click(function(e) {
       
    e.preventDefault();
   
    $.ajax({
       type: "POST",
       url: '../inc/members/recoverPwd.php',
       data: $("#forgotForm").serialize(),
       success: function(data)
       {
           if(data.trim() == 1){

                   $("#msgs").html('<div class="alert alert-success">Password successfully sent to your email address.</div>').show();
                   setTimeout(function() {
              $("#msgs").fadeOut(1500);
          }, 4000);
                   
                   $('#forgotForm')[0].reset();
                  
                  }else{
                     $.toast({ 
        text : data, 
        showHideTransition : 'fade',  
        bgColor : 'red',              
        textColor : '#fff',       
        allowToastClose : false,    
        hideAfter : 4000,
        loader: false,                               
        textAlign : 'center',           
        position : 'top-right'  
      });


                  }

       }
   });
 });

</script>

        <script type='text/javascript'>
      /*if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/ndc/sw.js');
      }*/
$(document).ready(function(){
  
    $("#searchmobile").keyup(function(){
       var query = $(this).val();
       $('.close-icon').addClass("input-icon").show();
       $('.search-icon').removeClass("input-icon").hide();
       if (query != "") {
         $.ajax({
           url: 'product-search.php',
          type:'GET',
           data: {query:query},
           success: function(data){
            $('.resultMoble-search').html(data).show();
              
            $(".resultMoble-search").css('background', '#f0f0f0');
           }
         });
       } else {
       $('#search-output').css('display', 'none');
     }
   });

});

$(document).ready(function(){

$('#logFormBtns').click(function(e){ 
    e.preventDefault();
      var username = $("#logemail").val();
      var password = $("#logpassword").val();
      if(username=="")
      {

       $.toast({ 
        text : 'Please enter your email', 
        showHideTransition : 'fade',  
        bgColor : 'red',              
        textColor : '#fff',       
        allowToastClose : false,    
        hideAfter : 4000,
        loader: false,                               
        textAlign : 'center',           
        position : 'top-right'  
      });

      }else if(password=="")
      {
       $.toast({ 
        text : 'Please enter your password', 
        showHideTransition : 'fade',  
        bgColor : 'red',              
        textColor : '#fff',       
        allowToastClose : false,    
        hideAfter : 4000,
        loader: false,                               
        textAlign : 'center',           
        position : 'top-right'  
      });

         
      }
else
{
    $.ajax({
       type: "POST",
       url: '../inc/members/login.php',
       data: $("#loginForms").serialize(),
       success: function(data)
       {
          if (data.trim() == 'ok') {
             $.toast({ 
            text : 'Please wait while we log you in...', 
            showHideTransition : 'fade',  
            bgColor : 'green',              
            textColor : '#fff',       
            allowToastClose : false,    
            hideAfter : 4000,
            loader: false,                               
            textAlign : 'center',           
            position : 'center'  
          });
           setTimeout(' window.location.href = "orders"; ',1000);

          }else if(data.trim() == "i"){

           
             $.toast({ 
            text : 'Your account is not yet activated at the moment. Please go to your email and confirm your email.', 
            showHideTransition : 'fade',  
            bgColor : 'red',              
            textColor : '#fff',       
            allowToastClose : false,    
            hideAfter : 4000,
            loader: false,                               
            textAlign : 'center',           
            position : 'top-right'  
          });

    }
    else if(data.trim() == "s"){

       $.toast({ 
            text : 'Your account is suspended.', 
            showHideTransition : 'fade',  
            bgColor : 'red',              
            textColor : '#fff',       
            allowToastClose : false,    
            hideAfter : 4000,
            loader: false,                               
            textAlign : 'center',           
            position : 'top-right'  
      });
    }
          else {

            $.toast({ 
            text : data, 
            showHideTransition : 'fade',  
            bgColor : 'red',              
            textColor : '#fff',       
            allowToastClose : false,    
            hideAfter : 4000,
            loader: false,                               
            textAlign : 'center',           
            position : 'top-right'  
           });

          }
       }
   });
}
 });



      $("#productSearch").keyup(function(){
         var query = $(this).val();
        
         if (query != "") {
           $.ajax({
             url: 'product-search.php',
            type:'GET',
             data: {query:query},
             success: function(data){
              $('.result-ajax-search').html(data).show();
              
                   $("#result-ajax-search").css('background', '#f0f0f0');
             }
           });
         } else {
         $('#result-ajax-search').css('display', 'none');
       }
     });

});




/*$(document).ready(function() {
        //Horizontal Tab
        $('#parentHorizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });

        // Child Tab
        $('#ChildVerticalTab_1').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true,
            tabidentify: 'ver_1', // The tab groups identifier
            activetab_bg: '#fff', // background color for active tabs in this group
            inactive_bg: '#F5F5F5', // background color for inactive tabs in this group
            active_border_color: '#c1c1c1', // border color for active tabs heads in this group
            active_content_border_color: '#5AB1D0' // border color for active tabs contect in this group so that it matches the tab head border
        });

        //Vertical Tab
        $('#parentVerticalTab').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo2');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
    });*/



/*function addToCart(product_id){

  $.post('inc/api.php',{product_id:product_id, act:"<?php //echo substr(md5('add-to-cart'), 3,15); ?>"},function(res){

    if (res == 1) {

      $.toast({ 
        text : '<b><ion-icon name="checkmark-circle"></ion-icon> &nbsp;Item successfully added to cart </b>', 
        showHideTransition : 'fade',  
        bgColor : 'green',              
        textColor : '#fff',       
        allowToastClose : false,    
        hideAfter : 4000,
        loader: false,                               
        textAlign : 'center',           
        position : 'top-right'  
      });
       $(".icart").load(location.href + " .icart");
       $("#actionSheetForm").modal("hide");
       //$("#actionSheetForm").modal('hide');
       $('.modal').modal('toggle');
        $('.modal-backdrop').removeClass('modal-backdrop');
        $('.action-sheet').removeClass('action-sheet');

        location.reload(true);
 
    }else{

      $.toast({ 
        text : '<b><ion-icon name="sad"></ion-icon> &nbsp;'+res+'</b>', 
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
  });
}*/
function deleteCartItem(cart_index){
  $.post('../inc/api.php', {cart_index:cart_index, act:"<?php echo substr(md5('delete-from-cart'),3,15); ?>"}, function(res){
     if (res == 1) {

      $("#msgs").html('<div class="alert alert-success"><i class="fa fa-check"></i> &nbsp;Item Successfully deleted from cart</div>').show();
      setTimeout(function() {
          $("#msgs").fadeOut(1500);
      }, 4000);
       $(".icart").load(location.href + " .icart");
       $(".refreshme").load(location.href + " .refreshme");
    }else{
      $("#msgs").html('<div class="alert alert-danger">'+res+'</div>').show();
        setTimeout(function() {
            $("#msgs").fadeOut(1500);
        }, 10000);
    }

  });
}


    $('#logFormBtn').click(function(e){ 
    e.preventDefault();
      var username = $("#logemail").val();
      var password = $("#logpassword").val();
      if(username=="")
      {

       $.toast({ 
        text : 'Please enter your email', 
        showHideTransition : 'fade',  
        bgColor : 'red',              
        textColor : '#fff',       
        allowToastClose : false,    
        hideAfter : 4000,
        loader: false,                               
        textAlign : 'center',           
        position : 'top-right'  
      });

      }else if(password=="")
      {
       $.toast({ 
        text : 'Please enter your password', 
        showHideTransition : 'fade',  
        bgColor : 'red',              
        textColor : '#fff',       
        allowToastClose : false,    
        hideAfter : 4000,
        loader: false,                               
        textAlign : 'center',           
        position : 'top-right'  
      });

         
      }
else
{
    $.ajax({
       type: "POST",
       url: '../inc/members/login.php',
       data: $("#login-form").serialize(),
       success: function(data)
       {
          if (data.trim() == 'ok') {
             $.toast({ 
            text : 'Please wait while we log you in...', 
            showHideTransition : 'fade',  
            bgColor : 'green',              
            textColor : '#fff',       
            allowToastClose : false,    
            hideAfter : 4000,
            loader: false,                               
            textAlign : 'center',           
            position : 'center'  
          });
           setTimeout(' window.location.href = "index"; ',1000);

          }else if(data.trim() == "i"){

           
             $.toast({ 
            text : 'Your account is not yet activated at the moment. Please go to your email and confirm your email.', 
            showHideTransition : 'fade',  
            bgColor : 'red',              
            textColor : '#fff',       
            allowToastClose : false,    
            hideAfter : 4000,
            loader: false,                               
            textAlign : 'center',           
            position : 'top-right'  
          });

    }
    else if(data.trim() == "s"){

       $.toast({ 
            text : 'Your account is suspended.', 
            showHideTransition : 'fade',  
            bgColor : 'red',              
            textColor : '#fff',       
            allowToastClose : false,    
            hideAfter : 4000,
            loader: false,                               
            textAlign : 'center',           
            position : 'top-right'  
      });
    }
          else {

            $.toast({ 
            text : data, 
            showHideTransition : 'fade',  
            bgColor : 'red',              
            textColor : '#fff',       
            allowToastClose : false,    
            hideAfter : 4000,
            loader: false,                               
            textAlign : 'center',           
            position : 'top-right'  
           });

          }
       }
   });
}
 });
    

$(document).ready(function() {
  $('#regBtn').click(function(e) {
    e.preventDefault();
     $('#regBtn').html("Registering...");

    $.ajax({
       type: "POST",
       url: '../inc/user/register.php',
       data: $("#registerForm-2").serialize(),
       success: function(data)
       {
           if(data.trim() == 1){

             $.toast({ 
            text : 'Successfully registered. Check your registered email for activation.', 
            showHideTransition : 'fade',  
            bgColor : 'green',              
            textColor : '#fff',       
            allowToastClose : false,    
            hideAfter : 4000,
            loader: false,                               
            textAlign : 'center',           
            position : 'top-right'  
           });

                   
                   
                   $('#registerForm-2')[0].reset();
                   $('#regBtn').html("Get Started");
                  }else{
                    $.toast({ 
            text : data, 
            showHideTransition : 'fade',  
            bgColor : 'red',              
            textColor : '#fff',       
            allowToastClose : false,    
            hideAfter : 4000,
            loader: false,                               
            textAlign : 'center',           
            position : 'top-right'  
           });

                    $('#regBtn').html("Get Started");
                  }

       }
   });
 });
});



$(document).ready(function() {
  $('#registerform').submit(function(e) {
    e.preventDefault();
     
    $.ajax({
       type: "POST",
       url: '../inc/members/register.php',
       data: $(this).serialize(),
       success: function(data)
       {
           if(data.trim() == 1){

             $.toast({ 
            text : 'Successfully registered. Proceed to login.', 
            showHideTransition : 'fade',  
            bgColor : 'green',              
            textColor : '#fff',       
            allowToastClose : false,    
            hideAfter : 4000,
            loader: false,                               
            textAlign : 'center',           
            position : 'top-right'  
           });

                   
                   
                   $('#registerform')[0].reset();
                   $('.login-section').addClass('section-open');
                 $('.login-section').removeClass('section-close');
                 $('.signup-section').addClass('section-close');
                 $('.signup-section').removeClass('section-open');
                  }else{
                    $.toast({ 
            text : data, 
            showHideTransition : 'fade',  
            bgColor : 'red',              
            textColor : '#fff',       
            allowToastClose : false,    
            hideAfter : 4000,
            loader: false,                               
            textAlign : 'center',           
            position : 'top-right'  
           });
                  }

       }
   });
 });
});


       $(document).ready(function() {

            filter_data();

            function filter_data() {
                $('.filter_data');
                
               
                var action = 'fetch-store-products.php';
                var minimum_price = $('#min_price_hide').val();
                var maximum_price = $('#max_price_hide').val();
                var sorting = $('#sorting').val();


                var brand = get_filter('brand');
                var low_price = get_filter('low_price');
                var high_price = get_filter('high_price');
                var paginate = get_filter("paginate");
                var size = get_filter('size');
                var color = get_filter('color');
                var icategory = get_filter('icategory');

                


                

                //console.log(icategory);
                $.ajax({
                    url: "fetch-store-products.php",
                    method: "POST",
                    data: {
                        action: action,
                        minimum_price: minimum_price,
                        maximum_price: maximum_price,
                        brand: brand,
                        size: size,
                        color: color,
                        sorting: sorting,
                        icategory: icategory                  



                        
                    },
                 
                    success: function(data) {
                        $('.filter_data').html(data);
                         $('.loading-overlay').fadeOut("slow");
                    }
                });
            }

            //executes code below when user click on pagination links
            $(".filter_data").on( "click", ".pagination a", function (e){
              e.preventDefault();
              //
              $(".loading-div").show(); //show loading element
              var page = $(this).attr("data-page"); //get page number from link

              $(".filter_data").load("fetch-store-products.php",{"page":page}, function(){ //get content from PHP page
                $(".loading-div").hide(); //once done, hide loading element
              });
              
            });

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                });
                return filter;
            }

            $('.filter_all').click(function() {
                filter_data();
            });

            $('#price_range').slider({
                range: true,
                min: 0,
                max: 1000000,
                values: [0, 1000000],
                step: 10,
                stop: function(event, ui) {
                    $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#min_price_hide').val(ui.values[0]);
                    $('#max_price_hide').val(ui.values[1]);
                    filter_data();
                }
            });

        });

if('serviceWorker' in navigator){

        console.log("service workers supported");
         //alert("service workers supported");

        window.addEventListener('load', function(){
             navigator.serviceWorker.register('sw_offlinesite.js')
            .then(function(registration){

                console.log('Service worker has registered successfully');
                console.log('Scope: ' + registration.scope)

            }, function(error){

                console.log('Service worker registration failed');
                console.log(error)
                ///alert('Service worker registration failed');

            });

        });

    }


</script>


    </body>
</html>
