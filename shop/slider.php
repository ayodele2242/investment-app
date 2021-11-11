  <div class="col">
                            <div class="max-width-890-wd max-width-660-xl">
                                <!-- Slider -->
                                <div class="slider-bg max-height-345-xl max-height-348-wd">
                                    <div class="overflow-hidden">
                                        <div class="js-slick-carousel u-slick"
                                            data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-start mb-3 mb-md-5 ml-3 ml-md-4 ml-lg-9 ml-xl-4 ml-wd-9">
                                    <?php 
                                    if($banner_info){
                                      foreach(array_slice($banner_info, 0, 6) as $banner_data){
                                    ?>
                                            <div class="js-slide">
                                                <div class="py-6 py-md-4 px-3 px-md-4 px-lg-9 px-xl-4 px-wd-9">
                                                    <div class="row no-gutters">
                                                        <div class="col-xl-6 col-6 mt-md-5">
                                                            <h1 class="font-size-58-sm text-lh-57 font-weight-light"
                                                                data-scs-animation-in="fadeInUp">
                                                                <?php echo wordwrap($banner_data->title,10,"<br>\n"); ?>
                                                            </h1>
                                                            <!--<h6 class="font-size-15-sm font-weight-bold mb-2 mb-md-3"
                                                                data-scs-animation-in="fadeInUp"
                                                                data-scs-animation-delay="200">UNDER FAVORABLE SMARTWATCHES
                                                            </h6>-->
                                                            <div class="mb-2 mb-md-4"
                                                                data-scs-animation-in="fadeInUp"
                                                                data-scs-animation-delay="300">
                                                                <!--<span class="font-size-13">FROM</span>
                                                                <div class="font-size-50 font-weight-bold text-lh-45">$749</div>-->
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-6 d-flex align-items-center"
                                                            data-scs-animation-in="zoomIn"
                                                            data-scs-animation-delay="400">
                                                            <img class="img-fluid max-width-300-md" src="../upload/banner/<?php echo $banner_data->image;?>" alt="Image Description">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                       <?php
                                          }
                                        }else{
                                            echo "nothing";
                                        }
                                      ?>   
                                        </div>
                                    </div>
                                </div>
                                <!-- Slider -->
                                <!-- Category -->
                                <ul class="list-group list-group-horizontal-sm position-relative z-index-2 flex-row overflow-auto overflow-md-visble" id="loadCategories">

                                  
                                   
                                   
                                </ul>
                                <!-- End Category -->
                            </div>
                        </div>
                        <!-- End Slider-Category Section -->

                        <!-- Banner -->
                        <div class="col-md-auto">
                            <div class="max-width-240-xl">
                                <div class="d-md-flex d-xl-block">
                                    <div class="bg-white border-top border-xl-top-0">
                                        <a href="returns_and_exchanges" class="text-gray-90 position-relative d-block overflow-hidden">
                                            <!--<div class="position-absolute transform-rotate-16-banner">
                                                <img class="img-fluid" src="icons/call-center.jpg" alt="Image Description" height="140" width="140">
                                            </div>-->
                                            <div class="px-3 py-6 min-height-172">
                                                <div class="i-flex">

                                                    <div id="left" class="flex-img">
                                                        <img class="icon-img" src="icons/help-2.png" alt="Help Center">
                                                        
                                                    </div>
                                                    <div id="right">
                                                         <strong>HELP CENTER</strong>
                                                         <p>Guide to Customer Care</p>
                                                    </div>

                                                </div>

                                                <!--<div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                                                    
                                                </div>
                                                <div class="link text-gray-90 font-weight-bold font-size-15" href="#">
                                                   
                                                    
                                                </div>-->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="bg-white border-top">
                                        <a href="#" class="text-gray-90 position-relative d-block overflow-hidden">
                                            <div class="position-absolute transform-rotate-16-banner">
                                                <!--<img class="img-fluid" src="assets/img/140X140/img2.png" alt="Image Description">-->
                                            </div>
                                            <div class="px-3 py-6 min-height-162">
                                                <div class="i-flex">

                                                    <div id="left" class="flex-img">
                                                        <img class="icon-img" src="icons/return.png" alt="Retun Policy">
                                                        
                                                    </div>
                                                    <div id="right">
                                                         <strong>EASY RETURN</strong>
                                                         <p>Quick Refund</p>
                                                    </div>

                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="bg-white border-top">
                                        <a href="#" class="text-gray-90 position-relative d-block overflow-hidden">
                                            <div class="position-absolute transform-rotate-16-banner">
                                               
                                            </div>
                                            <div class="px-4 py-6 min-height-162">
                                                <div class="i-flex">

                                                    <div id="left" class="flex-img">
                                                        <img class="icon-img" src="icons/delivery.png" alt="Retun Policy">
                                                        
                                                    </div>
                                                    <div id="right">
                                                         <strong>FAST DELIVERY</strong>
                                                         <p>Orders don't wait after purchase</p>
                                                    </div>

                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>