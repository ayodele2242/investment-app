<?php 

    require '../config/config.php';
    require '../config/function.php';
    require '../class/database.php';
    //require '../inc/pagination.php';
    //require '../inc/class.pdf2text.php';
    require '../inc/Language/en.php';
    require '../inc/functions.php';
    require '../inc/admins.php';
    $current_page = getCurrentPage();

   
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo ADMIN_PAGE_TITLE;?> | <?php echo ($current_page == 'index') ? 'Login' : ucfirst($current_page);?> </title>

    <!-- Bootstrap -->
    <link href="<?php echo CMS_VENDORS;?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo CMS_VENDORS;?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo CMS_VENDORS;?>nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo CMS_CSS;?>custom.min.css" rel="stylesheet">
<?php 
  if($current_page != 'index'){
 ?>
    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ASSETS;?>main/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ASSETS;?>main/css/mstepper.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo FRONT_ASSETS;?>main/css/materialize.css">
	 <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ASSETS;?>main/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ASSETS;?>main/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ASSETS;?>main/css/chartist.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ASSETS;?>main/css/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="<?php echo FRONT_ASSETS;?>dropify/dist/css/dropify.min.css">
    
   
   <!-- <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ASSETS;?>main/css/dashboard-modern.css">-->
    <!--<link rel="stylesheet" type="text/css" href="../assets/default/main/css/form-wizard.css">-->
    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ASSETS;?>main/css/custom.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ASSETS;?>main/css/jquery.mCustomScrollbar.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ASSETS;?>main/css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ASSETS;?>main/css/color.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ASSETS;?>main/css/table.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FRONT_ASSETS;?>main/css/tabs.css">
    

    <link rel="stylesheet" href="<?php echo FRONT_ASSETS;?>main/css/jquery-ui.min.css">

    <style type="text/css">
        #msgs {
         
          height: auto;
          width: auto;
          position: fixed;
          text-align: center;
          justify-content: center;
          align-items: center;
          left: 50%;
          margin-left: -37.5%;
                }
        #msgs {
          z-index: 30;
        }
    </style>
   
<?php
}
?>
     

    <!-- -->
    <script type="text/javascript" src="<?php echo $set['installUrl']; ?>assets/js/jquery-1.11.1.min.js"></script>

<style type="text/css">
    
</style>




  </head>
  <body class="<?php echo ($current_page == 'index') ? 'login' : 'nav-md'; ?>">

    <div id="msgs"></div>