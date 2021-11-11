<?php 
require_once('../config.php'); 


$output = array('data' => array());


$sql = "SELECT * FROM  branch  order by  branch";
$query = $mysqli->query($sql);

$x = 1;
while ($row = $query->fetch_assoc()) {
 
	
	

	$actionButton = '
	<a href="branches?id='.$row['branch_id'].'" type="button" class="btn btn-floating waves-effect waves-light green z-depth-4 btn-small"> <i class="material-icons left">edit</i>
    </a>	
	<a href="#menuModal" type="button" data-toggle="modal"  class="btn btn-floating waves-effect waves-light red z-depth-4 btn-small  modal-trigger" onclick="removeMenu('.$row['branch_id'].')"> <i class="material-icons left">delete</i>
    </a>	
	';
	
	$output['data'][] = array(
		$x,
		$row['branch'],
		$row['addr'],
		$row['decription'],		
		$actionButton
	);

	$x++;
}

// database connection close
$mysqli->close();

echo json_encode($output);