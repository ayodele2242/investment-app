<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["SAVINGS"]["SAVINGS CATEGORIES"]["create"]) || 
authorize($_SESSION["access"]["SAVINGS"]["SAVINGS CATEGORIES"]["edit"]) || 
authorize($_SESSION["access"]["SAVINGS"]["SAVINGS CATEGORIES"]["view"]) || 
authorize($_SESSION["access"]["SAVINGS"]["SAVINGS CATEGORIES"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

include("left_nav.php");
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">view_list</i> SAVINGS CATEGORIES</h4>
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
      
<div class="col m5">
  <div id="message" class="removeMessages"></div>
<form autocomplete="off" id="packagesForm" class="">

                
                <div class="form-group mb-2">
                    <label>Saving Name</label>
                <input type="text" name="name"  required="required" class="form-control" placeholder="Saving Name e.g Daily Savings">
                </div>

               
                <div class="form-group mb-2">
                <label>Duration</label>
                <select name="duration" class="browser-default  mselect" required="required">
                         <option value="">Select Saving Duration</option>
                         <option value="monthly">Monthly Saving</option>
                         <option value="weekly">Weekly Saving</option>
                         <option value="daily">Daily Saving</option>
                        
                        </select>
                </div>

                 <div class="form-group  mb-2" >
                  <label>Amount to Save for this Package</label>  
                <input type="number" name="amount"  required="required" class="form-control" placeholder="Package Saving Amount">
                </div>

                <div class="form-group mb-2">
                <label>Saving Details</label>
                <textarea id="editor" name="info"></textarea>
                </div>
                <div class="form-group mb-5">
                <div align="center">
                  <?php if (authorize($_SESSION["access"]["SAVINGS"]["SAVINGS CATEGORIES"]["create"])) { ?>
                <button type="submit" class="btn btn-md btn-info insertPackages" id="insertPackages"><i class="fa fa-plus"></i> Add</button>
                <?php } ?>
                </div>
                </div>

                </form>
      </div>
      <div class="col m7 s12">

       <table id="table" class="table table_view">
                    <thead class="heading">
                      <tr>
                       
                        <th>Saving Package Name</th>
                        <th>Saving Duration</th>
                        <th>Saing Amt</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="refresh">
       <?php  
       $users = getSavingPlans();
       foreach($users as $rows){
        
        if($rows['status'] == '1'){
        $esta = "checked";
         }else{
        $esta = "";
        }
        ?> 
        <tr class="animated fadeIn">
        <td><?php echo ucwords($rows['category']); ?></td>
        <td><?php echo ucwords($rows['duration']); ?></td>
        <td><?php echo number_format($rows['amount']); ?></td>
              
        <td class="tbtn"> 
          <!--<button id="<?php //echo  $rows['u_rolecode']; ?>" class="btn btn-floating uprivileges btn-small waves-effect waves-light orange z-depth-3"  ><i class="material-icons left">supervisor_account</i></button>-->
           <?php if (authorize($_SESSION["access"]["SAVINGS"]["SAVINGS CATEGORIES"]["edit"])) { ?>
          <a href="#planmodal" type="button" data-id="<?php echo $rows['id']; ?>" id="<?php echo $rows['id']; ?>" class="btn btn-floating waves-effect waves-light green z-depth-3 btn-small modal-trigger planmodal" type="button" title="Edit"><i class="material-icons left">create</i></a>
        <?php } ?>
         <?php if (authorize($_SESSION["access"]["SAVINGS"]["SAVINGS CATEGORIES"]["delete"])) { ?>
          <button id="<?php echo $rows['id']; ?>" class="btn btn-floating delPlan waves-effect waves-light red z-depth-4 btn-small" type="button" title="Delete"><i class="material-icons left">delete</i></button>
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



 <div id="planmodal" class="modal">
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

$(document).ready(function(){
 // Insert class
 $('#insertPackages').click(function(event) {
  event.preventDefault();
  for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
  //var data = $("#register-form").serialize();
  $.ajax({
    url: "../inc/saving/insert.php",
    method: "post",
    data:  new FormData($("#packagesForm")[0]),//new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    async: false,
    success: function(data){
    if(data == "done")
    { 
        M.toast({html: "Created successfully", classes: 'alert-success'});
        $('#packagesForm')[0].reset();
        setTimeout('window.location.href = "savings_categories"; ',1000);
        
        for ( instance in CKEDITOR.instances ){
        CKEDITOR.instances[instance].updateElement();
                                }
        CKEDITOR.instances[instance].setData('');
         
    }
    else{

       M.toast({html: data, classes: 'danger'});
       
    }

    }
  });
  });
});






  
 //Delete User from users' list
 $(document).ready(function(){
    $(".delPlan").click(function() {
     var pid = $(this).attr('id'); // get id of clicked row  
     if(confirm("Are you sure you want to delete this?")){
     $.post("../inc/saving/remove.php", {"member_id": pid, }, 
    function(data) {
        if(data == 1){
             M.toast({html: "Successfully Delected", classes: "alert-success"});
             setTimeout(' window.location.href = "savings_categories"; ',1000);
        }else{
            M.toast({html: data, classes: "alert-danger"});
            //alert(data);
        }
        
    });

}else{
        return false;
    }
    });
  });





 $(document).ready(function(){
    $(".planmodal").click(function() {
     
     var pid = $(this).attr('id'); // get id of clicked row
     $('#contents').html(''); // leave this div blank
     $('#planmodal').show();      // load ajax loader on button click
   
     $.ajax({
          url: '../inc/saving/getPlan.php',
          type: 'POST',
          data: 'uid='+pid,
          dataType: 'html'
     })
     .done(function(data){
          console.log(pid); 
          $('#contents').html(data); // load here
          $('#modal-loader').hide(); // hide loader  
           $('#user-modal').show();
     })
     .fail(function(){
          $('contents').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader').hide();
     });

    });

});


</script>