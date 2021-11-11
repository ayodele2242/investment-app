
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


if(isset($_SESSION['email'])){
  $email = $_SESSION['email'];
  $query = mysqli_query($mysqli,"select * from customer_login where email = '$email'");
  $udetails = mysqli_fetch_array($query);
  $uid = $udetails['id'];
  $_SESSION['uid'] = $udetails['id'];

  $addr = addresses($uid);

  //get my address

  $select = mysqli_query($mysqli,"select address1, state from customer_address where uid = '$uid' and default_address = 1");
  $maddr  = mysqli_fetch_array($select);
  $mhaddr = $maddr['address1'];
}
?>



<main id="content" role="main" class="checkout-page">

            <!-- breadcrumb -->
            <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="<?php echo url; ?>">Home</a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->

            <div class="container">
                <div class="mb-5">
                    <h1 class="text-center">Checkout</h1>
                </div>
                <?php if(!isset($_SESSION['email'])){ ?>
                <!-- Accordion -->
                <div id="shopCartAccordion" class="accordion rounded mb-5">
                    <!-- Card -->


                    <div class="card border-0">
                        <div id="shopCartHeadingOne" class="alert alert-primary mb-0" role="alert">
                            Returning customer? <a href="#" class="alert-link" data-toggle="collapse" data-target="#shopCartOne" aria-expanded="false" aria-controls="shopCartOne">Click here to login</a>
                        </div>
                        <div id="shopCartOne" class="collapse border border-top-0" aria-labelledby="shopCartHeadingOne" data-parent="#shopCartAccordion" style="">
                            <!-- Form -->
                            <form class="js-validate p-5" id="loginForms">
                                <!-- Title -->
                                <div class="mb-5">
                                    <p class="text-gray-90 mb-2">Welcome back! Sign in to your account.</p>
                                    <p class="text-gray-90">If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.</p>
                                </div>
                                <!-- End Title -->

                                <div class="row">
                                    <div class="col-lg-6">
                                        <!-- Form Group -->
                                        <div class="js-form-message form-group">
                                            <label class="form-label" for="signinSrEmailExample3">Email address</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email address" aria-label="Email address"  data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                                        </div>
                                        <!-- End Form Group -->
                                    </div>
                                    <div class="col-lg-6">
                                        <!-- Form Group -->
                                        <div class="js-form-message form-group">
                                            <label class="form-label" for="signinSrPasswordExample2">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="********" aria-label="********"  data-msg="Your password is invalid. Please try again." data-error-class="u-has-error" data-success-class="u-has-success">
                                        </div>
                                        <!-- End Form Group -->
                                    </div>
                                </div>

                                <!-- Checkbox -->
                                <div class="js-form-message mb-3 row">
                                    <div class="custom-control custom-checkbox d-flex align-items-center col-lg-5">
                                        <input type="checkbox" class="custom-control-input" id="rememberCheckbox" name="rememberCheckbox"  data-error-class="u-has-error" data-success-class="u-has-success">
                                        <label class="custom-control-label form-label" for="rememberCheckbox">
                                            Remember me
                                        </label>
                                    </div>

                                    <div class="mb-2 col-lg-7">
                                    	<div align="right">
                                        <a class="text-blue" href="#">Lost your password?</a>
                                    </div>
                                    </div>

                                </div>
                                <!-- End Checkbox -->

                                <!-- Button -->
                                <div class="mb-1">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary-dark-w px-5" id="logBtns">Login</button>
                                    </div>
                                    
                                </div>
                                <!-- End Button -->
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <!-- End Accordion -->
            <?php } ?>

              
                <!-- End Accordion -->
               
                    <div class="row">

                        <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                        	<form id="paymentForm">
                            <div class="pl-lg-3 ">
                                <div class="bg-gray-1 rounded-lg">
                                    <!-- Order Summary -->
                                    <div class="p-4 mb-4 checkout-table">
                                        <!-- Title -->
                                        <div class="border-bottom border-color-1 mb-5">
                                            <h3 class="section-title mb-0 pb-2 font-size-25">Your order</h3>
                                        </div>
                                        <!-- End Title -->
                                        <?php
                                        if($carts){
                                        	 $total_amountd = 0;
                                        	?>
                                        <!-- Product Content -->
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Product</th>
                                                    <th class="product-total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                    	<?php

				            $cartArray = array();

							
						   	foreach($carts as $cart_product){
				          $total_amountd += $cart_item['price']*$cart_item['quantity'];
				          if(isset($_SESSION['email'])){
				            $email = $_SESSION['email'];
				          }else{
				            $email = "";
				          }

				          $cartArray[] = array('product_id' => $cart_product['product_id'], 'title' => $cart_product['title'], 
				          'color'=>$cart_product['color'], 'size'=> $cart_product['size'],'price'=> $cart_product['price'], 
				          'vendor'=> $cart_product['vendor'],'image'=> $cart_product['image'], 'sessionId'=> $cart_product['sessionId'],
				          'quantity'=> $cart_product['quantity'], 'date_bought'=> $cart_product['added_date'], 'email'=> $email, 
				          'total_amt' => $total_amountd );

				                 if($cart_product['image'] != "" && file_exists('../upload/product/'.$cart_product['image'])){
				                    $thumbnail = '../upload/product/'.$cart_product['image'];
				                  }
				                  else {
				                    $thumbnail = FRONT_IMAGES.'no-image.png';
				                  }
				                  $total = $total_amount;
				                ?>
                                                <tr class="cart_item">
                                                    <td><?php echo $cart_product['title'];?>&nbsp;<strong class="product-quantity">× <?php echo number_format($cart_product['quantity']); ?></strong>
                                                    	<p>
                                                    		<small>Variation: <?php echo ucwords($cart_product['size']); ?></small> &nbsp;&nbsp;&nbsp;
                                                    	<small>Color:  <?php echo ucwords($cart_product['color']); ?></small>
                                                    	</p>

                                                    </td>
                                                    <td><?php echo $left_currency.number_format($cart_product['price']*$cart_product['quantity']).$right_currency; ?>.00</td>
                                                </tr>
                                                
                                            <?php } ?>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Subtotal</th>
                                                    <td>
                                                    	<input class="" id="iprice" type="text" value="<?php echo number_format($total); ?>" name="total_amt_to_pay" readonly style="background: transparent; border: none; text-align: right;">
                                                    </td>
                                                </tr>
                                                <!--<tr>
                                                    <th>Shipping</th>
                                                    <td>-->
                                                    	<?php
											          //$mstate = explode(',',$istate);

											               if(isset($maddr['state']) && $maddr['state'] == "Lagos"){
											               // echo number_format("1500");
											                ?>
											                <input type="hidden" name="shipping" id="shipping" value="0">
											                <?php
											               }else{
											                //echo number_format("2500");
											                ?>
											               <input type="hidden" name="shipping" id="shipping" value="0">

											                <?php
											               }

											            ?>

                                                    <!--</td>
                                                </tr>-->
                                                <tr>
                                                    <th>Discount</th>
                                                    <td ><strong id="result">--</strong></td>
                                                </tr>
                                                <tr>
                                                    <th>Total</th>
                                                    <td>
                                                    	<input class="" id="totAmt" type="text" value=""  readonly style="background: transparent; border: none; text-align: right;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2">
                                                    	 <input id="coupon" class="form-control coupon" type="text" name="coupon_code" placeholder="Coupon code" autocomplete="off" auto-complete="off">   
                                                    </th>
                                                    
                                                </tr>
                                            </tfoot>
                                        </table>
                                    <?php } ?>
                                        <!-- End Product Content -->
                                        

                                        	<?php if(isset($_SESSION['email'])){ ?> 
                                        		<div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                        			<div class="col-lg-12 mb-4"><h5>Choose Payment Method</h5></div>
                                            <!-- Basics Accordion -->
                                            <div id="basicsAccordion1">
                                                <!-- Card -->
                                                <div class="border-bottom border-color-1 border-dotted-bottom">
                                                    <div class="p-3" id="basicsHeadingOne">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" name="payment_method" class="custom-control-input" id="stylishRadio1"  value="pay_on_delivery" onclick="show1();">
                                                            <label class="custom-control-label form-label collapsed" for="stylishRadio1" data-toggle="collapse" data-target="#basicsCollapseOnee" aria-expanded="false" aria-controls="basicsCollapseOnee">
                                                            	Cash on delivery
                                                                
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="basicsCollapseOnee" class="border-top border-color-1 border-dotted-top bg-dark-lighter collapse" aria-labelledby="basicsHeadingOne" data-parent="#basicsAccordion1" style="">
                                                        <div class="p-4">
                                                           Pay with cash upon delivery.
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Card -->

                                                <!-- Card -->
                                                <div class="border-bottom border-color-1 border-dotted-bottom">
                                                    <div class="p-3" id="basicsHeadingTwo">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="secondStylishRadio1" name="payment_method" value="credit_card" onclick="cardPay();">
                                                            <label class="custom-control-label form-label collapsed" for="secondStylishRadio1" data-toggle="collapse" data-target="#basicsCollapseTwo" aria-expanded="false" aria-controls="basicsCollapseTwo">
                                                                Credit or Debit Cards
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="basicsCollapseTwo" class="border-top border-color-1 border-dotted-top bg-dark-lighter collapse" aria-labelledby="basicsHeadingTwo" data-parent="#basicsAccordion1" style="">
                                                        <div class="p-4">
                                                            Pay using your debit or credit card.
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Card -->
                                                <?php if(!empty($card['last4'])){ ?>
                                                <!-- Card -->
                                                <div class="border-bottom border-color-1 border-dotted-bottom">
                                                    <div class="p-3" id="basicsHeadingThree">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="thirdstylishRadio1" name="payment_method" value="credit_card" onclick="savedCard();">
                                                            <label class="custom-control-label form-label" for="thirdstylishRadio1" data-toggle="collapse" data-target="#basicsCollapseThree" aria-expanded="true" aria-controls="basicsCollapseThree">
                                                                <div class="credit-card visa selectable">
														        <div class="credit-card-last4">
														            <?php  echo $card['last4'];   ?>
														        </div>
														    </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="basicsCollapseThree" class="border-top border-color-1 border-dotted-top bg-dark-lighter collapse show" aria-labelledby="basicsHeadingThree" data-parent="#basicsAccordion1" style="">
                                                        <div class="p-4">
                                                            Pay with your saved card.
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Card -->
                                                <?php } ?>

                                                <!-- Card -->
                                                 <?php if(!empty($wallet['amount_saved'])){ ?>
                                                <div class="border-bottom border-color-1 border-dotted-bottom">
                                                    <div class="p-3" id="basicsHeadingFour">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="FourstylishRadio1" name="payment_method" value="wallet" onclick="walletPay();">
                                                            <label class="custom-control-label form-label" for="FourstylishRadio1" data-toggle="collapse" data-target="#basicsCollapseFour" aria-expanded="false" aria-controls="basicsCollapseFour">
                                                                Wallet
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="basicsCollapseFour" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter" aria-labelledby="basicsHeadingFour" data-parent="#basicsAccordion1">
                                                        <div class="p-4">
                                                            You can make payment using your wallet
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <!-- End Card -->
                                            </div>
                                            <!-- End Basics Accordion -->
                                        


                                        </div>


                                        <div id="cardPay" class="hide col-grey">

</div>
<?php  if($maddr['address1'] == ""){
    echo '<div class="alert alert-danger">Please add a shipping address/default address to continue</div>';
}else{ ?>

                                          <button id="default_btn" class="btn btn-sm btn-info btn-block">Place order</button>
	<button id="delivery_btn" class="btn btn-sm btn-info btn-block" style="display: none;">Place order</button>
	<button id="pay-now" class="btn btn-sm btn-info btn-block" style="display: none;">Place order</button>
  <button id="CardPayment" class="btn btn-sm btn-info btn-block" style="display: none;">Place order</button>
  <button id="walletPayment" class="btn btn-sm btn-info btn-block" style="display: none;">Place order</button>


                                         <?php
}

                                          }else{ ?>

                                         	<div class="alert alert-danger">
                                         		Login to continue to payment and if you're a new customer, add your <strong>Billing details</strong> to start.
                                         	</div>

                                         <?php } ?>
                                     
                                      
                                    </div>
                                    <!-- End Order Summary -->
                                </div>
                            </div>

                             <input type="hidden" name="mybonus" id="mybonus" value="">
                <input type="hidden" id="mtotal" name="mtotal" value="<?php echo $total; ?>">
                <input type="hidden" name="items_bought" id="items_bought" value="<?php error_reporting(0); echo htmlentities(serialize($cartArray));  ?>">
                <input type="hidden" name="cust_email" id="cust_email" value="<?php echo $_SESSION['email'];  ?>">
                <input type="hidden" name="trx_id" id="trx_id" value="<?php echo rand();  ?>">
                        </form>
                        </div>

                        <div class="col-lg-7 order-lg-1">
                            <div class="pb-2 mb-1">
                                <!-- Title -->
                                <div class="border-bottom border-color-1 mb-5">
                                    <h3 class="section-title mb-0 pb-2 font-size-25">Billing details</h3>
                                </div>
                                <!-- End Title -->

                                <?php if(!isset($_SESSION['email'])){ ?>

                                <!-- Billing Form -->
                                <div class="row">
                                    
                                <form id="regForms" class="row mt-4">


                       <div class="form-group basic col-lg-6 col-sm-12">
                            <div class="input-wrapper">
                                <label class="label" for="firstname">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic col-lg-6 col-sm-12">
                            <div class="input-wrapper">
                                <label class="label" for="lastname">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

               
                        <div class="form-group basic col-lg-6 col-sm-12">
                            <div class="input-wrapper">
                                <label class="label" for="email1">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Your e-mail">
                            </div>
                        </div>

                        <div class="form-group basic col-lg-6 col-sm-12">
                            <div class="input-wrapper">
                                <label class="label" for="email1">Phone No.</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Your Phone No.">
                                 <input type="hidden" class="form-control" id="zip" name="zip" placeholder="ZIP Code">
                            </div>
                        </div>
        
                        

                        <!--<div class="form-group basic col-12">
                            <div class="input-wrapper">
                                <label class="label" for="zipcode">ZIP Code</label>
                               
                            </div>
                        </div>-->

                        <div class="form-group basic col-lg-4 col-sm-12 ">
                            <div class="input-wrapper">
                                <label class="label" for="country">Country</label>
                                <select class="form-control" id="mcountry" name="country">
                                <option value="">Choose country</option>
                                <?php echo getCountry(); ?>
                                </select>
                                </select>
                            </div>
                        </div>

                        <div class="form-group basic col-lg-4 col-sm-12">
                            <div class="input-wrapper">
                                <label class="label" for="select4">State</label>
                                <select class="form-control " id="mstates" name="state">
                                    
                                </select>
                            </div>
                        </div>

                        <div class="form-group basic col-lg-4 col-sm-12">
                            <div class="input-wrapper">
                                <label class="label" for="select4">City</label>
                                <input type="text" name="city" class="form-control" id="city" placeholder="City">
                            </div>
                        </div>

                        <div class="form-group basic col-lg-6 col-sm-12">
                            <div class="input-wrapper">
                                <label class="label" for="textarea4">Address 1</label>
                                <textarea id="address1" rows="2" class="form-control"
                                    placeholder="Address 1" name="address1"></textarea>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic col-lg-6 col-sm-12">
                            <div class="input-wrapper">
                                <label class="label" for="textarea4">Address 2</label>
                                <textarea id="address2" rows="2" class="form-control"
                                    placeholder="Address 2"  name="address2"></textarea>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic col-lg-6 col-sm-12">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Your password">
                            </div>
                        </div>
        
                        <div class="form-group basic col-lg-6 col-sm-12">
                            <div class="input-wrapper">
                                <label class="label" for="password2">Confirm Password</label>
                                <input type="password" class="form-control" id="password2" name="password2" placeholder="Type password again">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        <div class="form-group basic col-lg-12">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" name="default-address" value="1" type="checkbox" checked id="same-address">
                            <label class="custom-control-label" for="same-address">Set as default shipping address</label>
                        </div>
                        </div>
                        
                        <!--<div class="form-group basic">
                        <div class="custom-control custom-checkbox mt-2 mb-1">
                           
                            <label class="custom-control-label" for="customChecka1">
                               
                            </label>
                        </div>
                        </div>-->
        
                    


                <div class="form-button-group col-12">
                    <button type="submit" class="btn btn-primary btn-block btn-lg regFormBtns">Register</button>
                  
                </div>

            </form>                 
                                    
                                </div>
                                <!-- End Billing Form -->
                            <?php }else{ ?>

                            
                             <p class="pr-1 pl-1 pt-1 pb-1 alert-info">Select the address you are shipping to. The purple color indicates it is already checked as your default shipping address.  </p>
                              <a href="#" class="link col-orange bolder" data-toggle="modal" data-target="#modalXL">Add New Address</a>

                              <?php
                $istate = array();
                  foreach ($addr as $myaddr) {
                     $istate[] = $myaddr['state'];
                  ?>
            <div class="d-flex overflow-auto pt-4 pb-2 bg-gray-13">
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
                    <?php  echo $myaddr['mobile']; ?><a class="nav-link-style ml-3 edit text-danger bolder" type="button" data-toggle="modal" data-target="#umodal"  data-toggle="tooltip" title="Edit" id="<?php  echo $myaddr['user_id']; ?>">
                    <ion-icon big name="pencil"></ion-icon> Update
                    </a>
                  </div>

                  
                  </div>
              </div>
                  <?php } } ?>
                               

                              
                                
                                <!-- End Input -->
                            </div>
                        </div>
                    </div>
                
            </div>
        </main> 



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
</script>

<script type="text/javascript">
	function show1(){
  document.getElementById('cardPay').style.display ='block';
  $("#pay-now").hide();
  $("#delivery_btn").show();
  $("#default_btn").hide();
  $("#CardPayment").hide();
  $("#walletPayment").hide();
}

function cardPay(){
  document.getElementById('cardPay').style.display = 'block';
  $("#pay-now").show();
  $("#delivery_btn").hide();
  $("#default_btn").hide();
  $("#CardPayment").hide();
  $("#walletPayment").hide();
}

function savedCard(){
    document.getElementById('cardPay').style.display = 'block';
  $("#pay-now").hide();
  $("#delivery_btn").hide();
  $("#default_btn").hide();
  $("#CardPayment").show();
  $("#walletPayment").hide();
}

function walletPay(){
    document.getElementById('cardPay').style.display = 'block';
  $("#pay-now").hide();
  $("#delivery_btn").hide();
  $("#default_btn").hide();
  $("#CardPayment").hide();
  $("#walletPayment").show();
}

$(document).ready(function() {
  $('#loginform_id').click(function(e) {
  	e.preventDefault();
 
    $('#loginDiv').show();
    $('#registerDiv').hide();
    // Alternative animation for example
    // slideToggle("fast");
  });

  $('#registerform_id').click(function(e) {
  	e.preventDefault();
 
    $('#loginDiv').hide();
    $('#registerDiv').show();
    // Alternative animation for example
    // slideToggle("fast");
  });



  
});

</script>


<script type="text/javascript">
  $(document).ready(function() {


 $('#logBtns').click(function(e){ 
    e.preventDefault();
      var username = $("#email").val();
      var password = $("#password").val();
      if(username=="")
      {

       $.toast({ 
        text : 'Please enter your email', 
        showHideTransition : 'fade',  
        bgColor : 'red',              
        textColor : '#fff',       
        allowToastClose : false,    
        hideAfter : 4000,
        loader: false,                               
        textAlign : 'center',           
        position : 'top-right'  
      });

      }else if(password=="")
      {
       $.toast({ 
        text : 'Please enter your password', 
        showHideTransition : 'fade',  
        bgColor : 'red',              
        textColor : '#fff',       
        allowToastClose : false,    
        hideAfter : 4000,
        loader: false,                               
        textAlign : 'center',           
        position : 'top-right'  
      });

         
      }
else
{
    $.ajax({
       type: "POST",
       url: '../inc/members/login.php',
       data: $("#loginForms").serialize(),
       success: function(data)
       {
          if (data.trim() == 'ok') {
             $.toast({ 
            text : 'Please wait while we log you in...', 
            showHideTransition : 'fade',  
            bgColor : 'green',              
            textColor : '#fff',       
            allowToastClose : false,    
            hideAfter : 4000,
            loader: false,                               
            textAlign : 'center',           
            position : 'center'  
          });
           setTimeout(' window.location.href = "checkout"; ',1000);

          }else if(data.trim() == "i"){

           
             $.toast({ 
            text : 'Your account is not yet activated at the moment. Please go to your email and confirm your email.', 
            showHideTransition : 'fade',  
            bgColor : 'red',              
            textColor : '#fff',       
            allowToastClose : false,    
            hideAfter : 4000,
            loader: false,                               
            textAlign : 'center',           
            position : 'top-right'  
          });

    }
    else if(data.trim() == "s"){

       $.toast({ 
            text : 'Your account is suspended.', 
            showHideTransition : 'fade',  
            bgColor : 'red',              
            textColor : '#fff',       
            allowToastClose : false,    
            hideAfter : 4000,
            loader: false,                               
            textAlign : 'center',           
            position : 'top-right'  
      });
    }
          else {

            $.toast({ 
            text : data, 
            showHideTransition : 'fade',  
            bgColor : 'red',              
            textColor : '#fff',       
            allowToastClose : false,    
            hideAfter : 4000,
            loader: false,                               
            textAlign : 'center',           
            position : 'top-right'  
           });

          }
       }
   });
}
 });













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
         /* $('#modal-loader').hide(); // hide loader  
          $('#umodal').modal('show');
          $(".showit").show();*/
          
     })
     .fail(function(){
          $('#contents').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader').hide();
     });

            
        });
    });


