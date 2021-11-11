<?php
require_once('../inc/config.php');
require_once('../inc/fetch.php');
 //$email = $_SESSION['email'];
  if(!empty($right_currency)){
    $right_currency = $right_currency;
  }else{
    $right_currency='';
  }
  if(!empty($left_currency)){
    $left_currency = $left_currency;
  }else{
    $left_currency='';
  }


  ?>


<?php

$rowperpage = 18;

// counting total number of posts
$allcount_query = "SELECT count(*) as allcount FROM product";
$allcount_result = mysqli_query($mysqli,$allcount_query);
$allcount_fetch = mysqli_fetch_array($allcount_result);
$allcount = $allcount_fetch['allcount'];

// select first 3 posts
$query = "SELECT product.*, GROUP_CONCAT(product_colors.color) as colors, 
GROUP_CONCAT(product_brands.brand) as brands, GROUP_CONCAT(product_sizes.size) as sizes  FROM product
left join product_colors on product_colors.product_id = product.id
left join product_brands on product_brands.product_id = product.id
left join product_sizes on product_sizes.product_id = product.id GROUP BY 
        product.id  order by product.id desc limit 0,$rowperpage ";
$result = mysqli_query($mysqli,$query);

while($row = mysqli_fetch_array($result)){

    if($row['images'] != "" && file_exists('../upload/product/'.$row['images'])){
        $thumbnail = '../upload/product/'.$row['images'];
      } else {
        $thumbnail = FRONT_IMAGES.'no-image.png';
      }

    $id = $row['id'];
    $content = $row['title'];
    $shortcontent = substr($content, 0, 50)."...";

?>


 <li class="col-6 col-md-3 col-xl-2gdot4-only col-wd-2 product-item">
                            <div class="product-item__outer h-100">
                                <div class="product-item__inner px-xl-4 p-3">
                                    <div class="product-item__body pb-xl-2">
                                        <div class="mb-2"></div>
                                        <h5 class="mb-1 product-item__title"><a href="detail?id=<?php echo $row['id']; ?>" class="text-grey font-weight-normal"><?php echo $shortcontent; ?></a></h5>
                                        <div class="mb-2">
                                            <a href="detail?id=<?php echo $row['id']; ?>" class="d-block text-center">
                                              <img class="img-fluid lazy featured-image front img-lazy blur-up auto-crop-false" 
                                              src="<?php echo $thumbnail;?>" 
                                              data-original="gif/load-sm.gif" 
                                               data-widths="[180, 320, 540, 720, 1080, 1366, 1920, 2048] "
                                               data-aspectratio="1.0909090909090908"
                                               data-expand="auto"
                                               data-sizes="auto"
                                               data-parent-fit="cover"
                                              alt="<?php echo stripslashes($row['title']); ?>" style="width: 100%; max-width: 100%; height: 100%; max-height: 150px; min-height: 150px;"></a>
                                        </div>
                                        <div class="flex-center-between mb-1">
                                            <div class="prodcut-price">
                                              <?php 
                                          if($row['size_category'] == "different"){

                                        $prices = $row['price'];
                                        $amt = explode(",", $prices);
                                        $min = min($amt);
                                        $max = max($amt);

                                        $price = " ".$left_currency.number_format($min).$right_currency.' - '." ".$left_currency.number_format($max).$right_currency; 

                                        echo $price;
                                        


                                          }else{
                                      $price =  $row['price'];
                                      $discount =  $row['discount'];
                                      if($discount > 0){
                                        $price = $price-(($price*$discount)/100);
                                      }

                                      echo '<small>'.$left_currency.number_format($price).$right_currency.'</small>';
                                      if($discount > 0){

                                        echo ' <del class="product-old-price text-danger">  '.$left_currency.number_format($row['price']).$right_currency.'</del>';
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
                                             <a href="detail?id=<?php echo $row['id']; ?>" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>

                                             <button class="btn-wishlist mr-lg-n3 mr-2" type="button" onclick="addToWishlist(<?php echo $row['id'];?>);" data-toggle="tooltip" title="Add to wishlist">
                                                        <i class="fa fa-heart"></i>
                                                      </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>





<?php
}
?>



<script>
//When the page has loaded.
$( document ).ready(function(){
   $('.loader-top').hide();
});
</script>