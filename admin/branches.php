
<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["BRANCHES"]["BRANCHES"]["create"]) || 
authorize($_SESSION["access"]["BRANCHES"]["BRANCHES"]["edit"]) || 
authorize($_SESSION["access"]["BRANCHES"]["BRANCHES"]["view"]) || 
authorize($_SESSION["access"]["BRANCHES"]["BRANCHES"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

include("left_nav.php");

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $my = mysqli_query($mysqli,"SELECT * FROM branch WHERE branch_id='$id'");
  $row = mysqli_fetch_array($my);
}

/*if(isset($_POST['updates'])){


  $name=$mysqli->real_escape_string($_POST['name']);
  $addr=$mysqli->real_escape_string($_POST['addr']);
  $branch=$mysqli->real_escape_string($_POST['branch']);
  $id = $_POST['aid'];

  $query = mysqli_query($mysqli,"UPDATE branch SET  branch='$name', addr='$addr', decription='$branch' WHERE branch_id ='$id' ");

  if($query){
    $message = '<div class="alert alert-success">Updated successfully</div>';
  }else{
    $delMsg = '<div class="alert alert-danger">Update failed.'.$mysqli->error.'</div>';
  }

}*/


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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">domain</i> Branches</h4>
              </div>
             
            </div>
          </div>
        </div>
        <div class="col s12">
 <?php
          if(isset($message)){
            echo $message;
            ?>
            <script type="text/javascript">
               setTimeout(function() {
              window.location.replace("branches");
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
          <div class="container">
            <!--Basic Card-->
<div class="card">
      <div class="card-content gradient-shadow">
            
    <div class="row">
       <div id="message" class="removeMessages col s12"></div>
        <div class="col s12 m4">
     <form id="branchForm" method="post">
   <div class="form-group mb-3">
   <input type="text" name="name" placeholder="Enter Branch Name" value="<?php if($row['branch']){ echo $row['branch']; } ?>">
   <input type="hidden" name="aid" value="<?php if($row['branch_id']){ echo $row['branch_id']; } ?>">
   </div>

   <div class="form-group mb-3">
    <select name="branch" id="branch" class="browser-default mselect select">
      <option value="">Branch Type </option>
      <option value="Branch Office" <?php if($row['decription'] && $row['decription'] == "Branch Office"){ echo "selected"; }  ?> >Branch Office</option>
      <option value="Head Office" <?php if($row['decription'] && $row['decription'] == "Head Office"){ echo "selected"; }  ?>>Head Office</option>
    </select>
   </div>   
   <div class="form-group mb-3">
  <textarea rows="6" name="addr" placeholder="Enter Address"><?php if($row['addr']){ echo $row['addr']; } ?></textarea>
   </div>

    <div class="form-group mb-3">

   <div align="center">


    <?php 

    if($row['branch_id']){
        echo '<button class="btn btn-sm bg-light-orange btn-submit">Update</button>';
      }else{
    if (authorize($_SESSION["access"]["BRANCHES"]["BRANCHES"]["create"])) { ?>
   <button class="btn btn-sm bg-light-blue btn-submit">Add</button>
<?php } } ?>
   </div>
   </div>   

  


     </form>
        </div>

        <div class="col s12 m8">
     
      <table id="branchTable" class="table table_view">
        <thead>
          <th>#ID</th>
          <th>Branch Name</th>
          <th>Address</th>
          <th>Type</th>
          <th></th>
        </thead>



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
   $('#branchForm').submit(function(event){
  event.preventDefault();
  //var data = $("#register-form").serialize();
  $.ajax({
    url: "../inc/branch/insert.php",
    method: "post",
    data: $('form').serialize(),
    success: function(data){
    //$('#message').html(strMessage);
    //$('#menuform')[0].reset();
    //branchTable.ajax.reload(null, false);
    if(data==1){
    $("#message").fadeIn(1000, function(){
      $("#message").html('<div class="alert alert-danger"> <span class="fa fa-info-circle"></span> &nbsp; Duplicate entry. Menu already exist in the database! </div>');
    });

    }else if(data=="added")
    {
          $('#branchForm')[0].reset();
          $("#branchTable").DataTable().ajax.reload();

          //$(".stas").load(location.href + " .stas");
          M.toast({html: "Operation was successful"});
          window.location.href = "branches";
    }else if(data=="updated")
    {     
          $("#branchTable").DataTable().ajax.reload();
          M.toast({html: "Updated successfully"});
          location.reload(true);
    }
    else{

        $("#message").fadeIn(1000, function(){
        $("#message").html('<div class="alert red col-white"><span class="fa fa-info-circle"></span> &nbsp; '+data+' !</div>');
        //$("#btn-submit").html('<i class="fa fa-plus"></i> Add Menu');
      });

    }

    }
  })
  })
</script>