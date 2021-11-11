<?php 
include('inc/config.php');
include('config/function.php');
include('inc/fetch.php');
define('url', $set['installUrl']);
$current_page = getCurrentPage();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="description" content="<?php echo $set['descr']; ?>">
<meta name="author" content="<?php echo $set['storeName']; ?>">
<meta name="keyword" content="<?php echo $set['keywords']; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<link rel="canonical" href="<?php echo url; ?>" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Home - <?php echo $set['storeName']; ?>" />
<meta property="og:url" content="<?php echo $set['installUrl']; ?>" />
<meta property="og:site_name" content="<?php echo $set['storeName']; ?>" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="Home - <?php echo $set['storeName']; ?>" />

<meta name="theme-color" content="#0b2154" />
		<meta name="msapplication-navbutton-color" content="#0b2154" />
		<meta name="apple-mobile-web-app-status-bar-style" content="#0b2154" />

<title><?php echo $set['storeName']; ?></title>
<link rel="icon" href="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?>" type="image/png" sizes="16x16">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700&display=swap">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fontisto@v3.0.4/css/fontisto/fontisto.min.css">

<link rel="stylesheet" href="front/css/bootstrap.min.css" type="text/css" media="all" />

<link rel="stylesheet" href="front/css/animate.min.css" type="text/css" media="all" />

<link rel="stylesheet" href="front/css/owl.carousel.min.css" type="text/css" media="all" />
<link rel="stylesheet" href="front/css/owl.theme.default.min.css" type="text/css" media="all" />

<link rel="stylesheet" href="front/css/meanmenu.min.css" type="text/css" media="all" />

<link rel="stylesheet" href="front/css/magnific-popup.min.css" type="text/css" media="all" />

<link rel='stylesheet' href='front/css/boxicons.min.css' type="text/css" media="all" />

<link rel='stylesheet' href='front/css/line-awesome.min.css' type="text/css" media="all" />

<link rel='stylesheet' href='front/css/flaticon.css' type="text/css" media="all" />

<link rel="stylesheet" href="front/css/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="front/css/menus.css" type="text/css" media="all" />
<link rel="stylesheet" href="member/assets/css/bootstrap-datetimepicker.css">
<link href="shop/frontpage/jquery.toast.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" type="text/css" />


<link rel="stylesheet" href="front/css/responsive.css" type="text/css" media="all" />
 <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $set['installUrl']; ?>assets/js/jquery-1.11.1.min.js"></script>




<style type="text/css">

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

.header-right-widget {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 1;
}


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


  .ajax-loader {
  position: absolute;
  height: 100%; 
  max-height: 150px; 
  width: 100%; 
  max-width: 150px;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  margin: auto; /* presto! */
}
.col-grey {
  color: #9E9E9E !important; }
	 #msgs {
         
          height: auto;
          width: auto;
          position: fixed;
          text-align: center;
          justify-content: center;
          align-items: center;
          top:15%;
          right: 0;
          left: 0;
          /*margin-right: -39.5%;*/
                }
        #msgs {
          z-index: 1030;
        }

ol.ilist {
  background: #ff9999;
  padding: 20px;
}

ul.mul {
  background: #3399ff;
  padding: 20px;
}

ol.ilist li {
  background: #ffe5e5;
  padding: 5px;
  margin-left: 35px;
}

ul.mul li {
  background: #cce5ff;
  margin: 5px;
}


@charset "UTF-8";
/*! 
 * PikadayResponsive 
 * A responsive datepicker built on top of Pikaday. It shows the native datepicker on mobile devices and a nice JS-picker on desktop. 
 * 
 * @author: Francesco Novy 
 * @licence: MIT <https://www.opensource.org/licenses/mit-license.php> 
 * @link https://github.com/mydea/PikadayResponsive 
 * @copyright: (c) 2016 
 * @version: 0.6.7 
 */
/*!
 * Pikaday
 * Copyright © 2014 David Bushell | BSD & MIT license | http://dbushell.com/
 */
