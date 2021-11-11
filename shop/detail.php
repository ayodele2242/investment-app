
<?php
include("header.php");
include("header-body.php");

//if(isset($_GET['id'])){
$p_id = (int)$_GET['id'];
//debugger($p_id);
$product = new Product();
$product_detail = $product->getProductByIdForDetail($p_id);
//debugger($product_detail);
$category_id = $product_detail[0]->cat_id;
//debugger($product_detail[0]->cat_id,true);
$picked_product = $product->getProductByCatId($category_id, $p_id);
//debugger($product_detail);
$all_images =explode(',', $product_detail[0]->image);
$countImages = count($all_images);
//debugger($all_images);
//debugger($all_images,true); 

$perPage = 2;
$sqlQuery = "SELECT * FROM  review_rating WHERE product_id = '$p_id'";
$result = mysqli_query($mysqli, $sqlQuery);
$totalRecords = mysqli_num_rows($result);
$totalPages = ceil($totalRecords/$perPage);

$sqlQuery2 = mysqli_query($mysqli,"SELECT * FROM  product_sizes WHERE product_id = '$p_id' order by variant_price");

$_SESSION['pid'] = $p_id;
$ratings = avgRating($p_id);
$limit = 3;
$reviews = getLimitRatings($p_id, $limit);

$itemRating = getItemRatings($p_id); 
    $ratingNumber = 0;
    $count = 0;
    $fiveStarRating = 0;
    $fourStarRating = 0;
    $threeStarRating = 0;
    $twoStarRating = 0;
    $oneStarRating = 0; 
    foreach($itemRating as $rate){
        $ratingNumber+= $rate['rating'];
        $count += 1;
        if($rate['rating'] == 5) {
            $fiveStarRating +=1;
        } else if($rate['rating'] == 4) {
            $fourStarRating +=1;
        } else if($rate['rating'] == 3) {
            $threeStarRating +=1;
        } else if($rate['rating'] == 2) {
            $twoStarRating +=1;
        } else if($rate['rating'] == 1) {
            $oneStarRating +=1;
        }
    }
    $average = 0;
    if($ratingNumber && $count) {
        $average = $ratingNumber/$count;
    }   
?>

<style type="text/css">
  

* {
  box-sizing: border-box;
}

img {
  vertical-align: middle;
}


/* .holder {
  display: flex;
  overflow-x: auto;
  overflow-y: hidden;
} */
.holder::-webkit-scrollbar {
  display: none;
}

/* Hide the images by default */
.slides {
  display: none;
  /* max-width: 1000px; */
  /* width: 100%;
  flex-shrink: 0;
  height: 100%; */
}

.slides img {
  width: 100%;
  height: 100%;
  max-height: 400px;
}

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (max-width: 600px) {
  .prevContainer,
.nextContainer {
    display: none;
    visibility: hidden;
  }
}
.prevContainer,
.nextContainer {
  background-color: rgba(0, 0, 0, 0.3);
  position: absolute;
  top: 50%;
  transform: translate(0, calc(-50% - 54px));
  height: 54px;
  width: 54px;
  cursor: pointer;
}

.prevContainer {
  margin-left: 26px;
  left: 0;
  border-radius: 30px 0 0 30px;
}

.prev {
  position: relative;
  top: 50%;
  transform: translate(0, -50%);
  height: 34px;
  width: 32px;
  float: left;
  margin-left: 12px;
}

.prev svg,
.next svg {
  fill: white;
}

.nextContainer {
  margin-right: 26px;
  right: 0;
  border-radius: 0 30px 30px 0;
}

.next {
  position: relative;
  top: 50%;
  transform: translate(0, -50%);
  height: 34px;
  width: 32px;
  float: right;
  margin-right: 12px;
}

/* Container for image text */
.caption-container {
  text-align: left;
  background-color: #222;
  padding: 2px 16px;
  color: white;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  float: left;
  width: 10.76%;
  margin: 4px;
}

