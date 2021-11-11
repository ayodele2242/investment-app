<?php
include('../inc/functions.php'); 
// Logout
//define(url,"https://fhmcooperative.com");
		$tv  = time();
	    $act = "Investor Logged Out";
        session_destroy();
        header("Location: ../login-signup");
		// mysqli_query($mysqli, "insert into logs(uid,name,action,etime)values('$id',$name','$act', '$tv')") or die(mysqli_error($mysqli));
   

?>