
<?php
include("header.php");
include("header-body.php");
if(!isset($_SESSION['email'])){
  header("Location: index");
}
$addr = addresses($urow['id']);
?>

        
<main id="content" role="main" class="checkout-page" style="background: #f0f0f0;">
               <div id="main-content">
                  <div class="main-content">
                     <div id="home-main-content" class="">
                       
                        <!-- BEGIN content_for_index -->
                       
                        <div id="shopify-section-1558341502241" class="shopify-section pl-5 pr-5">
                           <div class="section-separator section-separator-1558341502241 section-separator-margin-top section-separator-margin-bottom"> <h3>Address Book</h3>
                           </div>
                        </div>

   <div class="section full mt-2 p-5">

       <div class="section-heading text-right">
                  <h4 class="title"><a href="#" class="link col-orange bolder" data-toggle="modal" data-target="#modalXL">Add New Address</a></h4>
                  
          </div>

      <?php
                $istate = array();
                  foreach ($addr as $myaddr) {
                     $istate[] = $myaddr['state'];
                  ?>
            <div class="row bg-white col-grey p-3  mb-3">
                  <div class="col-1 mb-3">
                    <?php  if($myaddr['default_address'] == 1){ ?>
                      <div class="radio  iradio-type-button2" style="background: #6a1b9a" data-toggle="tooltip" data-placement="top" title="<?php  echo $myaddr['address1']; ?>">
                      <?php }else{ ?>
                      <div class="radio  iradio-type-button2" style="background: #ffbb33" data-toggle="tooltip" data-placement="top" title="<?php  echo $myaddr['address1']; ?>">

                      <?php
                    }
                    ?>
                    <label class="checkLabel" >
                          <input type="radio" name="addr_id" <?php  if($myaddr['default_address'] == 1){ echo 'checked="checked"'; } ?> class="colors" style="background: #9933CC"   value="<?php echo  $myaddr['user_id']; ?>" />
                          <span class="text">
                          
                          </span>
                        </label>
                      </div> 
                      </div>  

                      <div class="col-11 mb-3">     

                    <?php  echo ucwords($myaddr['address1']); ?> <?php  if($myaddr['default_address'] == 1){ ?><span class="align-middle badge bg-purple ml-1 bolder"><ion-icon name="checkmark"></ion-icon> Primary</span><?php } ?><br/>
                    <?php  echo $myaddr['mobile']; ?><a class="nav-link-style ml-3 edit text-warning bolder" type="button" data-toggle="modal" data-target="#umodal"  data-toggle="tooltip" title="Edit" id="<?php  echo $myaddr['user_id']; ?>">
                    <ion-icon big name="pencil"></ion-icon> Update
                    </a>  <a class="nav-link-style ml-3 del text-danger bolder" type="button" title="Delete" id="<?php  echo $myaddr['user_id']; ?>">
                    <ion-icon big name="trash"></ion-icon> Delete
                    </a>
                  </div> 

                  
                  </div>
                  <?php } ?>
      

    </div>
    </div>







</div>
</div>
</div>
</main>



 
<!-- Extra large modal-->
<div class="modal fade modalbox" id="modalXL" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add A New Address</h4>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <?php  include "change_shipping_address.php";  ?>
                </div>
               
              </div>
            </div>
          </div>
<!-- Extra large modal-->
          <div class="modal fade modalbox" id="umodal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Update Address</h4>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                <div id="warning"></div>
                  <div id="contents"></div>
                </div>
               
              </div>
            </div>
          </div>

<?php
include("footer.php");
?>

<script type="text/javascript">
  $(document).ready(function() {

   $(".del").click(function() {
      //e.preventDefault();
        
        var id = $(this).attr("id");
        
       
        $.ajax({
            type : 'POST',
            url  : '../inc/user/delete_address.php',
            data : {'id':id},
            success :  function(res)
            {
                if(res.trim() == 1)
                {
                   $("#msgs").html('<div class="alert alert-success"><i class="fa fa-check"></i> &nbsp;Address Deleted Successfully</div>').show();
        setTimeout(function() {
            $("#msgs").fadeOut(1500);
        }, 4000);
         document.location.href = document.location.href;
      }else{
        $("#msgs").html('<div class="alert alert-danger">'+res+'</div>').show();
          setTimeout(function() {
              $("#msgs").fadeOut(1500);
          }, 10000);
      }
            }
        });
        
      
  return false;
    });
});

$(document).ready(function() {
        $('.edit').click(function() {
          
            //e.preventDefault();
      var id = $(this).attr("id");
      
     $('#contents').html(''); // leave this div blank
     //$('#modal-loader').show();      // load ajax loader on button click
   
     $.ajax({
          url: 'get_address.php',
          type: 'POST',
          data: 'id='+ id,
          dataType: 'html'
     })
     .done(function(data){
          
          $('#contents').html(data); // load here
        
          
     })
     .fail(function(){
          $('#contents').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader').hide();
     });

            
        });
    });


$('#addAddrFormss').click(function(e){ 
e.preventDefault(); 

      var formElem = $("#newAddrForm");
      var formdata = new FormData(formElem[0]);


           $.ajax({  
                url:"../inc/addShippingAddress.php",  
                method:"POST",  
                data: formdata, 
                processData: false,
                contentType: false, 
                success:function(data)  
                {  

                  if(data.trim() == 1){
                   $(".mymsg").html('<div class="alert alert-success">Successfully added.</div>').show();
          setTimeout(function() {
              $(".mymsg").fadeOut(1500);
          }, 10000);
 
                 // $('#productForm')[0].reset();  
                 //location.href = 'checkout';
                  document.location.href = document.location.href;
                 
                  }else{
                    $(".mymsg").html('<div class="alert alert-danger text-left">'+data+'</div>').show();
          setTimeout(function() {
              $(".mymsg").fadeOut(1500);
          }, 10000);
                  }
                     //alert(data);  
                     
                }  
           }); 


      }); 



</script>