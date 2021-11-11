<?php
include('../inc/users.php');  

    $setSql = "SELECT * FROM store_setting";
    $setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
    $set = mysqli_fetch_array($setRes);


if(empty($d['img'])){
  $myimg  = $set['installUrl'].'assets/logo/avatar.png';
}else{
   $myimg = $set['installUrl'].'assets/images/'.$d['img'];
}
require("ifunctions.php");


?>

<!DOCTYPE html>
<html lang="zxx" class="js">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Softnio">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="<?php echo $set['descr']; ?>">
        <meta name="keywords" content="<?php echo $set['keywords']; ?>, <?php echo $name;  ?>">
        <meta name="author" content="Fagsoft">
        <link rel="shortcut icon" href="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?>">
        <title><?php echo $set['storeName']; ?> - <?php echo $name;  ?></title>
        <!--<link rel="stylesheet" href="assets/css/bootstrap.min.css">-->
        <link rel="stylesheet" href="assets/css/dashlite.css?ver=2.1.0">
        <link rel="stylesheet" href="assets/css/card.css">
        <link id="skin-default" rel="stylesheet" href="assets/css/theme.css?ver=2.1.0">
        <link rel="stylesheet" href="assets/css/placeholder-loading.css">
        <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.css">
        <link rel="stylesheet" type="text/css" href="../assets/default/main/css/dropify.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/default/main/css/docs.css">
        <link rel="stylesheet" href="datepicker/dist/mc-calendar.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />


        <script type="text/javascript" src="../assets/js/jquery-1.11.1.min.js"></script>
         <script src="../assets/js/jquery.countdown.min.js"></script>

         <script src="datepicker/dist/mc-calendar.min.js"></script>
         
        

        <style type="text/css">

           .datepicker-toggle {
          display: inline-block;
         
        }
        .datepicker-toggle-button {
          position: absolute;
          left: 0;
          width: 20px;
          height: 20px;
          /*background-image: url('data:image/svg+xml;base64,...');*/
        }

        .datepicker-input {
          position: absolute;
          left: 0;
          top: 0;
          width: 100%;
          max-width: 500px;
          min-width: 500px;
          opacity: 1;
          cursor: pointer;
          box-sizing: border-box;
        }


        .datepicker-input::-webkit-calendar-picker-indicator {
          position: absolute;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          margin: 0;
          padding: 0;
          cursor: pointer;
        }


            .card-img-top {
            width: 100%;
            height: 40vh;
            object-fit: cover;
            }
            .page-item{
                margin: 4px;
                
            }
            select {
  background-color: transparent;
  width: 100%;
  padding: 5px;
  border: none;
  border-radius: 2px;
  height: 2rem;
  border-bottom: 1px solid #9e9e9e;
}

.mselect, .mselect *, .mselect option {
    border: 0 !important;
    background: #fff;
  }

  .delete, .delete *, .delete option {
    background: #fff;
    color: #f0f0f0;
  }

     .mselect, .mselect:focus, .mselect:active,.mbtn,.mbtn:hover,.mbtn:focus{
      -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    appearance: none;
    outline: 0;
    box-shadow: none;
    background-image: none;
     }

.s-hidden {
    visibility:hidden;
    padding-right:10px;
}
.select {
    cursor:pointer;
    display:inline-block;
    position:relative;
    color:black;
    border:none;
}
        </style>
    </head>
    <body class="nk-body npc-invest bg-lighter ">
         <div class="nk-app-root">
            <div class="nk-wrap ">