<?php 
include('inc/config.php');
require_once 'config/function.php';


$setSql = "SELECT * FROM store_setting";
$setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
$set = mysqli_fetch_array($setRes);
define('url', $set['installUrl']);
$current_page = getCurrentPage();

 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="keywords" content="crypto, <?php echo $set['keywords']; ?>">
    <meta name="author" content="Creativegigs">
    <meta name="description" content="<?php echo $set['descr']; ?>">
    <meta name='og:image' content='<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?>'>
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- For Resposive Device -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $set['storeName']; ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="56x56" href="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?>">

    <!-- Main style sheet -->
    <link rel="stylesheet" type="text/css" href="front/style.css">
    <!-- responsive style sheet -->
    <link rel="stylesheet" type="text/css" href="front/responsive.css">
    <!-- Color Css -->
    <link rel="stylesheet" type="text/css" href="front/color-one.css">


    <style type="text/css">
      ul.servy{
        list-style-type: none;
        margin: 0;
        padding: 0;
      }
      ul.servy li{
        display: inline-block;
        margin: 10px;
      }
     ul.servy > li > .bullety{
        display: inline;
        width: 15px;
        height: 15px;
        border-radius: 100%;
        background: #880E4F;
        z-index: 10;
      }

      ol.ilist {
  display: block;
  list-style-type: none;
  margin-top: 1em;
  margin-bottom: 1em;
  margin-left: 0;
  margin-right: 0;
  padding-left: 40px;
}ol.ilist li{
  text-decoration: none;
  padding: 10px;
}

ul.mul{
  padding-left: 2rem;
  list-style-type: none;
}

ul.mul li{
  padding-left: 2rem;
  background-image: url(front/images/triangle.png);
  background-position: left;
  background-size: 1.0rem 1.0rem;
  background-repeat: no-repeat;
}
    </style>
      
  </head>

  <body>
    <div class="main-page-wrapper">


      <!-- ********************** Loading Transition ************************ -->
      <div id="loader-wrapper">
        <div id="loader"></div>
      </div>

      <div class="html-top-content">
        <!-- ********************** Theme Top Banne & Header ************************ -->
        <div class="theme-top-section">
          <!-- ^^^^^^^^^^^^^^^^^ Theme Menu ^^^^^^^^^^^^^^^ -->
          <header class="theme-main-menu">
            <div class="container">
              <div class="menu-wrapper clearfix">
                <div class="logo"><a href="<?php echo url; ?>"><img src="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?>" alt="Logo" style="width: 100%; max-width: 100px;  height: 100%; max-height: 100px;"></a></div>
                
                <ul class="right-widget celarfix">
                   <li class="login-button"><a href="login-signup" style="margin-right: 10px; color: #02d4b5;">Start saving <i class="flaticon-right-thin"></i></a></li>
                  <li class="login-button"><a href="<?php echo url ?>shop/" style="background: #02d4b5; color: #fff">Go to Store <i class="flaticon-right-thin" style="color: #fff;"></i></a></li>
                </ul> <!-- /.right-widget -->


                <!-- Navigation -->
                  <nav class="navbar navbar-expand-lg" id="mega-menu-holder">
                    <div class="container">
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav">
                          <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="">Home</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#features">About</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#services">Services</a>
                          </li>
                         <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#progress">How It Works</a>
                          </li>
                         
                          <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#contact">Contact us</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </nav>
              </div> <!-- /.menu-wrapper -->
            </div> <!-- /.container -->
          </header> <!-- /.theme-main-menu -->
          


        

