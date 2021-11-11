
<!--<footer class="footer-bg">
<div class="container">
<div class="footer-upper">
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-4">
<div class="footer-content-item">
<div class="footer-logo">
<a href="<?php //echo url; ?>"><img src="<?php //echo $set['installUrl'].'assets/logo/'.$set['logo']; ?>" alt="logo" style="height: 70px; width: auto;"></a>
</div>
<div class="footer-details">
<p></p>
</div>
</div>
</div>
<div class="col-sm-6 col-md-4 col-lg-2">
<div class="footer-content-list footer-content-item">
<div class="footer-content-title">
<h3>Support</h3>
</div>
<ul class="footer-details footer-list">
<li><a href="private-policy">Privacy Policy</a></li>
<li><a href="terms-conditions">Terms & Conditions</a></li>
</ul>
</div>
</div>
<div class="col-sm-6 col-md-4 col-lg-2">
<div class="footer-content-list footer-content-item">
<div class="footer-content-title">
<h3>Company</h3>
</div>
<ul class="footer-details footer-list">
<li><a href="about-us">About Us</a></li>
</ul>
</div>
</div>
<div class="col-sm-6 col-md-4 col-lg-4">
<div class="footer-content-list footer-content-item">
<div class="footer-content-title">
<h3>Head Office Address</h3>
</div>
<ul class="footer-details footer-list">
<li>Address: <span><?php echo $set['address']; ?></span></li>
<li>Message: <span><a href="mailto:<?php echo $set['Email']; ?>"><span class="__cf_email__"><?php echo $set['Email']; ?></span></a></span></li>
<li>Phone: <span><a href="tel:<?php echo $set['contactNum']; ?>"><?php echo $set['contactNum']; ?></a></span></li>

</ul>
</div>
</div>
</div>
</div>
<div class="footer-lower">
<div class="footer-lower-item footer-copyright-text">
<p>Copyright © 2020 - <?php echo date("Y"); ?>. <?php echo $set['storeName']; ?></p>
</div>

</div>
</div>
</footer>-->



<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<!--<script src="front/js/jquery-3.5.1.min.js"></script>-->
<script src="vendor/jquery.2.2.3.min.js"></script>

<script src="front/js/bootstrap.bundle.min.js"></script>



<script src="front/js/jquery.magnific-popup.min.js"></script>

<script src="front/js/owl.carousel.min.js"></script>

<script src="front/js/jquery.ajaxchimp.min.js"></script>

<script src="front/js/form-validator.min.js"></script>

<script src="front/js/contact-form-script.js"></script>

<script src="front/js/jquery.meanmenu.min.js"></script>

<script src="front/js/jquery.waypoints.js"></script>
<script src="front/js/counter-up.js"></script>
<script src="shop/frontpage/jquery.toast.min.js"></script>
<script src="front/js/script.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="assets/login/js/login-page_script.js"></script>
 <script src="assets/js/bootstrap-datepicker.min.js"></script>
 <script src="date.js"></script>
 <script type="text/javascript" src="asw.js" defer></script>

      
 <!-- Language js -->
