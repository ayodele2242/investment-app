<?php
require_once('../inc/config.php');
require_once('../inc/fetch.php');
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

$lastId = $_GET['last_id'];

$sqlQuery = "SELECT * FROM customer_order WHERE id < '" .$lastId . "' AND c_email='$email' AND (status='Processing' OR status='failed' OR status='Cancelled') ORDER BY id DESC LIMIT 5";

$result = mysqli_query($mysqli, $sqlQuery);

$count = mysqli_num_rows($result);

if($count > 0){

while ($row = mysqli_fetch_assoc($result))
 {
     $content = substr($row['product_name'], 0, 25)."...";
     if($row['product_image'] != "" && file_exists('../upload/product/'.$row['product_image'])){
        $thumbnail = '../upload/product/'.$row['product_image'];
      }
      else {
        $thumbnail = FRONT_IMAGES.'no-image.png';
      }
    ?>
        <!-- item -->
                <div class="col-lg-12 row mb-3 postid results shadow p-3" id="<?php echo $row['id']; ?>" style="background: #fff;">
                    <div class="detail col-9 row">
                      <div class="col-2">
                        <img src="<?php echo $thumbnail; ?>" alt="img" class="image-block imaged w48">
                      </div>
                       <div class="col-9">
                            <small><strong><?php echo $content; ?> </strong></small>
                            <p class="mt-2"><small class="p-1 bg-blue">Size: <?php echo $row['size']; ?></small>  <small class="p-1 bg-purple">Color: <?php echo $row['color']; ?></small> <small class="p-1 bg-orange">Qty: x <?php echo $row['quantity']; ?></small></p>
                                                      
                            <p>
                            <?php
                            if($row['status'] == "Processing"){
                              echo '<span class="round col-red">Payment failed</span>';
                            }else if($row['status'] == "Cancelled"){
                              echo '<span class="round col-orange">Order cancelled</span>';
                            }
                            ?>
                          </p>
                        </div>
                    </div>
                    <div class="right col-3">
                        <div class="price"> <?php echo $left_currency.number_format($row['total_amount']).$right_currency ?></div>
                    </div>

                </div>
                <!-- * item -->
    <?php
}

}else{
	echo "end";
}
?>