



<?php 
  if($current_page != 'index'){
 ?>
    <script src="<?php echo CMS_VENDORS;?>jquery/dist/jquery.min.js"></script>
    <!--<script src="<?php echo $set['installUrl']; ?>assets/main/js/vendors.min.js" type="text/javascript"></script>
    <script src="<?php echo $set['installUrl']; ?>assets/main/js/plugins.js" type="text/javascript"></script>
    <script src="<?php echo $set['installUrl']; ?>assets/main/js/customizer.js" type="text/javascript"></script>-->
   
    

  
    <!-- Bootstrap -->
    <script src="<?php echo CMS_VENDORS;?>bootstrap/dist/js/bootstrap.min.js"></script>

   
    <script src="<?php echo $set['installUrl']; ?>assets/dropify/dist/js/dropify.min.js"></script>

    <!-- FastClick -->
    <script src="<?php echo CMS_VENDORS;?>fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo CMS_VENDORS;?>nprogress/nprogress.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo CMS_JS;?>custom.min.js"></script>
    <script src="<?php echo CMS_JS;?>jquery.dataTables.min.js"></script>
     
    <script src="<?php echo $set['installUrl']; ?>assets/main/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="<?php echo $set['installUrl']; ?>assets/js/customs.js"></script>  
    <script type="text/javascript" src="<?php echo $set['installUrl']; ?>assets/js/slidderScript.js"></script>
    <script src="<?php echo $set['installUrl']; ?>assets/main/js/mstepper.min.js" type="text/javascript"></script>
    <script src="<?php echo $set['installUrl']; ?>assets/main/js/form-wizard.js" type="text/javascript"></script>

     

    <?php } ?> 
 <script type="text/javascript">
     $('.table').DataTable();
  setTimeout(function(){
    $('.alert').slideUp('slow');
    }, 5000);
   function viewThumbnail(input, thumbnail_id = 'thumbnail_img'){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
            $('#'+thumbnail_id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
   }
 </script>


 <?php //include('../assets/js/app.php'); ?>
    <script type="text/javascript">
        $(document).ready(function(){  
          $('.dropify').dropify();

          
        (function($){
            $(window).on("load",function(){
                $(".scrollable").mCustomScrollbar({
                 axis:"yx", // vertical and horizontal scrollbar
                 theme:"dark-3"
    });
            });
        })(jQuery);


     // $(element).perfectScrollbar('update');  
    });


    </script>
   
    
   

     <script>
       var stepper = document.querySelector('.stepper');
       var stepperInstace = new MStepper(stepper, {
          // options
          firstActive: 0 // this is the default
       })

    </script>
  </body>
</html>
 