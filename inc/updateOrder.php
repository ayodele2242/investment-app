
<?php
require 'functions.php';

if(isset($_POST['id'])){
	$id = safe_input($mysqli,$_POST['id']);


	$query = mysqli_query($mysqli, "select * from customer_order where id = '$id'");

    $pro_info = mysqli_fetch_array($query);


 ?>
<style type="text/css">
  
.mselect, .mselect *, .mselect option {
    border: 0 !important;
    background: #fbe9e7;
  }

  .delete, .delete *, .delete option {
    background: #b71c1c;
    color: #fff;
  }

     .mselect, .mselect:focus, .mselect:active,.mbtn,.mbtn:hover,.mbtn:focus{
      -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    appearance: none;
    outline: 0;
    box-shadow: none;
    background-image: none;
     }
</style>
<div class="row">
<div class="col-lg-4">
 <?php 
 $sample_image=explode(",", $pro_info['product_image']);
if ($pro_info['product_image'] !="" && file_exists(UPLOAD_DIR.'/product/'.$sample_image[0])) {
 
  ?>
  <div class="img img-responsive">
    <img src="<?php echo UPLOAD_URL.'product/'.$sample_image[0];?>" class="img img-thumbnail" style="width:150px;">
  </div>
  <?php
} 
?>
</div>
<div class="8">
<div class="col-lg-12">
	Payment Method: &nbsp;<?php echo $pro_info['payment'];?>
</div>
<div class="col-lg-12" style="font-weight: bolder;">
	Order Date: <?php echo $pro_info['added_date'];?> 
</div>
<div class="col-lg-12">
	<form id="orderiUpdate">
	<div class="row mb-3 mt-3">	
	<div class="col-lg-5" style="font-weight: bolder;">
    <?php  if(!empty($pro_info['delivery_date'])){ echo "Delivering Date"; }else{ ?>
  Enter Delivery Date:
<?php } ?> 
</div> 
	<div class="col-lg-7">

<div class="form-group">
                
                <div class='input-group'>
                  <input type='date' id="delivery_date" class="form-control singledate" name="delivery_date" value="<?php  if(!empty($pro_info['delivery_date'])){ echo $pro_info['delivery_date']; } ?>" />
                  
                </div>
                
              </div>

	</div>
  </div><!--row #end-->

  <div class="row mb-3 mt-3">	
	<div class="col-lg-5" style="font-weight: bolder;">Delivery Status:</div> 
	<div class="col-lg-7">
		<select name="delivery_status" class="form-control mselect select">
    <option value="Pending" selected>Pending</option>

    <option value="Cancelled" <?php if($pro_info['delivery_status'] == "Cancelled"){ echo "selected"; }  ?> >Cancel</option>
    <option value="Returned" <?php if($pro_info['delivery_status'] == "Returned"){ echo "selected"; }  ?> >Return</option>
	  <option value="Fulfilled" <?php if($pro_info['delivery_status'] == "Fulfilled"){ echo "selected"; }  ?> >Fulfilled</option>
	  <option value="Delivered" <?php if($pro_info['delivery_status'] == "Delivered"){ echo "selected"; }  ?> >Delivered</option>
				
			
		</select>
	</div>
  </div><!--row #end-->
<div id="error"></div>
<div class="modal-footer">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<button type="button" class="btn btn-danger infoUpdate">Save</button>
</div>
</form>
</div>


</div>

</div>








<?php

}


?>



<script type="text/javascript">
	//Update store setting table
$(document).ready(function() {

    $(".infoUpdate").click(function(e) {
       e.preventDefault();

       $("#error").html('<div class="alert alert-info darken-3">Updating. Please wait..</div>').show();
       setTimeout(function() {
              $("#error").fadeOut(1500);
          }, 30000);


   if($("#delivery_date").val() == ""){
    $("#error").html('<div class="alert alert-danger darken-3">Enter Delivery Date</div>').show();
       setTimeout(function() {
              $("#error").fadeOut(1500);
          }, 30000);

   }else{
    
    var form = $('#orderiUpdate').get(0); 
    //console.log(form);
    var fd = new FormData(form);
        
       $.ajax({
            url  : '../inc/update_order_status.php',
            type : 'POST',
            data : fd,
                    contentType: false,
                    processData:false,
            success :  function(data)
            {
                if(data.trim() == 1)
                {
                   
                	 $("#error").html('<div class="alert alert-success mt-3">Updated Successfully</div>');

                      setTimeout(function() {
              $("#error").fadeOut(1500);
          }, 30000);

                      location.reload();
                  
                	
                }else{
                  $(".btn-submit").html("UPDATE");
                  
                        $("#error").html('<div class="alert-danger red darken-3 text-white white-text mt-3"><i class="fa fa-info-circle"></i>  &nbsp;'+data+'</div>');
                           setTimeout(function() {
              $("#error").fadeOut(1500);
          }, 30000);


                   $(".modal-content").animate({ scrollTop: 0 }, 'slow');


                    

                }
            }
        });
       // return false;
      }

 
    });
});
	
</script>


<script src="../vendor/js/pick-a-datetime.min.js" type="text/javascript"></script>