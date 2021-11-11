<?php
require '../config/config.php';
require '../config/function.php';
require '../class/database.php';
require 'functions.php';

if(isset($_POST['id'])){
	$id = safe_input($mysqli,$_POST['id']);


	$query = mysqli_query($mysqli, "select * from customer_order where id = '$id'");

    $pro_info = mysqli_fetch_array($query);

    $username = $pro_info['vendor'];

    //get vendor name

    $vquery = mysqli_query($mysqli,"select * from vendors where username = '$username' ");
    $mvendor = mysqli_fetch_array($vquery);


 ?>

<div class="row">
<div class="col-lg-4">
 <?php 
 $sample_image=explode(",", $pro_info['product_image']);
if ($pro_info['product_image'] !="" && file_exists(UPLOAD_DIR.'/product/'.$sample_image[0])) {
 
  ?>
  
    <img src="<?php echo UPLOAD_URL.'product/'.$sample_image[0];?>" class="" style="width:150px;">
  
  <?php
} 
?>
</div>
<div class="8">
<div class="col-lg-12">
	Payment Method: &nbsp;<?php echo $pro_info['payment'];?>
</div>
<div class="col-lg-12">
	Oreder Date: <?php echo $pro_info['added_date'];?> 
</div>
<div class="col-lg-12">
	<form id="orderiUpdate">
	<div class="row">	
	<div class="col-lg-12">
    <?php  if(!empty($pro_info['delivery_date'])){ echo "Delivered Date: ".  $pro_info['delivery_date']; } ?> 
</div> 
	
  </div><!--row #end-->

  <div class="row mt-3 mb-3"> 
    <h5>Seller's Info</h5>

   <table class="table">
     
    <tr>
      <td>Name</td>
      <td><?php echo $mvendor['name'];  ?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?php echo $mvendor['email'];  ?></td>
    </tr>
    <tr>
      <td>Phone</td>
      <td><?php echo $mvendor['phone'];  ?></td>
    </tr>
    <tr>
      <td><h6>Bank Account Details</h6></td>
    </tr>
    <tr>
      <td>Bank Name</td>
      <td><?php echo $mvendor['bank_name'];  ?></td>
    </tr>
    <tr>
      <td>Ac Name</td>
      <td><?php echo $mvendor['ac_name'];  ?></td>
    </tr>
    <tr>
      <td>Ac Number</td>
      <td><?php echo $mvendor['ac_num'];  ?></td>
    </tr>

   </table> 


  </div>

  <div class="row mt-3 mb-3">	
	
  <div class="col-lg-5"><h6>Enter amount to settle seller</h6></div>
	<div class="col-lg-7">

   <input type="number" name="amount_paying" placeholder="Enter Amount">


	</div>
  </div><!--row #end-->
<div id="error"></div>
<div class="modal-footer">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
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

    
    var form = $('#orderiUpdate').get(0); 
    //console.log(form);
    var fd = new FormData(form);
        
       $.ajax({
            url  : '../inc/update_payment.php',
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
      //}

 
    });
});
	
</script>

