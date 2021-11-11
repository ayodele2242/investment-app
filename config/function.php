<?php

function debugger($data, $is_die=false){
	echo "<pre style='color: #FF0000;'>";
	print_r($data);
	echo "</pre>";
	if($is_die){
		exit;
	}
}

function getCurrentPage(){
	$current_uri = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
	return $current_uri;
}

function getCurrentPageUrl(){
	$query_string = $_SERVER['QUERY_STRING'];

	$url = SITE_URL.getCurrentPage();
	if($query_string != ""){
		$url .= "?".$query_string;
	}
	return $url;
}

function setFlash($status, $message){
	  if (!isset($_SESSION)) {
	  	session_start();
	  }
	  $_SESSION[$status] = $message;
}
 
 function getFlash(){
 	if (isset($_SESSION['success']) && $_SESSION['success']!="") {
 		 echo '<p class="alert alert-success">' .$_SESSION['success'].'</p>';
 		 unset($_SESSION['success']);
 	}
 	if(isset($_SESSION['error']) && $_SESSION['error']!=""){
 		echo '<p class="alert alert-danger">'.$_SESSION['error'].'</p>';
 		unset ($_SESSION['error']);
 	}
 	if(isset($_SESSION['warning']) && $_SESSION['warning']!=""){
 		echo '<p class="alert alert-warning">'.$_SESSION['warning'].'</p>';
 		unset ($_SESSION['warning']);

 }

 		if(isset($_SESSION['info']) && $_SESSION['info']!=""){
 		echo '<p class="alert alert-info">'.$_SESSION['info'].'</p>';
 		unset ($_SESSION['info']);
 	}
 }


 function addSlash($str){
 	$str = stripslashes($str);
 	$str = addslashes($str);
 	$str = htmlentities($str);
 	return $str;
 }
function sanitize($string){
 global $conn;
 return mysqli_real_escape_string($conn, $string);
}

 function uploadSingleImage($file, $path, $default_file = null){
 	if ($file['error'] == 0) {
 		$allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
    );
 		$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
 		if (in_array(strtolower($ext), $allowed_image_extension)) {
 			$destination = UPLOAD_DIR.'/'.$path;
 			if (!is_dir($destination)) {
 				mkdir($destination, '0777', true);
 			}
 			$filename=ucfirst($path).'-'.time().rand(0,999).'.'.$ext;
 			$success =move_uploaded_file($file['tmp_name'], $destination.'/'.$filename);
 			if($success){
 				if($default_file != null && file_exists($destination.'/'.$default_file)){
 					unlink($destination.'/'.$default_file);
 				}
 					return $filename;
 				}else{
 					return null;
 				}
 			}else{
 				return null;
 			}
 		}else{
 			return $default_file;
 		}
 	}
 function deleteImage($file_name, $location){
 	$f_name = explode(",", $file_name);
 	$success= false;
 	$i = 0;

 	while ($i < count($f_name)) {
 		$path = UPLOAD_DIR."/".$location."/".$f_name[$i];
 		
 	if (file_exists($path) && $path != "") {
 		$success = unlink($path);
 	}
 	
 		$i++;
 	}
 	return $success;
 	}

 function uploadMultipleFiles($files, $path,$default_file=null){
 	if (isset($files) && $files['error'][0] == 0) {
 		$upload_dir = UPLOAD_DIR."/".$path;
 		if (!is_dir($upload_dir)) {
 			mkdir($upload_dir, '0777', true);
 		}
 		$temp = array();
 		$allowed = array('gif', 'png', 'jpg');
 		for ($i=0; $i <count($files['name']) ; $i++) { 
 			$ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
 			if (in_array(strtolower($ext), $allowed)) {
 				$file_name = ucfirst($path)."-".time().rand(0, 999).".".$ext;
 				$success = move_uploaded_file($files['tmp_name'][$i], $upload_dir."/".$file_name);
 				if($success){
 					$temp[] = $file_name;
 				}
 			}
 		}
 		if ($default_file !="") {
 			$pre_files=explode(",", $default_file);
 		
 		if(file_exists($upload_dir.'/'.$pre_files[0])){
 		$i=0;
 		while($i<count($pre_files)){
 			$temp[]=$pre_files[$i];
 			$i++;
 		}
 		}}
 		return $temp;
 	}else{
 		return false;
 	}
 }
 
 function searchArray($array, $key, $value){
	$array_iteration = new RecursiveIteratorIterator(new RecursiveArrayIterator($array));

	$output = array();

	foreach($array_iteration as $sub_array){
		$sub = $array_iteration->getSubIterator();
		if($sub[$key] == $value){
			$output[] = iterator_to_array($sub);
		}
	}

	return $output;
}