<script src="front/lang.js"></script>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) {
        var options = {
            version: 1,
            storageName: "offline-cache",
            debug: false,
            filePath: "/asw.js",
            scope: "/",
            rules: [
                {
                    conditions: [
                        { url: "*Plugins/MediaDirectory/*.jpg" },
                        { url: "*Plugins/MediaDirectory/*.jpeg" },
                        { url: "*Plugins/MediaDirectory/*.webp" }
                    ],
                    strategy: AdvancedServiceWorker.Strategies.CacheFirst
                },
                {
                    conditions: [
                        { url: "*Plugins/MediaDirectory/*.mp4" },
                        { url: "*Plugins/MediaDirectory/*.webm" }
                    ],
                    strategy: AdvancedServiceWorker.Strategies.NetworkOnly
                },
                {
                    conditions: [
                        { url: "*.png" },
                        { url: "*.jpg" },
                        { url: "*.jpeg" },
                        { url: "*.gif" },
                        { url: "*.webp" },
                        { url: "*.ico" },
                        { url: "*.css" },
                        { url: "*.svg" },
                        { url: "*.svg?*" },
                        { url: "*.css?*" },
                        { url: "*.js" },
                        { url: "*.js?*" }
                    ],
                    strategy: AdvancedServiceWorker.Strategies.Race,
                    networkTimeout: 500,
                },
                {
                    conditions: [
                        { url: "/" },
                        { url: "/Video/*" },
                        { url: "/Tag/*" },
                        { url: "/Videos*" },
                        { url: "/Player*" }
                    ],
                    strategy: AdvancedServiceWorker.Strategies.Race,
                    offline: "/Offline",
                    networkTimeout: 3000,
                },
                {
                    conditions: [
                        { url: "*" }
                    ],
                    strategy: AdvancedServiceWorker.Strategies.Race,
                    offline: "/Offline",
                    networkTimeout: 1000,
                }
            ]
        };

        var serviceWorker = new AdvancedServiceWorker.Controller(options);
        serviceWorker.ensureInstalled();
    });
</script>

  <script type="text/javascript">

  	 String.prototype.trim = function() {
    try {
        return this.replace(/^\s+|\s+$/g, "");
    } catch(e) {
        return this;
    }
}


  	  //Back to login
  	  $(document).ready(function() {
  	  	$('.datepicker').datepicker();


     $('.login-page_back').click(function(e) {
        e.preventDefault();
       
        $('.forget-form').slideUp();
        $('.login-form').slideDown();
    });
     });

