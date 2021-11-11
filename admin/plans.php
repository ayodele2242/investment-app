<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["LOAN PRODUCTS"]["LOAN PRODUCTS"]["create"]) || 
authorize($_SESSION["access"]["LOAN PRODUCTS"]["LOAN PRODUCTS"]["edit"]) || 
authorize($_SESSION["access"]["LOAN PRODUCTS"]["LOAN PRODUCTS"]["view"]) || 
authorize($_SESSION["access"]["LOAN PRODUCTS"]["LOAN PRODUCTS"]["delete"]) ) {
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">view_list</i> LOAN PRODUCTS</h4>
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
                    <label>Loan Type</label>
                <input type="text" name="name"  required="required" class="form-control" placeholder="">
                </div>

                 <div class="form-group mb-2">
                    <label>Loan Amount</label>
                <input type="text" name="amount"  required="required" class="form-control thousand" placeholder="">
                </div>

                <div class="form-group stas mb-2" >
                  <label>Interest Rate(%)</label>  
                <input type="text" name="interest_rate"  required="required" class="form-control" placeholder="">
                </div>

                <div class="form-group mb-2">
                <label>Interval</label>
                <select name="duration" class="browser-default  mselect" required="required">
                        <option value="">Select Duration</option>
                        <option value="1">1 Month</option>
                        <option value="2">2 Months</option>
                        <option value="3">3 Months</option>
                        <option value="4">4 Months</option>
                        <option value="5">5 Months</option>
                        <option value="6">6 Months</option>
                        <option value="7">7 Months</option>
                        <option value="8">8 Months</option>
                        <option value="9">9 Months</option>
                        <option value="10">10 Months</option>
                        <option value="11">11 Months</option>
                        <option value="12">12 Months</option>
                        </select>
                </div>


                 <div class="form-group  mb-2" >
                  <label>Penalty Percentage (%) </label>  
                <input type="number" name="late_interest"  required="required" class="form-control" placeholder="">
                </div>

                 <div class="form-group mb-2">
                    <label>Description</label>
              <textarea id="editor" class="form-control" name="info"></textarea>
                </div>

               
                <div class="form-group mb-5">
                <div align="center">
                  <?php if (authorize($_SESSION["access"]["LOAN PRODUCTS"]["LOAN PRODUCTS"]["create"])) { ?>
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
                       
                        <th>Loan Type</th>
                        <th>Loan Amount</th>
                        <th>Interest Rate(%)</th>
                        <th>Interval</th>
                        <th>Penalty Percentage (%)</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="refresh">
       <?php  
       $users = getLoansPackage();
       foreach($users as $rows){

       
        
        if($rows['status'] == '1'){
        $esta = "checked";
         }else{
        $esta = "";
        }
        ?> 
        <tr class="animated fadeIn">
        <td><?php echo ucwords($rows['name']); ?></td>
        <td><?php echo $rows['amount']; ?></td>
        <td><?php echo $rows['interest'].'%'; ?></td>
        <td><?php echo $rows['duration']; ?></td>
        <td><?php echo $rows['late_interest'].'%'; ?></td>
      
              
        <td class="tbtn"> 
          <!--<button id="<?php //echo  $rows['u_rolecode']; ?>" class="btn btn-floating uprivileges btn-small waves-effect waves-light orange z-depth-3"  ><i class="material-icons left">supervisor_account</i></button>-->
           <?php if (authorize($_SESSION["access"]["LOAN PRODUCTS"]["LOAN PRODUCTS"]["edit"])) { ?>
          <a href="#planmodal" type="button" data-id="<?php echo $rows['id']; ?>" id="<?php echo $rows['id']; ?>" class="btn btn-floating waves-effect waves-light green z-depth-3 btn-small modal-trigger planmodal" type="button" title="Edit"><i class="material-icons left">create</i></a>
        <?php } ?>
         <?php if (authorize($_SESSION["access"]["LOAN PRODUCTS"]["LOAN PRODUCTS"]["delete"])) { ?>
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
    url: "../inc/loans/insert.php",
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
        setTimeout('window.location.href = "plans"; ',1000);
        
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
     $.post("../inc/loans/remove.php", {"member_id": pid, }, 
    function(data) {
        if(data == 1){
             M.toast({html: "Successfully Delected", classes: "alert-success"});
             setTimeout(' window.location.href = "plans"; ',1000);
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
          url: '../inc/loans/getPlan.php',
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