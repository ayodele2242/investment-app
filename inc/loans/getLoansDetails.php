
<?php
   
 require_once '../config.php';
$setSql = "SELECT * FROM store_setting";
    $setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
    $set = mysqli_fetch_array($setRes);
	
 
 if (isset($_REQUEST['uid'])) {
   
 $id = intval($_REQUEST['uid']);
 $query = mysqli_query($mysqli,"SELECT * FROM loans_payment_schedule WHERE loan_disburse_id='$id' order by payment_schedule");
 





 ?>
   
<div class="row">
<div class="col m12 s12 mb-3">
 <table>  
    <thead>
        <th>Amount</th>
        <th>Payment Status</th>
        <th>Payment Schedule Date</th>
        <th>Payment Date</th>
        <th></th>
    </thead>
 <tbody> 
<?php
while($row = mysqli_fetch_array($query)){
    $sta = $row['status'];
?>
<tr>
<td><?php echo $row['amount'];  ?></td>
<td><?php 
if($sta == "unpaid"){
 echo '<span class="text-danger col-red btn-details-'.$row['id'].'"><i class="fa fa-info-circle"></i> ' .ucwords($row['status']).'</span>';    
}else{
    echo '-';
}
?></td>
<td><?php echo date("M jS, Y", strtotime($row['payment_schedule']));  ?></td>
<td><?php 
if($row['payment_date'] != ""){
echo date("M jS, Y", strtotime($row['payment_date'])); 
}
?></td>
<td>
<?php
if($sta == "paid"){
echo '<span class="text-success col-green"><i class="fa fa-check"></i> Paid</span>'; 
}else{
 echo '<button class="btn btn-info btn-sm payBtn pay-'.$row['id'].'" id="'.$row['id'].'" data-loanid="'.$row['loan_id'].'" data-email="'.$row['email'].'">Pay</button>'; 
 echo '<span class="text-success hey col-green done-'.$row['id'].'"><i class="fa fa-check"></i> Paid</span>';    
}
?>
</td>


</tr>
<?php } ?>   
</tbody>
</table>  
 </div>
 </div>	



<?php } ?>




<script type="text/javascript">
    $(document).ready(function(){
        $(".hey").hide();
    $(".payBtn").click(function() {
     var pid = $(this).attr('id');
     var email = $(this).attr('data-email');
     var loanid = $(this).attr('data-loanid');
     $.post("../inc/loans/payLoan.php", {"id": pid, "email": email, "loanid": loanid }, 
    function(data) {
        if(data == 1){
             M.toast({html: "Transaction was successful"});
              $('#' + pid).prop("disabled", true);
              $('.btn-details-'+pid).removeClass('col-red');
              $('.btn-details-'+pid).html('-');
              $('.pay-'+pid).hide();
              $('.done-'+pid).show();
             

        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });

    });
  });
</script>