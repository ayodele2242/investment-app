<?php
require_once '../inc/config.php';
require_once '../inc/fetch.php';
require_once 'review_pagination.php';


function mrate($irate){
$stars = '';
for($i=0; $i<5; $i++){
if($irate <= $i){
$class = "fa-star-o empty";
}else{
$class = "fa-star star-filled";
}
$stars .= '<i class="fa '.$class.'"></i>';
}
return $stars;
}

$pid   = $_SESSION['pid'];
$item_per_page 		= 15; //item to display per page



//Get page number from Ajax
if(isset($_POST["page"])){
	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
	if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
}else{
	$page_number = 1; //if there's no page number, set it to 1
}

//get total number of records from database
$results = $mysqli->query("SELECT COUNT(*) FROM review_rating where product_id = '$pid'");
$get_total_rows = $results->fetch_row(); //hold total records in variable
//break records into pages

$total_pages = ceil($get_total_rows[0]/$item_per_page);

//position of records
$page_position = (($page_number-1) * $item_per_page);

//Limit our results within a specified range. 
$results = $mysqli->prepare("SELECT id, name, review, rating, added_date
				FROM review_rating where product_id = '$pid'
				 ORDER BY id ASC LIMIT $page_position, $item_per_page");
$results->execute(); //Execute prepared Query



$results->bind_result($id, $name, $review, $rating, $added_date); //bind variables to prepared statement

//Display records fetched from database.
//echo $get_total_rows[0];
//echo $total_pages;

if($get_total_rows[0] < 1){
	echo '<div class="col-red">No review yet for this product.</div>';
}else{

while($results->fetch()){ //fetch values
	$img = '<img class="rounded-circle" width="50" src="'. $set['installUrl'].'assets/img/login.png" alt="'.$name.'"/>';
    $irate = $rating;

?>	
	
<div  class="product-review pb-4 mb-4 border-bottom">
<div class="d-flex mb-3"> 
<div class="media media-ie-fix align-items-center mr-4 pr-2"><?php echo $img; ?>
<div class="media-body pl-3"><h6 class="font-size-sm mb-0"><?php echo $name; ?></h6>
<span class="font-size-ms text-muted"><?php echo $added_date; ?></span></div></div>
<div><div class="star-rating"><?php echo mrate($irate) ?></div></div> 
</div> 
<p class="mb-2 font-size-ms col-black"><?php echo $review; ?></p>
</div> 




<?php	
}
}
echo '<div align="center" class="Page navigation">';
// To generate links, we call the pagination function here. 
echo paginate_function($item_per_page, $page_number, $get_total_rows[0], $total_pages);
echo '</div>';

?>