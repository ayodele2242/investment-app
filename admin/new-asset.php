<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["ASSESTS"]["ASSESTS"]["create"]) || 
authorize($_SESSION["access"]["ASSESTS"]["ASSESTS"]["edit"]) || 
authorize($_SESSION["access"]["ASSESTS"]["ASSESTS"]["view"]) || 
authorize($_SESSION["access"]["ASSESTS"]["ASSESTS"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

include("left_nav.php");

if(isset($_GET['id'])){
$id = $_GET['id'];
$query = mysqli_query($mysqli, "SELECT * FROM assets WHERE ass_id = '$id'");
$row = mysqli_fetch_array($query);

}


if(isset($_POST['submit'])){
   
  $catid = $_POST['catid'];    
  $name = $_POST['assname'];
  $brand = $_POST['brand'];
  $model= $_POST['model'];    
  $code = $_POST['code'];   
  $config = $_POST['config'];   
  $purchase = $_POST['purchase'];   
  $price = $_POST['price'];   
  $qty = $_POST['pqty'];  

  $query = mysqli_query($mysqli, "insert into assets(category, ass_name, ass_brand, ass_model,ass_code,configuration,purchasing_date,ass_price,ass_qty)values('$catid','$name','$brand','$model','$code','$config','$purchase','$price','$qty')");

  if($query){
    $message = '<div class="alert alert-success">Inserted successfully</div>';
  }else{
    $delMsg = '<div class="alert alert-danger">Insertion failed. '.$mysqli->error.'</div>';
  }
}

if(isset($_POST['update'])){
  $id = $_POST['aid']; 
   $catid = $_POST['catid'];    
  $name = $_POST['assname'];
  $brand = $_POST['brand'];
  $model= $_POST['model'];    
  $code = $_POST['code'];   
  $config = $_POST['config'];   
  $purchase = $_POST['purchase'];   
  $price = $_POST['price'];   
  $qty = $_POST['pqty'];  

$query = mysqli_query($mysqli, "UPDATE assets SET category='$catid', ass_name='$name', ass_brand='$brand', ass_model='$model',ass_code='$code',configuration='$config',purchasing_date='$purchase',ass_price='$price',ass_qty='$qty' WHERE ass_id = '$id' ");

  if($query){
    $message = '<div class="alert alert-success">Updated successfully</div>';
  }else{
    $delMsg = '<div class="alert alert-danger">Update failed. '.$mysqli->error.'</div>';
  }


}
?>


    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-blue-grey-blue gradient-shadow"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">folder</i> Asset</h4>
              </div>
             
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
      <div class="card-content gradient-shadow">
          
    <div class="row">
        <div class="col s12 refresh">
 <?php
          if(isset($message)){
            echo $message;
            ?>
            <script type="text/javascript">
               setTimeout(function() {
              window.location.replace("assets");
            }, 2000);
            </script>
            <?php
          }else{
            $message = "";
          }

          if(isset($delMsg)){
            echo $delMsg;
          }else{
            $delMsg = "";
          }
          ?>
          <form method="post" action="new-asset" enctype="multipart/form-data">
                                    <div class="modal-body">
                                           <div class="row">
                                               <div class="col-md-6">      
                                            <div class="form-group">
                                                <label class="control-label">Asset name</label>
                                                <input type="text" name="assname" value="<?php if($row['category']){ echo $row['category']; }  ?>" class="form-control" id="recipient-name1" required>
                                            </div>
                                            <div class="form-group">
                                               <label class="control-label">Category Type </label>
                                                <input type="text" name="catid" value="<?php if($row['ass_name']){ echo $row['ass_name']; }  ?>" class="form-control" id="recipient-name1">
                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Assets Brand</label>
                                                <input type="text" name="brand" value="<?php if($row['ass_brand']){ echo $row['ass_brand']; }  ?>" class="form-control" id="recipient-name1">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Assets Model</label>
                                                <input type="text" name="model" value="<?php if($row['ass_model']){ echo $row['ass_model']; }  ?>" class="form-control" id="recipient-name1">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Assets Code</label>
                                                <input type="text" name="code" value="<?php if($row['ass_code']){ echo $row['ass_code']; }  ?>" class="form-control" id="recipient-name1 ">
                                            </div>                                                   
                                               </div>
                                               <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Configuration</label>
                                                <textarea class="form-control" name="config" id="message-text1" required  rows="4"><?php if($row['configuration']){ echo $row['configuration']; }  ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Purchaseing Date</label>
                                                <input type="text" name="purchase" value="<?php if($row['purchasing_date']){ echo $row['purchasing_date']; }  ?>" class="form-control mydatepicker" id="recipient-name1">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Price</label>
                                                <input type="number" name="price" value="<?php if($row['ass_price']){ echo $row['ass_price']; }  ?>" class="form-control" id="recipient-name1">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Quantity</label>
                                                <input type="number" name="pqty" value="<?php if($row['ass_qty']){ echo $row['ass_qty']; }  ?>"
                                                 class="form-control" id="recipient-name1">
                                            </div>                                                   
                                               </div>
                                        </div>
<!--
                                            <div class="form-group">
                                                <input name="type" type="checkbox" id="radio_2" data-value="Logistic" value="Logistic" class="type">
                                                <label for="radio_2">Add To Logistic Support List</label>
                                            </div>-->       
                                    </div>
                                    <div class="modal-footer">
                                       <input type="hidden" name="aid" value="<?php if($row['ass_id']){ echo $row['ass_id']; }  ?>">
                                       
                                       
                                         <?php
                                        if(!empty($row['ass_id'])){
                                          echo '<button type="submit" name="update" class="btn btn-sm bg-light-orange btn-submit">Update</button>';
                                        }else{
                                      if(authorize($_SESSION["access"]["ASSESTS"]["ASSESTS"]["create"])) 
                                      { ?>
                                      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                  <?php }  } ?>
                                    </div>
                                    </form>

     
            
                   
        </div>
    </div>

                        
</div>
</div>
</div>
</div>
</div>
</div>


<?php include("right_menu.php"); ?>
         
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

  

 <div id="ASSESTS-modal" class="modal">
    <div class="modal-content">
     <div id="modal-loader" style="display: none; text-align: center;">
           <!-- ajax loader -->
           <img src="../assets/img/loading.gif">
           </div>
                            
           <!-- mysql data will be load here -->                          
           <div id="contents"></div>
    </div>
    
  </div>
    


<?php
include("footer.php");
?>

<script type="text/javascript">
  $(document).ready(function() {
  $("#incCatTable").DataTable({
    "scrollY": 330,
        "scrollX": true,
    "pageLength": 150,
    "order": []
  });
  

});
</script>