function search($array, $search_list) { 
  
    // Create the result array 
    $result = array(); 
  
    // Iterate over each array element 
    foreach ($array as $key => $value) { 
  
        // Iterate over each search condition 
        foreach ($search_list as $k => $v) { 
      
            // If the array element does not meet 
            // the search condition then continue 
            // to the next element 
            if (!isset($value[$k]) || $value[$k] != $v) 
            { 
                  
                // Skip two loops 
                continue 2; 
            } 
        } 
      
        // Append array element's key to the 
        //result array 
        $result[] = $value; 
    } 
  
    // Return result  
    return $result; 
} 

//count rating and review
function review($id)
{
    global $mysqli;
    $sql = "SELECT COUNT(*) FROM review_rating where product_id='$id'";
    if ($result=mysqli_query($mysqli, $sql)){
        $row= mysqli_fetch_array($result);
        $rowcount = $row[0];
        mysqli_free_result($result);
    }
    return $rowcount;
}


 function getTotalRating($id)
    {
        global $mysqli;
    $sql = "SELECT * FROM review_rating where product_id='$id'";
    if ($result=mysqli_query($mysqli, $sql)){
        $row= mysqli_fetch_array($result);
        $rowcount = $row['rating'];
        mysqli_free_result($result);
    }
    return $rowcount;
}


 function avgRating($id)
    {
        global $mysqli;
    $sql = "SELECT  ROUND(AVG(rating),1) as averageRating FROM review_rating where product_id='$id'";
    if ($result=mysqli_query($mysqli, $sql)){
        $row= mysqli_fetch_array($result);
        $avgRating = $row['averageRating'];
        mysqli_free_result($result);
    }
    return $avgRating;
}




function rating($rating){
$stars = '';
for($i=0; $i<5; $i++){
if($irate <= $i){
$class = "fa-star-o empty";
}else{
$class = "fa-star star-filled";
}
$stars .= '<i class="fa '.$class.'"></i>';
}
return $stars;
}



function geCart($sessionId){
    global $mysqli;
    $query = "SELECT * FROM cart WHERE sessionId = '$sessionId' ORDER BY added_date";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
    }

function getProductsImages($id){
    global $mysqli;
    $query = "SELECT * FROM product_images WHERE product_id = '$id'";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
    }    
 
 //Get first latest product
function getLatestSingleProduct(){
    global $mysqli;
 $query = "SELECT product.*, GROUP_CONCAT(product_colors.color) as colors, 
GROUP_CONCAT(product_brands.brand) as brands, GROUP_CONCAT(product_sizes.size) as sizes  FROM product
left join product_colors on product_colors.product_id = product.id
left join product_brands on product_brands.product_id = product.id
left join product_sizes on product_sizes.product_id = product.id GROUP BY 
        product.id  order by product.id desc limit 1";
 $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;
}

function getAllProducts($rowperpage){
   global $mysqli;
   $query = "SELECT product.*, GROUP_CONCAT(product_colors.color) as colors, 
GROUP_CONCAT(product_brands.brand) as brands, GROUP_CONCAT(product_sizes.size) as sizes  FROM product
left join product_colors on product_colors.product_id = product.id
left join product_brands on product_brands.product_id = product.id
left join product_sizes on product_sizes.product_id = product.id GROUP BY 
        product.id  order by product.id desc limit 0,$rowperpage ";  
   $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;     
}


function getAllSubProduct($lastId){
   global $mysqli;
   $query = "SELECT product.*, GROUP_CONCAT(product_colors.color) as colors, 
GROUP_CONCAT(product_brands.brand) as brands, GROUP_CONCAT(product_sizes.size) as sizes  FROM product
left join product_colors on product_colors.product_id = product.id
left join product_brands on product_brands.product_id = product.id
left join product_sizes on product_sizes.product_id = product.id WHERE product.id < '" .$lastId . "'
 GROUP BY product.id  order by product.id desc ";  
   $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;     
}

function addresses($uid){
    global $mysqli;
    $query = "SELECT * FROM customer_address WHERE uid = '$uid' ";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}

function getMachineCategory(){
     global $mysqli;
    $query = "SELECT * from categories WHERE title='Water pumps/pumping machine'";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_assoc($result); 
    return $row;
}

