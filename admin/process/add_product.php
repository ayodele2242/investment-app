<?php 

require '../../inc/functions.php';




/*for ($i = 0; $i < count($_FILES['upload_files']['name']); $i++) {
// Loop to get individual element from the array
$validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.
$ext = explode('.', basename($_FILES['upload_files']['name'][$i]));   // Explode file name from dot(.)
$file_extension = end($ext); // Store extensions in the variable.
$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
$j = $j + 1;      // Increment the number of uploaded images according to the files in array.
if (($_FILES["upload_files"]["size"][$i] < 200000)     // Approx. 200kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if (move_uploaded_file($_FILES['upload_files']['tmp_name'][$i], $target_path)) {
// If file moved to uploads folder.
 mysqli_query($mysqli,"insert into product_images(product_id, image )values('$product_id','')")

echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
} else {     //  If File Was Not Moved.
echo $j. ').<span id="error">please try again!.</span><br/><br/>';
}
} else {     //   If File Size And File Type Was Incorrect.
echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
}
}*/

if(isset($_POST)){
$title           = $mysqli->real_escape_string($_POST['title']);
$summary         = $mysqli->real_escape_string($_POST['summary']);
$description     = $mysqli->real_escape_string($_POST['description']);
$cat_id          = (int)$_POST['cat_id'];
$child_cat_id    = isset($_POST['child_cat_id']) ? (int)$_POST['child_cat_id'] : 0;
$discount        = $mysqli->real_escape_string($_POST['discount']);
$brand           = $mysqli->real_escape_string($_POST['brand']);
$size_cat        = $mysqli->real_escape_string($_POST['size_cat']);
$size            = $mysqli->real_escape_string($_POST['size']);


$color           = $mysqli->real_escape_string($_POST['color']);
$quantity        = $mysqli->real_escape_string($_POST['quantity']);
$status          = $mysqli->real_escape_string($_POST['status']);




if($size_cat == "different"){
$price  = implode(',', $_POST['variance_price']);
}else{
$price = $mysqli->real_escape_string($_POST['price']);	
}


$query = mysqli_query($mysqli, "SELECT MAX(id) FROM product");
$results = mysqli_fetch_array($query);
$cur_auto_id = $results['MAX(id)'] + 1;
//Generate number
$string = $title;
$expr = '/(?<=\s|^)[a-z]/i';
preg_match_all($expr, $string, $matches);
$result = implode('', $matches[0]);
//second number
$string2 = 'SKU Number';
$expr2 = '/(?<=\s|^)[a-z]/i';
preg_match_all($expr2, $string2, $matches2);
$result2 = implode('', $matches2[0]);

$rno =$result.$result2.$cur_auto_id;
$num = rand(1111, 0000); 
$sku = $rno.'-'.$num;





//Product Images
$j = 0;     // Variable for indexing uploaded image.
$upload_dir = '../../upload/product/'; // upload directory
//Featured Image

$imgFile = $_FILES['feature_img']['name'];
$tmp_dir = $_FILES['feature_img']['tmp_name'];
$imgSize = $_FILES['feature_img']['size'];



$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

// valid image extensions
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

// rename uploading image
$userpic = "Feature-".rand(1000,1000000).".".$imgExt;

if(!empty($imgFile)){
$pic = $userpic;
move_uploaded_file($tmp_dir,$upload_dir.$pic);
}else{
    $pic = '';
}


  $deleted_file_ids = array();
  if(isset($_POST['deleted_file_ids']) && !empty($_POST['deleted_file_ids'])) {
    $deleted_file_ids = explode(",", $_POST['deleted_file_ids']);
  }


$query = mysqli_query($mysqli, "insert into 
		product(
		title,
		summary,
		description,
		cat_id,
		child_cat_id,
		price,
		discount,
		brand,
		availability,
		size,
		color,
		quantity,
		status,
		
		images,
		size_category,
		sku
		)values(
		'$title',
		'$summary',
		'$description',
		'$cat_id',
		'$child_cat_id',
		'$price',
		'$discount',
		'$brand',
		'$status',
		'$size',
		'$color',
		'$quantity',	
		'$status',
		'$pic',
		'$size_cat',
		'$sku'

		) 
   ");

if($query){

echo "Done";
$product_id = mysqli_insert_id($mysqli);

//color
$colorCount = explode(',', $_POST['color']);
foreach ($colorCount as $color)
 { 		
   mysqli_query($mysqli,"INSERT INTO product_colors(product_id,color) 
    VALUES('$product_id', '$color')");            
}
//Brands
$brandCount = explode(',', $_POST['brand']);
foreach ($brandCount  as $brand)
 { 		
   mysqli_query($mysqli,"INSERT INTO product_brands(product_id,brand) 
    VALUES('$product_id', '$brand')");            
}

//Check for variant category, we need to insert appropriately
if($size_cat == "single"){
	
//Sizes
$sizeCount = explode(',', $_POST['size']);
foreach ($sizeCount as $size)
 { 		
   mysqli_query($mysqli,"INSERT INTO product_sizes(product_id,size) 
    VALUES('$product_id', '$size')");            
}
            
}

if($size_cat == "different"){

$var = count($_POST['variance_size']);	
for($i = 0; $i < $var; $i++)
{

$imgFile = $_FILES['fimgs']['name'][$i];
$tmp_dir = $_FILES['fimgs']['tmp_name'][$i];
$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
$userpic = rand(1000,1000000).".".$imgExt;
if(!empty($imgFile)){
$pic = $userpic;
 move_uploaded_file($tmp_dir,$upload_dir.$pic);
}else{
    $pic = '';
}


$variance_size   = $_POST['variance_size'][$i];
$variance_price  = $_POST['variance_price'][$i];

 $ins = mysqli_query($mysqli,"INSERT INTO product_sizes(product_id, size, variant_price, image) 
                VALUES('$product_id', '$variance_size', '$variance_price','$pic')");      



}//for

if(!$ins){
echo "Error occured: ".$mysqli->error;	
}

}//different





//Let upload product images
$temp = array();
for($i=0; $i<sizeof($_FILES['upload_files']['name']); $i++) {
    if(!in_array($i, $deleted_file_ids)) {
      if($_FILES['upload_files']['name'][$i] != "") {
        $location = $upload_dir.$_FILES['upload_files']['name'][$i];
        copy($_FILES['upload_files']['tmp_name'][$i], $location); 
        $iname = $_FILES['upload_files']['name'][$i];
        $temp[] = $iname;

      }
    }
  }

//Implode the images and save
$imgs = implode(",", $temp);  
mysqli_query($mysqli,"insert into product_images(product_id, image )values('$product_id','$imgs')");


}else
{
	echo "Error occured: ". $mysqli->error;
}




// Close connection
mysqli_close($mysqli);


}











?>
