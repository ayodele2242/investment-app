<?php
header('Access-Control-Allow-Origin: *');

require 'inc/functions.php'; 

//if(isset($_POST['transId']) && !empty($_POST['reference'])){

$reference = safe_input($mysqli,$_POST['reference']);
$email     = safe_input($mysqli,$_POST['email']);
$date = date("m/d/y G.i:s", time());

$date = date("m/d/y G.i:s", time());

//get buys details



