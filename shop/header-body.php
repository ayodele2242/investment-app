

        <!-- ========== HEADER ========== -->
        
        <?php
if((isset($current_page)) && $current_page == 'index'){
    echo '<header id="header" class="u-header u-header-left-aligned-nav u-scrolled">';
}else{
    echo '<header id="header" class="u-header u-header-left-aligned-nav border-bottom border-color-1">';
}
?>

            <div class="u-header__section">


                <!-- Topbar -->
                <?php include("top-header.php"); ?>
                <!-- End Topbar -->
            <?php
            if((isset($current_page)) && $current_page == 'index'){
             ?>
                <!-- Logo-Search-header-icons -->
                <div class="py-2 py-xl-3 bg-primary bg-xl-transparent">
                    <div class="container">
                        <div class="row my-0dot5 my-xl-0 align-items-center position-relative">
                            <!-- Logo-offcanvas-menu -->
                            <div class="col-auto">
                                <!-- Nav -->
                                <nav class="navbar navbar-expand u-header__navbar py-0">
                                   
                                   <button id="sidebarHeaderInvokerMenu" type="button" class="navbar-toggler d-block btn u-hamburger mr-3 mr-xl-0 target-of-invoker-has-unfolds" aria-controls="sidebarHeader" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarHeader1" data-unfold-type="css-animation" data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft" data-unfold-duration="500">
                                        <span id="hamburgerTriggerMenu" class="u-hamburger__box">
                                            <span class="u-hamburger__inner"></span>
                                        </span>
                                    </button>

                                    <!-- Logo -->
                                    <a class="navbar-brand u-header__navbar-brand u-header__navbar-brand-center mr-0" href="<?php echo $set['installUrl']; ?>" aria-label="<?php echo $set['storeName']; ?>">

                                        <img src="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?>" width="120" height="60">

                                       
                                    </a>
                                    <!-- End Logo -->
                                     <?php include("side-navs.php");  ?>
                                </nav>
                                <!-- End Nav -->

                             
                            </div>
                        <?php }else{ ?>
                               <!-- Logo and Menu -->
                <div class="py-2 py-xl-4 bg-primary-down-lg">
                    <div class="container my-0dot5 my-xl-0">
                        <div class="row align-items-center">
                            <!-- Logo-offcanvas-menu -->
                            <div class="col-auto">
                                <!-- Nav -->
                                <nav class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between max-width-270 min-width-270">


                                    <!-- Logo -->
                                    <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="<?php echo url; ?>" aria-label="<?php echo $set['storeName']; ?>">
                                       <img src="../assets/logo/<?php echo $set['logo']; ?>" width="120" height="60">
                                    </a>
                                    <!-- End Logo -->

                                    <!-- Fullscreen Toggle Button -->
                                   <button id="sidebarHeaderInvokerMenu" type="button" class="navbar-toggler d-block btn u-hamburger mr-3 mr-xl-0 target-of-invoker-has-unfolds" aria-controls="sidebarHeader" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarHeader1" data-unfold-type="css-animation" data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft" data-unfold-duration="500">
                                        <span id="hamburgerTriggerMenu" class="u-hamburger__box">
                                            <span class="u-hamburger__inner"></span>
                                        </span>
                                    </button>
                                    <!-- End Fullscreen Toggle Button -->
                                </nav>
                                <!-- End Nav -->
                                <?php include("side-navs.php");  ?>
                               
                            </div>
                            <!-- End Logo-offcanvas-menu -->

                        <?php } ?>



                            <!-- End Logo-offcanvas-menu -->
                            <!-- Search Bar -->
                            <div class="col pl-0 d-none d-xl-block">
                                <form class="js-focus-state">
                                    
                                    <div class="input-group">
                                        <input type="text" class="form-control py-2 pl-5 font-size-15 border-right-0 height-40 border-width-2 rounded-left-pill border-primary" name="search" id="productSearch" placeholder="Search for products" aria-label="Search for products" aria-describedby="searchProduct1" required>
                                        <div class="input-group-append">
                                                                                       
                                            <!-- End Select -->
                                            <button class="btn btn-primary height-40 py-2 px-3 rounded-right-pill" type="button" id="searchProduct1">
                                                <span class="ec ec-search font-size-24"></span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div id="result-ajax-search" class="result-ajax-search pl-4 pr-4" style="background: #fff">
                                       
                                </div>
                            </div>
                            <!-- End Search Bar -->
                            <!-- Secondary Menu -->
                            <div class="col-md-auto position-static d-none d-xl-block">
                                <div class="secondary-menu v1">
                                    <!-- Nav -->
                                    <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space position-static">
                                        <!-- Navigation -->
                                        <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                            <ul class="navbar-nav u-header__navbar-nav">

                                                 <li class="nav-item u-header__nav-item">
                                                    <a class="nav-link u-header__nav-link" href="<?php echo url; ?>" aria-haspopup="true" aria-expanded="false" aria-labelledby="pagesSubMenu">

                                                    Home

                                                </a>
                                                </li>

                                              

                                                <?php
                                                   if(isset($_SESSION['email'])){
                                                 ?>

                                                   <!-- Home -->
                                                <li class="nav-item hs-has-sub-menu u-header__nav-item"
                                                    data-event="hover"
                                                    data-animation-in="slideInUp"
                                                    data-animation-out="fadeOut">
                                                    <a id="HomeMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle iflex" href="javascript:;" aria-haspopup="true" aria-expanded="false" aria-labelledby="HomeSubMenu">
                                                    
                                                    
                                                    <div id="ileft">
                                                       <i class="ec ec-user font-size-50 text-primary"></i>
                                                    </div>
                                                    <div id="right" style="padding-top: 14px;">
                                                         <strong>Hello</strong>
                                                         <p><?php echo $urow['last_name'];  ?></p>
                                                    </div>
                                                    

                                                    </a>

                                                    <!-- Home - Submenu -->
                                                    <ul id="HomeSubMenu" class="hs-sub-menu u-header__sub-menu animated fadeOut" aria-labelledby="HomeMegaMenu" style="min-width: 230px; display: none;">
                                                         <li class="listme"><a class="nav-link u-header__sub-menu-nav-link" href="failed-orders">Failed Orders</a></li>
                                                      <li class="listme"><a class="nav-link u-header__sub-menu-nav-link" href="orders">My Orders</a></li>
                                                       <li class="listme"><a class="nav-link u-header__sub-menu-nav-link" href="to-be-review">To Be Reviewed</a></li>
                                                       <li class="listme"><a class="nav-link u-header__sub-menu-nav-link" href="wishlist" class="item">Saved Items</a></li>
                                                       <li class="listme"><a class="nav-link u-header__sub-menu-nav-link" href="return" class="item">Return/Repair</a></li>
                                                       <li class="hrule"><hr/></li>
                                                       <li class="listme"><a class="nav-link u-header__sub-menu-nav-link" href="my-profile">My Details</a></li>
                                                       <li class="listme"><a class="nav-link u-header__sub-menu-nav-link" href="address-book">Address Book</a></li>
                                                       <li class="hrule"><hr/></li>
                                                       <li class="logout"><a class="nav-link u-header__sub-menu-nav-link col-red" href="logout">Logout</a></li>
                                                        
                                                        
                                                    </ul>
                                                    <!-- End Home - Submenu -->
                                                </li>



                                                  <?php }else{ 
                                                      if($current_page != 'login' and $current_page != 'register' ){
                                                    ?>

                                                <!-- Home -->
                                                <li class="nav-item hs-has-sub-menu u-header__nav-item"
                                                    data-event="hover"
                                                    data-animation-in="slideInUp"
                                                    data-animation-out="fadeOut">
                                                    <a id="HomeMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle iflex" href="javascript:;" aria-haspopup="true" aria-expanded="false" aria-labelledby="HomeSubMenu">
                                                    
                                                    
                                                    <div id="ileft">
                                                       <i class="ec ec-user font-size-50 text-primary"></i>
                                                    </div>
                                                    <div id="right" style="padding-top: 14px;">
                                                         <strong>My Account</strong>
                                                         <p>Hello, Sign In</p>
                                                    </div>
                                                    

                                                    </a>

                                                    <!-- Home - Submenu -->
                                                    <ul id="HomeSubMenu" class="hs-sub-menu u-header__sub-menu animated fadeOut" aria-labelledby="HomeMegaMenu" style="min-width: 230px; display: none;">
                                                        <li><!--<a class="nav-link u-header__sub-menu-nav-link" href="login-signup">Login / Signup</a>-->


                                                         <a id="sidebarNavToggler" href="javascript:;" role="button" class="nav-link u-header__sub-menu-nav-link"
                                            aria-controls="sidebarContent"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                            data-unfold-event="click"
                                            data-unfold-hide-on-scroll="false"
                                            data-unfold-target="#sidebarContent"
                                            data-unfold-type="css-animation"
                                            data-unfold-animation-in="fadeInRight"
                                            data-unfold-animation-out="fadeOutRight"
                                            data-unfold-duration="500">
                                            <i class="ec ec-user mr-1"></i> Register <span class="text-gray-50"> -or- </span> Sign in
                                        </a>
                                        </li>
                                                    </ul>
                                                    <!-- End Home - Submenu -->
                                                </li>

                                                <?php 
                                     } 

                                     }
                                     ?>      
                                                

                                                <!-- Featured Brands -->
                                               
                                                <!-- End Featured Brands -->

                                               
                                            </ul>
                                        </div>
                                        <!-- End Navigation -->
                                    </nav>
                                    <!-- End Nav -->
                                </div>
                            </div>
                            <!-- End Secondary Menu -->
                            <!-- Header Icons -->
                            <div class="col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                                <div class="d-inline-flex">
                                    <ul class="d-flex list-unstyled mb-0">
                                        <!-- Search -->
                                        <li class="col d-xl-none px-2 px-sm-3 position-static">
                                            <a id="searchClassicInvoker" class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary" href="javascript:;" role="button"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Search"
                                                aria-controls="searchClassic"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                                data-unfold-target="#searchClassic"
                                                data-unfold-type="css-animation"
                                                data-unfold-duration="300"
                                                data-unfold-delay="300"
                                                data-unfold-hide-on-scroll="true"
                                                data-unfold-animation-in="slideInUp"
                                                data-unfold-animation-out="fadeOut">
                                                <span class="ec ec-search"></span>
                                            </a>

                                            <!-- Input -->
                                            <div id="searchClassic" class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2" aria-labelledby="searchClassicInvoker">
                                                <form class="js-focus-state input-group px-3" id="search-mobile">
                                                    <input class="form-control" type="search" placeholder="Search Product" id="searchmobile">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary px-3" type="button"><i class="font-size-18 ec ec-search"></i></button>
                                                    </div>
                                                </form>
                                                <div class="resultMoble-search p-3" style="overflow: hidden;"></div>
                                            </div>
                                            <!-- End Input -->
                                        </li>
                                          <li class="col d-xl-none px-2 px-sm-3"><a id="sidebarNavToggler" href="javascript:;" 
                                            aria-controls="sidebarContent"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                            data-unfold-event="click"
                                            data-unfold-hide-on-scroll="false"
                                            data-unfold-target="#sidebarContent"
                                            data-unfold-type="css-animation"
                                            data-unfold-animation-in="fadeInRight"
                                            data-unfold-animation-out="fadeOutRight"
                                            data-unfold-duration="500"
                                            class="text-gray-90" data-toggle="tooltip" data-placement="top" title="" data-original-title="My Account"><i class="font-size-22 ec ec-user"></i></a></li>
                                        <!-- End Search -->
                                        <li class="col d-none d-xl-block col-md-auto">
                                            
                                    <div class="d-flex">
                                        <i class="ec ec-support font-size-50 text-primary"></i>
                                        <div class="ml-2">
                                            <div class="phone">
                                                <strong>Support</strong> <a href="tel:<?php echo $set['contactNum']; ?>" class="text-gray-90"><?php echo $set['contactNum']; ?></a>
                                            </div>
                                            <div class="email">
                                                E-mail: <a href="mailto:<?php echo $set['Email']; ?>?subject=Help Need" class="text-gray-90"><?php echo $set['Email']; ?></a>
                                            </div>
                                        </div>
                                    </div>

                                        </li>

                                                
                                        


                                         <?php 
                                                 $total_quantity = 0;
                                                 $total_amount = 0;
                                                 $cart = geCart($sessionId);
                                                // $size = "";
                                                 //$color = "";
                                                 if($cart){
                                                   foreach($cart as $cart_item){
                                                     $total_quantity += $cart_item['quantity'];
                                                     $total_amount += $cart_item['price']*$cart_item['quantity'];
                                                    // $size += $cart_item['size'];
                                                     //$color += $cart_item['color'];
                                                   }
                                                 }
                                                
                                               ?>
                                        <li class="col pr-xl-0 px-2 px-sm-3 icart">
                                            <a href="cart" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Cart">
                                                <i class="font-size-22 ec ec-shopping-bag"></i>
                                                <span class="width-22 height-22 bg-primary position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 bg-lg-down-black"><?php  echo $total_quantity; ?></span>
                                                <span class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3"><?php  echo $left_currency.number_format($total_amount).$right_currency; ?></span>
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                            <!-- End Header Icons -->
                        </div>
                    </div>
                </div>
                <!-- End Logo-Search-header-icons -->
            </div>
        </header>
        <!-- ========== END HEADER ========== -->