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

$sqlQuery = "SELECT * FROM customer_order WHERE id < '$lastId' AND c_email='$email' AND (status='Pending' OR status='Paid') ORDER BY id DESC LIMIT 5";

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
        $updatedDate = date("Y-m-d", strtotime($row['delivery_date'])); 
        $startDate = $row['added_date']; // 07/03/2011
        $startDate = date("Y-m-d", strtotime("$startDate +2 days"));
        $endDate = date("Y-m-d", strtotime("$startDate +4 days"));

        //get number of days
        $seconds = strtotime($row['delivery_date']) - time();
        $days = floor($seconds / 86400);
        $seconds %= 86400;
    ?>
       <!-- item -->
                <div class="item post-item col-lg-12 row mb-3 p-3 postid results" id="<?php echo $row['id']; ?>" style="background: #fff; ">
                    <div class="detail col-9 row">
                      <div class="col-2">
                        <img src="<?php echo $thumbnail; ?>" alt="img" class="image-block imaged w48" style="width: 100%; max-width: 100px; min-width: 100px; height: 100%; max-height: 100px;">
                      </div>
                       <div class="col-10">
                            <small><strong><?php echo $content; ?></strong></small>
                             <p class="mt-2"><small class="p-1 bg-blue">Size: <?php echo $row['size']; ?></small>  <small class="p-1 bg-purple">Color: <?php echo $row['color']; ?></small> <small class="p-1 bg-orange">Qty: x <?php echo $row['quantity']; ?></small></p>
                             
                              <?php
                                if($row['delivery_status'] != "Delivered" && $row['delivery_date'] == ''){
                                echo '<p class="col-grey">Your order will be delivered between <b>'.$startDate.'</b> and <b>'.$endDate.'</b></p>';
                                }else if($row['status'] == "Pending" && $row['delivery_status'] == 'Fulfilled' && $row['delivery_date'] != ''){
                                  echo '<p class="col-orange">Your order will be delivered on <b>'.$row['delivery_date'].'</b></p>';
                                }

                                else if($row['delivery_status'] == "Delivered"){
                              echo '<p class="text-success"><span class="text-success">Order delivered on '.$row['delivery_date'].'</span></p>';
                              }
                                ?>
                         
                            <p>Order Status: 
                               <?php 
                                if($row['status'] == "Pending" && $row['delivery_date'] == '' ){
                                echo '<span class="col-orange">'.$row['status'].'</span>';
                                }else if($row['status'] != "Paid" || $row['status'] == "Pending" && $row['delivery_status'] == 'Fulfilled' && $row['delivery_date'] != ''){
                                echo '<span class="text-info">Fulfilled</span>';
                                }else if($row['status'] == "Paid" && $row['delivery_status'] != "Delivered"){
                                echo '<span class="text-warning">Processing</span>';
                                }else if($row['status'] == "Paid" && $row['delivery_status'] == 'Fulfilled'){
                                echo '<span class="text-info">Fulfilled</span>';
                                }
                                else if($row['status'] == "Paid" && $row['delivery_status'] == "Delivered"){
                                echo ' <span class="text-success"><i class="fa fa-check"></i> Delivered</span>';
                                }
                                

                                ?>

                            </p>

                        </div>
                    </div>
                       <div class="right col-3">
                        <div class="price"> <?php echo $left_currency.number_format($row['total_amount']).$right_currency ?></div>
                        <?php
                         if($row['delivery_status'] == "Delivered" && strtotime($row['delivery_date']) < strtotime('+7 day')){
                        ?>
                        <div class="mt-2">
                          <a href="#" id="<?php echo $row['id']; ?>" data-product="<?php echo $row['product_name']; ?>" class="btn btn-warning returningBtn" data-toggle="modal" data-target="#actionReviewSheetForm">Return</a>

                        </div>

                        <?php }else if($row['return_status'] == "Returned"){ ?>
                           <div class="mt-2">
                          <small class="text-info">We receive your return status. We'll get back to you.</small>

                        </div>
                      
                      <?php }else if($row['return_status'] == "Resolved"){ ?>
                           <div class="mt-2">
                          <small class="text-success">Item return solved.</small>

                        </div>
                      <?php } ?>
                    </div>
                 
                </div>
                <!-- * item -->

    <?php
}
?>
 
<script type="text/javascript">
$(document).ready(function(){
$(".returningBtn").click(function(e) {
   e.preventDefault();
   
   var pid = $(this).attr('id'); // get id of clicked row 
   var title = $(this).attr("data-product");

   $("#reviewName").html("<b>"+title+"</b>");
   $("#proid").val(pid);

 });

 });
</script>
<?php
}else{
  echo "end";
}
?>
