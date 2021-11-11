<?php 
include("header.php");  

if(isset($_GET['name'])){
$name = $mysqli->real_escape_string($_GET['name']);




if($name == 'home'){
?>
<script type="text/javascript">window.location = "<?php echo url; ?>";</script>
<?php
}else if($name == 'about-us'){
echo '<script type="text/javascript">window.location = "about-us";</script>';
}else if($name == 'contact-us'){
echo '<script type="text/javascript">window.location = "contact-us";</script>';
}else{

 include("header-bottom.php");

    $pd = mysqli_query($mysqli,"select parent_id, link from navigation_bar where link = '$name'");
    $rob = mysqli_fetch_array($pd);
    $na = $rob['parent_id'];

    $pd2 = mysqli_query($mysqli,"select name, link from navigation_bar where id = '$na'");
    $rob2 = mysqli_fetch_assoc($pd2);
    $na2 = $rob2['link'];

    if($na2){
      $slash = " > ";
    }else{
      $slash = "";
    } 

    
 ?>

<section class="pt-100 pb-70 pt-70 overflow-x-hidden">
<div class="container">
	<div class="section-title"></div>


<div class="home-facility-details">

<?php   

$pcont = mysqli_query($mysqli,"select * from mp_pages where nav_id = '".$rob['link']."'");
$cget = mysqli_fetch_array($pcont);

if($cget < 1){
    echo '<div class="alert alert-danger">No post available yet for this link</div>';
}else{

?>
<div class="section-titles" style="text-align: right;">
<h4>
<?php  
echo  '<p><h6 class="col-grey"><a class="text-info" href="'.url.'"><i class="fa fa-home"></i> Home</a> > <a class="col-grey" href="page?name='.$rob2['link'].'">'.ucwords($rob2['name']).'</a>'. $slash .''.ucwords($rob['link']).'</h6></p>';

 ?></h4>
</div>
<style type="text/css">
  <?php 
if(!empty($cget['css'])){ echo $cget['css']; }
?>
</style>

<?php
 echo $s = html_entity_decode($cget['page_desc']); 
      
      /*echo eval('?>' . utf8_encode($s) . '<?php ');	*/
}

?>








</div>




</div>
</section>




<?php 

include("footer.php"); 
 }
}else{ header("Location: home"); } ?>