$('#addAddrForm').click(function(e){ 
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



$(document).ready(function() {
$("#default_btn").click(function(e) {
      e.preventDefault();

      $.toast({ 
                text : '<b>Please select your payment method to continue.</b>', 
                showHideTransition : 'fade',
                bgColor : 'red',            
                textColor : '#fff',
                allowToastClose : false,
                hideAfter : 4000,
                loader: false,            
                stack : 5,                     
                textAlign : 'center', 
                position : 'top-right'  
              });
        

        if($('input[name=addr_id]:checked').length < 1){
          $.toast({ 
                text : '<b>>We discovered you don\'t have a default address. Please select where you would want us to ship your items to.</b>', 
                showHideTransition : 'fade',
                bgColor : 'red',            
                textColor : '#fff',
                allowToastClose : false,
                hideAfter : 4000,
                loader: false,            
                stack : 5,                     
                textAlign : 'center', 
                position : 'top-right'  
              });

        }

  }); 



 $("#walletPayment").click(function(e) {
      e.preventDefault();
     
     if($('input[name=addr_id]:checked').length < 1){

      $.toast({ 
                text : '<b>>We discovered your don\'t have a default address. Please select where you would want us to ship your items to.</b>', 
                showHideTransition : 'slide',
                bgColor : 'red',            
                textColor : '#fff',
                allowToastClose : false,
                hideAfter : 4000,
                loader: false,            
                stack : 5,                     
                textAlign : 'center', 
                position : 'top-right'  
              });

        
        }else{
        
        //var serializedData = $("#paymentForm").serialize();
        $.ajax({

            type : 'POST',
            url  : '../inc/shop/pay_using_wallet.php',
            data: $("#paymentForm").serialize(),
            success :  function(res)
            {
                if(res.trim() == 1)
                {

                  $.toast({ 
                text : '<i class="fa fa-check"></i> &nbsp;Order Successfully Placed. Please check your order to see delivery date.', 
                showHideTransition : 'slide',
                bgColor : 'green',            
                textColor : '#fff',
                allowToastClose : false,
                hideAfter : 4000,
                loader: false,            
                stack : 5,                     
                textAlign : 'center', 
                position : 'top-right'  
              });


         //$(".icart").load(location.href + " .icart");
         location.href = 'orders';
         
      }else{

        $.toast({ 
                text : res, 
                showHideTransition : 'slide',
                bgColor : 'red',            
                textColor : '#fff',
                allowToastClose : false,
                hideAfter : 4000,
                loader: false,            
                stack : 5,                     
                textAlign : 'center', 
                position : 'top-right'  
              });
      }
            }
        });

          return false;
        }



 });



   $("#delivery_btn").click(function(e) {
      e.preventDefault();
     
     if($('input[name=addr_id]:checked').length < 1){

      $.toast({ 
                text : '<b>>We discovered your don\'t have a default address. Please select where you would want us to ship your items to.</b>', 
                showHideTransition : 'slide',
                bgColor : 'red',            
                textColor : '#fff',
                allowToastClose : false,
                hideAfter : 4000,
                loader: false,            
                stack : 5,                     
                textAlign : 'center', 
                position : 'top-right'  
              });

        
        }else{
        
        //var serializedData = $("#paymentForm").serialize();
        $.ajax({

            type : 'POST',
            url  : '../inc/shop/pay_on_delivery.php',
            data: $("#paymentForm").serialize(),
            success :  function(res)
            {
                if(res.trim() == 1)
                {

                  $.toast({ 
                text : '<i class="fa fa-check"></i> &nbsp;Order Successfully Placed. Please check your order to see delivery date.', 
                showHideTransition : 'slide',
                bgColor : 'green',            
                textColor : '#fff',
                allowToastClose : false,
                hideAfter : 4000,
                loader: false,            
                stack : 5,                     
                textAlign : 'center', 
                position : 'top-right'  
              });


         //$(".icart").load(location.href + " .icart");
         location.href = 'orders';
      }else{

        $.toast({ 
                text : res, 
                showHideTransition : 'slide',
                bgColor : 'red',            
                textColor : '#fff',
                allowToastClose : false,
                hideAfter : 4000,
                loader: false,            
                stack : 5,                     
                textAlign : 'center', 
                position : 'top-right'  
              });
      }
            }
        });

          return false;
        }



 });




$("#CardPayment").click(function(e) {
      e.preventDefault();
      $("#CardPayment").html("Processing payment");
      $("#CardPayment").prop("disabled",true);
       var serializedData = $("#paymentForm").serialize();
       $.ajax({
            type : 'POST',
            url  : '../inc/shop/cardPayment.php',
            data : serializedData,
            success: function (data) {
             
            var datas = JSON.parse(data);

            if(datas.success == true){

              document.location.href="payment_done?reference="+datas.ref+"&transId="+datas.transId+"&email="+datas.email;

               $('#CardPayment').html("Finalizing Payment");
                $("#CardPayment").prop("disabled",true);

            }else{
              $('#CardPayment').html("Try Again");
               $("#CardPayment").prop("disabled",false);
               $.toast({ 
              text : '<b><ion-icon name="sad"></ion-icon> &nbsp;'+datas.response+'</b>', 
              showHideTransition : 'fade',
              bgColor : 'red',            
              textColor : '#fff',
              allowToastClose : false,
              hideAfter : 4000,
              loader: false,            
              stack : 5,                     
              textAlign : 'center', 
              position : 'top-right'  
            });
            }


            }
        });
        return false;
      
      
 });






});       

$(document).ready(function(){
  function format(n, sep, decimals) {
    sep = sep || "."; // Default to period as decimal separator
    decimals = decimals || 2; // Default to 2 decimals

    return n.toLocaleString().split(sep)[0]
        + sep
        + n.toFixed(decimals).split(sep)[1];
}

  function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }
     
      var shipping =  parseInt($('#shipping').val());
      var mainPrice =  parseInt($('#iprice').val().split(",").join(""));
      var mytotal = mainPrice + shipping;
       
      $("#totAmt").val(commaSeparateNumber(mytotal));


      $("#total_result").html(format(mytotal));

		$("body").delegate(".coupon","keyup",function(event){
     event.preventDefault();
			var coupon = $("#coupon").val();
			var myprice = $("#mtotal").val();

            //alert(myprice);



			if(coupon == ""){

        $.toast({ 
                text : '<b><ion-icon name="sad"></ion-icon> &nbsp;Please enter a coupon code.</b>', 
                showHideTransition : 'slide',
                bgColor : 'red',            
                textColor : '#fff',
                allowToastClose : false,
                hideAfter : 4000,
                loader: false,            
                stack : 5,                     
                textAlign : 'center', 
                position : 'top-right'  
              });


			}else{
        if(coupon.length > 8){
        var shipping =  parseInt($('#shipping').val());

		$.ajax({

            type : 'POST',
            url  : '../inc/get_coupon.php',
            data : { coupon: coupon, price: myprice },
            cache: false,
            success :  function(res)
            {
                if(res.trim() == "error")
                {

                $.toast({ 
                text : '<b><ion-icon name="sad"></ion-icon> &nbsp;Invalid Coupon Code</b>', 
                showHideTransition : 'fade',
                bgColor : 'red',            
                textColor : '#fff',
                allowToastClose : false,
                hideAfter : 4000,
                loader: false,            
                stack : 5,                     
                textAlign : 'center', 
                position : 'top-right'  
              });

                
          
                    }else{

              

         				var json = JSON.parse(res);
         				 $.toast({ 
			                text : json.discount+' <b>% Off</b>', 
			                showHideTransition : 'fade',
			                bgColor : 'green',            
			                textColor : '#fff',
			                allowToastClose : false,
			                hideAfter : 4000,
			                loader: false,            
			                stack : 5,                     
			                textAlign : 'center', 
			                position : 'top-right'  
			              });

						$('#result').html("<h6 class='pull-right text-danger'>"+json.discount+"% Off</h6>");


						$('#iprice').val(json.price);
                        $('#mybonus').val(json.price);

            var mainPrice =  parseInt((json.price).split(",").join(""));
            var mytotal = mainPrice + shipping;

            $("#totAmt").val(commaSeparateNumber(mytotal));

            $("#total_result").html(format(mytotal));


                    }
            }
        });


      }//#if


			}//else




		});
	});






$('#pay-now').click(function(e){ 
e.preventDefault(); 

 
$('#pay-now').html("Initializing");

  //function saveOrderThenPayWithPaystack(){
 if($('input[name=addr_id]:checked').length < 1){
          $("#msgs").html('<div class="alert alert-danger">We discovered your don\'t have a default address. Please select where you would want us to ship your items to.</div>').show();
          setTimeout(function() {
              $("#msgs").fadeOut(1500);
          }, 10000);
$('#pay-now').html("Pay with Card");

        }else{   


var addr_id = $("#addr_id").val();
var total_amt_to_pay = $("#iprice").val();
var items_bought = $("#items_bought").val();
var cust_email = $("#cust_email").val();
var shipping = $("#shipping").val();
var coupon = $("#coupon").val();
var trx_id = $("#trx_id").val();

var globalData;
//var email;


var orderObj = {
    addr_id: addr_id,
    cust_email:  cust_email,
    total_amt_to_pay: total_amt_to_pay,
    items_bought: items_bought,
    shipping: shipping,
    coupon_code: coupon,
    trx_id: trx_id

  };
    // Send the data to save using post
    var posting = $.post( '../inc/shop/pay_with_card.php', orderObj );

    posting.done(function( data ) {

      $('#pay-now').html("Processing...");
      /* check result from the attempt */
      var jresponse =  JSON.parse(data);

      var email = jresponse.email;
      var name = jresponse.name;
      var amount = jresponse.amount;
      var transId = jresponse.transId;
      console.log(email);

      let handler = PaystackPop.setup({
    key: 'pk_live_d84031a0dc03f24b7a267761cc836431d26ea5e8',
    email: email,
    display_name: name,
    amount: amount * 100,
    ref: ''+Math.floor((Math.random() * 1000000000) + 1),
     metadata: {
         custom_fields: [
            {
                display_name: name,
            }
         ]
      },
    onClose: function(){
       alert('Payment cancelled');
       $('#pay-now').html("Try agin");
       $('#paymenFailed').html("Order placed but your payment failed").show();
    },
    callback: function(response){
     $('#pay-now').html("Please wait...");
       /* var queryString = "?reference=" + response.reference + "&email=" + email + "&transId=" + transId;
          window.location.href = "payment-verify" + queryString;*/
          
          jQuery.ajax({
            url: 'payment-verify.php',
            method: 'post',
            async:false,
            data:{reference: response.reference, transId: transId, email: email},
            success: function (data) {
             
            var datas = JSON.parse(data);

            if(datas.success == true){

              document.location.href="payment_done.php?reference="+datas.ref+"&transId="+datas.transId+"&email="+datas.email;

               $('#pay-now').html("Finalizing Payment");

            }else{
              $('#pay-now').html("Pay with Card");
               $.toast({ 
              text : '<b><ion-icon name="sad"></ion-icon> &nbsp;'+data+'</b>', 
              showHideTransition : 'fade',
              bgColor : 'red',            
              textColor : '#fff',
              allowToastClose : false,
              hideAfter : 4000,
              loader: false,            
              stack : 5,                     
              textAlign : 'center', 
              position : 'top-right'  
            });
            }


            }
          });


    }
  });
  handler.openIframe();
       
       
     // console.log(response[0].email);
    });
    posting.fail(function( data ) { /* and if it failed... */ });

  }
  //}
  });




 </script>