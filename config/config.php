<?php 
 
 ob_start();
 session_start();
$sessionId = session_id();



 	//	error_reporting(0);
 		define('SITE_URL', 'https://www.buildit.com.ng/');
 		define('UPLOAD_DIR',$_SERVER['DOCUMENT_ROOT'].'/upload');
 		define('DB_HOST','localhost');
     	define('DB_USER','root');
     	define('DB_PWD','');
     	define('DB_NAME', 'akawo');

 		$dbhost = DB_HOST; 
		$dbuser = DB_USER;
		$dbpass = DB_PWD;
		$dbname = DB_NAME;
 	


    //Mysqli
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno()) {
	printf("MySQLi Database connection failed: ", mysqli_connect_error($mysqli));
	exit();
}

// Change character set to utf8
if (!$mysqli->set_charset('utf8')) {
	printf('Error loading character set utf8: %s\n', $mysqli->error);
}

//PDO
try{
		
	$db_con = new PDO("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpass);
	$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	echo $e->getMessage();
}


 	//Admin constants
 	
 	define('FORM_CSS',SITE_URL.'form/');
 	define('CMS_URL',SITE_URL.'cms/');
 	define('CMS_ASSETS', CMS_URL.'assets/');
 	define('CMS_TINYMCE',CMS_ASSETS.'tinymce/');
 	define('CMS_JS', CMS_ASSETS.'js/');
 	define('CMS_CSS', CMS_ASSETS.'css/');
 	define('CMS_IMAGES', CMS_ASSETS.'images/');
 	define('CMS_VENDORS', CMS_ASSETS.'vendors/');
	define('ADMIN_PAGE_TITLE','Ecommerce Admin');
//	define('ALLOWED_EXTENSION',array('jpg','jpeg','png','gif','bmp'));
	define('UPLOAD_URL', SITE_URL.'upload/');

//Front Constants
 	define('FRONT_ASSETS', SITE_URL.'assets/');
 	define('FRONT_JS', FRONT_ASSETS.'js/');
 	define('FRONT_CSS', FRONT_ASSETS.'css/');
 	define('FRONT_IMAGES', FRONT_ASSETS.'img/');
 	define('SITE_TITLE', 'Online Shopping Ecommerce');
 	define('KEYWORDS', 'Online Shopping, Ecommerce, buildit, buildit.com.ng, Online, Shopping');
 	define('DESCRIPTION', "Online ecommerce website for everyone.");




 ?>