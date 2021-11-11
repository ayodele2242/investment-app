<?php
include("header.php");
include("top-header.php");

$hist = alltransHistory($email);

?>


<div class="nk-content nk-content-lg nk-content-fluid">
<div class="container-xl wide-lg">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                   
                    <h2 class="nk-block-title fw-normal">My Reffered</h2>
                 
                </div>
            </div>


 <table class="table table-ulogs">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="tb-col-os">
                                                        <span class="overline-title">
                                                            Saving Package
                                                        </span>
                                                    </th>
                                                    <th class="tb-col-ip">
                                                        Amount
                                                    </th>
                                                    <th class="tb-col-ip">
                                                       Transaction Status
                                                    </th>
                                                    <th class="tb-col-ip">
                                                        Date
                                                    </th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if(!$hist){
                                                    echo '<tr><td colspan="4">No transations performed.</td></tr>';
                                                }else{
                                                foreach($hist as $planhistory){
                                                ?>
                                                <tr>
                                                    <td><?php echo $planhistory['saving_category']; ?></td>
                                                    <td>
                                                        <?php echo number_format($planhistory['amount_saved'],2); ?>
                                                    </td>
                                                    <td>
                                                        <?php if($planhistory['status'] != "pending"){ 
                                                                        echo '<span class="text-success"><ion-icon name="arrow-up"></ion-icon> Payment Successful</span>'; }else{ 
                                                                        echo '<span class="text-danger"><ion-icon name="arrow-down"></ion-icon> Payment Failed</span>'; } 
                                                                       ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $planhistory['created_date']; ?>
                                                    </td>
                                                    
                                                    
                                                </tr>
                                                <?php }

                                                } ?>
                                            </tbody>
                                        </table>






        </div>
    </div>
</div>
</div>







<?php
include("footer.php");
?>