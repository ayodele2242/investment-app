<?php
include("header.php");
include("top-header.php");

$hist = getWithdrawals($email);

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
                                                    
                                                    <th >
                                                        Amount
                                                    </th>
                                                    <th >
                                                        Transaction Type
                                                    </th>
                                                    <th>
                                                       Transaction Status
                                                    </th>
                                                    <th>
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
                                                    
                                                    <td>
                                                        <?php echo number_format($planhistory['amount'],2); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $planhistory['widrawal_type']; ?>
                                                    </td>
                                                    <td>
                                                        <?php if($planhistory['status'] == "Pending"){ 
                                                            echo '<span class="text-warning">Pending</span>'; 
                                                            
                                                        }else if($planhistory['status'] == "Transferred"){
                                                            echo '<span class="text-success">Money transferred to your account</span>'; 
                                                            
                                                        }
                                                        
                                                        else{ 
                                                            echo '<span class="text-danger">transferred Failed</span>'; } 
                                                           ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $planhistory['wdate']; ?>
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