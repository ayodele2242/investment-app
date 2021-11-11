<?php
require_once('../inc/config.php');
require_once '../class/database.php';
require_once('../inc/fetch.php');
require_once '../config/function.php';
require_once '../class/product.php';
require '../class/wishlist.php';  
$wishlist = new Wishlist();
$product = new Product();

 $email = $_SESSION['email'];
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
  $list = $wishlist->getWishlist($_SESSION['login_id']);
  $ratings = "";

  ?>

     <div class="transactions row" id="post-list">
            
            <?php
            
           if (!empty($list[0]->product_id)) {
          $p_id =$list[0]->product_id;
          $pro_id = explode(',', $p_id); 

          $counter = 1;
          foreach($pro_id as $key => $id){

          $product_info = $product -> getProductById($id);
          $ratings = avgRating($id);
          //debugger($product_info,true);
          if ($product_info) {
             if($product_info[0]->images != "" && file_exists('../upload/product/'.$product_info[0]->images)){
                        $thumbnail = '../upload/product/'.$product_info[0]->images;
              } else {
                $thumbnail = FRONT_IMAGES.'no-image.png';
              }
              $content = substr(stripcslashes($product_info[0]->title), 0, 30)."...";
            ?>
                <!-- item -->
                <div class="item post-item postid results col-lg-12 row mb-3 p-3" id="<?php echo $product_info[0]->id; ?>" style="background: #fff;"> 
                    <div class="detail col-9 row">
                      <div class="col-2">
                        <img src="<?php echo $thumbnail; ?>" alt="img" class="image-block imaged w48" style="width: 100%; max-width: 100px; min-width: 100px; height: 100%; max-height: 100px;">
                      </div>
                       <div class="col-10">
                            <small><strong><a  href="detail?id=<?php echo $product_info[0]->id; ?>"><?php echo $content; ?></a></strong></small>
                            <p><small>Price: <?php 
                             if($product_info[0]->size_category == "different"){
                             $prices = $product_info[0]->price;
                             $amt = explode(",", $prices);
                             $min = min($amt);
                             $max = max($amt);

                             $price = " ".$left_currency.number_format($min).$right_currency.' - '." ".$left_currency.number_format($max).$right_currency; 

                             echo $price;

                             }else{    

                            $price =  $product_info[0]->price;
                            $discount =  $product_info[0]->discount;
                            if($discount > 0){
                              $price = $price-(($price*$discount)/100);
                            }

                            echo " ".$left_currency.number_format($price).$right_currency;
                            if($discount > 0){

                              echo ' <del class="product-old-price">  '.$left_currency.number_format( $product_info[0]->price).$right_currency.'</del>';
                            }

                          }

                             ?></small></p>

                           
                           
                        </div>
                    </div>
                    <div class="right col-3">

                        


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

                         


                       
                    </div>

                </div>
                <!-- * item -->

               
                <?php
                }
              }
            }else{
              ?>
  <div class="empty-cart">
    <div class="empty-results">
      <h3 class="text-center">
          <i class="fa fa-heart fa-2x col-red"></i>
      </h3>
      <p class="text-center col-red">
       No items added to your wishlist.
      </p>
    </div>
  </div>

                  <?php
                }
                ?>
            </div>
            <div class="aloader text-center">
               <div class="ME">
                <img src="gif/loading.gif">
               </div>
            </div>
      
        <!-- * Categories -->
  


 <script type="text/javascript">
$(document).ready(function(){
    $('.aloader').hide();


});


</script>