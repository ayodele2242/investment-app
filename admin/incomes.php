
<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["ACCOUNTING"]["INCOMES"]["create"]) || 
authorize($_SESSION["access"]["ACCOUNTING"]["INCOMES"]["edit"]) || 
authorize($_SESSION["access"]["ACCOUNTING"]["INCOMES"]["view"]) || 
authorize($_SESSION["access"]["ACCOUNTING"]["INCOMES"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

include("left_nav.php");

if(isset($_GET['id'])){
$id = $_GET['id'];
$query = mysqli_query($mysqli, "SELECT * FROM incomes WHERE inc_id = '$id'");
$row = mysqli_fetch_array($query);
$cat = $row['Inc_type'];
$branch = $row['branch'];
}
if(isset($_POST['update'])){
  $id = $_POST['id'];

  $type = $_POST['inctype'];
  $amt = $mysqli->real_escape_string($_POST['amount']);
  $amount = (int)str_replace(',', '', $amt);
  $details = $mysqli->real_escape_string($_POST['details']);
  $from = $mysqli->real_escape_string($_POST['receive_from']);
  $branch = $_POST['branch'];
  $date = DateTime::createFromFormat('d/m/Y', $_POST['date']);
  $odate = $date->format('Y-m-d');

  
  $query = mysqli_query($mysqli, "update incomes SET Inc_type = '$type',amount = ' $amount',details = '$details',receive_from = '$from',branch = '$branch',date_updated = '$odate' WHERE inc_id = '$id' ");
   
  if($query){
    $message = '<div class="alert alert-success">Updated successfully</div>';
  }else{
    $delMsg = '<div class="alert alert-danger">Update failed.'.$mysqli->error.'</div>';
  }
}

if(isset($_GET['del'])){
  $id = $_GET['del'];
  $query = mysqli_query($mysqli, "SELECT * FROM incomes WHERE inc_id = '$id'");
  $row = mysqli_fetch_array($query);
  

  if($query){
    $delMsg = '<div class="alert alert-warning">Are you surely you want to delete <strong>'.$row['Inc_type'].'</strong>?  <a href="incomes?yes_del='.$row['inc_id'].'">Yes, delete it</a></div>';
  }
}
if(isset($_GET['yes_del'])){
  $id = $_GET['yes_del'];
  $query = mysqli_query($mysqli,"delete from incomes WHERE inc_id = '$id'");
  if($query){
    $message = '<div class="alert alert-success">Deleted successfully</div>';
  }else{
    $delMsg = '<div class="alert alert-danger">Delete failed. '.$mysqli->error.'</div>';
  }

  }

if(isset($_POST['add'])){
 
  $type = $_POST['inctype'];
  $amt = $mysqli->real_escape_string($_POST['amount']);
  $amount = (int)str_replace(',', '', $amt);
  $from = $mysqli->real_escape_string($_POST['receive_from']);
  $details = $mysqli->real_escape_string($_POST['details']);
  $branch = $_POST['branch'];

  

  $date = DateTime::createFromFormat('d/m/Y', $_POST['date']);
  $odate = $date->format('Y-m-d');

  $query = mysqli_query($mysqli, "insert into incomes(Inc_type,amount,details,receive_from,user_id,branch,created_date)values('$type','$amount','$details','$from','$name','$branch','$odate')");

  if($query){
    $message = '<div class="alert alert-success">Saved  '.$type. ' successfully</div>';
  }else{
     $delMsg = '<div class="alert alert-danger">Error occured: '.$mysqli->error.'</div>';
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">domain</i> INCOMES</h4>
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
              window.location.replace("incomes");
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
         
     <form id="addIncomes" method="post">
         <div class="form-group mb-3">
          <select name="inctype" class="browser-default select mselect ">
            <option value="">Select Income Category</option>
  <?php
     $incom = getIncomesCat();
      foreach($incom as $income){
        if(isset($row['Inc_type']) && $row['Inc_type'] == $income['inctype_type'] ){
          $selected = "selected"; 
        }else{
          $selected = "";
        }
     ?>
<option value="<?php echo $income['inctype_type']; ?>" <?php echo $selected; ?>><?php echo ucwords($income['inctype_type']); ?></option>
    <?php
   }
     ?>
     </select>
   </div>
   <div class="form-group mb-3">
   <input type="text" name="amount" value="<?php if($row['amount']){ echo $row['amount']; }  ?>" class="thousand digit" placeholder="Enter Income Amount" >
   </div>

   <div class="form-group mb-3">
   <input type="text" name="receive_from" value="<?php if($row['receive_from']){ echo $row['receive_from']; }  ?>" class="" placeholder="Receieve From" >
   </div>

    <div class="form-group mb-3">
    <textarea name="details" class="form-control " placeholder="Details"><?php if($row['details']){ echo $row['details']; }  ?></textarea>
    </div>
  
   <div class="form-group mb-3">
   <input type="text" name="date" value="" class="datepicker" placeholder="<?php if($row['Inc_type']){ echo 'Update'; }else{ echo 'Income'; } ?> Date">
   </div>

    <div class="form-group mb-3">
   <select name="branch" class="city browser-default mselect" id="branch">
  <option value="" selected="selected"  >Branch</option>
  <?php
  $aCm     = "select * from branch";
  $CCm     = @mysqli_query($mysqli,$aCm);
  while($fetm = @mysqli_fetch_assoc($CCm)){
     if(isset($row['branch']) && $row['branch'] == $fetm['branch']){
          $selected = "selected"; 
        }else{
          $selected = "";
        }
  ?>
  <option value="<?php echo $fetm['branch'] ?>" <?php echo $selected; ?>><?php echo $fetm['branch'] ?></option>
  <?php } ?>
  </select>
   </div>

    <div class="form-group mb-3">

   <div align="center">
     <input type="hidden" name="id" value="<?php if($row['Inc_type']){ echo $row['inc_id']; }  ?>">
    <?php
      if(!empty($row['inc_id'])){
        echo '<button type="submit" name="update" class="btn btn-sm bg-light-orange btn-submit">Update</button>';
      }else{
    if(authorize($_SESSION["access"]["ACCOUNTING"]["INCOMES"]["create"])) 
    { ?>
   <button type="submit" name="add" class="btn btn-sm bg-light-blue btn-submit addMe">Add</button>
<?php }  } ?>
   </div>
   </div>   

  


     </form>
        </div>

        <div class="col s12 m8">
     
      <table id="incCatTable" class="table table_view">
        <thead>
          <th>#ID</th>
          <th>Incomes Types</th>
          <th>Amount</th>
          <th>Received from</th>
          <th>Details</th>
          <th>Branch</th>
          <th>Date</th>
          <th></th>
        </thead>

   <tbody>
     <?php
     $incom = getIncomes();
     $x = 1;
      foreach($incom as $income){
     ?>

   <tr>
   <td><?php echo $x; ?></td>
   <td><?php echo ucwords($income['Inc_type']); ?></td>
   <td><?php echo number_format($income['amount']); ?></td>
   <td><?php echo ucwords($income['receive_from']); ?></td>
   <td><?php echo ucwords($income['details']); ?></td>
   <td><?php echo ucwords($income['branch']); ?></td>
   <td><?php echo ucwords($income['created_date']); ?></td>
    <td class="tbtn"> 
           <?php if (authorize($_SESSION["access"]["ACCOUNTING"]["INCOMES"]["edit"])) { ?>
          <a href="incomes?id=<?php echo $income['inc_id']; ?>" class="btn btn-floating waves-effect waves-light green z-depth-3 btn-small" type="button" title="Edit"><i class="material-icons left">create</i></a>
        <?php } ?>
         <?php if (authorize($_SESSION["access"]["ACCOUNTING"]["INCOMES"]["delete"])) { ?>
          <a href="incomes?del=<?php echo $income['inc_id']; ?>" id="<?php echo $income['inc_id']; ?>" class="btn btn-floating delIncCat waves-effect waves-light red z-depth-4 btn-small" type="button" title="Delete"><i class="material-icons left">delete</i></a>
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



  $(document).ready(function() {
    var $submit = $("input[type=submit]"),
        $inputs = $('input[type=text], input[type=password]');

    function checkEmpty() {
        return $inputs.filter(function() {
            return !$.trim(this.value);
        }).length === 0;
    }

    $inputs.on('blur', function() {
        $submit.prop("disabled", !checkEmpty());
    }).blur();
});

  $('.mselect').on('change', function () {
    $('.addMe').prop('disabled', !$(this).val());
}).trigger('change');


    

    $(document).ready(function() {

     $(".addMes").click(function(e) {
       e.preventDefault();

         var form = $('#addUser').get(0); 
         var fd = new FormData(form);
        
       $.ajax({
            url  : '../inc/accounting/addIncome.php',
            type : 'POST',
            data : $('#addIncome').serialize(),
            beforeSend: function(){
                    $("#error").fadeOut();
                    $(".btn-submit").html('<img src="../assets/img/loading.gif" width="20" height="20" /> &nbsp; Adding...');
                    },
                    contentType: false,
                    processData:false,
            success :  function(data)
            {
                if(data.trim() == 1)
                {

                   M.toast({html: '<i class="material-icons">done</i> Added Successfully'});
                  
                   $(".btn-submit").html("Submit");
                   $('#addUser').trigger("reset");
                   location.reload(true);
                  
                }else{
                  $(".btn-submit").html("Submit");
                  $("#error").fadeIn(1000, function(){
                        $("#error").html('<div class="alert-danger red darken-3 text-white white-text"><i class="material-icons">help_outline</i>  &nbsp;'+data+'</div>');
                        
                    });


                   $(".modal-content").animate({ scrollTop: 0 }, 'slow');


                    

                }
            }
        });
       // return false;
        });
     });
</script>