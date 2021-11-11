<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["MEMBERS"]["NEW MEMBER"]["create"]) || 
authorize($_SESSION["access"]["MEMBERS"]["NEW MEMBER"]["edit"]) || 
authorize($_SESSION["access"]["MEMBERS"]["NEW MEMBER"]["view"]) || 
authorize($_SESSION["access"]["MEMBERS"]["NEW MEMBER"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

include("left_nav.php");
?>

<style>
    .tbtns{
        display: flex;
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">people</i> New Customer</h4>
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

          <form id="addUser" enctype="multipart/form-data">
   
   <div id="horizontalTab">
     <ul>
    <li><a href="#tab-1" class="col-black"> Personal Information</a></li>
    <li>|</li>
    <li><a href="#tab-6" class="col-black">Profile Picture</a></li>
    <li>|</li>
    <li><a href="#tab-7" class="col-black">Guarantor's Details</a></li>

     
  </ul>

<div id="tab-1">
<table class="table table_view">
<tbody>

<tr class="formRow">
<td>Full Name:</td>
<td colspan="2"><input type="text" name="cust_name" id="cust_name" placeholder=""  class="textinput form-control"></td>


<td>Phone No:</td>
<td colspan="2"><input type="text" name="cust_phone" id="cust_phone" class="textinput form-control"></td>
</tr>

<tr>
<td>Username</td>
<td colspan="2"><input type="text" name="username" id="username" class="textinput form-control" value=""></td>

<td>Password</td>
<td colspan="2"><input type="text" name="password" id="password" class="textinput form-control" value=""></td>

</tr>

<tr>
<td>Address:</td>
<td>
<textarea name="cust_address" id="cust_address" class="textinput form-control"></textarea>
</td>
<td>Business Address:</td>
<td>
<textarea name="biz_address" id="biz_address" class="textinput form-control"></textarea>
</td>
<td>Gender:</td>
<td>
<select name="custsex_id" id="custsex_id" class=" form-control mselect browser-default">
 <option value=""></option> 
 <option value="male">Male</option>
 <option value="female">Female</option>
</select>
</td>

</tr>  
<tr>
<td>DoB:</td>
<td><input type="text" id="datepicker" name="cust_dob" placeholder="" class="textinput form-control datepicker"></td>
<td>Occupation:</td>
<td><input type="text" name="cust_occup" id="cust_occup" class="textinput form-control"></td>

<td >Branch </td>
<td class="labeledCtrl">
<select name="branch" class="city browser-default mselect" id="branch">
<option value="" selected="selected"  ></option>
<?php
$aCm     = "select * from branch";
$CCm     = @mysqli_query($mysqli,$aCm);
while($fetm = @mysqli_fetch_assoc($CCm)){
?>
<option value="<?php echo $fetm['branch'] ?>"><?php echo $fetm['branch'] ?></option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td>Marital Status:</td>
<td>
  <select name="custmarried_id" class="textinput form-control mselect browser-default">
   <option value=""></option>
   <option value="Married">Married</option>
   <option value="Single">Single</option>
   <option value="Divorced">Divorced</option>
   <option value="Widow">Widow</option>
  </select>
</td>
<td>Next of Kin Name</td>
<td><input type="text"  name="kin_name" class="textinput form-control"></td>
<td>Next of Kin Phone</td>
<td><input type="text"  name="kin_phone" class="textinput form-control"></td>
</tr>  

<tr>
<td>Next of Kin Relationship</td>
<td>
<select name="cust_nokrelationship" class="form-control mselect browser-default" required>
  <option value=""></option>
  <option value="Father">Father</option>
  <option value="Mother">Mother</option>
  <option value="Spouse">Spouse</option>
  <option value="Brother">Brother</option>
  <option value="Sister">Sister</option>
  <option value="Son">Son</option>
  <option value="Daughter">Daughter</option>
  <option value="Cousin">Cousin</option>
  <option value="Aunt">Aunt</option>
  <option value="Uncle">Uncle</option>
  <option value="Nephew">Nephew</option>
  <option value="Niece">Niece</option>
</select>   
</td>
<td>
Next of Kin Address
</td>
<td>
  <input type="text"  name="kin_address" class="textinput form-control">
</td>
<td>E-Mail:</td>
<td><input type="text" name="cust_email" id="cust_email" placeholder="abc@xyz.com" class="textinput form-control"></td>

</tr>  
<tr>
<td>Bank Account Name:</td>
<td>
<input type="text" name="ac_name" id="ac_name" class="textinput form-control">
</td>
<td>Bank Account No.</td>
<td>
<input type="text" name="account_number" id="account_number" class="textinput form-control">
</td>
<td>Bank Name:</td>
<td>
 <select id="get_bank_code" class="form-control mselect select browser-default" name="bankname"  >
              <option value=""></option>
               <?php

                            $slq = mysqli_query($mysqli,"select * from banks");
                            while ($brow = mysqli_fetch_array($slq)) {
                              
                              ?>
                              <option value="<?php echo $brow['code'];  ?>" ><?php echo $brow['name'];  ?></option>
                              <?php
                              # code...
                            }
                            ?>
          
              </select>
</td>

</tr> 

</tbody>
</table>

</div>





<div id="tab-6">
<table>
    <tbody>

      <tr class="formRow">
        
        <td>
          <div align="center">


        <img id="thumbnil" style="width:250px; height: 250px; margin-bottom:10px;"  src=""/>
        <div class="" style="width: 100%;">
        <input type="file" name="photoimg" accept="image/*"  onchange="showMyImage(this)" />
       
          </div>
         
        </div>
        </td>
        
      </tr>
      
      
    </tbody>
  </table>
</div>

<div id="tab-7" class="form-fields">
<table role="table" class="table table_view rowfy" id="user_table"> 
                                         <tbody role="rowgroup">
                                        <tr id="template" role="row"> 
                                         
                                          <td role="cell">
                                           <input type="text" name="gua_name[]" placeholder="Guarantor name" class="textinput form-control">
                                        </td>
                                      <td role="cell">
                                       <input type="number" name="gua_phone[]" placeholder="Phone number" class="textinput form-control">
                                      </td>
                                      <td role="cell">
                                      <input type="text" name="gua_addr[]" placeholder="Guarantor address" class="textinput form-control">
                                      </td>
                                      <td role="cell">
                                        <input type="text" name="gua_relationship[]" placeholder="Guarantor relationship" class="textinput form-control">
                                      </td>
                                      <td role="cell">
                                       <input type="text" name="gua_occupation[]" placeholder="Guarantor Occupation" class="textinput form-control">

                                      </td>
                                     
                                     </tr>
                                   </tbody>
                                        </table>  
                    
                                        <div class="row" style="margin-top: 15px; margin-bottom: 15px;">

                                         <div class="col m4 s4 mb-3 mb">
                                           <button id="add-line" class="btn btn-floating addme waves-effect waves-light green" type="button" ><i class="material-icons left">add</i></button>

                                         </div>
                                   
                                          
                                        </div>  

</div>  

</div>
<div class="col-lg-12">
  <div class="col-lg-12 mb-3" id="error"></div>
<div align="center">
<button class="waves-effect waves dark btn bg-light-blue newMem btn-submit" id="submitMember" type="submit">Submit</button> 
</div>
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

  

 <div id="MEMBERS-modal" class="modal">
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


//Update store setting table
$(document).ready(function() {

    $("#submitMember").click(function(e) {
       e.preventDefault();
    
if($("#cust_name").val() == ""){
      $("#error").html('<div class="alert alert-danger red darken-3 text-white white-text">Customer name is required</div>');
}

else if($("#cust_address").val() == ""){
      $("#error").html('<div class="alert alert-danger red darken-3 text-white white-text">Customer address is required</div>');
}
else if($("#cust_phone").val() == ""){
      $("#error").html('<div class="alert alert-danger red darken-3 text-white white-text">Customer phone number is required</div>');
}
else if($("#cust_dob").val() == ""){
      $("#error").html('<div class="alert alert-danger red darken-3 text-white white-text">Customer date of birth is required</div>');
}
else if($("#custsex_id").val() == ""){
      $("#error").html('<div class="alert alert-danger red darken-3 text-white white-text">Customer gender is required</div>');
}else if($("#custmarried_id").val() == ""){
      $("#error").html('<div class="alert alert-danger red darken-3 text-white white-text">Customer marital status is required</div>');
}else if($("#branch").val() == ""){
      $("#error").html('<div class="alert alert-danger red darken-3 text-white white-text">Branch is required</div>');
}else{
    
    var form = $('#addUser').get(0); 
    var fd = new FormData(form);
        
       $.ajax({
            url  : '../inc/members/newMember.php',
            type : 'POST',
            data : fd,
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
      }

 
    });
});








function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById("thumbnil");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }


$(document).ready(function(){

  
  

  
})

</script>