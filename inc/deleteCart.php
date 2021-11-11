<?php 

require 'config.php';



if(isset($_POST['id'])){
$id = $_POST['id'];
 
$query = mysqli_query($mysqli, "delete from cart where id='$id' and sessionId = '$sessionId'");

if($query){
	echo 1;
}else{
	echo "Error occured while deleting. Please try again.";
}

}


?>