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

if(isset($_GET['del'])){
  $id = $_GET['del'];
  $query = mysqli_query($mysqli, "SELECT * FROM assets WHERE ass_id = '$id'");
  $row = mysqli_fetch_array($query);
  

  if($query){
    $delMsg = '<div class="alert alert-warning">Are you sure you want to delete <strong>'.$row['ass_name'].'</strong>?  <a href="assets?yes_del='.$row['ass_id'].'">Yes, delete it</a></div>';
  }
}
if(isset($_GET['yes_del'])){
  $id = $_GET['yes_del'];
  $query = mysqli_query($mysqli,"delete from assets WHERE ass_id = '$id'");
  if($query){
    $message = '<div class="alert alert-success">Deleted successfully</div>';
  }else{
    $delMsg = '<div class="alert alert-danger">Delete failed. '.$mysqli->error.'</div>';
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">folder</i> ASSESTS</h4>
              </div>
             
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
      <div class="card-content gradient-shadow">
            <a href="new-asset" class="btn btn-info mb-3">Add asset</a>
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

     <table id="incCatTable" class="table_view">
       <thead>
       <th>category</th>
      <th>Name </th>
      <th>Brand </th>
      <th>Model</th>
      <th>Code </th>
      <th>Configuration </th>
      <th>Price </th>
      <th>Qty</th>
       <th>Purchased Date</th>
        <?php if (authorize($_SESSION["access"]["ASSESTS"]["ASSESTS"]["edit"])) { ?><th>Account Status</th><?php } ?>
     
       </thead>
       <tbody class="refresh">
       <?php  
       $ASSESTSs = getASSESTSs();
       foreach($ASSESTSs as $rows){
       
        ?> 
        <tr class="animated fadeIn">
        <td><?php echo ucwords($rows['category']); ?></td>
        <td><?php echo ucwords($rows['ass_name']); ?></td>
        <td><?php echo $rows['ass_brand']; ?></td>
        <td><?php echo $rows['ass_model']; ?></td>
         <td><?php echo $rows['ass_code']; ?></td>
          <td><?php echo $rows['configuration']; ?></td>
           <td><?php echo $rows['ass_price']; ?></td>
            <td><?php echo $rows['ass_qty']; ?></td>
            <td><?php echo $rows['purchasing_date']; ?></td>
        
      
        <td class="tbtn"> 
          <!--<button id="<?php //echo  $rows['u_rolecode']; ?>" class="btn btn-floating uprivileges btn-small waves-effect waves-light orange z-depth-3"  ><i class="material-icons left">supervisor_account</i></button>-->
           <?php if (authorize($_SESSION["access"]["ASSESTS"]["ASSESTS"]["edit"])) { ?>
          <a href="new-asset?id=<?php echo $rows['ass_id']; ?>" class="btn btn-floating waves-effect waves-light green z-depth-3 btn-small" type="button" title="Edit"><i class="material-icons left">create</i></a>
        <?php } ?>
         <?php if (authorize($_SESSION["access"]["ASSESTS"]["ASSESTS"]["delete"])) { ?>
          <a href="assets?del=<?php echo $rows['ass_id']; ?>"  class="btn btn-floating  waves-effect waves-light red z-depth-4 btn-small" type="button" title="Delete"><i class="material-icons left">delete</i></button>
      <?php } ?>
        </td>
        </tr>
        <?php
        }
        ?>
       </tbody>


     </table>       
            
                   
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