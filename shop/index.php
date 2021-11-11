<?php
include("header.php");
include("header-body.php");
?>

        




        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main">
           


            <!-- Vertical-Slider-Category-Banner Section -->
                        <?php include("left-vertical-menu.php");  ?>
                        <!-- End Vertical Menu -->


                      
            <!-- End Vertical-Slider-Category-Banner Section -->



            <div class="container">
                <!-- Deals of The Day -->
               
                <!-- End Deals of The Day -->

                <!-- Full banner -->
                <!--<div class="mb-6">
                    <a href="../shop/shop.html" class="d-block text-gray-90">
                        <div class="" style="background-image: url(../../assets/img/1400X206/img1.jpg);">
                            <div class="space-top-2-md p-4 pt-6 pt-md-8 pt-lg-6 pt-xl-8 pb-lg-4 px-xl-8 px-lg-6">
                                <div class="flex-horizontal-center mt-lg-3 mt-xl-0 overflow-auto overflow-md-visble">
                                    <h1 class="text-lh-38 font-size-32 font-weight-light mb-0 flex-shrink-0 flex-md-shrink-1">SHOP AND <strong>SAVE BIG</strong> ON HOTTEST TABLETS</h1>
                                    <div class="ml-5 flex-content-center flex-shrink-0">
                                        <div class="bg-primary rounded-lg px-6 py-2">
                                            <em class="font-size-14 font-weight-light">STARTING AT</em>
                                            <div class="font-size-30 font-weight-bold text-lh-1">
                                                <sup class="">$</sup>79<sup class="">99</sup>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>-->
                <!-- End Full banner -->
                <!-- Popular Categories this Week -->


                <!-- Recommendation For You -->
                <div class="mb-6">
                    <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-sm-bottom-0 mb-4">
                        <h3 class="section-title section-title__full mb-0 pb-2 font-size-22"></h3>
                        <a class="d-block  border-top border-color-1 border-md-top-0 w-100 w-md-auto pt-2 pt-md-0 col-orange" href="store">View All Products <i class="ec ec-arrow-right-categproes"></i></a>
                    </div>
                    <ul class="row list-unstyled products-group no-gutters" id="loadProducts">

                       
                   
                  
                      
                 
                  
               
                 
            
                    
                    </ul>
                </div>
                <!-- End Recommendation For You -->
           
               
                

          
            </div>
        </main>
        <!-- ========== END MAIN CONTENT ========== -->

       <?php  include("footer.php"); ?>

       <script>
$('#loadProducts').addClass("loadingProducts");
  $('#loadCategories').addClass("loadingCategories");
  $('.featured-image').addClass("loadingOverlay");
        //When the page has loaded.
        $( document ).ready(function(){
         $('.featured-image').removeClass("loadingOverlay");
          $("#loader").hide();
            //Perform Ajax request.
            $.ajax({
                url: 'loadFrontProducts.php',
                type: 'get',
                success: function(data){
                    //If the success function is execute,
                    //then the Ajax request was successful.
                    //Add the data we received in our Ajax
                    //request to the "content" div.
                    $('#loadProducts').html(data).removeClass("loadingProducts");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Ajax request failed: ' + xhr.responseText;
                    $('#loadProducts').html(errorMsg).removeClass("loadingProducts");
                  }
            });
        });


        $( document ).ready(function(){

            //Perform Ajax request.
            $.ajax({
                url: 'loadFrontCategories.php',
                type: 'get',
                success: function(data){
                    //If the success function is execute,
                    //then the Ajax request was successful.
                    //Add the data we received in our Ajax
                    //request to the "content" div.
                    $('#loadCategories').html(data).removeClass("loadingCategories");
                    
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Request failed: ' + xhr.responseText;
                    $('#loadCategories').html(errorMsg).removeClass("loadingCategories");
                    $(".product_item").removeClass("loadingCategories");
                  }
            });
        });
        </script>