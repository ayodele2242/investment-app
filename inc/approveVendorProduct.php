<?php
require '../config/config.php';
require '../config/function.php';
require '../class/database.php';
require 'functions.php';

if(isset($_POST['id'])){
	$id = safe_input($mysqli,$_POST['id']);


	$query = mysqli_query($mysqli, "select * from product where id = '$id'");

    $pro_info = mysqli_fetch_array($query);

    //get details of the seller
    $u = $pro_info['vendor_name'];
    $sel = mysqli_query($mysqli, "select * from vendors where username = '$u'");
    $irow = mysqli_fetch_array($sel);


 ?>
<form id="orderiUpdate">

<div class="row">
<div class="col-lg-12">

 <?php 
 $sample_image=explode(",", $pro_info['images']);
if ($pro_info['images'] !="" && file_exists(UPLOAD_DIR.'/product/'.$sample_image[0])) {
 
  ?>
  
    <img src="<?php echo UPLOAD_URL.'product/'.$sample_image[0];?>" class="img-thumb" style="width:250px; height: 250px;">
 
  <?php
} 
?>

</div>
</div>


<div class="container-fluid bd-example-row">



<div class="col-lg-12">

<table class="table table-striped">
<tr>
  <td>Vendor Name</td>
   <td><?php echo $irow['name'];?></td>
</tr>
<tr>
  <td>Phone Number</td>
   <td><?php echo $irow['phone'];?></td>
</tr>
<tr>
  <td>Email</td>
   <td><?php echo $irow['email'];?></td>
</tr>
<tr>
  <td> Date Added</td>
   <td><?php echo $pro_info['added_date']; ?></td>
</tr>
</table>


</div>

</div>




 <div class="row mb-5"> 
  <div class="col-lg-5"><h6>Activation Status:</h6></div> 
  <div class="col-lg-7">
    <select name="delivery_status" class="form-control">
   
    <option value="0" <?php if($pro_info['status'] == "0"){ echo "selected"; }  ?> >Disapprove</option>
    <option value="1" <?php if($pro_info['status'] == "1"){ echo "selected"; }  ?> >Approve</option>
      
      
    </select>
  </div>
  </div><!--row #end-->



  <div id="error"></div>
<input type="hidden" name="id" value="<?php echo $id; ?>">
<button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-danger infoUpdate">Save</button>



</form>



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
            url  : '../inc/activate_product.php',
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

