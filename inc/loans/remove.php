<?php 

require_once('../config.php'); 



$id = $_POST['member_id'];

//Let check if this package has investors on it

$query = mysqli_query($mysqli,"select loan_id from loan_disburse where loan_id='$id'");
$count = mysqli_num_rows($query);
if($count > 0){
	echo "You can't delete this loan product; there is already active loan on it.";
}else{


$sql = "DELETE FROM loans_packages WHERE id = {$id}";
$query = $mysqli->query($sql);
if($query === TRUE) {
	echo 1;
} else {
	echo  'Error while deleting. '. $mysqli->error;
}


}

// close database connection
$mysqli->close();

