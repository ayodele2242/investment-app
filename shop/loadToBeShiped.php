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
            $sqlQuery = "SELECT * FROM customer_order WHERE (status='Pending' OR status='Paid') AND c_email='$email'";
            $result = mysqli_query($mysqli, $sqlQuery);
            $total_count = mysqli_num_rows($result);
            
            $sqlQuery = "SELECT * FROM customer_order WHERE (status='Pending' OR status='Paid') AND c_email='$email' ORDER BY id DESC LIMIT 25";
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
                  $startDate = $row['added_date']; // 07/03/2011
                  $startDate = date("Y-m-d", strtotime("$startDate +2 days"));
                  $endDate = date("Y-m-d", strtotime("$startDate +4 days"));

                     //get number of days
                  $seconds = strtotime($row['delivery_date']) - time();
                  $days = floor($seconds / 86400);
                  $seconds %= 86400;

                  $expiry_date = $row['delivery_date'];
                  $expiry_date = new DateTime($expiry_date);
                  $today = new DateTime();
                  $interval = $today->diff($expiry_date);
                  $expday = $interval->format('%r%a');
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
                              echo '<p class="text-success"><span class="text-success">Order delivered on '.date("M jS, Y", strtotime($row['delivery_date'])).'</span></p>';
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
                        //echo $expday;
                         if(strtotime($row['delivery_date']) > strtotime('-7 day') && $row['return_status'] != "Returned"){

                        ?>
                        <div class="mt-2">
                          <a href="#" id="<?php echo $row['id']; ?>" data-product="<?php echo $row['product_name']; ?>" class="btn btn-warning returningBtn" data-toggle="modal" data-target="#actionReviewSheetForm">Return</a>

                        </div>

                        <?php }else if($row['return_status'] == "Returned"){ ?>
                           <div class="mt-2">
                          <div class="alert alert-info">We received your return query. We'll get back to you.</div>

                        </div>
                      
                      <?php }else if($row['return_status'] == "Resolved"){ ?>
                           <div class="mt-2">
                          <div class="alert alert-success">Item return solved.</div>

                        </div>
                      <?php } ?>
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
                     <i class="fa fa-shopping-cart" style="font-size: 80px"></i>
                    </h3>
                    <p class="text-center col-red">
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
                <img src="gif/loading.gif">
               </div>
            </div>
      
        <!-- * Categories -->


       <!-- Form Action Sheet -->
        <div class="modal fade action-sheet" id="actionReviewSheetForm" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reviewName">Add Comment</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                          <div class="alert alert-default" id="loadName"></div>

                            <form id="reviewForm" class="row">
                               

                          <div class="form-group boxed col-lg-12 mb-3">
                            <div class="input-wrapper">
                                <label class="label" for="textarea4b">Reason for Return</label>
                                <textarea id="textarea4b" rows="6" class="form-control"
                                    placeholder="Reason for Return" name="comment"></textarea>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>



                                <div class="form-group basic col-lg-12">
                                   <input type="hidden" class="form-control form-control-lg" id="proid" name="id" >
                                   <input type="hidden" name="email" value="<?php echo $email; ?>">
                                   <div align="center"> 

                                    <button type="button" class="btn btn-warning btn-sm" id="reviewFormBtn" 
                                        >Submit</button>

                                      </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Form Action Sheet -->


        <!-- Alert Success Action Sheet -->
        <div class="modal fade action-sheet" id="actionSheetAlertSuccess" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <div class="iconbox text-success">
                                <ion-icon name="checkmark-circle"></ion-icon>
                            </div>
                            <div class="text-center p-2">
                                <h3>Success</h3>
                                <p>We have received your return query. We'll get back to you.</p>
                                <p>Thanks for shopping with Buildit.</p>
                            </div>
                            <a href="#" class="btn btn-primary btn-lg btn-block" data-dismiss="modal">Done</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Alert Success Action Sheet -->



    <script type="text/javascript">
$(document).ready(function(){
  $('.aloader').hide();

$(".returningBtn").click(function(e) {
   e.preventDefault();
   
   var pid = $(this).attr('id'); // get id of clicked row 
   var title = $(this).attr("data-product");

   $("#reviewName").html("<b>"+title+"</b>");
   $("#proid").val(pid);

 });


$('#reviewFormBtn').click(function(e){ 
  e.preventDefault(); 
  
  $('#reviewFormBtn').html("Submitting..");
  
             $.ajax({  
                  url:"../inc/returnProduct.php",  
                  method:"POST",  
                  data: $("#reviewForm").serialize(), 
                  success:function(data)  
                  {  
                    $('#reviewFormBtn').html("Submit");
  
                        if(data.trim() == 1){
                          $("#actionReviewSheetForm").modal("hide");
                          $("#actionSheetAlertSuccess").modal("show");
      
                         $('#reviewForm')[0].reset();  
                         setTimeout(' window.location.href = document.location.href; ',4000);
                  
                    }else{
                      $('#reviewFormBtn').html("Submit");

                      $.toast({ 
                        text : '<b><ion-icon name="sad"></ion-icon> &nbsp;'+data+'</b>', 
                        showHideTransition : 'fade',
                        bgColor : 'red',            
                        textColor : '#fff',
                        allowToastClose : false,
                        hideAfter : 4000,
                        loader: false,            
                        stack : 5,                     
                        textAlign : 'center', 
                        position : 'top-right'  
                      });
                    }
                       //alert(data);  
                       
                  }  
             }); 
  
  
        }); 








$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        var last_id = $(".postid:last").attr("id");
        loadMore(last_id);
    }
});

function loadMore(last_id){
  $.ajax({
      url: 'getToBeShiped.php?last_id=' + last_id,
      type: "get",
      beforeSend: function(){
          $('.aloader').show();
      }
  }).done(function(data){
    if(data === "end"){
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