<?php
 
  require_once '../inc/config.php';
  require_once '../config/function.php';
  require_once '../class/database.php';
  require_once '../class/category.php';
  require_once '../class/banner.php';
  require_once '../class/product.php';

  require_once '../class/ads.php';
  require_once '../class/login_register.php';
  require_once '../inc/fetch.php';
  require_once  '../inc/functions.php';


  if(!empty($right_currency)){
    $right_currency = $right_currency;
  }else{
    $right_currency='';
  }
  if(!empty($left_currency)){
    $left_currency = $left_currency;
  }else{
    $left_currency='';
  }

  //$category = new Category();
  //$product = new Product();
  

  
  //debugger($login_in_fo,true);
  $current_page = getCurrentPage();
//debugger($current_page);
//exit;
  $category = new Category();
  $parent_cats = $category->getAllParentCats();

  $product = new Product();

$latest_product = $product->getLatestProduct();

/**/
$banner = new Banner();

$banner_info = $banner->getBannerForHome(25);

$ads = new Ads();
$ads_info = $ads->getAdsForHome(3);


//$category->getCategoryById($parent_id);
// $PublicIP = get_client_ip();
 //$a = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$PublicIP));
 if(isset($_SESSION['email'])){
 $email = $_SESSION['email'];
 $query = mysqli_query($mysqli,"SELECT * FROM customer_login WHERE email='$email'");
 $urow = mysqli_fetch_array($query);

//get user saved card

$cquery = mysqli_query($mysqli,"SELECT * FROM card_details WHERE email='$email'");
$card = mysqli_fetch_array($cquery);


//let see if this user has money in his/her wallet
$wquery = mysqli_query($mysqli, "select amount_saved from savings_history where email = '$email' ");
$wallet = mysqli_fetch_array($wquery);

 }
 
define('url', 'https://akawocommunity.com/shop');
$sessionId = session_id();
 ?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Title -->
        <title><?php 
    if((isset($current_page)) && $current_page == 'index'){ echo "Akawo Store - No 1 online store for anything home and office"; }else{
    echo (isset($current_page)) ? ucwords(str_replace('_', ' ', $current_page)) : SITE_TITLE;
    } ?></title>

        <!-- Required Meta Tags Always Come First -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo $set['installUrl'] ?>assets/logo/<?php echo $set['logo']; ?>">
         <meta property="og:site_name" content="<?php echo $set['storeName'] ?>">
          <meta property="og:url" content="">
          <meta property="og:title" content="<?php echo $set['storeName'] ?>">
          <meta property="og:type" content="website">
          <meta property="og:description" content="<?php echo $set['storeName'] ?>">
          <meta name="twitter:card" content="summary_large_image">
          <meta name="twitter:title" content="<?php echo $set['storeName'] ?>">
          <meta name="twitter:description" content="<?php echo $set['storeName'] ?>">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap">
        <!-- CSS Implementing Plugins -->
        <link rel="stylesheet" href="assets/vendor/font-awesome/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/css/font-electro.css">
        
        <link rel="stylesheet" href="assets/vendor/animate.css/animate.min.css">
        <link rel="stylesheet" href="assets/vendor/hs-megamenu/src/hs.megamenu.css">
        <link rel="stylesheet" href="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
        <link rel="stylesheet" href="assets/vendor/fancybox/jquery.fancybox.css">
        <link rel="stylesheet" href="assets/vendor/slick-carousel/slick/slick.css">
        <link rel="stylesheet" href="assets/css/ion.rangeSlider.css">
        <link rel="stylesheet" href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/default/main/css/color.css" />

        <!-- CSS Electro Template -->
        <link rel="stylesheet" href="assets/css/theme.css">
         <link href="assets/css/modal.css" rel="stylesheet" type="text/css" media="all">
         <link href="assets/css/rating.css" rel="stylesheet" type="text/css" media="all">
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css" media="all">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css" rel="stylesheet" type="text/css" media="all"> 
         <link href="frontpage/scrollbar.css" rel="stylesheet" type="text/css" media="all">
         <link href="frontpage/jquery-ui.css" rel="stylesheet">
         <link rel="stylesheet" href="frontpage/card.css">
         <link href="frontpage/jquery.toast.min.css" rel="stylesheet">

         

       

        <style type="text/css">
            .i-flex{
              display: flex;
            }

             .iflex{
              display: flex;
            }

            #left {
              flex: 1;
            }
            #ileft {
              flex: 1;
              padding-top: 14px;
            }

            #right {
              flex: 0 0 65%;
              padding-top: 10px;
            }
            #right p{
              font-size: 10px;
              font-weight: bold;
            }
            #right strong{
              font-size: 16px;
              font-weight: bolder;
            }
            .icon-img{
                width: 100%;
                max-width: 60px;
                height: 100%;
                max-height: 60px;
            }
             .loadingCategories{
        font-weight: bold;
        padding: 10px;
        height: 100%;
        min-height: 200px;
        margin: 0 auto;
        margin-bottom: 10px;
        background: url(gif/load-sm.gif) no-repeat center center;  
        text-align: center;
        display: block;
      }

      .loadingOverlay{
        font-weight: bold;
        padding: 10px;
        height: 100%;
        max-height: 500px;
        width: 100%
        max-width: 500px;
        margin: 0 auto;
        margin-bottom: 10px;
        background: url(gif/load-sm.gif) no-repeat center center;  
        text-align: center;
        display: block;
      }

     /* .loadingProducts {
        font-weight: bold;
        padding: 10px;
        margin: 0 auto;
        height: 100%;
        min-height: 200px;
        margin-bottom: 10px;
        background: url(gif/house-loading.gif) no-repeat center center;  
        text-align: center;
        display: block;
      }*/

      .btn-wishlist{
     
    width: 40px;
    height: 40px;
    border-radius: 100%;
    background-color: red;
    font-size: 24px;
    color: #fff;
    display: flex;
    transition:color 0.25s ease-in-out;
    border: none;
    justify-content: center;
    align-items: center;

  }
  .btn-wishlist:hover{
    background-color: rgb(192, 94, 94);
    transition: all .3s ease 0s 
  }

  .btn-circle{
     
    width: 40px;
    height: 40px;
    border-radius: 100%;
    background-color: #004D40;
    font-size: 24px;
    color: #fff;
    display: flex;
    transition:color 0.25s ease-in-out;
    border: none;
    justify-content: center;
    align-items: center;

  }

.progress-bar-success {
  background-color: #4CAF50;
}
       
.progress-bar-blue{
    background-color: #0D47A1;
}
.progress-bar-primary{
    background-color: #B0BEC5;
}
.progress-bar-yellow{
    background-color: #FF8F00;
}
.progress-bar-red{
    background-color: #DD2C00;
}

#result-ajax-search, .resultMoble-search{
  position: absolute;
  z-index: 103;
  width: 100%;
  max-width: 500px;
  background: #fff;
}
        </style>
    </head>

    <body>