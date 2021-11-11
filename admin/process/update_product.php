<?php 
require '../../inc/functions.php';


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
//$pro_status      = (int)$_POST['pro_status'];

$color           = $mysqli->real_escape_string($_POST['color']);
$quantity        = $mysqli->real_escape_string($_POST['quantity']);
$status          = $mysqli->real_escape_string($_POST['status']);

$id = (int)$_POST['pro_id'];


$query = mysqli_query($mysqli, "
UPDATE product SET title = '$title', summary = '$summary', description = '$description', cat_id = '$cat_id', child_cat_id = '$child_cat_id', 
 discount = '$discount', brand = '$brand', availability='$status',size='$size', quantity='$quantity'
WHERE id = '$id' ");

if($query){
echo "Done";
}else
{
	echo "Error occured: ". $mysqli->error;
}




// Close connection
mysqli_close($mysqli);


}



?>
