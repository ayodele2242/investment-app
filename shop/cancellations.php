
<?php
include("header.php");
include("header-body.php");
?>

        
<main id="content" role="main" class="checkout-page" style="background: #f0f0f0;">
               <div id="main-content">
                  <div class="main-content">
                     <div id="home-main-content" class="">
                       
                     
<div class="bg-secondary py-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
              <li class="breadcrumb-item"><a class="text-nowrap col-white" href="index"><i class="fa fa-home"></i> Home</a></li>
              <li class="breadcrumb-item text-nowrap"><a href="#" class="col-white" style="background: transparent;">Help center</a>
              </li>
              <li class="breadcrumb-item text-nowrap active col-white" aria-current="page">Cancellations
              </li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 col-white">Cancellations</h1>
        </div>
      </div>
    </div>
    
    
    
 <!-- Page Content-->
    <div class="container py-5 mt-md-2 mb-2">
      <div class="row">
        <div class="col-lg-3">
          <!-- Related articles sidebar-->
          <div class="cz-sidebar border-right" id="help-sidebar">
            <div class="cz-sidebar-header box-shadow-sm">
              <button class="close ml-auto" type="button" data-dismiss="sidebar" aria-label="Close"><span class="d-inline-block font-size-xs font-weight-normal align-middle">Close sidebar</span><span class="d-inline-block align-middle ml-2" aria-hidden="true">&times;</span></button>
            </div>
            <div class="cz-sidebar-body py-lg-1 pl-lg-0" data-simplebar data-simplebar-auto-hide="true">
              <!-- Links-->
             <?php
             include("help_links.php");
             
             ?>
              
            </div>
          </div>
        </div>

        <div class="col-lg-9">

          <h3 class="mb-2 mt-2 col-blue">Canceling an Order</h3>
          
          <p class="font-size-md">You can cancel any order before it ships from Orders. However, once an item has been shipped, it cannot be canceled. </p>

          <p class="font-size-md mt-3">
             <h3 class="mb-2 mt-2 col-blue">Canceling a Return</h3>

            If you missed the window to cancel the order, you can always set up a return or exchange ahead of time, and then send the item back once it arrives. Please note, return shipping costs may apply!
          </p>

         

    </div>
  </div>
</div>






</div>
</div>
</div>
</main>


<?php

include("footer.php");
?>