 <div class="mb-6 bg-gray-1 pb-4">
                <div class="container">

                    <div class="row no-gutters">
                        <!-- Vertical Menu -->
                        <div class="col-md-auto d-none d-xl-block">
                            <div class="max-width-270 min-width-270">
                                <!-- Basics Accordion -->
                                <div id="basicsAccordion">
                                    <!-- Card -->
                                    <div class="card border-0">
                                       
                                        <div class="card-header card-collapse border-0 flex-center-between bg-primary text-lh-1 rounded-0" id="basicsHeadingOne">
                                            <div class="btn-link btn-remove-focus btn-block pl-4 py-3 card-btn shadow-none rounded-0 border-0 font-weight-bold text-gray-90"
                                                data-toggle="collapse"
                                                data-target="#basicsCollapseOne"
                                                aria-expanded="true"
                                                aria-controls="basicsCollapseOne">
                                                <span class="pl-1 text-gray-90">Departments</span>
                                            </div>
                                            <a href="category" class="d-block font-size-13 py-3 pr-4 font-weight-bold text-gray-90 ml-auto flex-shrink-0">View All</a>
                                        </div>

                                        <div id="basicsCollapseOne" class="collapse show vertical-menu rounded-0"
                                            aria-labelledby="basicsHeadingOne"
                                            data-parent="#basicsAccordion">
                                            <div class="card-body p-0">
                                                <nav class="js-mega-menu navbar navbar-expand-xl u-header__navbar u-header__navbar--no-space hs-menu-initialized">
                                                    <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                                        <ul class="navbar-nav u-header__navbar-nav">
                                                            

                                                    <?php 
                                                     if(isset($parent_cats) && !empty($parent_cats)){
                                                     $i = 0;
                                                     foreach (array_slice($parent_cats, 0, 13) as $parents ) {
                                                     $child_cats = $category->getChildByParentId($parents->id);
                                                       
                                                    ?>


                                                            
                                                            <!-- Nav Item MegaMenu -->
                                                            <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                                data-event="hover"
                                                                data-animation-in="slideInUp"
                                                                data-animation-out="fadeOut"
                                                                data-position="left">
                                                                <a id="basicMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="category?cid=<?php echo $parents->id; ?>" aria-haspopup="true" aria-expanded="false"><?php echo stripslashes($parents->title); ?></a>

                                                                <!-- Nav Item - Mega Menu -->
                                                                <?php  if ($child_cats) {   ?>
                                                                <div class="hs-mega-menu vmm-tfw u-header__sub-menu" aria-labelledby="basicMegaMenu">
                                                                    <!--<div class="vmm-bg">
                                                                        <img class="img-fluid" src="<?php echo '../upload/category/'.$parents->featured_image; ?>" alt="<?php echo stripslashes($parents->title); ?>" style="width: 100%; max-width: 200px; height: 100%; max-height: 150px;">
                                                                    </div>-->
                                                                    <div class="row u-header__mega-menu-wrapper">
                                                                         <?php 
                                                              foreach (array_slice($child_cats, 0, 6) as $children) {
                                                                                                                             
                                                               $subchild_cats = $category->getChildByParentId($children->id);
                                                              ?>
                                                                        <div class="col-lg-4 mb-3 mb-sm-0">

                                                                            <span class="u-header__sub-menu-title"> <?php echo stripcslashes(mb_strimwidth($children->title, 0, 30, "...")); ?> </span>
                                                                            <ul class="u-header__sub-menu-nav-group mb-3">
                                                                                 <?php 
                                                                     foreach (array_slice($subchild_cats, 0, 10) as $subchildren) {

                                                                       ?>
                                                                                <li><a class="nav-link u-header__sub-menu-nav-link" href="detail?id=<?php echo $subchildren->id; ?>"><?php echo stripcslashes(mb_strimwidth($subchildren->title, 0, 30, "...")); ?></a></li>
                                                                                
                                                                            

                                                                                 <?php } ?>
                                                                            </ul>
                                                                        </div>

                                                                       
                                                                         <?php 
                                                               }
                                                                ?>
                                                                    </div>
                                                                </div>
                                                                <?php } ?>
                                                                <!-- End Nav Item - Mega Menu -->
                                                            </li>
                                                            <!-- End Nav Item MegaMenu-->


                                                             <?php 
                                                 
                                                        }
                                                      } ?>


                                                         
                                                            <!-- End Nav Item -->
                                                        </ul>
                                                    </div>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Card -->
                                </div>
                                <!-- End Basics Accordion -->
                            </div>
                        </div>


                          <!-- Slider-Category Section -->
                      <?php

                      if((isset($current_page)) && $current_page == 'index'){
                       include("slider.php"); 
                   }

                       ?>
                        <!-- End Banner -->
                    </div>
                </div>
            </div>