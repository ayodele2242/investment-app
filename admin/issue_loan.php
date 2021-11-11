<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["LOAN PRODUCTS"]["ISSUE LOAN"]["create"]) || 
authorize($_SESSION["access"]["LOAN PRODUCTS"]["ISSUE LOAN"]["edit"]) || 
authorize($_SESSION["access"]["LOAN PRODUCTS"]["ISSUE LOAN"]["view"]) || 
authorize($_SESSION["access"]["LOAN PRODUCTS"]["ISSUE LOAN"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

include("left_nav.php");
$ltype = loanTypes();
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">view_list</i> ISSUE LOAN</h4>
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
      
<div class="col m12">
  <div id="message" class="removeMessages"></div>
  <div id="no_records"></div>
<form autocomplete="off" id="packagesForm" class="row">

                <div class="form-group mb-2 col l4 s12">
                    <label>Loan Type</label>
               <select name="loan_id" id="loantype"  class="browser-default select mselect ">
                <option value=""> </option>
             <?php
              foreach($ltype as $income){ 
             ?>
             <option value="<?php echo $income['id']; ?>"><?php echo ucwords($income['name']); ?></option>
            <?php
           }
             ?>
             </select>
                </div>

                 <div class="form-group mb-2 col l4 s12">
                    <label>Loan Amount</label>
                <input type="text" name="amount"  id="amount" required="required" class="form-control thousand digit" placeholder="">
                <input type="hidden" name="duration"  id="duration">
                </div>

                <div class="form-group stas mb-2 col l4 s12" >
                  <label>Interest Rate(%)</label>  
                <input type="text" name="interest_rate" id="interest"  required="required" class="form-control" placeholder="">
                </div>

             

                <div class="form-group  mb-2" >
                  <label>Borrower's E-mail Address</label>  
                <input type="email" name="email" id="iemail"  required="required" class="form-control" placeholder="">
                </div>

                 <div class="form-group  mb-2 col m6 s12" >
                  <label>Loan Status</label>  
               <select name="status" class="browser-default mselect">
                 <option value="active">Approve</option>
                 <option value="pending">Pending</option>
               </select>
                </div>


                <div class="form-group mb-2 col m6 s12">
                <label>Payment Frequency</label>
                <select name="frequency" id="frequency" class="browser-default mselect">
                      <option value=""></option>
                      <option value="Monthly">Monthly</option>
                      <option value="2 Weeks">2 Weeks</option>
                      <option value="Weekly">Weekly</option>
                    </select>
                </div>

               
                <div class="form-group mb-5">
                <div align="center">
                  <?php if (authorize($_SESSION["access"]["LOAN PRODUCTS"]["ISSUE LOAN"]["create"])) { ?>
                <button class="btn btn-md btn-info insertPackages" id="insertPackages"><i class="fa fa-plus"></i> Preview</button>

                 <button class="btn btn-md btn-success finish" id="finish"><i class="fa fa-plus"></i> Grant Loan</button>
                <?php } ?>
                </div>
                </div>

                </form>
      </div>

      <div id="details"></div>




 


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
  $("#finish").hide();
 // Insert class
 $('.insertPackages').click(function(event) {
 event.preventDefault();
 
 var loan = $("#loantype").val();
 var amt = $("#amount").val();
 var interest = $("#interest").val();
 var frequency = $("#frequency").val();
 var email = $("#iemail").val();
 if(loan == "" || amt=="" || interest =="" || frequency == "" || email == ""){
   M.toast({html: "Check for empty value(s)", classes: "alert-danger"});
 }else{
        
  //var data = $("#register-form").serialize();
  $.ajax({
    url: "../inc/loans/insertBorrowLoan.php",
    method: "post",
    data:  $("#packagesForm").serialize(),//new FormData(this),
    
    success: function(data){
  
     $("#details").html(data);
      $("#finish").show();
    }
  });//ajax ends

}
  });
});



$(document).ready(function(){
 
 // Insert class
 $('#finish').click(function(event) {
 event.preventDefault();
 
 var loan = $("#loantype").val();
 var amt = $("#amount").val();
 var interest = $("#interest").val();
 var frequency = $("#frequency").val();
 var email = $("#iemail").val();
 if(loan == "" || amt=="" || interest =="" || frequency == "" || email == ""){
   M.toast({html: "Check for empty value(s)", classes: "alert-danger"});
 }else{
        
  //var data = $("#register-form").serialize();
  $.ajax({
    url: "../inc/loans/processLoan.php",
    method: "post",
    data:  $("#packagesForm").serialize(),//new FormData(this),
    
    success: function(data){

      if(data == "done"){
         $("#finish").hide();
         $("#details").html('<div class="alert alert-success">Loan has been disbursed</div>');
         $("#packagesForm")[0].reset()


      }else{
        $("#details").html('<div class="alert alert-danger">'+data+'</div>');
      }
  
     
      
    }
  });//ajax ends

}
  });
});




$(document).ready(function(){  
  // code to get all records from table via select box
  $("#loantype").change(function() {    
    var id = $(this).find(":selected").val();
    var dataString = 'id='+ id;    
    $.ajax({
      url: '../inc/loans/getloanAjax.php',
      dataType: "json",
      data: dataString,  
      cache: false,
      success: function(employeeData) {
         if(employeeData) {    
          $("#amount").val(employeeData.amount);
          $("#interest").val(employeeData.interest);
          $("#duration").val(employeeData.duration);
            
        } else {
          $("#no_records").show();
        }     
      } 
    });
  }) 
});


</script>