/* Add a transparency effect for thumbnail images */
.slide-thumbnail {
  width: 100%;
  height: 100%;
  max-height: 100px;
  margin-bottom: 6px;
  opacity: 0.6;
  cursor: pointer;

}

.active,
.slide-thumbnail:hover {
  opacity: 1;
}
</style>

<main id="content" role="main">
            <!-- breadcrumb -->
            <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="<?php echo $set['installUrl']; ?>">Home</a></li>
                                
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><?php echo $product_detail[0]->title; ?></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->
            <div class="container">
                <!-- Single Product Body -->
                <div class="mb-xl-14 mb-6">

<div class="row">
   
<div class="col-md-5 mb-4 mb-md-0">

 <!-- main images -->
  <div class="holder">

<?php 
   $j = 1;
   foreach ($all_images as $key => $img) {  
    $item_class = ($j == 1) ? 'cz-preview-item active' : 'cz-preview-item';
?>
    <div class="slides">
      <img src="<?php echo '../upload/product/'.$img;?>" alt="" />
    </div>
<?php $j++; } ?>
   


  </div>

  <div class="prevContainer"><a class="prev" onclick="plusSlides(-1)">
    <svg viewBox="0 0 24 24">
    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"></path>
</svg>
    </a>
</div>
  <div class="nextContainer"><a class="next" onclick="plusSlides(1)">
    <svg viewBox="0 0 24 24">
  <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
</svg>
    </a>
</div>

  <!--<div class="caption-container">
    <p id="caption"></p>
  </div>-->

  <!-- thumnails in a row -->
  <div class="row">

   <?php 
          $i = 1;
          foreach ($all_images as $key => $img) {  
          $item_class = ($i == 1) ? 'cz-thumblist-item active' : 'cz-thumblist-item';
    ?>

    <div class="column">
      <img class="slide-thumbnail" src="<?php echo '../upload/product/'.$img;?>" onclick="currentSlide(<?php echo $i; ?>)" alt="<?php echo $product_detail[0]->title; ?>">
    </div>
<?php $i++; } ?>

  
  </div>
                       


