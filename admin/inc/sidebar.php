        <div class="col-md-3 left_col">
          <div class="left_col scroll-view sfixed">
            <div class="navbar nav_title" style="border: 0;">
              <a href="dashboard" class="site_title"><i class="fa fa-paw"></i> <span>Admin Panel</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
           
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu " >
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="banner">Banner</a></li>
                      <li><a href="pages">Pages</a></li>
                     
                    </ul>
                  </li>
                  <li><a><i class="fa fa-list"></i> Categories<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     
                      <li><a href="category">List Category</a></li>
                     
                    </ul>
                  </li>
                  <li><a><i class="fa fa-product-hunt"></i> Products<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="product_add">Add Product</a></li>
                      <li><a href="product">List Product</a></li></ul></li>
                  
                  <li><a><i class="fa fa-shopping-cart"></i> Orders<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     
                      <li><a href="orders.php">Pending Orders</a></li>
                      <li><a href="to_be_delivered">Orders Awaiting Delivery</a></li>
                       <li><a href="delivered_products">Delivered Products</a></li>
                      
                    </ul>
                  </li>

                  <li><a><i class="fa fa-users"></i>Users Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="login_users.php">Users List</a></li>
                    </ul>
                  </li> 

                  <li><a href="vendors.php"><i class="fa fa-users"></i> Vendors Management</a></li> 

                  <li><a><i class="fa fa-dollar"></i>Advertisement<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     <li><a href="ads">Ads List</a></li>
                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-cogs"></i>Store Settings<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     <li><a href="store_details">Store Details</a></li>
                     <li><a href="currency_setting">Currency Setting</a></li>
                      
                    </ul>
                  </li>



                   
                 </ul> 
                 </div>
                 </div> 
               </div>
              </div>
    <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php 
                    echo $_SESSION['name'];?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                      <li><a href="../"><i class="fa fa-sign-out pull-right"></i> Visit Website</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->               