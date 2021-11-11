<?php
//require_once '../config.php';
require_once '../functions.php';


$email = safe_input($mysqli,$_POST['email']);
$password = encryptIt($_POST['password']);
$sql = "
SELECT 
id, 
email, 
password,
last_name,
first_name,
status
FROM 
customer_login 
WHERE 
email = '$email' 
AND password='$password'";


$resultset = mysqli_query($mysqli, $sql) or die("database error:". mysqli_error($mysqli));

$row = mysqli_fetch_array($resultset);



if($row['password']==$password AND $row['email']==$email AND $row['status']=='1'){
echo "ok";

$_SESSION['uid'] = $row['id'];
$_SESSION['login_id'] = $row['id'];
$_SESSION['email'] = $row['email'];
$name            = $row['last_name'] . ' ' .$row['first_name'] ;

$user_ip 		 = getUserIP();
$tv 			 = time();
$id 			 = $_SESSION['uid'];

//$date            = date("Y-m-d H:i");
$time 			 = time();

$arr_browsers = ["Opera", "Edg", "Chrome", "Safari", "Firefox", "MSIE", "Trident"];                             
$agent = $_SERVER['HTTP_USER_AGENT'];
$user_browser = '';
foreach ($arr_browsers as $browser) {
if (strpos($agent, $browser) !== false) {
$user_browser = $browser;
break;
}   
}

switch ($user_browser) {
case 'MSIE':
$user_browser = 'Internet Explorer';
break;

case 'Trident':
$user_browser = 'Internet Explorer';
break;

case 'Edg':
$user_browser = 'Microsoft Edge';
break;

case 'Chrome':
$user_browser = 'Chrome';
break; 
case 'Safari':
$user_browser = 'Safari';
break;  
case 'Firefox':
$user_browser = 'Firefox';
break;          
}
                                                      
//echo "You are using ".$user_browser." browser";
$date = date('j M, Y h:i:s A');
mysqli_query($mysqli,"insert into users_log(user_id,browser,ip,log_time,sec_log)values('$id','$user_browser','$user_ip','$date','$time')");


}else if($row['password']==$password AND  $row['email']==$email AND $row['status'] == '0' ){
echo "i";
}	
else if($row['password']==$password AND  $row['email']==$email AND $row['status'] == '2'){
echo "s";
}else {
echo " Invalid login details entered"; // wrong details
}


?>