
                  <!-- Sidebar Navigation -->
        <aside id="sidebarContent1" class="u-sidebar u-sidebar--left" aria-labelledby="sidebarNavToggler1">
            <div class="u-sidebar__scroller">
                <div class="u-sidebar__container">
                    <div class="">
                        <!-- Toggle Button -->
                        <div class="d-flex align-items-center pt-3 px-4 bg-white">
                            <button type="button" class="close ml-auto"
                                aria-controls="sidebarContent1"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-unfold-event="click"
                                data-unfold-hide-on-scroll="false"
                                data-unfold-target="#sidebarContent1"
                                data-unfold-type="css-animation"
                                data-unfold-animation-in="fadeInLeft"
                                data-unfold-animation-out="fadeOutLeft"
                                data-unfold-duration="500">
                                <span aria-hidden="true"><i class="ec ec-close-remove"></i></span>
                            </button>
                        </div>
                        <!-- End Toggle Button -->

                        <!-- Content -->
                        <div class="js-scrollbar u-sidebar__body">
                            <div class="u-sidebar__content u-header-sidebar__content px-4">

                                 <div class="mb-6">
                           
                            <h4 class="font-size-14 mb-3 font-weight-bold">Categories</h4>

                            <div class="scrollbars pl-3 pt-2" id="style-11"  >
                                 <?php

                     if(isset($parent_cats) && !empty($parent_cats)){
                           
                      foreach ($parent_cats as $parents ) {
                          $child_cats = $category->getChildByParentId($parents->id);
                          ?>

                           <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input filter_all" id="<?php echo str_replace(' ', '-', stripslashes($parents->title)); ?>" value="<?php echo $parents->id; ?>">
                                        <label class="custom-control-label" for="<?php echo str_replace(' ', '-', stripslashes($parents->title)); ?>"><?php echo ucwords($parents->title); ?></label>
                                    </div>
                                </div>


                          <?php
         
                               }
                              }
                          ?>

                            </div>

                        
                    </div>

                        <div class="mb-6">
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Filters</h3>
                            </div>
                            <div class="border-bottom pb-4 mb-4">
                                <h4 class="font-size-14 mb-3 font-weight-bold">Color</h4>

                                <div class="grid-uniform" data-prefix="color">
                        <div id="filter-1" class="sb-filter color" data-type="color">
                          
                           <div class="d-flex flex-wrap">
                   <?php
                    $cquery = mysqli_query($mysqli,"
                    SELECT DISTINCT(color)  FROM product_colors ORDER BY color DESC
                    ");

                     $ccount = mysqli_num_rows($cquery);
                    if($ccount < 1){
                      echo "No brands available.";
                    }else{
                    
                    while($crow = mysqli_fetch_array($cquery))
                    {
                       $colors[] = lcfirst($crow['color']);
     
                    }

                $j = 0; 
                foreach( $colors as $element) {  
            $arr[$j] = strtolower($element); 
              
            $j++; 
        } 

        //print_r($arr);

   
                $colors = array_unique(array_map('trim', explode(',', implode(',', $arr))));
        sort($colors);
          $icolors = implode(',', $colors);



          $mcolor = explode(',',  $icolors);
        foreach($mcolor as $color) {
          # code...
        $icolor = str_replace(" ", "", $color);
        if( preg_match("/_|&|%/", $icolor) )
                       {
                        $names_array = array_map('trim',explode('&', $icolor));
                        $grad = array();
                        foreach($names_array as $gradient){
                        //echo $names_array[2];
                          
                          $grad[] = $gradient;

                          }
                          $grad = implode(",", $grad);  
                          

        ?>
                   <div class="radio  iradio-type-button2" style="background-image: linear-gradient(to right, <?php echo  $grad; ?>
    );"  data-toggle="tooltip" data-placement="top" title="<?php echo $icolor; ?>">
                   <?php
                   

                 }else{
                   ?>
                     <div class="radio  iradio-type-button2" style="background: <?php  echo $icolor; ?>"  data-toggle="tooltip" data-placement="top" title="<?php  echo $icolor; ?>">

                <?php
              }

              ?>

               <label class="checkLabel">
                       <input type="radio" name="color" class="colors filter_all"  data-size="<?php echo  $icolors;  ?>" value="<?php echo  $icolors ?>" />

                       <span class="text">
                       
                       </span>

                     </label>

                   </div>          

              <?php

                }
              }
                ?>  



                  
                </div>
                         
                        </div>
                      </div>
                                <!-- End Checkboxes -->

                          
                                <!-- End Link -->
                            </div>


                            <div class="border-bottom pb-4 mb-4">
                                <h4 class="font-size-14 mb-3 font-weight-bold">size</h4>
                                <div class="scrollbars pl-3 pt-2" id="style-16" >
                        
                                <?php
                    $squery = mysqli_query($mysqli,"
                    SELECT DISTINCT(size)  FROM product_sizes ORDER BY size DESC
                    ");

                     $scount = mysqli_num_rows($squery);
                    if($scount < 1){
                      echo "No sizes available.";
                    }else{
                    
                    while($srow = mysqli_fetch_array($squery))
                    {
                       $sizes[] = $srow['size'];
     
                    }

                    $sj = 0; 
                foreach( $sizes as $selement) {  
            $sarr[$sj] = strtolower($selement); 
              
            $sj++; 
        } 
   
                $sizes = array_unique(array_map('trim', explode(',', implode(',', $sarr))));
        sort($sizes);
          $isizes = implode(',', $sizes);

          $msize = explode(',', $isizes);
        foreach($msize as $size) {
          # code...
        

        ?>


                                <!-- Checkboxes -->
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input filter_all" id="<?php echo $size;  ?>" value="<?php echo $size;  ?>">
                                        <label class="custom-control-label" for="<?php echo $size;  ?>"><?php echo $size;  ?></label>
                                    </div>
                                </div>
                               
                                
        <?php
         }
        }

                    ?>                        <!-- End Checkboxes -->

                              
                                <!-- End View More - Collapse -->
                            </div>
                              
                            </div>


                            <div class="border-bottom pb-4 mb-4 mt-3">
                                <h4 class="font-size-14 mb-3 font-weight-bold">Brand</h4>
                                <div class="scrollbars pl-3 pt-2" id="style-16">
                        
                                <?php
                    $bquery = mysqli_query($mysqli,"
                    SELECT DISTINCT(brand)  FROM product_brands where brand != '' ORDER BY brand DESC
                    ");

                    $bcount = mysqli_num_rows($bquery);
                    if($bcount < 1){
                      echo "No brands available.";
                    }else{

                    
                    while($brow = mysqli_fetch_array($bquery))
                    {
                      $brands[] = $brow['brand'];
                                        
                   }


                   $bj = 0; 
                foreach( $brands as $belement) {  
            $barr[$bj] = strtolower($belement); 
              
            $bj++; 
        }  

                $brands = array_unique(array_map('trim', explode(',', implode(',', $barr))));
        sort($brands);
          $ibrands = implode(',', $brands);

          $mbrands = explode(',', $ibrands);
        foreach($mbrands as $bvalue) {

                ?>

                                <!-- Checkboxes -->
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input filter_all" id="<?php echo $bvalue; ?>" value="<?php echo $bvalue; ?>">
                                        <label class="custom-control-label" for="<?php echo $bvalue; ?>"><?php echo ucwords($bvalue); ?></label>
                                    </div>
                                </div>
                               
                                
        <?php
         }
        }

                    ?>                        <!-- End Checkboxes -->

                              
                                <!-- End View More - Collapse -->
                            </div>
                              
                            </div>





                            <div class="range-slider">
                                <h4 class="font-size-14 mb-3 font-weight-bold">Price</h4>
                                <!-- Range Slider -->
                                <span class="irs js-irs-0 u-range-slider u-range-slider-indicator u-range-slider-grid"><span class="irs"><span class="irs-line" tabindex="0"><span class="irs-line-left"></span><span class="irs-line-mid"></span><span class="irs-line-right"></span></span><span class="irs-min" style="display: none;">0</span><span class="irs-max" style="display: none;">1</span><span class="irs-from" style="display: none; left: 0%;">0</span><span class="irs-to" style="display: none; left: 0%;">0</span><span class="irs-single" style="display: none; left: 0%;">0</span></span><span class="irs-grid"></span><span class="irs-bar" style="left: 2.98612%; width: 94.0278%;"></span><span class="irs-shadow shadow-from" style="display: none;"></span><span class="irs-shadow shadow-to" style="display: none;"></span><span class="irs-slider from type_last" style="left: 0%;"></span><span class="irs-slider to" style="left: 94.0278%;"></span></span><input class="js-range-slider irs-hidden-input" type="text" data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid" data-type="double" data-grid="false" data-hide-from-to="true" data-prefix="$" data-min="0" data-max="3456" data-from="0" data-to="3456" data-result-min="#rangeSliderExample3MinResult" data-result-max="#rangeSliderExample3MaxResult" tabindex="-1" readonly="">
                                <!-- End Range Slider -->
                                <div class="mt-1 text-gray-111 d-flex mb-4">
                                    <span class="mr-0dot5">Price: </span>
                                    <span>$</span>
                                    <span id="rangeSliderExample3MinResult" class="">0</span>
                                    <span class="mx-0dot5"> — </span>
                                    <span>$</span>
                                    <span id="rangeSliderExample3MaxResult" class="">3456</span>
                                </div>
                                
                            </div>
                        </div>


                        <div class="mb-8">
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Latest Products</h3>
                            </div>
                            <ul class="list-unstyled" id="loadCategories">





                               
                              
                            </ul>
                        </div>
                    </div>
                               

                                
                            </div>
                        </div>
                        <!-- End Content -->
                    </div>
                </div>
            </div>
        </aside>
        <!-- End Sidebar Navigation -->