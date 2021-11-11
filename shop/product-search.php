<?php
  require_once '../inc/config.php';
  include '../inc/fetch.php';
  include '../inc/functions.php';
 
  if (isset($_GET['query'])) {

    $search = $mysqli->real_escape_string($_GET['query']);
     
    $query = "SELECT product.*, GROUP_CONCAT(product_colors.color) as colors, 
    GROUP_CONCAT(product_brands.brand) as brands, GROUP_CONCAT(product_sizes.size) as sizes  FROM product
    left join product_colors on product_colors.product_id = product.id
    left join product_brands on product_brands.product_id = product.id
    left join product_sizes on product_sizes.product_id = product.id  WHERE product.availability = '1' 
    AND product.title LIKE '%$search%' 
    OR product.summary LIKE '%$search%'
    OR product_colors.color  LIKE '%$search%' 
    OR product.brand LIKE '%$search%'
    GROUP BY product.id order by product.id  LIMIT 50";
    $result = mysqli_query($mysqli, $query);
 
  if (mysqli_num_rows($result) > 0) {
     while ($row = mysqli_fetch_array($result)) {
        if($row['images'] != "" && file_exists('../upload/product/'.$row['images'])){
            $thumbnail = '../upload/product/'.$row['images'];
          } else {
            $thumbnail = FRONT_IMAGES.'no-image.png';
          }
          $content = $row['title'];
          $shortcontent = substr($content, 0, 50)."...";
          ?>

      <a href="detail?id=<?php echo clean($row['id']); ?>" class="search_items row" style="background-color: #fff; padding: 10px">
      <div class="s-img col-2 p-1">
      <img src="<?php echo $thumbnail;?>" class="imaged h48 w48" style="width: 100%; max-width: 50px; min-width: 50px; height: 100%; max-height: 50px;">
        </div>
        <div class="s-name col-10 p-1"> 
        <?php echo clean($row['title']); ?>
        <p>
        <?php 
            if($row['size_category'] == "different"){

          $prices = $row['price'];
          $amt = explode(",", $prices);
          $min = min($amt);
          $max = max($amt);

          $price = " ".$left_currency.number_format($min).$right_currency.' - '." ".$left_currency.number_format($max).$right_currency; 

          echo ' <del class="text-success">  '.$price.'</del>';;
            }else{
          $price =  $row['price'];
          $discount =  $row['discount'];
          if($discount > 0){
          $price = $price-(($price*$discount)/100);
          }

          echo " ".$left_currency.number_format($price).$right_currency;
          if($discount > 0){

          echo ' <del class="product-old-price text-danger">  '.$left_currency.number_format($row['price']).$right_currency.'</del>';
          }

          }

          ?>
        </p>
        </div>
      </a>

      <?php
    }
  } else {
    echo "<p style='color:red; padding:10px;'>Product not found...</p>";
  }
 
}
?>