</div>



                        <div class="col-md-7 mb-md-6 mb-lg-0">
                           <form id="productForm">
                            <div class="mb-2">
                                <div class="border-bottom mb-3 pb-md-1 pb-3">
                                    
                                    <h2 class="font-size-25 text-lh-1dot2"><?php echo $product_detail[0]->title; ?></h2>
                                    <div class="mb-2">
                                        <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="#">
                                            <div class="text-warning text-ls-n2 mr-2">
                                                <?php 

                                              //echo '<span style="font-size: 18px;">' .$ratings. "</span> <span class='stars'>";
                                              for ( $i = 1; $i <= 5; $i++ ) {
                                                  if ( round( $ratings - .25 ) >= $i ) {
                                                      echo "<i class='fas fa-star'></i>"; //fas fa-star for v5
                                                  } elseif ( round( $ratings + .25 ) >= $i ) {
                                                      echo "<i class='fas fa-star-half-alt '></i>"; //fas fa-star-half-alt for v5
                                                  } else {
                                                      echo "<i class='far fa-star text-muted'></i>"; //far fa-star for v5
                                                  }
                                              }
                                              //echo '</span>';
                                              ?>
                                               
                                            </div>
                                            <span class="text-secondary font-size-13">(
                                                <?php 
                                                if(review($p_id) < 2){
                                                echo review($p_id) .' Review';
                                                }else{
                                                echo review($p_id). ' Reviews';
                                              }
                                              ?>
                                            )</span>
                                        </a>
                                    </div>
                                    <div class="d-md-flex align-items-center">
                                        <?php if (isset($product_detail[0]->brand)) { ?>
                                        Brand: &nbsp;&nbsp;&nbsp;&nbsp; <a href="brand?name=<?php echo $product_detail[0]->brand; ?>" class="max-width-150 ml-n2 mb-2 mb-md-0 d-block"><?php echo stripcslashes($product_detail[0]->brand); ?></a>
                                       <?php  } ?>

                                        <div class="ml-md-3 text-gray-9 font-size-14">Availability: 
                                            <?php if($product_detail[0]->quantity > 5){ ?>
                                            <span class="text-green font-weight-bold"><?php echo $product_detail[0]->quantity;  ?> in stock</span>
                                        <?php }else{ ?>
                                             <span class="text-red font-weight-bold"><?php echo $product_detail[0]->quantity;  ?> in stock</span>

                                        <?php } ?>

                                        </div>


                                    </div>
                                </div>
                                <div class="flex-horizontal-center flex-wrap mb-4">
                                  
                                     


                            
                                </div>
                                <div class="mb-2">
                                    
                                      <?php echo $product_detail[0]->summary;?>
                                     
                                </div>
                                <p><strong>SKU</strong>: <?php echo $product_detail[0]->sku ?></p>
                                <div class="mb-4">
                                    <div class="d-flex align-items-baseline">
                                        <?php 
                                           if($product_detail[0]->size_category == "different"){
                                                 $prices = $product_detail[0]->price;
                                                 $amt = explode(",", $prices);
                                                 $min = min($amt);
                                                 $max = max($amt);

                                                 $price = $min;

                                                 $prices = " ".$left_currency.number_format($min).$right_currency.' - '." ".$left_currency.number_format($max).$right_currency; 

                                                 echo '<ins class="font-size-36 text-decoration-none">'.$prices.'</ins>';
                                                 

                                                }else{
                                                $price = $product_detail[0]->price;
                                                $discount = $product_detail[0]->discount;
                                                if($discount > 0){
                                                  $price = $price-(($price*$discount)/100);
                                                }
                                            ?>

                                         <ins class="font-size-36 text-decoration-none"><?php echo $left_currency.number_format($price).$right_currency; ?></ins>
                                          <?php
                                          if($discount > 0){
                                                echo ' <del class="font-size-20 ml-2 text-gray-6">'.$left_currency.number_format($product_detail[0]->price).$right_currency.'</del>';
                                            }
                                          }
                                          ?>

                                    </div>

                                </div>
                                <span class="price-new mb-4"><strong class="col-red" id="price-old"><?php //echo " ".$left_currency.number_format($price).$right_currency; ?></strong></span>


                                <div class="border-top border-bottom py-3 mb-4">
                                    <div class="d-flex align-items-center">
                                        
                                      <?php 
                 if (!empty($product_detail[0]->color)) {
                ?>
                
              <div class="form-group">
                    <div class="d-flex justify-content-between align-items-center pb-1">
                      <label class="font-weight-medium" for="product-color">Pick Color:</label>
                    </div>

                    <div id="input-options" class="d-flex flex-wrap input-options">

                  <?php
                   $colors = explode(",", $product_detail[0]->color);
                     foreach($colors as $icolor){
                      $icolors = str_replace(" ", "", $icolor);
                      if( preg_match("/_|&|%/", $icolors) )
                       {
                        $names_array = array_map('trim',explode('&', $icolors));
                        $grad = array();
                        foreach($names_array as $gradient){
                        //echo $names_array[2];
                          
                          $grad[] = $gradient;

                          }
                          $grad = implode(",", $grad);  
                          


                  ?>
                   <div class="radio  iradio-type-button2" style="background-image: linear-gradient(to right, <?php echo  $grad; ?>
    );"  data-toggle="tooltip" data-placement="top" title="<?php echo $icolors; ?>">
                    <?php
                   

                 }else{
                   ?>
                   <div class="radio  iradio-type-button2" style="background: <?php  echo $icolors; ?>"  data-toggle="tooltip" data-placement="top" title="<?php  echo $icolors; ?>">
                   <?php
                   }
                  ?>

                     <label class="checkLabel">
                       <input type="radio" name="color" class="colors"  data-size="<?php echo  $icolors;  ?>" value="<?php echo  $icolors ?>" />

                       <span class="text">
                       
                       </span>

                     </label>

                   </div>                   
                   <?php
                     }
                   ?>

                

                 </div>




                     <div class="d-flex flex-wrap">
                    
                   </div>
                   
                  </div>
                   </div>

                <?php } 
                ?>

                 <?php 
                 if ($product_detail[0]->size_category == "single" && !empty($product_detail[0]->size)) {
                ?>
                  <div class="form-group">
                    <div class="d-flex justify-content-between align-items-center pb-1">
                      <label class="font-weight-medium" for="product-size">Pick Size:</label>
                    </div>

                  
                    <div id="input-option" class="radios">
                       <?php
                      $sizes = explode(",", $product_detail[0]->size);
                       foreach($sizes as $isize){
                        ?>

                       <div class="radio  radio-type-button2" data-toggle="tooltip" data-placement="top" title="<?php echo $isize; ?>">
                     <label>
                       <input type="radio" name="product_size" value="<?php echo  $isize;  ?>" />
                       <span class="text"><?php echo  $isize;  ?>
                        
                       </span>
                     </label>
                   </div> 
                   <?php
                   }

                      ?>        

                       <input type="hidden" name="sprice" id="prize" value="<?php echo  $price; ?>" >
                       <input type="hidden" name="sseller" value="<?php echo $product_detail[0]->vendor_name; ?>">
                       <input type="hidden" name="product_id" value="<?php echo $product_detail[0]->id; ?>">
                       <input type="hidden" name="cat_type" id="cat_type" value="single">
                       <input type="hidden" name="mysession" id="mysession" value="<?php echo session_id(); ?>">

                    </div> 

                  </div>
                <?php 
              }
                 if ($product_detail[0]->size_category == "different") {
               
                //get item size variance with price


                  ?>


            <div id="product">
               <div class="options">
                 <div class="form-group">
                  <div class="d-flex justify-content-between align-items-center pb-1">
                      <label class="font-weight-medium" for="product-size">Pick Size:</label>
                    </div>
                 <div id="input-option" class="d-flex flex-wrap">

                  <?php
                  $color_arrar = array('#9933CC','#4285F4','#880e4f','#01579b','#e65100');
                  //$size_of_array = sizeof($color_arrar);
                  $x=0;
                  while($result = mysqli_fetch_array($sqlQuery2)){
                    $x++;
                    //$n = rand(0,$size_of_array-1);
                    //$color = $color_arrar[$n%5];
                    $color = $color_arrar[$x%5];
                  ?>
                   <div class="radio  radio-type-button2" style="background: <?php  echo $color; ?>"  data-toggle="tooltip" data-placement="top" title="<?php echo $left_currency.number_format($result['variant_price']).$right_currency; ?>">
                     <label>
                       <input type="radio" name="product_price" id="<?php echo  $result['id'];  ?>" data-size="<?php echo  $result['size'];  ?>" value="<?php echo  $result['variant_price']  ?>" />
                       <span class="text"><?php echo  $result['size'];  ?>
                        
                       </span>
                     </label>
                   </div>                   
                   <?php
                     }
                   ?>

                   <input type="hidden" name="dproduct_id" id="product_id">
                   <input type="hidden" name="dsize" id="size">
                   <input type="hidden" name="dprice" id="prize">
                   <input type="hidden" name="dseller" value="<?php echo $product_detail[0]->vendor_name; ?>">
                   <input type="hidden" name="cat_type" id="cat_type" value="different">
                   <input type="hidden" name="img" id="imgy">
                   <input type="hidden" name="mysession" id="mysession" value="<?php echo session_id(); ?>">

                   

                 </div>

               </div>
           
                </div>

            </div>



                <?php
                } 
                ?>


                                   
                                </div>
                                <div class="d-md-flex align-items-end mb-3">
                                    <div class="max-width-150  mb-3">
                                      <div class="number-spinner">
                                      <span class="ns-btn">
                                          <a data-dir="dwn" id="q_down"><span class="icon-minus"></span></a>
                                      </span>
                                      <input type="text" class="pl-ns-value" name="quantity" id="quantity_wanted" value="1" maxlength=2>
                                      <span class="ns-btn">
                                          <a data-dir="up" id="q_up"><span class="icon-plus"></span></a>
                                      </span>
                                    </div>
                                    
                                    </div>

                                    <div class="ml-md-3 mb-3">
                                        <?php if($product_detail[0]->quantity > 0) { ?>
                                            <button class="btn px-5 btn-primary-dark transition-3d-hover" type="submit" id="addToCart"><i class="ec ec-add-to-cart mr-2 font-size-20"></i> Add to Cart</button>
                                         <?php }else{ ?>

                                             <button class="btn bg-red btn-shadow btn-md inactive disabled" type="submit" ><i class="ec ec-add-to-cart mr-2 font-size-20"></i> Sold out</button>

                                         <?php } ?>


                                    </div>
                                    <div class="ml-md-3 mb-3">
                    <button class="btn-wishlist mr-lg-n3 mr-2" type="button" onclick="addToWishlist(<?php echo $product_detail[0]->id;?>);" data-toggle="tooltip" title="Add to wishlist">
                    <i class="fa fa-heart"></i>
                  </button>
              </div>

                                </div>
                            </div>
                        </div>
                      </form>
                    </div>
                </div>
                <!-- End Single Product Body -->
                <!-- Single Product Tab -->
                <div class="mb-8">
                    <div class="position-relative position-md-static px-md-6">
                        <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
                           

                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link" id="Jpills-two-example1-tab" data-toggle="pill" href="#Jpills-two-example1" role="tab" aria-controls="Jpills-two-example1" aria-selected="false">Description</a>
                            </li>

                           
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link active" id="Jpills-four-example1-tab" data-toggle="pill" href="#Jpills-four-example1" role="tab" aria-controls="Jpills-four-example1" aria-selected="true">Reviews</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                        <div class="tab-content" id="Jpills-tabContent">

                            <div class="tab-pane fade" id="Jpills-two-example1" role="tabpanel" aria-labelledby="Jpills-two-example1-tab">
                                
                             <?php echo html_entity_decode($product_detail[0]->description); ?>
                            </div>

                            
                            <div class="tab-pane fade active show" id="Jpills-four-example1" role="tabpanel" aria-labelledby="Jpills-four-example1-tab">
                                <div class="row mb-8">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <h3 class="font-size-18 mb-6">Based on <?php 
                                                if(review($p_id) < 2){
                                                echo review($p_id) .' Review';
                                                }else{
                                                echo review($p_id). ' Reviews';
                                              }
                                              ?> &nbsp;&nbsp; - &nbsp;&nbsp;<a href="#" data-id="<?php echo $p_id; ?>" class="col-purple productinfo" data-toggle="modal" data-target="#PanelLeft">View all reviews</a></h3> 
                                            <h2 class="font-size-30 font-weight-bold text-lh-1 mb-0"><?php if($ratings < 1 ){ echo '0.0'; }else{ echo $ratings; }  ?></h2>
                                            <div class="text-lh-1">overall</div>
                                        </div>

                                        <?php
                                        $fiveStarRatingPercent = round(($fiveStarRating/5)*100);
                                        $fiveStarRatingPercent = !empty($fiveStarRatingPercent)?$fiveStarRatingPercent.'%':'0%';    
                                        
                                        $fourStarRatingPercent = round(($fourStarRating/5)*100);
                                        $fourStarRatingPercent = !empty($fourStarRatingPercent)?$fourStarRatingPercent.'%':'0%';
                                        
                                        $threeStarRatingPercent = round(($threeStarRating/5)*100);
                                        $threeStarRatingPercent = !empty($threeStarRatingPercent)?$threeStarRatingPercent.'%':'0%';
                                        
                                        $twoStarRatingPercent = round(($twoStarRating/5)*100);
                                        $twoStarRatingPercent = !empty($twoStarRatingPercent)?$twoStarRatingPercent.'%':'0%';
                                        
                                        $oneStarRatingPercent = round(($oneStarRating/5)*100);
                                        $oneStarRatingPercent = !empty($oneStarRatingPercent)?$oneStarRatingPercent.'%':'0%';
                                        
                                        ?>


                                        <!-- Ratings -->
                                        <ul class="list-unstyled">
                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">

                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar progress-bar-success" role="progressbar" style="width: <?php echo $fiveStarRatingPercent; ?>;"aria-valuenow="5" aria-valuemin="0" aria-valuemax="5"></div>

                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-right">
                                                        <span class="text-gray-90"><?php echo $fiveStarRating; ?></span>
                                                    </div>
                                                </a>
                                            </li>

                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">

                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                    </div>
                                                   <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar progress-bar-blue" role="progressbar" style="width: <?php echo $fourStarRatingPercent; ?>;"aria-valuenow="4" aria-valuemin="0" aria-valuemax="5"></div>

                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-right">
                                                        <span class="text-gray-90"><?php echo $fourStarRating; ?></span>
                                                    </div>
                                                </a>
                                            </li>


                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">

                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                    </div>
                                                   <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar progress-bar-primary" role="progressbar" style="width: <?php echo $threeStarRatingPercent; ?>;"aria-valuenow="3" aria-valuemin="0" aria-valuemax="5"></div>

                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-right">
                                                        <span class="text-gray-90"><?php echo $threeStarRating; ?></span>
                                                    </div>
                                                </a>
                                            </li>


                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">

                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                    </div>
                                                   <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar progress-bar-yellow" role="progressbar" style="width: <?php echo $twoStarRatingPercent; ?>;"aria-valuenow="2" aria-valuemin="0" aria-valuemax="5"></div>

                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-right">
                                                        <span class="text-gray-90"><?php echo $twoStarRating; ?></span>
                                                    </div>
                                                </a>
                                            </li>

                                                <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">

                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                    </div>
                                                   <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar progress-bar-red" role="progressbar" style="width: <?php echo $oneStarRatingPercent; ?>;"aria-valuenow="1" aria-valuemin="0" aria-valuemax="5"></div>

                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-right">
                                                        <span class="text-gray-90"><?php echo $oneStarRating; ?></span>
                                                    </div>
                                                </a>
                                            </li>
                                            
                                           
                                         
                                        </ul>
                                        <!-- End Ratings -->
                                    </div>

                                   
                                </div>


                                 <?php   
                                
                                foreach ($reviews as $value) {
                                    
                                 ?>
                                <!-- Review -->
                                <div class="pb-4 border-bottom mb-3">
                                    <!-- Review Rating -->
                                    <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                                        <div class="text-warning text-ls-n2 font-size-16" style="width: auto;">
                                           <?php echo mrate($value['rating']); ?>
                                        </div>
                                    </div>
                                    <!-- End Review Rating -->

                                    <p class="text-gray-90"><?php echo $value['review']; ?></p>

                                    <!-- Reviewer -->
                                    <div class="mb-2">
                                        <strong><?php echo $value['name']; ?></strong>
                                        <span class="font-size-13 text-gray-23">- <?php echo $value['added_date']; ?></span>
                                    </div>
                                    <!-- End Reviewer -->
                                </div>
                                <!-- End Review -->

                                <?php } ?>

                                


                            </div>
                        </div>
                    </div>
                    <!-- End Tab Content -->
                </div>
                <!-- End Single Product Tab -->
                <!-- Related products -->
                <div class="mb-6">
                    <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                        <h3 class="section-title mb-0 pb-2 font-size-22">Related products</h3>
                    </div>

                    <ul class="row list-unstyled products-group no-gutters">

                        <?php  
                                        if($picked_product){
                                             foreach ($picked_product as $key => $row) {
                                                if($row->images != "" && file_exists('../upload/product/'.$row->images)){
                                                     $thumbnail = '../upload/product/'.$row->images;
                                                   } else {
                                                     $thumbnail = FRONT_IMAGES.'no-image.png';
                                                   }

                                                 $id = $row->id;
                                                 $content = $row->title;
                                             
                                             ?>
                    
                        <li class="col-6 col-md-3 col-xl-2gdot4-only col-wd-2 product-item">
                            <div class="product-item__outer h-100">
                                <div class="product-item__inner px-xl-4 p-3">
                                    <div class="product-item__body pb-xl-2">
                                        <div class="mb-2"></div>
                                        <h5 class="mb-1 product-item__title"><a href="detail?id=<?php echo $row->id; ?>" class="text-grey font-weight-normal"><?php echo $content; ?></a></h5>
                                        <div class="mb-2">
                                            <a href="detail?id=<?php echo $row->id; ?>" class="d-block text-center">
                                              <img class="img-fluid lazy featured-image front img-lazy blur-up auto-crop-false" 
                                              src="<?php echo $thumbnail;?>" 
                                              data-original="gif/load-sm.gif" 
                                               data-widths="[180, 320, 540, 720, 1080, 1366, 1920, 2048] "
                                               data-aspectratio="1.0909090909090908"
                                               data-expand="auto"
                                               data-sizes="auto"
                                               data-parent-fit="cover"
                                              alt="<?php echo stripslashes($row->title); ?>" style="width: 100%; max-width: 100%; height: 100%; max-height: 150px; min-height: 150px;"></a>
                                        </div>
                                        <div class="flex-center-between mb-1">
                                            <div class="prodcut-price">
                                              <?php 
                                          if($row->size_category == "different"){

                                        $prices = $row->price;
                                        $amt = explode(",", $prices);
                                        $min = min($amt);
                                        $max = max($amt);

                                        $price = " ".$left_currency.number_format($min).$right_currency.' - '." ".$left_currency.number_format($max).$right_currency; 

                                        echo $price;
                                        


                                          }else{
                                      $price =  $row->price;
                                      $discount =  $row->discount;
                                      if($discount > 0){
                                        $price = $price-(($price*$discount)/100);
                                      }

                                      echo '<small>'.$left_currency.number_format($price).$right_currency.'</small>';
                                      if($discount > 0){

                                        echo ' <del class="product-old-price text-danger">  '.$left_currency.number_format($row->price).$right_currency.'</del>';
                                      }

                                    }

                                    ?>
                                                
                                            </div>
                                            <div class="d-none d-xl-block prodcut-add-cart">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__footer">
                                        <div class="border-top pt-2 flex-center-between flex-wrap">
                                             <a href="detail?id=<?php echo $row->id; ?>" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>

                                            <a href="#" class="text-gray-6 font-size-13" onclick="addToWishlist(<?php echo  $row->id;?>);"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>



                        <?php 
                    } 

                }else{

                    ?>

                     <li class="col-12 col-md-12 col-xl-2gdot4-only  d-xl-none d-wd-block">
                            <div class="product-item__outer h-100 alert alert-danger text-center">
                           No related products for this item.
                            </div>
                        </li>


                <?php } ?>



                    </ul>
                </div>
                <!-- End Related products -->
              
            </div>
        </main>




