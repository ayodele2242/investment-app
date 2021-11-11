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



    <!--<div class="pt-2 pb-2">
      <div class="container pt-2 pb-3 pt-lg-2 pb-lg-2">
        <div class="d-lg-flex justify-content-between pb-2">
          <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo $set['installUrl'];  ?>"><i class="fa fa-home"></i>Home</a></li>
                <li class="breadcrumb-item text-nowrap"><a href="#" style="background: transparent;">Products</a>
                </li>
                <li class="breadcrumb-item text-nowrap"><a href="#" style="background: transparent;">Categories</a>
                </li>
                <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo $cat[0]->title; ?></li>
              </ol>
            </nav>
          </div>
          <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
            <h1 class="h3 text-light mb-0 col-blue"><?php echo $cat[0]->title; ?></h1>
          </div>
        </div>
      </div>
    </div>-->


<main id="content" role="main" class="checkout-page">
    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 mt-1 shopify-section">
      <div class="main-content">

          <div id="breadcrumb" class="breadcrumb-holder container">
              
                <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="<?php echo $set['installUrl']; ?>">Home</a></li>
                                
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><?php echo $cat[0]->title; ?></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>

  </div>
</div>


<div class="container">
  
            <?php 
            if($category_product){
                echo '<ul class="row list-unstyled products-group no-gutters" id="loadProducts">';
              $counter = 1;
              foreach($category_product as $cat_product){
                   if($cat_product->images != "" && file_exists('../upload/product/'.$cat_product->images)){
                    $thumbnail = '../upload/product/'.$cat_product->images;
                  } else {
                    $thumbnail = FRONT_IMAGES.'no-image.png';
                  }
            
                $id = $cat_product->id;
                $content = $cat_product->title;
                $shortcontent = substr($content, 0, 50)."...";
            ?>      
                                  
                         <li class="col-6 col-md-3 col-xl-2gdot4-only col-wd-2 product-item">
                            <div class="product-item__outer h-100">
                                <div class="product-item__inner px-xl-4 p-3">
                                    <div class="product-item__body pb-xl-2">
                                        <div class="mb-2"></div>
                                        <h5 class="mb-1 product-item__title"><a href="detail?id=<?php echo $cat_product->id; ?>" class="text-grey font-weight-normal"><?php echo $shortcontent; ?></a></h5>
                                        <div class="mb-2">
                                            <a href="detail?id=<?php echo $cat_product->id; ?>" class="d-block text-center">
                                              <img class="img-fluid lazy featured-image front img-lazy blur-up auto-crop-false" 
                                              src="<?php echo $thumbnail;?>" 
                                              data-original="gif/load-sm.gif" 
                                               data-widths="[180, 320, 540, 720, 1080, 1366, 1920, 2048] "
                                               data-aspectratio="1.0909090909090908"
                                               data-expand="auto"
                                               data-sizes="auto"
                                               data-parent-fit="cover"
                                              alt="<?php echo stripslashes($cat_product->title); ?>" style="width: 100%; max-width: 100%; height: 100%; max-height: 150px; min-height: 150px;"></a>
                                        </div>
                                        <div class="flex-center-between mb-1">
                                            <div class="prodcut-price">
                                              <?php 
                                          if($cat_product->size_category == "different"){

                                        $prices = $cat_product->price;
                                        $amt = explode(",", $prices);
                                        $min = min($amt);
                                        $max = max($amt);

                                        $price = " ".$left_currency.number_format($min).$right_currency.' - '." ".$left_currency.number_format($max).$right_currency; 

                                        echo $price;
                                        


                                          }else{
                                      $price =  $cat_product->price;
                                      $discount =  $cat_product->discount;
                                      if($discount > 0){
                                        $price = $price-(($price*$discount)/100);
                                      }

                                      echo '<small>'.$left_currency.number_format($price).$right_currency.'</small>';
                                      if($discount > 0){

                                        echo ' <del class="product-old-price text-danger">  '.$left_currency.number_format($cat_product->price).$right_currency.'</del>';
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
                                             <a href="detail?id=<?php echo $cat_product->id; ?>" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>

                                             <button class="btn-wishlist mr-lg-n3 mr-2" type="button" onclick="addToWishlist(<?php echo $cat_product->id;?>);" data-toggle="tooltip" title="Add to wishlist">
                                                        <i class="fa fa-heart"></i>
                                                      </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
          
                                  
                                  
            
            <?php 
            }
            echo '</ul>';
            }else{
                echo '<div class="alert alert-danger">No products available for this category</div>';
            }
            ?>

</div>


</div>
</main>

<?php
include("footer.php");
?>

<script type="text/javascript">
   $( document ).ready(function(){
   $(".loader-top").hide();


    $('.sort-action').click(function(){  // add event any time the sort box changes
      var sortingMethod = jQuery(this).attr('data-sort');
      //alert(value);
        
      if(sortingMethod == 'price-ascending') {
        sortProductsPriceAscending();
      } else if (sortingMethod == 'price-descending') {
        sortProductsPriceDescending();
      }
      
      });

    function sortProductsPriceAscending() {
  var gridItems = $('.grid-item');

  gridItems.sort(function(a, b) {
    return $('.product-card', a).data("price") - $('.product-card', b).data("price");
  });

  $(".isotope-grid").append(gridItems);
}

function sortProductsPriceDescending() {
  var gridItems = $('.grid-item');

  gridItems.sort(function(a, b) {
    return $('.product-card', b).data("price") - $('.product-card', a).data("price");
  });

  $(".isotope-grid").append(gridItems);
}

   });


</script>