.pika-single {
  z-index: 9999;
  display: block;
  position: relative;
  color: #333;
  background: #fff;
  border: 1px solid #ccc;
  border-bottom-color: #bbb;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

/*
clear child float (pika-lendar), using the famous micro clearfix hack
http://nicolasgallagher.com/micro-clearfix-hack/
*/
.pika-single:before,
.pika-single:after {
  content: " ";
  display: table;
}

.pika-single:after {
  clear: both;
}

.pika-single {
  *zoom: 1;
}

.pika-single.is-hidden {
  display: none;
}

.pika-single.is-bound {
  position: absolute;
  box-shadow: 0 5px 15px -5px rgba(0, 0, 0, 0.5);
}

.pika-lendar {
  float: left;
  width: 240px;
  margin: 8px;
}

.pika-title {
  position: relative;
  text-align: center;
}

.pika-label {
  display: inline-block;
  *display: inline;
  position: relative;
  z-index: 9999;
  overflow: hidden;
  margin: 0;
  padding: 5px 3px;
  font-size: 14px;
  line-height: 20px;
  font-weight: bold;
  background-color: #fff;
}

.pika-title select {
  cursor: pointer;
  position: absolute;
  z-index: 9998;
  margin: 0;
  left: 0;
  top: 5px;
  filter: alpha(opacity=0);
  opacity: 0;
}

.pika-prev,
.pika-next {
  display: block;
  cursor: pointer;
  position: relative;
  outline: none;
  border: 0;
  padding: 0;
  width: 20px;
  height: 30px;
  /* hide text using text-indent trick, using width value (it's enough) */
  text-indent: 20px;
  white-space: nowrap;
  overflow: hidden;
  background-color: transparent;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: 75% 75%;
  opacity: 0.5;
  *position: absolute;
  *top: 0;
}

.pika-prev:hover,
.pika-next:hover {
  opacity: 1;
}

.pika-prev,
.is-rtl .pika-next {
  float: left;
  background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAeCAYAAAAsEj5rAAAAUklEQVR42u3VMQoAIBADQf8Pgj+OD9hG2CtONJB2ymQkKe0HbwAP0xucDiQWARITIDEBEnMgMQ8S8+AqBIl6kKgHiXqQqAeJepBo/z38J/U0uAHlaBkBl9I4GwAAAABJRU5ErkJggg==");
  *left: 0;
}

.pika-next,
.is-rtl .pika-prev {
  float: right;
  background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAeCAYAAAAsEj5rAAAAU0lEQVR42u3VOwoAMAgE0dwfAnNjU26bYkBCFGwfiL9VVWoO+BJ4Gf3gtsEKKoFBNTCoCAYVwaAiGNQGMUHMkjGbgjk2mIONuXo0nC8XnCf1JXgArVIZAQh5TKYAAAAASUVORK5CYII=");
  *right: 0;
}

.pika-prev.is-disabled,
.pika-next.is-disabled {
  cursor: default;
  opacity: 0.2;
}

.pika-select {
  display: inline-block;
  *display: inline;
}

.pika-table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  border: 0;
}

.pika-table th,
.pika-table td {
  width: 14.2857142857%;
  padding: 0;
}

.pika-table th {
  color: #999;
  font-size: 12px;
  line-height: 25px;
  font-weight: bold;
  text-align: center;
}

.pika-button {
  cursor: pointer;
  display: block;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  outline: none;
  border: 0;
  margin: 0;
  width: 100%;
  padding: 5px;
  color: #666;
  font-size: 12px;
  line-height: 15px;
  text-align: right;
  background: #f5f5f5;
}

.pika-week {
  font-size: 11px;
  color: #999;
}

.is-today .pika-button {
  color: #33aaff;
  font-weight: bold;
}

.is-selected .pika-button {
  color: #fff;
  font-weight: bold;
  background: #33aaff;
  box-shadow: inset 0 1px 3px #178fe5;
  border-radius: 3px;
}

.is-inrange .pika-button {
  background: #D5E9F7;
}

.is-startrange .pika-button {
  color: #fff;
  background: #6CB31D;
  box-shadow: none;
  border-radius: 3px;
}

.is-endrange .pika-button {
  color: #fff;
  background: #33aaff;
  box-shadow: none;
  border-radius: 3px;
}

.is-disabled .pika-button {
  pointer-events: none;
  cursor: default;
  color: #999;
  opacity: 0.3;
}

.pika-button:hover {
  color: #fff;
  background: #ff8000;
  box-shadow: none;
  border-radius: 3px;
}

/* styling for abbr */
.pika-table abbr {
  border-bottom: none;
  cursor: help;
}


.pikaday__container {
  display: inline-block;
  position: relative;
}

/* Height and width has to be equal! */
.pikaday__display, .pikaday__invisible {
  width: 100%;
}

.pikaday__display--native {
  pointer-events: none;
  cursor: pointer;
}

.pikaday__display.is-invalid {
  background: rgba(255, 0, 0, 0.05);
}

.pikaday__invisible {
  opacity: 0;
  color: transparent;
  background: transparent;
  border: none;
  box-shadow: none;
  position: absolute;
  display: block;
  left: 0;
  top: 0;
  height: 100%;
  width: 100%;
}
</style>




</head>
<body class="trans-section">

  