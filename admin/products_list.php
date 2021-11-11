<?php
include("header.php");
include("header_bottom.php");

require_once '../class/product.php';
$product_info = new Product();
$all_product = $product_info->getAllProducts();


$status = FALSE;
if ( authorize($_SESSION["access"]["PRODUCTS"]["PRODUCTS LIST"]["create"]) || 
authorize($_SESSION["access"]["PRODUCTS"]["PRODUCTS LIST"]["edit"]) || 
authorize($_SESSION["access"]["PRODUCTS"]["PRODUCTS LIST"]["view"]) || 
authorize($_SESSION["access"]["PRODUCTS"]["PRODUCTS LIST"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

include("left_nav.php");
?>
 <style type="text/css">
        #preview_file_div ul li{
          list-style-type: none;
          
        }

        #preview_file_div ul li{
          display: inline-flex;
          margin: 10px;
        }

        #preview_file_div ul li .ic-sing-file{
        padding-left: 10px;
          overflow: hidden; 
           position: relative;
        }
        #preview_file_div ul li .ic-sing-file img{
          width: 130px;
          height: 100px;

      
        }

        #preview_file_div ul li .ic-sing-file p.close{
          color: white;
          font-weight: bolder;
          position: absolute;
          top: 0px;
          right: 0px;
          display: flex;
          justify-content: center;
          align-items: center;
          border-radius: 50%;
          width: 25px;
          height: 25px;
          background: red;

      
        }
        
       .control-label{
        font-weight: bolder;
       font-size: 14px;
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">computer</i> Products List Page</h4>
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
      
<div class="col m12
">
 
  <?php getFlash();?>

  <table id="table" class="table table_view">
                        <thead>
                          <th>S.N</th>
                          <th>Name</th>
                          <th>Sample </th>
                          <th>Price</th>
                          <th>Discount</th>
                          <th>Stock</th>
                          <th>Action</th>
                         </thead>
                         <tbody>
                          <?php 
                          if ($all_product) {
                            foreach ($all_product as $key => $pro_info) {
                              ?>
                              <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $pro_info->title; ?></td>
                                <td>
                                    <?php 
                                     $sample_image=explode(",", $pro_info->images);
                                    if ($pro_info->images !="" && file_exists('../upload/product/'.$sample_image[0])) {
                                     
                                      ?>
                                      <div class="img img-responsive">
                                        <img src="<?php echo '../upload/product/'.$sample_image[0];?>" class="img img-thumbnail" style="width:50px; height: 50px;">
                                      </div>
                                      <?php
                                    } 
                                    ?>
                                  </td>
                                  <td><?php echo number_format($pro_info->price); ?></td>
                                  <td><?php echo $pro_info->discount; ?></td>
                                  <td>

                                    <?php if ($pro_info->quantity >= 10) {
                                    echo '<span class="col-green" style="font-weight:bolder; font-size:16px;">'.$pro_info->quantity.' Left</div>';
                                  }elseif ($pro_info->quantity < 10) {
                                     echo '<span class="col-orange" style="font-weight:bolder; font-size:16px;">'.$pro_info->quantity.' Left</div>';
                                  }elseif ($pro_info->quantity < 1) {
                                     echo '<span class="col-red" style="font-weight:bolder; font-size:16px;">Out of stock</div>';
                                  }
                                   ?>
                                  </td>
                                  <td>
                                     <?php 
                                  $vrl = "add_product?id=".$pro_info->id."&act=".substr(md5($_SESSION['session_id']."edit-product".$pro_info->id), 5,15);
                                   ?>
                                  <a href="<?php echo $vrl; ?>" class="btn-floating waves-effect waves-light gradient-45deg-amber-amber  btn-link"><i class="fa fa-pencil"></i></a>
                                  <?php 
                                  $url = "process/product?id=".$pro_info->id."&act=".substr(md5($_SESSION['session_id']."del-product".$pro_info->id), 5,15);
                                   ?>
                                  <a href="<?php echo $url; ?>" class="btn-floating waves-effect waves-light gradient-45deg-red-pink small btn-link" onclick = "return confirm('Are you sure you want to delete this product?');"><i class="fa fa-trash"></i>Delete</a></td>
                              </tr>
                              <?php
                            }
                          }
                           ?>
                          
                           
                         </tbody></table>


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


