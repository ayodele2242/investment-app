<?php
include('../inc/admins.php');
// Set your cookie before redirecting to the login page
setcookie("redirect","", time()-3600);
$current_page = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$expire=time() + (86400 * 30);
setcookie("redirect", $current_page, $expire, "/");


    require '../config/function.php';
    require '../class/database.php';
    //require '../inc/pagination.php';
    //require '../inc/class.pdf2text.php';
    require '../inc/Language/en.php';
    //require '../inc/functions.php';
    require '../class/category.php';

   
    $current_page = getCurrentPage();



$setSql = "SELECT * FROM store_setting";
$setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
$set = mysqli_fetch_array($setRes);
?>

<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="">
<meta name="keywords" content="admin, dashboard, eCommerce, analytic dashboard, ">
<meta name="author" content="Fagsoft">
<title>Admin Page</title>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Roboto:400,300,700,900|Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>


<!--<link rel="stylesheet" type="text/css" media="screen" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />-->

<link rel="stylesheet" type="text/css" href="../assets/default/main/css/vendors.min.css">
<link rel="stylesheet" type="text/css" href="../assets/default/main/css/mstepper.min.css">
<link rel="stylesheet" type="text/css" href="../assets/default/main/css/animate.css">
<link rel="stylesheet" type="text/css" href="../assets/default/main/css/chartist.min.css">
<link rel="stylesheet" type="text/css" href="../assets/default/main/css/chartist-plugin-tooltip.css">
<link rel="stylesheet" type="text/css" href="../assets/default/main/css/materialize.css">
<link rel="stylesheet" type="text/css" href="../assets/default/main/css/style.css">



<link rel="stylesheet" type="text/css" href="../assets/default/main/css/custom.css">
<link rel="stylesheet" type="text/css" href="../assets/default/main/css/jquery.mCustomScrollbar.css" />
<link rel="stylesheet" type="text/css" href="../assets/default/main/css/animate.min.css" />
<link rel="stylesheet" type="text/css" href="../assets/default/main/css/color.css">
<link rel="stylesheet" type="text/css" href="../assets/default/main/css/table.css">
<link rel="stylesheet" type="text/css" href="../assets/default/main/css/tabs.css">
<link rel="stylesheet" type="text/css" href="../assets/default/main/css/dropify.min.css">
<link rel="stylesheet" type="text/css" href="../assets/default/main/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="../assets/default/main/css/spectrum.css">
<link rel="stylesheet" type="text/css" href="../assets/default/main/css/docs.css">
 <link type="text/css" rel="stylesheet" href="../assets/default/main/css/responsive-tabs.css" />

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">








<!-- -->
<script type="text/javascript" src="../assets/js/jquery-1.11.1.min.js"></script>
<script src="../assets/js/jquery.countdown.min.js"></script>

<script src="../assets/default/main/js/spectrum.js"></script>
<script type='text/javascript' src='../assets/default/main/js/toc.js'></script>
<script type='text/javascript' src='../assets/default/main/js/docs.js'></script>
<!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script src="../assets/ckeditor/ckeditor.js"></script>
<script src="../assets/ckeditor/config.js"></script>




<style>

.imsg{
    padding: 20px;
    margin-bottom: 10px;
    margin-top: 10px;
}

	._mCS_1 .mCSB_dragger .mCSB_dragger_bar{ background-color: black; }
._mCS_1 .mCSB_dragger .mCSB_dragger_bar:hover,
._mCS_1 .mCSB_dragger .mCSB_dragger_bar:active{ background-color: blue; }

._mCS_2 .mCSB_dragger .mCSB_dragger_bar{ background-color: green; }

#mCSB_3_dragger_vertical .mCSB_dragger_bar{ background-color: blue; }

#mCSB_1_scrollbar_vertical .mCSB_dragger{ height: 60px; }

#mCSB_1_scrollbar_horizontal .mCSB_dragger{ width: 100px; }

.mCSB_1_scrollbar .mCSB_dragger .mCSB_draggerRail{ width: 12px; }
.mCSB_1_scrollbar .mCSB_dragger .mCSB_draggerRail:hover{ width: 9px; background-color: blue; }
}

.page-wrapper
{
width:1000px;
margin:0 auto;
}


.mtabs {
position: relative;
min-height: 740px;
/* This part sucks */
clear: both;
margin: 25px 0;
}

