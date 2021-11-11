
<?php
include("header.php");
include("header-body.php");
if(!isset($_SESSION['email'])){
  header("Location: index");
}
?>

        
<main id="content" role="main" class="checkout-page" style="background: #f0f0f0;">
               <div id="main-content">
                  <div class="main-content">
                     <div id="home-main-content" class="">
                       
                        <!-- BEGIN content_for_index -->
                       
                        <div id="shopify-section-1558341502241" class="shopify-section pl-5 pr-5">
                           <div class="section-separator section-separator-1558341502241 section-separator-margin-top section-separator-margin-bottom"> <h3>Returned Products</h3>
                           </div>
                        </div>

   <div class="section full mt-2 p-2 container" id="loadProducts">
        
     	
        <!-- * Categories -->
    </div>







</div>
</div>
</div>
</main>


<?php
//include("footer-newsletter-section.php");
//include("footer-section-two.php");
//include("footer-partners.php");
include("footer.php");
?>

<script type="text/javascript">
	$('#loadProducts').addClass("loadingProducts");

//When the page has loaded.
$( document ).ready(function(){
    //Perform Ajax request.
    $.ajax({
        url: 'loadReturnItems.php',
        type: 'get',
        success: function(data){
            //If the success function is execute,
            $('#loadProducts').html(data).removeClass("loadingProducts");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Ajax request failed: ' + xhr.responseText;
            $('#loadProducts').html(errorMsg).removeClass("loadingProducts");
          }
    });
});
</script>