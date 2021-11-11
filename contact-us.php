
<?php  
include("header-main.php");
//include("banner.php");
?>

   
  <!-- ##### Welcome Area Start ##### -->
    <div class="breadcumb-area">
        <!-- breadcumb content -->
        <div class="breadcumb-content">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="breadcumb--con text-center">
                            <h2 class="w-text title wow fadeInUp" data-wow-delay="0.2s">Contact Us</h2>
                            <ol class="breadcrumb justify-content-center wow fadeInUp" data-wow-delay="0.4s">
                                <li class="breadcrumb-item"><a href="<?php echo url; ?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Welcome Area End ##### -->

    <section class="section-padding-100 contact_us_area" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <div class="mb-15 justify-content-center fadeInUp" data-wow-delay="0.2s">
                            <span class="gradient-text blue">Contact Us</span>
                        </div>
                        <h2 class="wow fadeInUp" data-wow-delay="0.3s">Contact With Us</h2>
                        
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="contact_form">
                    	<div id="msg"></div>
                        <form action="#" method="post" id="main_contact_form" novalidate>
                            <div class="row">
                                <div class="col-12">
                                    <div id="success_fail_info"></div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="group wow fadeInUp" data-wow-delay="0.2s">
                                        <input type="text" name="name" id="name" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Name</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="group wow fadeInUp" data-wow-delay="0.3s">
                                        <input type="text" name="email" id="email" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group wow fadeInUp" data-wow-delay="0.4s">
                                        <input type="text" name="subject" id="subject" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group wow fadeInUp" data-wow-delay="0.5s">
                                        <textarea name="message" id="message" required></textarea>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Message</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.6s">
                                    <button type="submit" class="btn more-btn" id="send">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
   

<?php  
include("footer-main.php");
?>        


<script type="text/javascript">
	jQuery("#send").click(function() { 
    
    jQuery("#send").html("Sending...");
    
    var title = jQuery("#subject").val(); 
    var name = jQuery("#name").val(); 
    var mail = jQuery("#email").val();  
    var message = jQuery("#message").val(); 

   var data = "title=" + title + "&name=" + name + "&mail=" + mail + "&message=" + message;
//or however u want to format your data

jQuery.ajax({
     type: "POST",
     url: "sendmail.php",
     data: data,
      success: function (data) {
          if(data == "sent"){
             jQuery('#registerform').trigger("reset");
               
              jQuery("#send").html("SEND MESSAGE");
               
              jQuery("#msg").html('<div class="alert alert-success "><p>Thank you for the message.</p><p>We will reply as soon as possible.</p></div>').show();
              setTimeout(function() {
                  jQuery("#msg").fadeOut(1500);
              }, 10000);
              }else{
                  jQuery("#send").html("SEND MESSAGE");
                  
                   jQuery("#msg").html('<div class="alert alert-danger ">'+data+'</div>').show();
              setTimeout(function() {
                  jQuery("#msg").fadeOut(1500);
              }, 10000);
                  
              }
          
    }
});   
});  
</script>