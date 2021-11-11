<?php 

require_once('../config.php'); 



$id = $_POST['member_id'];

//Let check if this package has investors on it

$query = mysqli_query($mysqli,"select saving_id from savings where saving_id='$id'");
$count = mysqli_num_rows($query);
if($count > 0){
	echo "You can't delete this package. It has members on it already";
}else{


$sql = "DELETE FROM saving_packages WHERE id = {$id}";
$query = $mysqli->query($sql);
if($query === TRUE) {
	echo 1;
} else {
	echo  'Error while deleting. '. $mysqli->error;
}


}

// close database connection
$mysqli->close();

