<?php
require_once('../inc/config.php');
require_once('../config/function.php');
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


  $ratings = "";

$rowperpage = 4;

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

    $ratings = avgRating($id);

?>


 <li class="mb-4">
                                    <div class="row">
                                        <div class="col-auto">
                                            <a href="detail?id=<?php echo $row['id']; ?>" class="d-block width-75">
                                               <img class="img-fluid lazy featured-image front img-lazy blur-up auto-crop-false" 
                                              src="<?php echo $thumbnail;?>" 
                                              data-original="gif/load-sm.gif" 
                                               data-widths="[180, 320, 540, 720, 1080, 1366, 1920, 2048] "
                                               data-aspectratio="1.0909090909090908"
                                               data-expand="auto"
                                               data-sizes="auto"
                                               data-parent-fit="cover"
                                              alt="<?php echo stripslashes($row['title']); ?>" style="width: 100%; max-width: 100%; height: 100%; max-height: 60px; min-height: 60px;">
                                            </a>
                                        </div>
                                        <div class="col">
                                            <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="detail?id=<?php echo $row['id']; ?>"><?php echo $shortcontent; ?></a></h3>
                                            <div class="text-warning text-ls-n2 font-size-12 mb-1" style="width: 80px;">
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
                                            <div class="font-weight-bold">
                                               <?php 
                                          if($row['size_category'] == "different"){

                                        $prices = $row['price'];
                                        $amt = explode(",", $prices);
                                        $min = min($amt);
                                        $max = max($amt);

                                        $price = " ".$left_currency.number_format($min).$right_currency.' - '." ".$left_currency.number_format($max).$right_currency; 

                                        echo '<small class="font-size-11 text-gray-9 d-block">'.$price.'</small>';
                                        


                                          }else{
                                      $price =  $row['price'];
                                      $discount =  $row['discount'];
                                      if($discount > 0){
                                        $price = $price-(($price*$discount)/100);
                                      }

                                      echo '<small class="font-size-11 text-gray-9 d-block">'.$left_currency.number_format($price).$right_currency.'</small>';
                                      if($discount > 0){

                                        echo ' <del class="product-old-price font-size-15 text-red text-decoration-none d-block">  '.$left_currency.number_format($row['price']).$right_currency.'</del>';
                                      }

                                    }

                                    ?>
                                                
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