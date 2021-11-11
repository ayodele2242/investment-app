<?php
include("header.php");
include("header_bottom.php");

include("left_nav.php");
$query = mysqli_query($mysqli,"select * from faqs");
$row = mysqli_fetch_array($query);

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $query = mysqli_query($mysqli, "SELECT * FROM  faqplus WHERE cont_id = '$id'");
  $irow = mysqli_fetch_array($query);
  
}
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">note</i> FAQs Page</h4>
              </div>
             
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
      <div class="card-content gradient-shadow">
      <form enctype="multipart/form-data" <?php if(isset($irow['cont_id'])){ ?> id="updateFagPage" <?php }else{ ?> id="faqpage" <?php } ?>  class="row">
    
        <div class="col l12 form-group">Question</div>
       <div class="input-field col l12 form-group">
        <input type="text" name="title" class="form-control" value="<?php if(isset($irow['title'])){ echo $irow['title']; } ?>" placeholder="Title" >
        <input type="hidden" name="pid" value="<?php if(isset($irow['cont_id'])){ echo $irow['cont_id']; } ?>">
       </div>

 <div class="col l12 form-group">Answer</div>
<div class="input-field col s12">
    <div class="form-group form-float mb-2">
      <textarea name="jobdes"  id="editor" ><?php if(isset($irow['dtl'])){ echo $irow['dtl']; } ?></textarea>
  </div> 
</div>

<div class="input-field col s12 mt-3">
<div align="center">  
<?php if(isset($irow['cont_id'])){ 
echo '<button type="submit" class="btn btn-warning btn-md" id="btn-submit">Update</button>';
 }else{ ?>                     
  <button type="submit" class="btn btn-primary btn-md" id="btn-submit">Add</button>
<?php } ?>
</div>

</div>

<div class="col s12 l12 mt-5">

                              
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

  



<?php
include("footer.php");
?>

<script type="text/javascript">
  $(document).ready(function (e) {
    
$("#faqpage").on('submit',(function(e) {
        e.preventDefault();

        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        
        $.ajax({
            url: "../inc/page/faq.php",
            type: "POST",
            data:  new FormData($("#faqpage")[0]),//new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            async: false,
            success: function(data)
            {
       if(data=="added")
          {
            M.toast({html: "Saved successfully", classes: 'alert-success' });
          $('#faqpage')[0].reset();        
          for (instance in CKEDITOR.instances){
             CKEDITOR.instances[instance].setData(" ");
          }             
          
          }
          else{
                    M.toast({html: data, classes: 'alert-danger'});

          }
      

            },
            error: function() 
            {
            }           
       });
    }));


$("#updateFagPage").on('submit',(function(e) {
        e.preventDefault();

        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        
        $.ajax({
            url: "../inc/page/faqUpdate.php",
            type: "POST",
            data:  new FormData($("#updateFagPage")[0]),//new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            async: false,
            success: function(data)
            {
       if(data=="added")
          {
            M.toast({html: "Updated successfully", classes: 'alert-success' });
          $('#faqpage')[0].reset();   

          for (instance in CKEDITOR.instances){
             CKEDITOR.instances[instance].setData(" ");
          }    

           location.href = "faq-list";         
          
          }
          else{
                    M.toast({html: data, classes: 'alert-danger'});

          }
      

            },
            error: function() 
            {
            }           
       });
    }));
});
</script>