function getMachineCategoryProduct($mid){
     global $mysqli;
    $query = "SELECT product.*, GROUP_CONCAT(product_colors.color) as colors, 
GROUP_CONCAT(product_brands.brand) as brands, GROUP_CONCAT(product_sizes.size) as sizes  FROM product
left join product_colors on product_colors.product_id = product.id
left join product_brands on product_brands.product_id = product.id
left join product_sizes on product_sizes.product_id = product.id WHERE product.cat_id = '".$mid."'
 GROUP BY product.id  order by product.id desc limit 12";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}

//Bathroom

function getBathroomCategory(){
     global $mysqli;
    $query = "SELECT * from categories WHERE title='Bathroom'";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_assoc($result); 
    return $row;
}

function getBathroomCategoryProduct($mid){
     global $mysqli;
    $query = "SELECT product.*, GROUP_CONCAT(product_colors.color) as colors, 
GROUP_CONCAT(product_brands.brand) as brands, GROUP_CONCAT(product_sizes.size) as sizes  FROM product
left join product_colors on product_colors.product_id = product.id
left join product_brands on product_brands.product_id = product.id
left join product_sizes on product_sizes.product_id = product.id WHERE product.cat_id = '".$mid."'
 GROUP BY product.id  order by product.id desc limit 12";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}


//Kitchen

function getKitchenCategory(){
     global $mysqli;
    $query = "SELECT * from categories WHERE title='Kitchen'";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_assoc($result); 
    return $row;
}

function getKitchenCategoryProduct($mid){
     global $mysqli;
    $query = "SELECT product.*, GROUP_CONCAT(product_colors.color) as colors, 
GROUP_CONCAT(product_brands.brand) as brands, GROUP_CONCAT(product_sizes.size) as sizes  FROM product
left join product_colors on product_colors.product_id = product.id
left join product_brands on product_brands.product_id = product.id
left join product_sizes on product_sizes.product_id = product.id WHERE product.cat_id = '".$mid."'
 GROUP BY product.id  order by product.id desc limit 12";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}



 function alladdresses($uid){
    global $mysqli;
    $query = "SELECT * FROM customer_address WHERE uid = '$uid'";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
    }       

function orderbyTransId($email){
    global $mysqli;
    $query = "SELECT * FROM customer_order WHERE c_email = '$email' and status='Paid' OR status='Pending' order by added_date desc";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
    } 

function failedPaymentOrders($email){
    global $mysqli;
    $query = "SELECT * FROM transactions WHERE payer_email = '$email' and payment_status='Payment Pending' order by id desc";
    $result = mysqli_query($mysqli,$query);
    $resArr = array();
    while($row = mysqli_fetch_assoc($result)) { 
      $resArr[] = $row;
    }
    return $resArr;   
    }  
    
  
    
    


function orders($email){
    global $mysqli;
    $query = "SELECT * FROM customer_order WHERE c_email = '$email' order by added_date";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
    } 


function customerInfo($email){
    global $mysqli;
    $query = "SELECT * FROM customer_login WHERE email = '$email'";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
    } 

 function vendorAvailabileProducts($username){
    global $mysqli;
    $query = "SELECT * FROM product WHERE vendor_name = '$username' and availability = 1 and status != 0";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
    }  

 function editProducts($id){
    global $mysqli;
    $query = "SELECT * FROM product WHERE id = '$id'";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); 
    while($row = mysqli_fetch_assoc($result)) { 
      $resArr[] = $row;
    }
    return $resArr;   
    }     

 function getProductImages($id){
    global $mysqli;
    $query = "SELECT * FROM product_images WHERE product_id = '$id'";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); 
    while($row = mysqli_fetch_assoc($result)) { 
      $resArr[] = $row;
    }
    return $resArr;   
    }   


 function getProductColor($id){
    global $mysqli;
    $query = "SELECT distinct  color
   from product_colors WHERE product_id = '$id'";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); 
    while($row = mysqli_fetch_assoc($result)) { 
      $resArr[] = $row;
    }
    return $resArr;   
    }    

 function getProductSize($id){
    global $mysqli;
    $query = "SELECT * from product_sizes where product_id = '$id'";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); 
    while($row = mysqli_fetch_assoc($result)) { 
      $resArr[] = $row;
    }
    return $resArr;   
    }  



 function vendorAwaitingProducts($username){
    global $mysqli;
    $query = "SELECT * FROM product WHERE vendor_name = '$username' and availability = 1 and status = 0";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
    }    
       

function vendorInfo($email){
    global $mysqli;
    $query = "SELECT * FROM vendors WHERE email = '$email'";
    $result = mysqli_query($mysqli,$query);
    $resArr = array();
    while($row = mysqli_fetch_assoc($result)) {
      $resArr[] = $row;
    }
    return $resArr;   
    }   

