<?php
include("functions.php");
if(!isset($_SESSION['uid'])){
    redirect('../login-signup');
}else{ 
error_reporting(0);	
$msgBox = '';
$activeAccount = '';
$nowActive = '';  


$t = date("Y-m-d H:i:s");
$tv = time(); 

$id = $_SESSION['uid'];
$user = mysqli_query($mysqli, "select * from customer_login where id='$id' ");
$d = mysqli_fetch_assoc($user);
$acno = $d['account_number'];
$name  = $d['last_name'].' '.$d['first_name'];
$uname = $d['lname'];
$email = $d['email'];
$refCode  =  $d['referral_code'];
//$_SESSION["rolecode"] = $d['u_rolecode'];
//$tel   = $d['phone'];

$_SESSION['name'] = $name;
$_SESSION['uname'] = $uname;

$ac_code = $d['bank_code'];


$neverText = '';

//Get country from currency table
$currency = mysqli_query($mysqli, "select country_name,currency_position from currency_setting ");
$country = mysqli_fetch_assoc($currency);
$cname = $country['country_name'];
$cpost = $country['currency_position'];
$ccode = $country['code'];


//get states name from states table
$state = mysqli_query($mysqli, "select name from states");
$cstate = mysqli_fetch_assoc($state);
$sname = $cstate['name'];
$_SESSION['state'] = $sname;


// Logout
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'logout') {
          session_unset();
        session_destroy();
         redirect('login/login');
    }
}

//get users privilege
//$mpri = mysqli_query($mysqli,"select ")

//get store settings details
$que = "select * from store_setting";
$our = mysqli_query($mysqli,$que);
$set = mysqli_fetch_array($our);
$country_name = $set['country'];
$_SESSION['stateName'] = $set['state'];



//Get user card detils
$uque = mysqli_query($mysqli,"select * from card_details where email='$email' limit 1");
$card = mysqli_fetch_array($uque);

//get referral details
$refquery = mysqli_query($mysqli,"SELECT SUM(amt) as totAmt, count(referred_by) as totReferred FROM referral WHERE referred_by='$refCode' AND user_made_pament='1'");
$refRow = mysqli_fetch_array($refquery);

//get emergency cashout
$eque = mysqli_query($mysqli,"select * from emergency_cashout where email='$email' ORDER BY id DESC LIMIT 1");
$ecashout = mysqli_fetch_array($eque);
$ecashoutCount = mysqli_num_rows($ecashout);

function currency(){
global $mysqli;
global $cname;
$cur="SELECT * FROM currency";
$run = mysqli_query($mysqli, $cur);
while ($row=mysqli_fetch_array($run)) {
    if($row['name'] == $cname){
        $selected = "selected";
    }else{
        $selected = "";
    }
    echo '<option value="'.$row['currency_symbol'].','.$row['name'].'" '.$selected.'>'.$row['name'].' ('.$row['code'].')   '. $row['currency_symbol'].'</option>';
      }

}

function getWithdrawals($email){
    global $mysqli;
    $query = "SELECT * FROM pending_withdrawal WHERE email='$email' ORDER BY id DESC ";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
    }


function getPlans(){
    global $mysqli;
    $query = "SELECT * FROM farm_packages ORDER BY category ASC ";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
    }


function getDailyGrowth($email){
    global $mysqli;
    $query = "SELECT distinct plan, daily_growth  FROM plans where email = '$email' and status = 'active' and exp_date > DATE(NOW()) and transId !=''";
    $result = mysqli_query($mysqli,$query);
    $resArr = array();
    while($row = mysqli_fetch_assoc($result)) {
      $resArr[] = $row;
    }
    return $resArr;   
    } 


	
}


?>