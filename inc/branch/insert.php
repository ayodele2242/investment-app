<?php
	require_once('../functions.php');

	/*t = date("Y-m-d H:i:s");
	$tv = time(); 
	$id = $_SESSION['id'];
	$fullname = $_SESSION['name'] ;
	$uname = $_SESSION['uname'];*/



 if(isset($_POST['aid']) && $_POST['aid'] != ""){


  $name=$mysqli->real_escape_string($_POST['name']);
  $addr=$mysqli->real_escape_string($_POST['addr']);
  $branch=$mysqli->real_escape_string($_POST['branch']);
  $id = $_POST['aid'];

  $query = mysqli_query($mysqli,"UPDATE branch SET  branch='$name', addr='$addr', decription='$branch' WHERE branch_id ='$id' ");

   if($query){
    echo "added";
  }else{
    echo "Update failed: ".$mysqli->error;
  }

}else{

	$name=$mysqli->real_escape_string($_POST['name']);
	$addr=$mysqli->real_escape_string($_POST['addr']);
	$branch=$mysqli->real_escape_string($_POST['branch']);
	
	

	$sql2 = "SELECT * FROM branch WHERE branch = '$name'";
    $result = mysqli_query($mysqli,$sql2) or die($mysqli->error);
    $count = mysqli_num_rows($result);
    if ($count == 0) {
    	$sql = "INSERT INTO branch(branch, addr, decription)values('$name','$addr','$branch')";
	$done =	mysqli_query($mysqli, $sql);

	if($done){
		echo "added";
	}else{
		echo $mysqli->error;
	}

    }else{
		echo "Branch already exist";
    }

}
?>