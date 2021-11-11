<?php
require_once '../functions.php';

$id = safe_input($mysqli,$_POST['id']);

if(!empty($_POST['lname'])){
$lname = safe_input($mysqli,$_POST['lname']);
}else{
	echo "Last name is required<br/>";
}

if(!empty($_POST['fname'])){
$fname = safe_input($mysqli,$_POST['fname']);
}else{
   echo "First name is required<br/>";
}

if(!empty($_POST['phone'])){
$phone = safe_input($mysqli,$_POST['phone']);
}else{
$phone = "";
}

if(!empty($_POST['dob'])){
$dob = safe_input($mysqli,$_POST['dob']);
}else{
	$dob = "";
}

if(!empty($_POST['gender'])){
$gender = safe_input($mysqli,$_POST['gender']);
}else{
	$gender = "";
}




if (!empty($_FILES['image']['name'])) {


/* Getting file name */
$filename = $_FILES['image']['name'];

/* Location */
$location = "../../assets/images/".$filename;
$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

/* Valid Extensions */
$valid_extensions = array("jpg","jpeg","png");
/* Check file extension */
if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
   $uploadOk = 0;
   echo "Invalid image uploaded";
}

if($uploadOk == 0){
   echo "Error updating profile image";
}else{
   /* Upload file */
   move_uploaded_file($_FILES['image']['tmp_name'],$location);
      //echo $location;
   }
}else{
	$filename = "";
}


if(!empty($_POST['lname']) && !empty($_POST['fname']) && !empty($_POST['phone']) && !empty($_POST['gender']) && !empty($_POST['dob'])){

$sql = mysqli_query($mysqli,"UPDATE customer_login SET last_name='$lname', first_name='$fname', phone='$phone', dob='$dob', gender='$gender', img='$filename' where id = '$id'");


if($sql){
	echo 1;

}else{
	echo "Error occured: ".$mysqli->error;
}

}

?>