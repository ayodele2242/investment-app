<?php
include("header.php");
include("header_bottom.php");
$category = new Category();

$parent_cats = $category->getAllParentCats();
$all_category = $category->getAllCategory();

$status = FALSE;
if ( authorize($_SESSION["access"]["PRODUCT CATEGORIES"]["PRODUCT CATEGORIES"]["create"]) || 
authorize($_SESSION["access"]["PRODUCT CATEGORIES"]["PRODUCT CATEGORIES"]["edit"]) || 
authorize($_SESSION["access"]["PRODUCT CATEGORIES"]["PRODUCT CATEGORIES"]["view"]) || 
authorize($_SESSION["access"]["PRODUCT CATEGORIES"]["PRODUCT CATEGORIES"]["delete"]) ) {
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">view_list</i> PRODUCT CATEGORIES</h4>
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
  <?php getFlash();?>
 <form action="process/category" id="form-reset" method="post" enctype="multipart/form-data" class="form form-horizontal">
  
      <div class="modal-body">
        <div class="form-group mb-3">
          <label class="col-sm-3 control-label">Title:</label>
          <div class="col-sm-8">
            <input type="text" required class="form-control" placeholder="Enter Category Title" name="title" id="title">
          </div>
        </div>
         <div class="form-group mb-3">
          <label class="col-sm-3 control-label">Summary:</label>
          <div class="col-sm-8">
           <textarea class="form-control" id="editor" name="summary" rows="6" style="resize: none;" ></textarea>
          </div>
        </div>
        <div class="form-group mb-3">
          <label class="control-label col-sm-3">Status:</label>
          <div class="col-sm-8">
            <select name="status" id="status" required class="browser-default  mselect">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
        </div>
        <div class="form-group mb-3">
          <label class="control-label col-sm-3">Is Parent:</label>
          <div class="col-sm-8">
            <label>
            <input type="checkbox" name="is_parent" id="is_parent" checked value="1">
            <span>Yes <i style="font-size: 10px">(Uncheck if the category is a sub-category to select it parent)</i></span>
            </label>
          </div>
        </div>
        <div class="form-group hidden mb-3" id="parent_cat_div">
          <label class="control-label col-sm-3">Parent Category:</label>
        <div class="col-sm-8">
          <select class="form-control mselect browser-default" name="parent_id" id="parent_id">
            <option value="" selected disabled> --Select Category--</option>
            <?php 
            echo cat_list();
            ?>          
          </select>
        </div>
        </div>
        <div class="form-group mb-3">
          <label class="control-label col-sm-3">Show in Menu:</label>
          <div class="col-sm-8">
             <label>
            <input type="checkbox"  id="show_in_menu" name="show_in_menu" checked value="1">
            <span>Yes</span>
          </label>
          </div>

        </div>
        <div class="form-group mb-3">
          <label class="control-label col-sm-3">Show in Home Tab:</label>
          <div class="col-sm-8">
            <label>
            <input type="checkbox" id="show_in_home_tab" name="show_in_home_tab" checked value="1">
            <span>Yes</span>
            </label>
          </div>
        </div>

        <div class="form-group mb-3">
          <label class="col-sm-3 control-label">Featured Image:</label>
          <div class="col-sm-4 mb-3">
            <input type="file" name="featured_image" alt="" accept="image/*" id="image_uploader" onchange="viewThumbnail(this)">
          </div>
          <div class="col-sm-4 ">
            <img src="" id="thumbnail_img" alt="" class="img img-thumbnail">
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <input type="hidden" name="category_id"  value="" id="category_id">
          <input type="hidden" name="default_img"  value="" id="default_img">
        <?php if (authorize($_SESSION["access"]["PRODUCT CATEGORIES"]["PRODUCT CATEGORIES"]["create"])) { ?>
          <button type="submit" class="btn btn-primary btn-sm">Save</button>
        <?php } ?>
      </div>
    </form>
      </div>
      <div class="col m7 s12">

       <table id="table" class="table table_view">
                    <thead class="heading">
                      <tr>
                        <th>S.N</th>
                          <th>Title</th>
                          <th>Thumbnail</th>
                          <th>Is Parent</th>
                          <th>Show in Menu</th>
                          <th>Show in </br> Home Tab</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="refresh">
       <?php 
                          if($all_category){
                            foreach($all_category as $key => $cat_info){
                                ?>
                                <tr>
                                  <td> <?php echo $key+1; ?> </td>
                                  <td><?php echo $cat_info->title; ?></td>
                                  
                                  <td>
                                    <?php 
                                    if ($cat_info->featured_image !="" &&file_exists('../upload/category/'.$cat_info->featured_image)) {
                                      ?>
                                     
                                        <img src="<?php echo '../upload/category/'.$cat_info->featured_image;?>" class="img img-thumbnail" style="width:50px; height: 50px" />
                                      
                                      <?php
                                    } 
                                    ?>
                                  </td>
                                  <td><?php echo ($cat_info->is_parent == 1) ? 'Yes': 'No'; ?></td>
                                  <td><?php echo ($cat_info->show_in_menu == 1) ? 'Yes':'No'; ?></td>
                                   <td><?php echo ($cat_info->show_in_home_tab == 1) ? 'Yes':'No'; ?></td>
                                 
                                  <td><?php echo ($cat_info->status == 1) ? 'Active':'Inactive'; ?></td>
                                  <td>
                                    <?php if (authorize($_SESSION["access"]["PRODUCT CATEGORIES"]["PRODUCT CATEGORIES"]["edit"])) { ?>
                                    <a href="javascript:;"  class='btn-floating waves-effect waves-light gradient-45deg-amber-amber small' onclick='editCategory(<?php echo json_encode($cat_info); ?>)'><i class="fa fa-pencil"></i></a>
                                  <?php } 
                                  if (authorize($_SESSION["access"]["PRODUCT CATEGORIES"]["PRODUCT CATEGORIES"]["edit"])) {
                                    $url = "process/category?id=".$cat_info->id."&act=".substr(md5($_SESSION['session_id'].'del-cat-'.$cat_info->id), 3, 15);

                                     ?>

                                     <a href="<?php echo $url; ?>" onclick= "return confirm('Are you sure you want to delete this category?');" class='btn-floating waves-effect waves-light gradient-45deg-red-pink small'>
                                       <i class="fa fa-trash"></i>
                                     </a>
                                   <?php } ?>
                                  </td>
                                </tr>
                           <?php
                            }
                           
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
       $('#add_category_btn').click(function(){
              $('#form-reset')[0].reset();
              $('#thumbnail_img').attr('src','');
          });

 function editCategory(cat_info){

      console.log(cat_info);
      $('.modal-title').html('Edit Category');
      $('#title').val(cat_info.title);
      $('#summary').val(cat_info.summary);
      $('#status').val(cat_info.status);
      $('#thumbnail_img').attr('src','<?php echo UPLOAD_URL."category/"; ?>'+cat_info.featured_image);
     
     if(cat_info.is_parent == 0){
      $('#is_parent').prop('checked', false);
      $('#parent_cat_div').removeClass('hidden');
      $('#parent_id').val(cat_info.parent_id);
     }
       
       if(cat_info.show_in_home_tab == 0){
       $('#show_in_home_tab').prop('checked', false);
       }

       if(cat_info.show_in_menu == 0){
        $('#show_in_menu').prop('checked', false);
       }
       $('#category_id').val(cat_info.id);
       $('#default_img').val(cat_info.featured_image);
        $('#cat_add_modal').modal('show');
    }

  

     $('#is_parent').click(function(){
      var checked = $('#is_parent').prop('checked');
      if(checked == true){
        $('#parent_cat_div').addClass('hidden');

      }else{
        $('#parent_cat_div').removeClass('hidden');
      }
     });

    </script>

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
        setTimeout('window.location.href = "PRODUCT CATEGORIES_categories"; ',1000);
        
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
             setTimeout(' window.location.href = "PRODUCT CATEGORIES_categories"; ',1000);
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