<script type="text/javascript" src="../assets/js/jquery-1.11.1.min.js"></script>
<script src="../assets/ckeditor/ckeditor.js"></script>
<script src="../assets/ckeditor/config.js"></script>
<?php
   
 require_once '../config.php';
$setSql = "SELECT * FROM store_setting";
    $setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
    $set = mysqli_fetch_array($setRes);
	
 
 if (isset($_REQUEST['uid'])) {
   
 $id = intval($_REQUEST['uid']);
 $query = mysqli_query($mysqli,"SELECT * FROM loans_packages WHERE id='$id'");
 $row = mysqli_fetch_array($query);
 $u = $row['id'];




 ?>
   
 <div class="row">
 
<div class="col m12 s12 mb-3">
<div id="message" class="removeMessages"></div>
<form autocomplete="off" id="fine" class="">
                
                <div class="form-group mb-2">
                    <label>Loan Type</label>
                <input type="text" name="name" value="<?php echo $row['name'];  ?>"  required="required" class="form-control" placeholder="">
                </div>

                 <div class="form-group mb-2">
                    <label>Loan Amount</label>
                <input type="text" name="amount" value="<?php echo $row['amount'];  ?>"  required="required" class="form-control thousand digit" placeholder="">
                </div>

                <div class="form-group stas mb-2" >
                  <label>Interest Rate(%)</label>  
                <input type="text" name="interest_rate" value="<?php echo $row['interest'];  ?>"  required="required" class="form-control" placeholder="">
                </div>
              

                
                <div class="form-group mb-2">
                <label>Interval</label>
                <select name="duration" class="browser-default  mselect" required="required">
                    
                        
                        <option value="">Select Duration</option>
                        <option value="1" <?php if($row['duration'] == "1") echo "selected";  ?>>1 Month</option>
                        <option value="2" <?php if($row['duration'] == "2") echo "selected";  ?>>2 Months</option>
                        <option value="3" <?php if($row['duration'] == "3") echo "selected";  ?>>3 Months</option>
                        <option value="4" <?php if($row['duration'] == "4") echo "selected";  ?>>4 Months</option>
                        <option value="5" <?php if($row['duration'] == "5") echo "selected";  ?>>5 Months</option>
                        <option value="6" <?php if($row['duration'] == "6") echo "selected";  ?>>6 Months</option>
                        <option value="7" <?php if($row['duration'] == "7") echo "selected";  ?>>7 Months</option>
                        <option value="8" <?php if($row['duration'] == "8") echo "selected";  ?>>8 Months</option>
                        <option value="9" <?php if($row['duration'] == "9") echo "selected";  ?>>9 Months</option>
                        <option value="10" <?php if($row['duration'] == "10") echo "selected";  ?>>10 Months</option>
                        <option value="11" <?php if($row['duration'] == "11") echo "selected";  ?>>11 Months</option>
                        <option value="12" <?php if($row['duration'] == "12") echo "selected";  ?>>12 Months</option>
                        </select>
                </div>

                <div class="form-group  mb-2" >
                  <label>Penalty Percentage (%) </label>  
                <input type="text" name="late_interest" value="<?php echo $row['late_interest'];  ?>"  required="required" class="form-control" placeholder="">
                </div>

                <div class="form-group mb-2">
                <label>Details</label>
                <textarea id="editor" name="info"><?php echo $row['details'];  ?></textarea>
                </div>
                <div class="form-group mb-5">
                <div align="center">
                 <input type="hidden" name="id" value="<?php echo $row['id'];  ?>">
                <button type="submit" class="btn btn-md btn-info" id="updateMe">Update</button>
               
                </div>
                </div>

                </form>
      
 </div>

 </div>	



<?php } ?>


<script type="text/javascript">

//Update store setting table
$(document).ready(function() {
    $("#updateMe").click(function() {
       //preventDefault();   
       $.ajax({

            type : 'POST',
            url  : '../inc/loans/updatePlan.php',
            data : $("#fine").serialize(),
            success :  function(data)
            {
                if(data.trim() == 1)
                {

                	 M.toast({html: 'Update was Successful', classes: 'alert-success'});
                   setTimeout(' window.location.href = "plans"; ',1000);
                	
                }else{

                	M.toast({html: data, classes: 'alert-danger'});
                    

                }
            }
        });
        return false;

 
    });
});




$(document).ready(function () {
  //called when key is pressed in textbox
   $(".digit").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $(".derror").html("Only digits allow").show().fadeOut("slow");
               return false;
    }
   });


//Thousand separator
$(".thousand").on("keyup", function(event ) {                   
    // When user select text in the document, also abort.
    var selection = window.getSelection().toString(); 
    if (selection !== '') {
        return; 
    }       
    // When the arrow keys are pressed, abort.
    if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
        return; 
    }       
    var $this = $(this);            
    // Get the value.
    var input = $this.val();            
    input = input.replace(/[\D\s\._\-]+/g, ""); 
    input = input?parseInt(input, 10):0; 
    $this.val(function () {
        return (input === 0)?"":input.toLocaleString("en-US"); 
    }); 
}); 

});



 </script>
 

