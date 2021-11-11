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
         
            $sqlQuery = "SELECT t1.*
                        FROM customer_order t1
                        WHERE NOT EXISTS (SELECT t2.product_id, t2.email FROM review_rating t2 WHERE t1.product_id = t2.product_id AND t1.c_email = t2.email) AND t1.status='Paid' AND t1.c_email='$email'";
            $result = mysqli_query($mysqli, $sqlQuery);

            $count = mysqli_num_rows($result);
            if($count > 0){

            while ($row = mysqli_fetch_assoc($result)) {
                $content = substr($row['product_name'], 0, 75)."...";
                 if($row['product_image'] != "" && file_exists('../upload/product/'.$row['product_image'])){
                    $thumbnail = '../upload/product/'.$row['product_image'];
                  }
                  else {
                    $thumbnail = FRONT_IMAGES.'no-image.png';
                  }
                ?>

                <!-- item -->
                <div class="item post-item postid results col-lg-12 row mb-3 p-3" id="<?php echo $row['id']; ?>" style="background: #fff;">
                    <div class="detail col-9 row">
                        <div class="col-2">
                        <img src="<?php echo $thumbnail; ?>" alt="img" class="image-block imaged w48" style="width: 100%; max-width: 100px; min-width: 100px; height: 100%; max-height: 100px;">
                      </div>
                         <div class="col-10">
                            <small><strong><?php echo $content; ?></strong></small>
                            <p class="mt-2"><small class="p-1 bg-blue">Size: <?php echo $row['size']; ?></small>  <small class="p-1 bg-purple">Color: <?php echo $row['color']; ?></small> <small class="p-1 bg-orange">Qty: x <?php echo $row['quantity']; ?></small></p>
                            <p>
                            <?php
                            if($row['status'] == "Processing"){
                              echo '<span class="round bg-red">Payment failed</span>';
                            }else if($row['status'] == "Cancelled"){
                              echo '<span class="round bg-orange">Order cancelled</span>';
                            }
                            ?>
                          </p>
                        </div>
                    </div>
                    <div class="right col-3">
                        <div class="price"> <?php echo $left_currency.number_format($row['total_amount']).$right_currency ?></div>
                        <div class="review mt-2">
                          <a href="#" id="<?php echo $row['product_id']; ?>" data-product="<?php echo $row['product_name']; ?>" class="btn btn-warning reviewBtn" data-toggle="modal" data-target="#actionReviewSheetForm">Review</a>
                        </div>
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
                     
                       <i  class="fa fa-info-circle fa-2x col-red"></i>
                    </h3>
                    <p class="text-center col-red">
                     No items to be reviewed at the moment.
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
    </div>




     <!-- Form Action Sheet -->
        <div class="modal fade action-sheet" id="actionReviewSheetForm" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reviewName">Add your Review</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                          <div class="alert alert-default" id="loadName"></div>

                            <form id="reviewForm" class="row">
                                <div class="form-group boxed col-lg-12 mb-3">
                                    <div class="input-wrapper">
                                        <label class="label" for="account1">Rating</label>
                                        <select class="form-control" name="rate">
                                            <option value="">Select your rating</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                   
                                </div>


                          <div class="form-group boxed col-lg-12 mb-3">
                            <div class="input-wrapper">
                                <label class="label" for="textarea4b">Comment</label>
                                <textarea id="textarea4b" rows="6" class="form-control"
                                    placeholder="Comment here" name="comment"></textarea>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>



                                <div class="form-group basic col-lg-12 mb-3">
                                  <div align="center">  <input type="hidden" class="form-control form-control-lg" id="proid" name="product_id" >
                                   <input type="hidden" name="email" value="<?php echo $email; ?>">
                         <button type="button" class="btn bg-blue btn-sm" id="reviewFormBtn">Submit Review</button></div>
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
                                <p>Your review is submitted.</p>
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


  $(".reviewBtn").click(function(e) {
     e.preventDefault();
     
     var pid = $(this).attr('id'); // get id of clicked row 
     var title = $(this).attr("data-product");

     $("#reviewName").html("<b>"+title+"</b>");
     $("#proid").val(pid);

   });



/*$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        var last_id = $(".postid:last").attr("id");
        loadMore(last_id);
    }
});

function loadMore(last_id){
  $.ajax({
      url: 'getMoreReview.php?last_id=' + last_id,
      type: "get",
      beforeSend: function(){
          $('.aloader').show();
      }
  }).done(function(data){
    if(data == "end"){
      $('.aloader').addClass("section");
      $('.ME').html("You have gotten to the end of data.").addClass("item");
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
}*/



//Review form

$('#reviewFormBtn').click(function(e){ 
  e.preventDefault(); 
  
  $('#reviewFormBtn').html("Submitting...");
  
             $.ajax({  
                  url:"../inc/addReview.php",  
                  method:"POST",  
                  data: $("#reviewForm").serialize(), 
                  success:function(data)  
                  {  
                    $('#reviewFormBtn').html("Submit Review");
  
                        if(data.trim() == 1){
                          $("#actionReviewSheetForm").modal("hide");
                          $("#actionSheetAlertSuccess").modal("show");
      
                         $('#reviewForm')[0].reset();  
                         setTimeout(' window.location.href = document.location.href; ',2000);
                   //location.href = 'checkout';
                    //document.location.href = document.location.href;
                   
                    }else{
                      $('#reviewFormBtn').html("Submit Review");

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


});


</script>