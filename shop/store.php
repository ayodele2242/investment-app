<?php
include("header.php");
include("header-body.php");
 $category = new Category();
  $product = new Product();
  $parent_id = null;
  $child_cat_id = null;

  if (isset($_GET['cid'])) {
    $parent_id = (int)$_GET['cid'];
     $cat = $category->getCategoryById($parent_id);
  }

  if (isset($_GET['child_id'])) {
    $child_cat_id = (int)$_GET['child_id'];
    $cat = $category->getCategoryById($child_cat_id);

  }

  $category_product = $product->getProductByCategory($parent_id, $child_cat_id);


?>


<main id="content" role="main">
               <div class="container pt-3">

                <div class="row mb-8">

                    <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">

                        <!-- <div class="mb-6">
                           
                            <h4 class="font-size-14 mb-3 font-weight-bold">Sorting</h4>

                            <div class="pl-3 pt-2" >

                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input filter_all low_price" id="low_price" value="low_price">
                                        <label class="custom-control-label" for="">Sort by price: low to high</label>
                                    </div>
                                </div>

                                 <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input filter_all high_price" id="high_price" value="high_price">
                                        <label class="custom-control-label" for="">Sort by price: high to low</label>
                                    </div>
                                </div>

                                
                            </div>
                        </div>-->



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
                                        <input type="checkbox" class="custom-control-input filter_all icategory" id="<?php echo str_replace(' ', '-', stripslashes($parents->title)); ?>" value="<?php echo $parents->id; ?>">
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

               
                       <input type="checkbox" name="color" class="colors filter_all color"  id="<?php echo  $icolors;  ?>" value="<?php echo  $icolors ?>" />

                       
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
                                        <input type="checkbox" class="custom-control-input filter_all size" id="<?php echo $size;  ?>" value="<?php echo $size;  ?>">
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
                                        <input type="checkbox" class="custom-control-input filter_all brand" id="<?php echo $bvalue; ?>" value="<?php echo $bvalue; ?>">
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
                               
                                <div class="widget mb-2 pb-2">
                    <input type="hidden" id="min_price_hide" value="0" />
                    <input type="hidden" id="max_price_hide" value="1000000" />
                    <p id="price_show">0 - 1000000</p>
                    <div id="price_range"></div>

              
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

                


                    <div class="col-xl-9 col-wd-9gdot5">
                        
                      
                        <!-- Shop Body -->
                        <!-- Tab Content -->
                        <div class="tab-content">
                         <div class="row list-unstyled products-group no-gutters grid filter_data" id="filter_data">



                         </div>




                        </div>
                        <!-- End Tab Content -->
                        <!-- End Shop Body -->
                        <!-- Shop Pagination -->
                        <!--<nav class="d-md-flex justify-content-between align-items-center border-top pt-3" aria-label="Page navigation example">
                            <div class="text-center text-md-left mb-3 mb-md-0"></div>
                            <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start">
                                <li class="page-item"><a class="page-link current" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                            </ul>
                        </nav>-->
                        <!-- End Shop Pagination -->
                    </div>
                </div>

<?php
include("mobile-side-menu.php");
?>


            </div>
        </main>

        <?php  include("footer.php"); ?>


               <script>
$('#loadProducts').addClass("loadingProducts");
  $('#loadCategories').addClass("loadingCategories");
  $('.featured-image').addClass("loadingOverlay");
        

        $( document ).ready(function(){

            //Perform Ajax request.
            $.ajax({
                url: 'latest-products.php',
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