<!-- Panel Left for rating -->
<div class="modal fade panelbox panelbox-left" id="PanelLeft" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="review-title"> Reviews</h5>
              <a href="javascript:;" data-dismiss="modal" ><ion-icon class="text-danger closeme" name="close-outline"></ion-icon></a>
          </div>
          <div class="modal-body">
          <div class="review_detail"></div>
          </div>
      </div>
  </div>
</div>
<!-- * Panel Left for rating -->


  <?php  include("footer.php"); ?>    

  <script type="text/javascript">
      var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("slides");
  var dots = document.getElementsByClassName("slide-thumbnail");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  console.log(slideIndex);

  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
      // slides[i].style.display = "inline";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  // slides[slideIndex-1].style.display = "inline";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}

   $(document).ready(function() {
  $("#cresults").load( "fetch_reviews.php"); //load initial records
  $(".loading-div").hide();
  //executes code below when user click on pagination links
  $("#cresults").on( "click", ".pagination a", function (e){
    e.preventDefault();
    //
    $(".loading-div").show(); //show loading element
    var page = $(this).attr("data-page"); //get page number from link

    $("#cresults").load("fetch_reviews.php",{"page":page}, function(){ //get content from PHP page
      $(".loading-div").hide(); //once done, hide loading element
    });
    
  });
});
 </script>