$(document).ready(function() {
  $('#loginform').submit(function(e) {
    e.preventDefault();
      var username = $("#lemail").val();
      var password = $("#lpassword").val();
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
       url: 'inc/members/login.php',
       data: $(this).serialize(),
       success: function(data)
       {
          if (data.trim() === 'ok') {
              
                 $.toast({ 
        text : 'Please wait while we log you in...', 
        showHideTransition : 'fade',  
        bgColor : 'green',              
        textColor : '#fff',       
        allowToastClose : false,    
        hideAfter : 4000,
        loader: false,                               
        textAlign : 'center',           
        position : 'top-right'  
      });



           setTimeout(' window.location.href = "member/dashboard.php"; ',1000);

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
});

$(document).ready(function() {
 
 $('.payForm').hide();

  $('#registerform').submit(function(e) {
    e.preventDefault();
     
    $.ajax({
       type: "POST",
       url: 'inc/user/register.php',
       data: $(this).serialize(),
       success: function(response)
       {

        if (response == 1) {
           $('#registerform')[0].reset();
           
      $.toast({ 
        text : 'You have successfully registered. Check your email for activation code to activate your acount.', 
        showHideTransition : 'fade',  
        bgColor : 'green',              
        textColor : '#fff',       
        allowToastClose : false,    
        hideAfter : 5000,
        loader: false,                               
        textAlign : 'center',           
        position : 'top-right'  
      });



        } else {
            //alert(response.message);
        $.toast({ 
        text : response, 
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

$('#feeform').submit(function(e) {
    e.preventDefault();
    $("#payment-btn").html('Processing');

    var name = $("#pname").val();
    var email = $("#pemail").val();
    var transId = $("#refcode").val();

    let handler = PaystackPop.setup({
    key: 'pk_test_f8a1a19e9fa5040753fc7eeab1d453f0cb9b804a',
    email: email,
    display_name: name,
    amount: 2500 * 100,
    ref: ''+Math.floor((Math.random() * 1000000000) + 1),
     metadata: {
         custom_fields: [
            {
                display_name: name,
            }
         ]
      },
    onClose: function(){
       alert('Payment cancelled');
    },
    callback: function(response){
      $("#payment-btn").html('Finanlizing Pament');
       /* var queryString = "?reference=" + response.reference + "&email=" + email + "&transId=" + transId;
          window.location.href = "payment-verify" + queryString;*/
          
          jQuery.ajax({
            url: 'payment-verify.php',
            method: 'post',
            async:false,
            data:{reference: response.reference, transId: transId, email: email},
            success: function (data) {
              if(data.trim() == 1){

              
             $('.payForm').hide();
             $('.regForm').show();
             $('#registerform').trigger("reset");
               //window.location="active-plans";
               $("#payment-btn").html('Pay');
               
              jQuery("#msgs").html('<div class="alert alert-success ">Your registration was successful. Please proceed to login in.</div>').show();
              setTimeout(function() {
                  jQuery("#msgs").fadeOut(1500);
              }, 10000);

              

              }else{

            jQuery("#msgs").html('<div class="alert alert-danger">'+data+'</div>').show();
              setTimeout(function() {
                  jQuery("#msgs").fadeOut(1500);
              }, 10000);
              
              $("#payment-btn").html('Pay');

              }
            }
          });

    }
  });
  handler.openIframe();
      
       
     // console.log(response[0].email);
    });
   

});


 /* $('#loginform').submit(function(e) {
    e.preventDefault();
     
    $.ajax({
       type: "POST",
       url: 'inc/members/session.php',
       data: $(this).serialize(),
       success: function(data)
       {
           

       }
   });
 });*/




$(document).ready(function() {
    
   /*
     $("#forgotMe").click(function(){
        alert("button");
    }); 
    
    */
    
  $('#forgotForm').submit(function(e) {
    e.preventDefault();
     
    $.ajax({
       type: "POST",
       url: 'inc/members/recoverPwd.php',
       data: $(this).serialize(),
       success: function(data)
       {
           if(data.trim() == 1){
               
               $.toast({ 
                        text : 'Password successfully sent to your email address.', 
                        showHideTransition : 'fade',  
                        bgColor : 'green',              
                        textColor : '#fff',       
                        allowToastClose : false,    
                        hideAfter : 4000,
                        loader: false,                               
                        textAlign : 'center',           
                        position : 'top-right'  
                      });

          
                   
                   $('#forgotForm')[0].reset();
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
  </script>  
<script>
    (function($) {
$.fn.menumaker = function(options) {  
 var cssmenu = $(this), settings = $.extend({
   format: "dropdown",
   sticky: true
 }, options);
 return this.each(function() {
   $(this).find(".button").on('click', function(){
     $(this).toggleClass('menu-opened');
     var mainmenu = $(this).next('ul');
     if (mainmenu.hasClass('open')) { 
       mainmenu.slideToggle().removeClass('open');
     }
     else {
       mainmenu.slideToggle().addClass('open');
       if (settings.format === "dropdown") {
         mainmenu.find('ul').show();
       }
     }
   });
   cssmenu.find('li ul').parent().addClass('has-sub');
multiTg = function() {
     cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
     cssmenu.find('.submenu-button').on('click', function() {
       $(this).toggleClass('submenu-opened');
       if ($(this).siblings('ul').hasClass('open')) {
         $(this).siblings('ul').removeClass('open').slideToggle();
       }
       else {
         $(this).siblings('ul').addClass('open').slideToggle();
       }
     });
   };
   if (settings.format === 'multitoggle') multiTg();
   else cssmenu.addClass('dropdown');
   if (settings.sticky === true) cssmenu.css('position', 'fixed');
resizeFix = function() {
  var mediasize = 1000;
     if ($( window ).width() > mediasize) {
       cssmenu.find('ul').show();
     }
     if ($(window).width() <= mediasize) {
       cssmenu.find('ul').hide().removeClass('open');
     }
   };
   resizeFix();
   return $(window).on('resize', resizeFix);
 });
  };
})(jQuery);

(function($){
$(document).ready(function(){
$("#cssmenu").menumaker({
   format: "multitoggle"
});
});
})(jQuery);
</script>
</body>
</html>