function getBuyerInfo($email){
    global $mysqli;
    $ccsql="SELECT c.*, a.mobile, a.address1, a.address2, a.state, a.city, a.zip FROM customer_login c LEFT JOIN customer_address a ON c.id = a.uid WHERE c.email = '$email'  AND a.default_address = '1'";
       
        $ccsql_run = mysqli_query($mysqli, $ccsql);

        $row=mysqli_fetch_array($ccsql_run);
           
            return $row;
} 

function allvendor(){
    global $mysqli;
    $query = "SELECT * FROM vendors order by name";
    $result = mysqli_query($mysqli,$query);
    $resArr = array();
    while($row = mysqli_fetch_assoc($result)) {
      $resArr[] = $row;
    }
    return $resArr;   
    }  


function totalAmt($username){
    global $mysqli;
    $ccsql="SELECT SUM(total_amount) as amt FROM customer_order WHERE vendor = '$username' and status = 'Paid' ";
        $ccsql_run = mysqli_query($mysqli, $ccsql);

        $row=mysqli_fetch_array($ccsql_run);
           
            echo number_format($row['amt']);
}     

function totalEarning($username){
    global $mysqli;
    $ccsql="SELECT SUM(amount_issued) as amt FROM customer_order WHERE vendor = '$username' and vendor_payment_status = 'Settled' ";
        $ccsql_run = mysqli_query($mysqli, $ccsql);

        $row=mysqli_fetch_array($ccsql_run);
           
            echo number_format($row['amt']);
} 


function shippingTo($transid){
    global $mysqli;
    $ccsql="SELECT address_street, address_state, receiver_email FROM transactions WHERE txn_id = '$transid'";
        $ccsql_run = mysqli_query($mysqli, $ccsql);
        $count = mysqli_num_rows($ccsql_run);
        $row=mysqli_fetch_array($ccsql_run);
           if($count > 0){
            echo $row['address_street'] .' - '. $row['address_state'];
        }else{
            echo "Address not available";
        }
}      



function vendorPaidOrder($username){
    global $mysqli;
    $query = "SELECT * FROM customer_order WHERE vendor = '$username' and delivery_status IS NULL ";
    $result = mysqli_query($mysqli,$query);
    $resArr = array();
    while($row = mysqli_fetch_assoc($result)) {
      $resArr[] = $row;
    }
    return $resArr;   
    } 

function adminPaidOrder(){
    global $mysqli;
    $query = "SELECT * FROM `customer_order` ";
    $result = mysqli_query($mysqli,$query);
    $resArr = array();
    while($row = mysqli_fetch_assoc($result)) {
      $resArr[] = $row;
    }
    return $resArr;   
    }    

function adminNotDelivered(){
    global $mysqli;
    $query = "SELECT * FROM customer_order WHERE delivery_status != 'Delivered' ";
    $result = mysqli_query($mysqli,$query);
    $resArr = array();
    while($row = mysqli_fetch_assoc($result)) {
      $resArr[] = $row;
    }
    return $resArr;   
    }                    

function productNotDelivered($username){
    global $mysqli;
    $query = "SELECT * FROM customer_order WHERE vendor = '$username' and delivery_status != 'Delivered' ";
    $result = mysqli_query($mysqli,$query);
    $resArr = array();
    while($row = mysqli_fetch_assoc($result)) {
      $resArr[] = $row;
    }
    return $resArr;   
    }       

function productDelivered($username){
    global $mysqli;
    $query = "SELECT * FROM customer_order WHERE vendor = '$username' and delivery_status = 'Delivered'";
    $result = mysqli_query($mysqli,$query);
    $resArr = array();
    while($row = mysqli_fetch_assoc($result)) {
      $resArr[] = $row;
    }
    return $resArr;   
    }  


function adminproductDelivered(){
    global $mysqli;
    $query = "SELECT * FROM customer_order WHERE delivery_status = 'Delivered'";
    $result = mysqli_query($mysqli,$query);
    $resArr = array();
    while($row = mysqli_fetch_assoc($result)) {
      $resArr[] = $row;
    }
    return $resArr;   
    }       


function getVendorSale($username){
    global $mysqli;
    $query = "SELECT distinct product_name, SUM(quantity) as quantity  FROM customer_order where vendor = '$username' and status = 'Paid' GROUP by product_name";
    $result = mysqli_query($mysqli,$query);
    $resArr = array();
    while($row = mysqli_fetch_assoc($result)) {
      $resArr[] = $row;
    }
    return $resArr;   
    }        

