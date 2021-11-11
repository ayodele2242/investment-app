<?php
include("header.php");
include("top-header.php");


?>

<div class="nk-content nk-content-lg nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-inner">
                            <div class="nk-content-bodys">

                                <div class="nk-block-head text-center">
                                    <div class="nk-block-head-content">

                                        
                                        <div class="nk-block-head-content">
                                            <h2 class="nk-block-title fw-normal">My Active Plans</h2>
                                      
                                            <div class="nk-block-des nk-news card card-bordered">
                                                <p>Here are list of your savings subscription plans.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-block row">

                                    
                                 <?php

//$plans = getPlans()
//DO NOT limit this query with LIMIT keyword, or...things will break!
$querys = "SELECT s.*, h.amount_saved FROM saving_packages s inner join savings_history h on s.id = h.saving_pid  where h.email='$email' AND h.status='active' order by h.id desc";
$getifs = mysqli_query ($mysqli, $querys);

if(mysqli_num_rows($getifs) < 1){
   echo '<div class="col-lg-12 col-md-6 s12 alert alert-danger" style="text-align:center; padding: 7px; font-weight:bolder;">You do not have any active plan at the moment.</div>';
}else{

 //these variables are passed via URL
$limits = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 6; //list per page
$pages = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1; //starting page
$links2 = 10;

$paginators = new Paginator($mysqli, $querys ); //__constructor is called
$results2 = $paginators->getData( $limits, $pages );
     
for ($ps = 0; $ps < count($results2->data); $ps++):
//store in $get variable for easier reading
$get = $results2->data[$ps]; 




$myimg  = $set['installUrl'].'assets/img/farm.png';

?>

<div class="col-lg-4 mb-3 animated fadeIn border-radius">

 <div class="card shadow">
   <!-- <img src="<?php //echo $myimg; ?>" class="card-img-top" alt="">-->
    <div class="plan-item-head">
        <div class="plan-item-heading">
            <h4 class="plan-item-title card-title title"><?php echo $get['category'];  ?></h4>
            <h3 class="text-info text-bolder"><?php echo '₦'.number_format($get['amount']);  ?></h3>
        </div>
        <div class="plan-item-summary card-text">
            <div class="row">
                <div class="col-lg-12"><strong><?php echo ucwords($get['duration']);  ?></strong> Contribution</div>
                
            </div>
        </div>
        
    </div>
   
</div>


</div>
<?php
 endfor;
//} 
 echo '<div class="col-lg-12 l12 mt-5">';
echo $paginators->createLinks( $links2, 'pagination pagination-lg justify-content-center' );
echo '</div>';
}
?>
                                   


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

  


<?php
include("footer.php");
?>

