
  <?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["REPORTS"]["EMI"]["create"]) || 
authorize($_SESSION["access"]["REPORTS"]["EMI"]["edit"]) || 
authorize($_SESSION["access"]["REPORTS"]["EMI"]["view"]) || 
authorize($_SESSION["access"]["REPORTS"]["EMI"]["delete"]) ) {
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">folder</i> EMI Report</h4>
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

          <form id="emiForm">
              <div class="modal-body">
                     <div class="row">
                         <div class="col l6 s12">      
                      <div class="form-group">
                          <label class="control-label">From</label>
                          <input type="text" name="from_date" value="" class="form-control datepicker" id="from" required>
                      </div>
                    </div>
                    <div class="col l6 s12">  
                      <div class="form-group">
                         <label class="control-label">To </label>
                          <input type="text" name="to_date" value="" class="form-control datepicker" id="to">
                          
                      </div>
                    </div>
                      
                    
                         
              </div>
              <div class="modal-footer">

                 <?php
                  
                if(authorize($_SESSION["access"]["REPORTS"]["EMI"]["create"])) 
                { ?>
                <button class="btn btn-primary btn-submit" id="emiBtn">Search</button>
            <?php }  ?>
              </div>
              </form>

               <div class="col l12 s12" id="detail">  </div>

     
            
                   
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

 


<?php
include("footer.php");
?>

<script type="text/javascript">

$(document).ready(function(){
  $('#emiBtn').click(function(e) {
    e.preventDefault();

  var from   = $('#from').val();
  var to    = $('#to').val();
    
    /*if(from == ""){
      
       M.toast({html: "Please provide all search data ", classes: 'rounded bg-red'});
        $(".btn-submit").html('Try Again');
    }else{*/
          
      $.ajax({
        type: "POST",
        url: "../inc/reports/emi.php",
        data: $("#emiForm").serialize(),
         beforeSend: function(){
        $("#error").fadeOut();
        $(".btn-submit").html('<img src="../assets/img/loading.gif" width="20" height="20" /> Prevewing');
        },
        
        success: function(message){
          
          $("#detail").html(message);
           
           $(".btn-submit").html('Preview');

        }
    })
 
    //}
    return false;

 });
});




  $(document).ready(function() {
  $("#incCatTable").DataTable({
    "scrollY": 330,
        "scrollX": true,
    "pageLength": 150,
    "order": []
  });
  

});
</script>