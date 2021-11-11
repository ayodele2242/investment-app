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
<html lang="zxx">

<head>
    <meta charset="UTF-8">
     <meta name="keywords" content="crypto, <?php echo $set['keywords']; ?>">
    <meta name="author" content="Creativegigs">
    <meta name="description" content="<?php echo $set['descr']; ?>">
    <meta name='og:image' content='<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?>'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $set['storeName']; ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="56x56" href="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?>">



    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="default/css/style.css">

    <!-- Responsive Stylesheet -->
    <link rel="stylesheet" href="default/css/responsive.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
 ol.my-order-list{
    list-style-type: none;
 }

 ol.my-order-list li{
    list-style-type: none;
    margin-bottom:13px;
 }

 ol.my-order-list li strong{
    display: block;
    margin-bottom: 10px;
 }

  ol.my-order-list li strong span {
  display:inline-flex;
  align-items:center;
  justify-content:center;
  margin-right: 15px;
  font-size: 13px;
  width:35px;
  height:35px;
  border-radius:50%;
  background-color:#0D47A1;
  color:#fff;
}

ul.bolder li{
    font-weight: bold;
}


ul.child-list {
  padding-left: 2rem;
  list-style-type: none;
}

ul.child-list li {
  padding-left: 2rem;
  background-image: url(front/images/check.png);
  background-position: left;
  background-size: 14px;
  background-repeat: no-repeat;
}

.inum{
     display:inline-flex;
  align-items:center;
  justify-content:center;
  margin-right: 15px;
  font-size: 16px;
}

 .goog-te-banner-frame.skiptranslate {
            display: none !important;
        } 
        body {
            top: 0px !important; 
        }
        .goog-logo-link {
            display:none !important;
        }


.header-right-widget {
  color: #fff !important;
}


 .header-right-widget,
.header-right-widget .social-icon li a {
    transition: all .3s ease-in-out;
}

/*.header-right-widget {
    position: absolute;
    top: 52px;
    right: 60px;
    z-index: 1;
}*/


.header-right-widget>ul>li {
    display: inline-block;
    vertical-align: middle;
}

.header-right-widget .language-switcher button {
    background: transparent;
    height: 40px;
    border: none;
    color: white;
    text-transform: uppercase;
    color: #233D63;
    font-size: 16px;
    margin: 0 45px 0 40px;
}

.header-right-widget .language-switcher .dropdown-menu {
    min-width: 170px;
    padding: 10px 0;
    color: #fff !important;
    background: #fff;
    box-shadow: 0px 25px 50px 0px rgba(213, 216, 223, 0.5);
    border: 1px solid #f8f8f8;
    border-radius: 0;
}

.header-right-widget .language-switcher .dropdown-menu ul li a {
    display: block;
    padding: 0 15px;
    font-size: 15px;
    color: #767a89;
    line-height: 35px;
    text-transform: uppercase;
}

.skiptranslate {
    display: none !important;
}

.header-right-widget .language-switcher .dropdown-menu ul li a:hover {
    padding-left: 20px;
}

.header-right-widget .language-switcher .dropdown-toggle::after {
    color: #fff;
}

.header-right-widget .call-us {
    font-size: 20px;
    color: #A2ADBD;
}

.header-right-widget .call-us a {
    font-size: 24px;
    margin-left: 15px;
}
    </style>




</head>

<body class="light-version">
    <!-- Preloader -->
    <div id="preloader">
        <div class="preload-content">
            <div id="loader-load"></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <nav class="navbar navbar-expand-md navbar-white fixed-top" id="banner">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand mobile-hide" href="<?php echo url; ?>"><span><img src="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?>" alt="logo" style="width: 100%; max-width: 140px;  height: 100%; max-height: 70px;"></span></a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="<?php echo url; ?>">Home</a>
                       
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about-us">About Us</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="faq">FAQ</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="contact-us">Contact</a>
                    </li>
                    <a href="login-signup" class="btn login-btn mr-im login-last">Log in / Signup</a>
                   
                </ul>

                    
            </div>
            <div class="header-right-widget">
                    <ul>
                       
                        <li class="language-switcher">
                            <div class="dropdown">
                                <button type="button" class="dropdown-toggle" data-toggle="dropdown" style="color: #fff;">
                                    En
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="ct-language__dropdown">
                                        <li><a href="#googtrans(en|en)" class="lang-en lang-select" data-lang="en"><span class="flag-icon flag-icon-us"></span> English</a></li>
                                        <li><a href="#googtrans(en|pt)" class="lang-es lang-select" data-lang="pt"><span class="flag-icon flag-icon-pt"></span> Portugal</a></li>
                                        
                                        <li><a href="#googtrans(en|es)" class="lang-es lang-select" data-lang="es"><span class="flag-icon flag-icon-es"></span> Mexico</a></li>
                                        <li><a href="#googtrans(en|fr)" class="lang-es lang-select" data-lang="fr"><span class="flag-icon flag-icon-fr"></span> France</a></li>
                                        <li><a href="#googtrans(en|zh-CN)" class="lang-es lang-select" data-lang="zh-CN"><span class="flag-icon flag-icon-cn"></span> China</a></li>
                                        <li><a href="#googtrans(en|de)" class="lang-es lang-select" data-lang="de"><span class="flag-icon flag-icon-de"></span> German</a></li>
                                        <li><a href="#googtrans(en|hi)" class="lang-es lang-select" data-lang="hi"><span class="flag-icon flag-icon-in"></span> Hindi</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        
                    </ul>
                </div> <!-- /.header-right-widget -->
        </div>
    </nav>
    <!-- ##### Header Area End ##### -->