function dailySale($username){
    global $mysqli;
    $query = "SELECT DISTINCT product_name, SUM(product_price) as price, SUM(quantity) as quantity, DAY(added_date) as day, MONTH(added_date) as month, YEAR(added_date) as year FROM customer_order
       WHERE vendor='$username'
       GROUP BY product_name, YEAR(added_date), MONTH(added_date), DAY(added_date)";
    $result = mysqli_query($mysqli,$query);
    $resArr = array();
    while($row = mysqli_fetch_assoc($result)) {
      $resArr[] = $row;
    }
    return $resArr;   
    }                        

 function productbyCat($id)
{
    global $mysqli;
    $sql = "SELECT * FROM product where id = '$id'";
    $result = mysqli_query($mysqli,$sql);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr; 
} 



function getItemRatings($itemId){
        global $mysqli;
        $sqlQuery = "
            SELECT *
            FROM review_rating 
            WHERE product_id = '$itemId'";

        $result = mysqli_query($mysqli,$sqlQuery);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;     
    }



function getRatingsAverage($itemId){
        $itemRating = $this->getItemRatings($itemId);
        $ratingNumber = 0;
        $count = 0;     
        foreach($itemRating as $itemRatingDetails){
            $ratingNumber+= $itemRatingDetails['rating'];
            $count += 1;            
        }
        $average = 0;
        if($ratingNumber && $count) {
            $average = $ratingNumber/$count;
        }
        return $average;    
    }

function getLimitRatings($itemId, $limit){
        global $mysqli;
        $sqlQuery = "
            SELECT *
            FROM review_rating 
            WHERE product_id = '$itemId' LIMIT $limit";

        $result = mysqli_query($mysqli,$sqlQuery);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;     
} 

function mrate($irate){
$stars = '';
for($i=0; $i<5; $i++){
if($irate <= $i){
$class = "far fa-star text-muted";
}else{
$class = "fas fa-star";
}
$stars .= '<i class="'.$class.'"></i>';
}
return $stars;
}   

/*function getCountry(){
    global $mysqli;
    global $country_name;
    $ccsql="SELECT id,name,iso2 FROM countries";
        $ccsql_run = mysqli_query($mysqli, $ccsql);

        while ($row=mysqli_fetch_array($ccsql_run)) {
       if($country_name == $row["id"]){
        $selected = "selected";
       }else{
        $selected = "";
       }

            echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["name"].'</option>';
    }
}*/

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

       function randID($length) {
        $vowels = 'AEUY';
        $consonants = '0123456789BCDFGHJKLMNPQRSTVWXZ';
        $idnumber = '';
        $alt = time() % 2;
        for ($i = 0;$i < $length;$i++) {
            if ($alt == 1) {
                $idnumber.= $consonants[(rand() % strlen($consonants)) ];
                $alt = 0;
            } else {
                $idnumber.= $vowels[(rand() % strlen($vowels)) ];
                $alt = 1;
            }
        }
        
        return $jobID;
    }


    

function calculate_postpone_due_date($billingcycle)
{
    switch($billingcycle)
    {
        case "Monthly":         $months = 1; break;
        case "Quarterly":       $months = 3; break;
        case "Semi-Annually":   $months = 6; break;
        case "Annually":        $months = 12; break;
        case "Biennially":      $months = 24; break;
        case "Triennially":     $months = 36; break;
        default:                $months = 0; break;
    }


    if ($months == 0)
        return FALSE;    

    $today = date('Y-m-d');
    $next_due_date = strtotime($today.' + '.$months.' Months');
    return date('Y-m-d', $next_due_date);

}


 /*
    Here's the logic:
    We want to show X numbers.
    If length of STR is less than X, hide all.
    Else replace the rest with *.

    */

function mask($str, $first, $last) {
    $len = strlen($str);
    $toShow = $first + $last;
    return substr($str, 0, $len <= $toShow ? 0 : $first).str_repeat("*", $len - ($len <= $toShow ? 0 : $toShow)).substr($str, $len - $last, $len <= $toShow ? 0 : $last);
}

function mask_email($email) {
    $mail_parts = explode("@", $email);
    $domain_parts = explode('.', $mail_parts[1]);

    $mail_parts[0] = mask($mail_parts[0], 2, 1); // show first 2 letters and last 1 letter
    $domain_parts[0] = mask($domain_parts[0], 2, 1); // same here
    $mail_parts[1] = implode('.', $domain_parts);

    return implode("@", $mail_parts);
}

?>