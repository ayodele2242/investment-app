<?php
require_once '../inc/config.php'; //Database Connection
include '../inc/fetch.php';
include '../config/function.php';
require_once 'review_pagination.php';



$item_per_page    = 50; //item to display per page

//Get page number from Ajax
if(isset($_POST["page"])){
  $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
  if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
}else{
  $page_number = 1; //if there's no page number, set it to 1
}

//get total number of records from database
$results = mysqli_query($mysqli,"SELECT COUNT(*) as totalPro FROM product");
$get_total_row = mysqli_fetch_array($results); //hold total records in variable
//break records into pages
$get_total_rows = $get_total_row['totalPro'];

$total_pages = ceil($get_total_rows/$item_per_page);

//position of records
$page_position = (($page_number-1) * $item_per_page);

  $ratings = "";



//if (isset($_POST["action"])) {
    $gquery = "
  SELECT product.*, GROUP_CONCAT(product_colors.color) as colors, 
  GROUP_CONCAT(product_brands.brand) as brands, GROUP_CONCAT(product_sizes.size) as sizes  FROM product
  left join product_colors on product_colors.product_id = product.id
  left join product_brands on product_brands.product_id = product.id
  left join product_sizes on product_sizes.product_id = product.id
  WHERE product.availability = '1' 
 ";

 

    if (isset($_POST["minimum_price"], $_POST["maximum_price"]) 
      && !empty($_POST["minimum_price"]) 
      && !empty($_POST["maximum_price"])) {
      $max = $mysqli->real_escape_string($_POST["minimum_price"]);
      $min = $mysqli->real_escape_string($_POST["maximum_price"]);

        $gquery .= "
     AND product.price BETWEEN '$max' 
     AND '$min' 
  ";

    }
    if (isset($_POST["brand"])) {

        $brand_filter = preg_replace("/'/", "", $_POST["brand"]);

        $brand_filter = implode("','", $brand_filter);
        
        $gquery .= "
   AND product_brands.brand IN('".$brand_filter."')
  ";
    }
    if (isset($_POST["size"])) {
        $size_filter = implode("','", $_POST["size"]);
        
        $gquery .= "
   AND product_sizes.size IN('" . $size_filter . "') 
  ";


    }
    if (isset($_POST["color"])) {
        $color_filter = implode("','", $_POST["color"]);
        $gquery .= "
   AND product_colors.color IN('" . $color_filter . "')
  ";
    }

    if(isset($_POST["sorting"]) && $_POST["sorting"] == "low_price"){
      $gquery .= "
      AND product.price = (SELECT MIN(price) FROM product)
       ";
    }

    if(isset($_POST["sorting"]) && $_POST["sorting"] == "high_price"){
      $gquery .= "
      AND product.price <= (SELECT MAX(price) FROM product)
       ";
    }

    if(isset($_POST["icategory"])){
    
     $catid  = implode("','", $_POST["icategory"]);
        
    // var_dump($catid);
      $gquery .= "
      AND product.cat_id IN('" . $catid . "')
       ";
    }
    

    $gquery .= "
        GROUP BY 
        product.id 
        
        ORDER BY product.id ASC LIMIT $page_position, $item_per_page
    ";



    
    $statement = mysqli_query($mysqli,$gquery);


    $total_row = mysqli_num_rows($statement);

    $output    = '';

    if ($total_row > 0) {
        while($row = mysqli_fetch_array($statement)) {

           if($row['images'] != "" && file_exists('../upload/product/'.$row['images'])){
              $thumbnail = '../upload/product/'.$row['images'];
            } else {
              $thumbnail = FRONT_IMAGES.'no-image.png';
            }

            if($row['size_category'] == "different"){
                 $prices = $row['price'];
                 $amt = explode(",", $prices);
                 
                 //$min = min($amt);
                 $iprice = max($amt);

                
            }else{
             $iprice =  $row['price'];
             }

             $ratings = avgRating($row['id']);


          ?>



 <div class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                   
                                                    <h5 class="mb-1 product-item__title"><a href="detail?id=<?php echo $row['id']; ?>" class="text-blue font-weight-bold"><?php echo stripslashes($row['title']); ?></a></h5>
                                                    <div class="mb-2">
                                                        <a href="detail?id=<?php echo $row['id']; ?>" class="d-block text-center"><img class="img-fluid" src="<?php echo $thumbnail;?>" alt="<?php echo stripslashes($row['title']); ?>" style="width: 100%; height: 100%; max-height: 100px; min-height: 150px;"></a>
                                                    </div>
                                                    <div class="mb-3">
                                                        <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                            <div class="text-warning mr-2">
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
                                                           
                                                        </a>
                                                    </div>
                                                    <div class="font-size-12 p-0 text-gray-110 mb-4">
                                                       <?php //echo $row['summary']; ?>
                                                    </div>
                                                    <!--<div class="text-gray-20 mb-2 font-size-12">SKU: <?php //echo $row['sku']; ?></div>-->
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                           <?php 
                                          if($row['size_category'] == "different"){

                                        $prices = $row['price'];
                                        $amt = explode(",", $prices);
                                        $min = min($amt);
                                        $max = max($amt);

                                        $price = " ".$left_currency.number_format($min).$right_currency.' - '." ".$left_currency.number_format($max).$right_currency; 

                                        echo '<small class="font-size-15 text-gray-20 d-block">'.$price.'</small>';
                                        


                                          }else{
                                      $price =  $row['price'];
                                      $discount =  $row['discount'];
                                      if($discount > 0){
                                        $price = $price-(($price*$discount)/100);
                                      }

                                      echo '<small class="font-size-15 text-gray-20 d-block">'.$left_currency.number_format($price).$right_currency.'</small>';
                                      if($discount > 0){

                                        echo ' <del class="product-old-price font-size-15 text-red text-decoration-none d-block">  '.$left_currency.number_format($row['price']).$right_currency.'</del>';
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
                                                       
                                                       <button class="btn-wishlist mr-lg-n3 mr-2" type="button" onclick="addToWishlist(<?php echo $row['id'];?>);" data-toggle="tooltip" title="Add to wishlist">
                                                        <i class="fa fa-heart"></i>
                                                      </button>

                                                       <?php if($row['quantity'] > 0) { ?>
                                               <a href="detail?id=<?php echo $row['id']; ?>" class="btn-circle transition-3d-hover"><i class="ec ec-add-to-cart font-size-20"></i></a>
                                         <?php }else{ ?>

                                             <button class="btn bg-red btn-shadow btn-sm inactive disabled" type="submit" ><i class="ec ec-add-to-cart mr-2 font-size-20"></i> Sold</button>

                                         <?php } ?>




                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

<?php


        }

echo '<nav class="d-md-flex justify-content-between align-items-center border-top pt-3 col-12 mt-4" aria-label="Page navigation">
                            <div class="text-center text-md-left mb-3 mb-md-0"></div>';
echo paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages);
echo ' </nav>';
       
    } else {
        echo '<h4>No Product Found</h4>' . $mysqli->error;
    }
    
// /}

?>


<div id="modal-container">
  <div class="modal-background">
    <div class="modal">
    <div id="product_contents"></div>
    <div class="close-div closeMe">X</div>
    </div>
    
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function () {
  $(".loader-top").hide();

});
</script>
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