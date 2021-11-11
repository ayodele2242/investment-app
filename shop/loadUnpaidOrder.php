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
  ?>

     <div class="transactions row" id="post-list">
            
            <?php
            $email = $_SESSION['email'];
            $sqlQuery = "SELECT * FROM customer_order WHERE (status='Processing' OR status='failed' OR status='Cancelled') AND c_email='$email'";
            $result = mysqli_query($mysqli, $sqlQuery);
            $total_count = mysqli_num_rows($result);
            
            $sqlQuery = "SELECT * FROM customer_order WHERE (status='Processing' OR status='failed' OR status='Cancelled') AND c_email='$email' ORDER BY id DESC LIMIT 6";
            $result = mysqli_query($mysqli, $sqlQuery);
            $count = mysqli_num_rows($result);
            if($count > 0){
            ?>
            <input type="hidden" name="total_count" id="total_count" value="<?php echo $total_count; ?>" />

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
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
                        <img src="<?php echo $thumbnail; ?>" alt="img" class="image-block imaged" style="width: 100%; max-width: 100px; min-width: 100px; height: 100%; max-height: 100px;">
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
                    <div class="right col-2">
                        <div class="price"> <?php echo $left_currency.number_format($row['total_amount']).$right_currency ?></div>
                    </div>

                </div>
                <!-- * item -->

               
                <?php
                }
            }else{
                ?>
                <div class="empty-cart">
                  <div class="empty-results">
                    <h3 class="text-center">
                     
                       <i class="fa fa-shopping-cart" style="font-size: 80px; font-weight: bolder;"></i>
                    </h3>
                    <p class="text-center">
                     No order items.
                    </p>
                  </div>
                </div>
                
                <?php
            }
            ?>
            </div>
            <div class="aloader text-center">
               <div class="ME">
                <img src="gif/cart-2.gif" width="50" height="50">
               </div>
            </div>
      
        <!-- * Categories -->
    </div>


    <script type="text/javascript">
$(document).ready(function(){
    $('.aloader').hide();

$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        var last_id = $(".postid:last").attr("id");
        loadMore(last_id);
    }
});

function loadMore(last_id){
  $.ajax({
      url: 'getMoreFailedOrder.php?last_id=' + last_id,
      type: "get",
      beforeSend: function(){
          $('.aloader').show();
      }
  }).done(function(data){
    if(data == "end"){
      $('.aloader').addClass("section");
      $('.ME').html('<div class="alert alert-danger">You have gotten to the end of data.</div>').addClass("item");
       setTimeout(function() {
            $(".aloader").fadeOut(1500);
        }, 1000);
      //$('.aloader').removeClass("ajax-load").addClass("displayMe");
    }else{
      //$('.ajax-load').addClass("hide");  
      //$('.aloader').removeClass("aloader").addClass("displayMe");
      $("#post-list").append(data);
      $('.aloader').hide();

  }
  }).fail(function(jqXHR, ajaxOptions, thrownError){
      //alert('server not responding...');
  });
}

});


</script>