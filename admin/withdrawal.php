<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["SAVINGS"]["WITHDRAWAL"]["create"]) || 
authorize($_SESSION["access"]["SAVINGS"]["WITHDRAWAL"]["edit"]) || 
authorize($_SESSION["access"]["SAVINGS"]["WITHDRAWAL"]["view"]) || 
authorize($_SESSION["access"]["SAVINGS"]["WITHDRAWAL"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

include("left_nav.php");
$ltype = savingTypes();
?>
<style>
   tr > td > span{
        font-weight: bolder;
        text-align:center;
       
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
                <h4 class="mt-0 mb-0 text-white" >WITHDRAWAL</h4>
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
        <div class="col s12 refresh scroll">

         <form autocomplete="off" id="packagesForm" class="row">

           <div class="form-group mb-2 col l4 s12">
                    <label>Saving Package Type</label>
               <select name="saving_id" id="saving_id"  class="browser-default select mselect ">
                <option value=""> </option>
             <?php
              foreach($ltype as $income){ 
             ?>
             <option value="<?php echo $income['id']; ?>"><?php echo ucwords($income['category']); ?></option>
            <?php
           }
             ?>
             </select>
                </div>

               
                 <div class="form-group mb-2 col l4 s12">
                    <label>Amount to Withdral</label>
                <input type="text" name="amount"  id="amount" required="required" class="form-control thousand digit" placeholder="">
               
                </div>

                 <div class="form-group mb-2 col l4 s12">
                    <label>Date</label>
                <input type="text" name="date"  id="date" required="required" class="form-control datepicker" placeholder="">
               
                </div>

                

             

                <div class="form-group  mb-2" >
                  <label>Withdrawee's E-mail Address</label>  
                <input type="email" name="email" id="iemail"  required="required" class="form-control" placeholder="">
                </div>

                
               

               
                <div class="form-group mb-5">
                <div align="center">
                  <?php if (authorize($_SESSION["access"]["SAVINGS"]["WITHDRAWAL"]["create"])) { ?>
               
                 <button class="btn btn-md btn-success finish" id="finish"><i class="fa fa-plus"></i> Withdraw</button>
                <?php } ?>
                </div>
                </div>

                </form>
                 <div id="details"></div>
                   
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

  

 <div id="SAVINGS-modal" class="modal">
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

<script>
 $(document).ready(function(){
 
 // Insert class
 $('#finish').click(function(event) {
 event.preventDefault();
 
 var saving_id = $("#saving_id").val();
 var amt = $("#amount").val();

 var date = $("#date").val();
 var email = $("#iemail").val();
 if(saving_id == "" || amt=="" || date =="" || email == ""){
   M.toast({html: "Check for empty value(s)", classes: "alert-danger"});
 }else{
        
  //var data = $("#register-form").serialize();
  $.ajax({
    url: "../inc/saving/processWithdrawal.php",
    method: "post",
    data:  $("#packagesForm").serialize(),//new FormData(this),
    
    success: function(data){

      if(data == "done"){
         $("#finish").hide();
         $("#details").html('<div class="alert alert-success">Transaction was successful</div>');
         $("#packagesForm")[0].reset()


      }else{
        $("#details").html('<div class="alert alert-danger">'+data+'</div>');
      }
  
     
      
    }
  });//ajax ends

}
  });
});
</script>