.tab {
float: left;
}

.tab label {
background: #eee;
padding-bottom: 10px;
padding-top: 10px;
padding-left: 10px;
padding-right: 10px;
border: 1px solid #ccc;
margin-left: -1px;
position: relative;
left: 1px;
}

.tab [type="radio"] {
opacity: 0;
}

.contents {
position: absolute;
top: 30px;
left: 0;
background: white;
right: 0;
bottom: 0;
padding: 5px;
padding-bottom: 20px;
border: 1px solid #ccc;
overflow: hidden;
}

.contents > * {
opacity: 0;
transform: translateX(-100%);
transition: all 0.6s ease;
}

[type="radio"]:focus ~ label {
ouline: 2px solid blue;
}

[type="radio"]:checked ~ label {
background: white;
border-bottom: 1px solid white;
z-index: 2;
}

[type="radio"]:checked ~ label ~ .contents {
z-index: 1;
}

[type="radio"]:checked ~ label ~ .contents > * {
opacity: 1;
transform: translateX(0);
}

::placeholder{
color: #000;
font-weight: bold;
}
label{
font-size: 14px;
font-weight: bolder;
color: #000;
}

.form-group > input[type=text], 
.form-group > input[type=password], 
.form-group > input[type=number], 
.form-group > textarea,
table > tr > td > input[type=text], 
table > tr > td > input[type=password], 
table > tr > td > input[type=number], 
table > tr > td > textarea,
input.textinput, .mselect, .mselect *, .mselect option {
    -webkit-transition: width 0.5s ease-in-out;
    transition: width 0.5s ease-in-out;
     box-sizing: border-box;
    padding-left: 5px;
    border: solid 2px #666666;
    height: 40px;
}
.modalbox  {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
    transition: 0.5s all !important
}

.modalbox .modal-content {
    border-radius: 0;
    border: 0;
    height: 100vh;
    margin: auto;
    overflow: auto;
    padding-top: 20px
}

.modalbox .modal-dialog .modal-content .modal-header {
    border: 0;
    padding: 0;
    min-height: 56px;
    padding: 10px 16px;
    border-radius: 0;
    display: flex;
    border-bottom: 1px solid #DCDCE9;
    align-items: center;
    justify-content: space-between;
    margin: 0;
    position: fixed;
    left: 0;
    right: 0;
    top: 0;
    width: 100%;
    z-index: 100;
    background: #FFF
}

.modalbox .modal-dialog .modal-content .modal-header .modal-title {
    margin: 0;
    color: #27173E;
    font-size: 17px
}

.modalbox .modal-dialog .modal-content .modal-body {
    padding: 20px 16px;
    min-height: calc(100vh - 56px);
    overflow: auto
}

.modalbox.show .modal-dialog {
    transform: translate(0, 0) !important
}

.modal-full {
    min-width: 100%;
    margin: 0;
}

.modal-full .modal-content {
    min-height: 100vh;
}
</style>




<script type="text/javascript">
$(window).load(function() {
$(".page-loader-wrapper").fadeOut("slow");
});




</script>

<script>
/*tinymce.init({
selector : '#richTextArea',
plugins : 'image',
toolbar : 'image',

images_upload_url : 'upload.php',
automatic_uploads : false,

images_upload_handler : function(blobInfo, success, failure) {
var xhr, formData;

xhr = new XMLHttpRequest();
xhr.withCredentials = false;
xhr.open('POST', 'upload.php');

xhr.onload = function() {
var json;

if (xhr.status != 200) {
failure('HTTP Error: ' + xhr.status);
return;
}

json = JSON.parse(xhr.responseText);

if (!json || typeof json.file_path != 'string') {
failure('Invalid JSON: ' + xhr.responseText);
return;
}

success(json.file_path);
};

formData = new FormData();
formData.append('file', blobInfo.blob(), blobInfo.filename());

xhr.send(formData);
},
});*/
</script>

<style type="text/css">
.danger{
background: #ff4444;
color: #ffffff;
}
</style>



</head>



<!-- END: Head-->
<body id="welcomeText" class="vertical-modern-menu" >

<!-- Page Loader -->
<div class="page-loader-wrapper anim" style="background:none;">
<div class="loader">
<p>
<a class="btn btn-floating pulse btn-large">

</a>
</p>
</div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->