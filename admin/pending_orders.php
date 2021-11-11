<?php
include("header.php");
include("header_bottom.php");
require '../class/login_register.php';
require '../class/customer_info.php';
require '../class/customer_order.php';

$cus_login = new LoginRegister();
$customer_login = $cus_login->getAllLoginInfo();
//debugger($customer_c_info);
//$customer_info = $cus_info->getAllInfo();
//debugger($customer_info,true);

$cus_order = new Customer_order();
//$customer_cus_order = $cus_order->getAllOrderByCInfoId($customer_cus_info[0]->id);
//debugger($customer_c_order,true);
//$customer_order = $cus_order->getAllOrderByCInfoId($customer_info[1]->id);
//debugger($_SESSION,true);

$myproduct = adminPaidOrder();


$status = FALSE;
if ( authorize($_SESSION["access"]["ORDERS"]["PENDING ORDERS"]["create"]) || 
authorize($_SESSION["access"]["ORDERS"]["PENDING ORDERS"]["edit"]) || 
authorize($_SESSION["access"]["ORDERS"]["PENDING ORDERS"]["view"]) || 
authorize($_SESSION["access"]["ORDERS"]["PENDING ORDERS"]["delete"]) ) {
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">computer</i> PENDING ORDERS Page</h4>
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

   <table id="table" class="table table_view file-export">

      <thead>
                          <th>S.N</th>
                          <th></th>
                          <th>Buyers Name</th>
                          <th>Buyers Phone</th>
                          <th>Shipping Address</th>
                          <th>Product Name</th>
                          <th>Payment Method</th>
                          <th>Payment Status</th>
                          <th>Order Delivery Status</th>
                          <th>Color</th>
                          <th>Size</th>
                          <!--<th>Image </th>-->
                          <th>Price</th>
                          <th>Quantity Bought</th>
                           
                          <th>Total Amount</th>

                          
                         </thead>
                         <tbody>
                          <?php 
                          if ($myproduct) {
                            $key = 1;
                            foreach ($myproduct as $pro_info) {
                              $email = $pro_info['c_email'];
                              $transid = $pro_info['transId'];
                              $udetails = getBuyerInfo($email);
                              ?>
                              <tr>
                                <td><?php echo $key; ?></td>
                                <td>

                                    <a href="#orderModal" class="btn btn-info delivery_status modal-trigger"  id="<?php echo $pro_info['id']; ?>"  data-name="<?php echo $pro_info['product_name']; ?>">Update Delivery Status</a> 
                                
                              </td>
                                <td><?php echo $udetails['last_name'] .' '.$udetails['first_name']; ?></td>
                                <td><?php echo $udetails['mobile'];  ?></td>
                                <td><?php echo $udetails['address1'];  ?></td>
                                <td><?php echo $pro_info['product_name']; ?></td>
                                 <td><?php echo $pro_info['payment']; ?></td>
                                 <td><?php if($pro_info['status'] == "Paid"){ echo '<span class="text-success">Paid</span>'; }else{ echo '<span class="text-warning">Payment Pending</span>'; }  ?></td>
                                  <td><?php echo $pro_info['delivery_status']; ?></td>
                                <td><?php echo $pro_info['color']; ?></td>
                                <td><?php echo $pro_info['size']; ?></td>
                                <!--<td>
                                    <?php 
                                     $sample_image=explode(",", $pro_info['product_image']);
                                    if ($pro_info['product_image']) {
                                     
                                      ?>
                                      
                                        <img src="../upload/product/<?php echo $pro_info['product_image'];?>" class="img img-thumbnail" style="width:150px;">
                                     
                                      <?php
                                    } 
                                    ?>
                                  </td>-->
                                  <td>
                                    <?php 
                                    

                               echo number_format($pro_info['product_price']);
                            

                                    ?>
                                      
                                    </td>
                                  <td><?php echo $pro_info['quantity']; ?></td>
                                  
                                  <td><?php  echo number_format($pro_info['total_amount']); ?></td>
                                  
                              </tr>
                              <?php
                              $key++;
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


 <div id="orderModal" class="modal">
    <div class="modal-content">
      <h4 class="modal-title" id="basicModalLabel4"></h4>
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
    // $('.table').DataTable();
    // $('.table_prop').DataTable();
    function removeAll(cusinfo_id){
      $.post('inc/api1.php',{customer_id:cusinfo_id, act:"<?php echo substr(md5('remove-all-order'), 3,15); ?>"},function(res){
        
        document.location.href = document.location.href;
      });
    }

    function delivered(pro_order_id){
      $.post('inc/api1.php',{order_id:pro_order_id, act:"<?php echo substr(md5('deliverd-this-order'), 3,15); ?>"},function(res){
        //alert(res);
        document.location.href = document.location.href;
      });
    }

    function removeOrder(order_id){
      $.post('inc/api.php',{order_id:order_id, act:"<?php echo substr(md5('remove-this-order'), 3,15); ?>"},function(res){
       // alert(res);
        document.location.href = document.location.href;
      });
    }

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


<script type="text/javascript">
  $('.delivery_status').click(function(e){ 
  
  e.preventDefault(); 
 var id = $(this).attr("id");  
 var name = $(this).attr("data-name");

 $(".modal-title").html(name);
 
     $('#contents').html(''); 
     $('#modal-loader').show();  
     $.ajax({
          url: '../inc/updateOrder.php',
          type: 'POST',
          data: 'id='+id,
          dataType: 'html'
     })
     .done(function(data){
          $('#contents').html(data); // load here
          $('#modal-loader').hide(); // hide loader  
           $('#orderModal').show();
     })
     .fail(function(){
          $('contents').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader').hide();
     });

});
</script>

