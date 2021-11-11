<?php
include("header.php");
include("top-header.php");

$log = myReferral($refCode);
$query = mysqli_query($mysqli,"select * from customer_login where id='$id'");
$row = mysqli_fetch_array($query);

if(empty($row['img'])){
  $img = $set['installUrl'].'assets/logo/avatar.png';
}else{
   $img = $set['installUrl'].'assets/images/'.$row['img'];
}
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
                                                            Referred Name
                                                        </span>
                                                    </th>
                                                    <th class="tb-col-ip">
                                                        Amount Earned
                                                    </th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if(!$log){
                                                    echo '<tr><td colspan="3">No Logs Available.</td></tr>';
                                                }else{
                                                foreach ($log as $logs) { ?>
                                                <tr>
                                                    <td class="tb-col-os"><?php echo ucwords($logs['last_name'].' '.$logs['first_name']); ?></td>
                                                    <td class="tb-col-ip">
                                                        <span class="sub-text"><?php echo number_format($logs['amt']); ?></span>
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