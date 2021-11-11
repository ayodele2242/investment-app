
<?php
include("header.php");
include("header-body.php");


$total = 0;
$carts = geCart($sessionId);
$cart = geCart($sessionId);
$total_quantity = 0;
$total_amount = 0;

if($cart){
    foreach($cart as $cart_item){
    $total_quantity += $cart_item['quantity'];
    $total_amount += $cart_item['price']*$cart_item['quantity'];
    // $size += $cart_item['size'];
    //$color += $cart_item['color'];
    }
}


?>
 

<main id="content" role="main" class="cart-page">
            <!-- breadcrumb -->
            <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="index">Home</a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->

            <div class="container">
                <div class="mb-4">
                    <h1 class="text-center">Cart</h1>
                </div>
                <div class="mb-10 cart-table">

                   <table class="table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="product-remove">&nbsp;</th>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity w-lg-15">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if($carts){
                               
                                foreach($carts as $cart_product){
                                  if($cart_product['image'] != "" && file_exists('../upload/product/'.$cart_product['image'])){
                                    $thumbnail = '../upload/product/'.$cart_product['image'];
                                  }
                                  else {
                                    $thumbnail = FRONT_IMAGES.'no-image.png';
                                  }

                                ?>
                                <tr class="">
                                    <td class="text-center d-inline-flex align-items-center">
                                        <a href="#" class="text-gray-32 font-size-26 cart-remove-btn delete btn-wishlist delete" data-toggle="modal" data-target="#delmodal_<?php echo $cart_product['product_id'];?>"><i class="fa fa-trash"></i></a>

                                        <button type="button" class="btn-wishlist mr-2 ml-2" onclick="addToWishlist(<?php echo  $cart_product['id'];?>);">
                                                 <i class="fa fa-heart"></i>
                                        </button>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <a href="detail?id=<?php echo $cart_product['product_id'];?>"><img class="img-fluid max-width-100 p-1 border border-color-1" src="<?php echo $thumbnail;?>" alt=""></a>
                                    </td>

                                    <td data-title="Product">
                                        <a href="detail?id=<?php echo $cart_product['product_id'];?>" class="text-gray-90"><?php echo $cart_product['title'];?></a> 
                                        <p>
                                        <small>
                                        Variant/color:&nbsp; <?php echo $cart_product['color']; ?><br/>
                                        Size:&nbsp; <?php echo $cart_product['size']; ?>
                                        </small>
                                    </p>
                                    </td>

                                    <td data-title="Price">
                                        <span class=""><?php echo $left_currency.number_format($cart_product['price']).$right_currency; ?>.00</span>
                                    </td>

                                    <td data-title="Quantity">
                                        
                                        <!-- Quantity -->
                                        <div class="num-block skin-1">
                                          <input type="hidden" name="id" class="mid"  value="<?php echo $cart_product['id']; ?>">
                                          <div class="num-in">
                                            <span class="minus dis" id=""></span>
                                            <input type="text" class="in-num qty" value="<?php echo $cart_product['quantity'] ?>" readonly="">
                                            <span class="plus"></span>
                                          </div>
                                        </div>
                                        <!-- End Quantity -->
                                    </td>

                                    <td data-title="Total">
                                        <?php echo $left_currency.number_format($cart_product['price']*$cart_product['quantity']).$right_currency; ?>.00
                                    </td>



                                    <!--Modal for delete-->
                         <!-- Panel Left -->
                         <div class="modal fade panelbox panelbox-left" id="delmodal_<?php echo $cart_product['product_id'];?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Item</h5>
                                <a href="javascript:;" data-dismiss="modal">Close</a>
                            </div>
                            <div class="modal-body">
                            Are you sure you want to delete  <b class="col-blue"><?php echo $cart_product['title'];?> </b>?
                            </div>
                            <div class="modal-footer">
                            <button class="btn-delete" id="<?php echo $cart_product['id'];?>" datacolor="<?php echo $cart_product['color'];?>" datatitle="<?php echo $cart_product['title'];?>"> 
                        <span class="fa fa-trash ion-2x"></span>
                        </button>
                        </div>
                        </div>
                        </div>
                        </div>
                                <!-- * Panel Left -->
                        <!-- * Modal for delete -->

                                </tr>

                                

                                <?php } ?>

                        <tr class="last">

                       <td colspan="7" class="pb-4">
                        <div align="right">
                       <h6><strong>Cart Total &nbsp;<?php echo $left_currency.number_format($total_amount).$right_currency; ?>.00</strong></h6>
                        </div>
                       </td>

                     </tr>

                                
                                <tr>
                                    <td colspan="7" class="border-top space-top-2 justify-content-center">
                                       
                                                   <div align="right">

                                                     <a href="store" class="btn bg-red btn-2  mb-3 btn-continue col-white ml-md-2 px-5 px-md-4 px-lg-5  w-md-auto  d-md-inline-block mt-3">Continue Shopping</a>



                                                    <a href="checkout" class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5  w-md-auto  d-md-inline-block">Proceed to checkout</a>
                                                </div>
                                               
                                    </td>
                                </tr>



 <?php }else{ ?>

<tr>

<td colspan="7">
<div class="alert alert-danger">No product(s) in your cart.</div>
</td>

</tr>


<?php } ?>
                            </tbody>
                        </table>



            </div>

             
            </div>
        </main>


<?php
include("footer.php");
?>

<script type="text/javascript">
  function show_hide_password(target){
  var input = document.getElementById('password-input');
  if (input.getAttribute('type') == 'password') {
    target.classList.add('view');
    input.setAttribute('type', 'text');
  } else {
    target.classList.remove('view');
    input.setAttribute('type', 'password');
  }
  return false;
}



$(document).ready(function(){

  $('.delete').click(function () {
    var row = $(this).closest("tr");
     row.find(".me").show().html("Hello");
     //row.find('.modal').modal('show');
  });
});
</script>