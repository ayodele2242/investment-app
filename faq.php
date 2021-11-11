
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
                            <h2 class="w-text title wow fadeInUp" data-wow-delay="0.2s">FAQ Questions</h2>
                            <ol class="breadcrumb justify-content-center wow fadeInUp" data-wow-delay="0.4s">
                                <li class="breadcrumb-item"><a href="<?php echo url; ?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Welcome Area End ##### -->


     <section class=" section-padding-100-70">
        <div class="container">
          
         
               <!-- ##### team Area Start ##### -->
        <div class="striples-bg">
            <div class="faq-timeline-area transparent section-padding-100-85" id="faq">
                <div class="container">
                    <div class="section-heading text-center">
                        
                        <div class="mb-15 justify-content-center fadeInUp" data-wow-delay="0.2s">
                            <span class="gradient-text blue">Our Platform FAQ</span>
                        </div>
                        <h2 class="fadeInUp" data-wow-delay="0.3s">  Frequently Questions</h2>
                        <p class="fadeInUp" data-wow-delay="0.4s"></p>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-6 col-md-12">
                            <div class="wrapper-counter">
                                <img src="default/img/core-img/about-2.png" alt="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-12">
                            <div class="faq-area mt-s ">
                                <dl style="margin-bottom:0">

                                  <?php
                                    $query = mysqli_query($mysqli,"select * from faqplus");
                                    $count = mysqli_num_rows($query);
                                    if($count < 1){
                                       echo '<p data-v-0517282b="" class="text-lg mt-3 font-serif font-normal col-red md:pb-0 ">Nothing here at the moment</p>';
                                    }else{
                                       while($row = mysqli_fetch_array($query)){
                                    ?>
                                    <!-- Single FAQ Area -->
                                    <dt class="wave fadeInUp" data-wow-delay="0.2s"> <?php echo ucwords($row['title']); ?> </dt>
                                    <dd class="fadeInUp" data-wow-delay="0.3s">

                                         <?php echo html_entity_decode($row['dtl']); ?>
                                    </dd>
                                    
                                   <?php 
                                    } 
                                    } 
                                    ?>
                                    
                                   
                                </dl>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
           

          

        </div>
         
        </div>
    </section>
   

<?php  
include("footer-main.php");
?>        