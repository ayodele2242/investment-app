<?php 

require '../../inc/config.php';


if (isset($_POST['id']) && !empty($_POST['id'])) {
    
    $id = $_POST['id'];

	// Fetch state name base on country id
	$query = "SELECT * FROM categories WHERE parent_id = '$id' ";
	$result = $mysqli->query($query);

	if ($result->num_rows > 0) {
		echo '<option value="">Select Child category</option>'; 
		while ($row = $result->fetch_assoc()) {
		    $mid = $row['id'];
		    echo '<option value="'.$row['id'].'">'.$row['title'].'</option>'; 
		    	$query2 = "SELECT * FROM categories WHERE parent_id = '$mid' ";
            	$result2 = $mysqli->query($query2);
		    	while ($row = $result2->fetch_assoc()) {
			echo '<option value="'.$row['id'].'">'.$row['title'].'</option>'; 
			
		    	}
		}
	} else {
		echo '<option value="">Child category not available</option>'; 
	}
} 






?>