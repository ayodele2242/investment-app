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
 $query = mysqli_query($mysqli,"SELECT * FROM saving_packages WHERE id='$id'");
 $row = mysqli_fetch_array($query);
 $u = $row['id'];


 ?>
   
 <div class="row">
 
<div class="col m12 s12 mb-3">
<div id="message" class="removeMessages"></div>
<form autocomplete="off" id="fine" class="">
                
              
                <div class="form-group mb-2">
                    <label>Saving Name</label>
                <input type="text" name="name"  required="required" class="form-control" placeholder="Saving Name e.g Esusu" value="<?php echo $row['category'];  ?>">
                </div>

                

                <div class="form-group mb-2">
                <label>Duration</label>
                <select name="duration" class="browser-default  mselect" required="required">
                    
                        
                       
                         <option value="">Select Saving Duration</option>
                         <option value="monthly" <?php if($row['duration'] == "monthly") echo "selected";  ?>>Monthly Saving</option>
                         <option value="weekly" <?php if($row['duration'] == "weekly") echo "selected";  ?>>Weekly Saving</option>
                         <option value="daily" <?php if($row['duration'] == "daily") echo "selected";  ?>>Daily Saving</option>
                        </select>
                </div>

                 <div class="form-group  mb-2" >
                  <label>Amount to Save for this Package</label>  
                <input type="number" name="amount"  required="required" class="form-control" placeholder="Package Saving Amount" value="<?php echo $row['amount'];  ?>">
                </div>

                <div class="form-group mb-2">
                <label>Farm Details</label>
                <textarea id="editor" name="info"><?php echo $row['details'];  ?></textarea>
                </div>
                <div class="form-group mb-5">
                <div align="center">
                 <input type="hidden" name="id" value="<?php echo $row['id'];  ?>">
                <button type="submit" class="btn btn-md btn-info updatePlan" id="updateMyPlan">Update</button>
               
                </div>
                </div>

                </form>
      
 </div>

 </div>	



<?php } ?>


<script type="text/javascript">

//Update store setting table
$(document).ready(function() {
    $("#updateMyPlan").click(function() {
        // using serialize function of jQuery to get all values of form
        var serializedData = new FormData($("#fine")[0]); //$("#fine").serialize();
        //var loader='<img src="../assets/img/loading.gif" width="40" height="40"/>';
        //alert(serializedData);         
       $.ajax({

            type : 'POST',
            url  : '../inc/saving/updatePlan.php',
            data : serializedData,
            contentType: false,
            cache: false,
            processData: false,
            async: false,
            success :  function(data)
            {
                if(data.trim() == 1)
                {

                	 M.toast({html: 'Update was Successful', classes: 'alert-success'});
                   setTimeout(' window.location.href = "savings_categories"; ',1000);
                	
                }else{

                	M.toast({html: data, classes: 'alert-danger'});
                    

                }
            }
        });
        return false;

 
    });
});


//Delete User from users' list
 $(document).ready(function(){
    $(".btn-delete").click(function() {
     var pid = $(this).attr('id'); // get id of clicked row  
     //confirm("Are you sure you want to delete "+pid+"? There is no undo."); 
     $.post("../admin/script/deleteMenu.php", {"id": pid, }, 
    function(data) {
        if(data == 1){
        	 $(".refresh").load(location.href + ".refresh");
             M.toast({html: "Menu Privilege Delected"});
             $("#tableData").load();
             
            //alert(data);
        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });

    });
  });



$(document).ready(function() {
    var template = $('#template'),
        id = 0;
    
    $("#add-line").click(function() {
        if(!template.is(':visible'))
        {
            template.show();
            return;
        }
        var row = template.clone().append('<td><button class="btn btn-small btn btn-floating '
      + ($(this).is(":last-child") ?
        'rowfy-addrow remove red">-' :
        'rowfy-deleterow remove waves-effect waves-light red">-') 
      +'</button></td>');
        //template.find(".mselect").val();
        row.attr('id', 'row_' + (++id));
        template.after(row);

        //$(this).removeClass('rowfy-addrow btn-success').addClass('rowfy-deleterow btn-danger').text('-');
    });
    
    $('.form-fields').on('click', '.remove', function(){
        var row = $(this).closest('tr');
        if(row.attr('id') == 'template')
        {
            row.hide();
        }
        else
        {
            row.remove();
        }
    });
});
 



$(document).ready(function() {
    $("#submitUser").click(function() {

    	var sender = $("#mPrivilege").serialize();
    	//console.log(sender);

    

     var error = '';

    $('.module').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select module to add to user/'s privileges </p>";
    return false;
   }
   count = count + 1;
  });

  $('.create').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select permission on create </p>";
    return false;
   }
   count = count + 1;
  });  

  $('.delete').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select permission on delete</p>";
    return false;
   }
   count = count + 1;
  });  
  
  $('.view').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select permission on view </p>";
    return false;
   }
   count = count + 1;
  });  

  $('.edit').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select permission on edit</p>";
    return false;
   }
   count = count + 1;
  });  

  if(error == '')
  {
       $.ajax({
            type : 'POST',
            url  : '../admin/script/updatePrivilege.php',
            data : sender,
            success :  function(data)
            {
                if(data=="i")
                {
                  $(".refresh").load(location.href + ".refresh");
                	 M.toast({html: '<div class="alert-success green darken-4"> <i class="material-icons">done</i> Insertion was Successful!!</div>'});

                    

                }
                else{

                	M.toast({
                		html: '<div class="alert-danger alert">'+data+' !</div>'

                		});


                }
            }
        });
        return false;

} else
  {

  	 M.toast({
  	 	html: error,
  		type: "warning",
  	 });

    
  }
 
    });
}); 
 </script>
 
 <script type="text/javascript">
      //<![CDATA[

        // This call can be placed at any point after the
        // <textarea>, or inside a <head><script> in a
        // window.onload event handler.

        // Replace the <textarea id="editor"> with an CKEditor
        // instance, using default configurations.
       
        CKEDITOR.replace( 'editor',
                {
                    filebrowserBrowseUrl :'../assets/ckeditor/filemanager/browser/default/browser.html?Connector=../assets/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserImageBrowseUrl : '../assets/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector='../'assets/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserFlashBrowseUrl :'../assets/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=../assets/ckeditor/filemanager/connectors/php/connector.php',
          filebrowserUploadUrl  :'../assets/ckeditor/filemanager/connectors/php/upload.php?Type=File',
          filebrowserImageUploadUrl : '../assets/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
          filebrowserFlashUploadUrl : '../assets/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
                });
             


      //]]>
      </script> 


