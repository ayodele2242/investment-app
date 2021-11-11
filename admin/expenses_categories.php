
<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["ACCOUNTING"]["EXPENSES CATEGORIES"]["create"]) || 
authorize($_SESSION["access"]["ACCOUNTING"]["EXPENSES CATEGORIES"]["edit"]) || 
authorize($_SESSION["access"]["ACCOUNTING"]["EXPENSES CATEGORIES"]["view"]) || 
authorize($_SESSION["access"]["ACCOUNTING"]["EXPENSES CATEGORIES"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

include("left_nav.php");

if(isset($_GET['id'])){
$id = $_GET['id'];
$query = mysqli_query($mysqli, "SELECT * FROM exptype WHERE exptype_id = '$id'");
$row = mysqli_fetch_array($query);

}
if(isset($_POST['update'])){
  $cat = $_POST['name'];
  $id = $_POST['id'];
  //$query = mysqli_query($mysqli,"insert into exptype(exptype_type)values('$cat')");
  $query = mysqli_query($mysqli,"update exptype SET exptype_type = '$cat' WHERE exptype_id = '$id' ");
  if($query){
    $message = '<div class="alert alert-success">Updated successfully</div>';
  }else{
    $message = '<div class="alert alert-danger">Update failed.'.$mysqli->error.'</div>';
  }
}

if(isset($_GET['del'])){
  $id = $_GET['del'];
  $query = mysqli_query($mysqli, "SELECT * FROM exptype WHERE exptype_id = '$id'");
  $row = mysqli_fetch_array($query);
  

  if($query){
    $delMsg = '<div class="alert alert-warning">Are you surely you want to delete <strong>'.$row['exptype_type'].'</strong>?  <a href="expenses_categories?yes_del='.$row['exptype_id'].'">Yes, delete it</a></div>';
  }
}
if(isset($_GET['yes_del'])){
  $id = $_GET['yes_del'];
  $query = mysqli_query($mysqli,"delete from exptype WHERE exptype_id = '$id'");
  if($query){
    $message = '<div class="alert alert-success">Deleted successfully</div>';
  }else{
    $message = '<div class="alert alert-danger">Delete failed. '.$mysqli->error.'</div>';
  }

  }

if(isset($_POST['add'])){
  $name = $mysqli->real_escape_string($_POST['name']);
  $query = mysqli_query($mysqli, "insert into exptype(exptype_type)values('$name')");
  if($query){
    $message = '<div class="alert alert-success">Saved successfully</div>';
  }else{
    $message = '<div class="alert alert-danger">Error occured: '.$mysqli->error.'</div>';
  }

}


?>
<style type="text/css">
  .large{
    width: 100%;
    height: 100%;
  }
</style>

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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">domain</i> EXPENSES CATEGORIES</h4>
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
       <?php
          if(isset($message)){
            echo $message;
            ?>
            <script type="text/javascript">
               setTimeout(function() {
              window.location.replace("incomes_category");
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
       <div id="message" class="removeMessages col s12"></div>
        <div class="col s12 m4">
         
     <form id="incCatForm" method="post">
   <div class="form-group mb-3">
   <input type="text" name="name" value="<?php if($row['exptype_type']){ echo $row['exptype_type']; }  ?>" placeholder="Enter Expense Category">
   <input type="hidden" name="id" value="<?php if($row['exptype_type']){ echo $row['exptype_id']; }  ?>">
   </div>
 

    <div class="form-group mb-3">

   <div align="center">
    <?php
      if(!empty($row['exptype_id'])){
        echo '<button type="submit" name="update" class="btn btn-sm bg-light-orange btn-submit">Update</button>';
      }else{
    if(authorize($_SESSION["access"]["ACCOUNTING"]["EXPENSES CATEGORIES"]["create"])) 
    { ?>
   <button type="submit" name="add" class="btn btn-sm bg-light-blue btn-submit">Add</button>
<?php }  } ?>
   </div>
   </div>   

  


     </form>
        </div>

        <div class="col s12 m8">
     
      <table id="incCatTable" class="table table_view">
        <thead>
          <th>#ID</th>
          <th>Expenses Types</th>
        
          <th></th>
        </thead>

   <tbody>
     <?php
     $exp = getExpensesCat();
     $x = 1;
      foreach($exp as $expense){
     ?>

   <tr>
   <td><?php echo $x; ?></td>
   <td><?php echo ucwords($expense['exptype_type']); ?></td>
    <td class="tbtn"> 
           <?php if (authorize($_SESSION["access"]["ACCOUNTING"]["EXPENSES CATEGORIES"]["edit"])) { ?>
          <a href="expenses_categories?id=<?php echo $expense['exptype_id']; ?>" class="btn btn-floating waves-effect waves-light green z-depth-3 btn-small" type="button" title="Edit"><i class="material-icons left">create</i></a>
        <?php } ?>
         <?php if (authorize($_SESSION["access"]["ACCOUNTING"]["EXPENSES CATEGORIES"]["delete"])) { ?>
          <a href="expenses_categories?del=<?php echo $expense['exptype_id']; ?>" id="<?php echo $expense['exptype_id']; ?>" class="btn btn-floating delIncCat waves-effect waves-light red z-depth-4 btn-small" type="button" title="Delete"><i class="material-icons left">delete</i></a>
      <?php } ?>
        </td>
   </tr>

   <?php $x++; } ?>
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



         
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

  



<!-- remove modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="menuModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Delete</h4>
        </div>
        <div class="modal-body">
          <p >Do you really want to delete it?</p>
          <div class="removeMessages"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn default modal-close" data-dismiss="modal">Close</button>
          <button type="button" class="btn red btn-small" id="removeBtn"><i class="material-icons left">delete</i> Delete</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- /remove modal -->

    


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