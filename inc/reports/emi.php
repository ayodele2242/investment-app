<?php 
include '../config.php';
//include '../function.php';
error_reporting(0);

 if($_POST['from_date'] || $_POST['to_date'])
          {
            $count_post = 0;
            
            $query = "SELECT expenses.*, sum(amount) as totExp FROM expenses WHERE (";
            
            if($_POST['from_date'])
            {
              $count_post++;
              
             //$from = date("Y-m-d", strtotime($_POST['from_date']));  

             $date = DateTime::createFromFormat('d/m/Y', $_POST['from_date']);
              $from = $date->format('Y-m-d');

             
              $query .= "expenses.created_date >= '$from' ";
            }
            if($_POST['to_date'])
            {
              $count_post++;
              
              if($count_post > 1)
              {
                $query .= " AND ";
              }
             $date = DateTime::createFromFormat('d/m/Y', $_POST['to_date']);
              $to = $date->format('Y-m-d');

              $query .= "expenses.created_date <= '$to'";
            }
                        
            $query .= ") group BY exp_id ORDER BY exp_id DESC";

            //income

            $income_query = "SELECT incomes.*, sum(amount) as totInc FROM incomes WHERE (";
            
            if($_POST['from_date'])
            {
              $count_post++;
              
            
              $date = DateTime::createFromFormat('d/m/Y', $_POST['from_date']);
              $from = $date->format('Y-m-d');

             
              $income_query .= "incomes.created_date >= '$from'";
            }
            if($_POST['to_date'])
            {
              $count_post++;
              
              if($count_post > 1)
              {
                $income_query .= " AND ";
              }
              $date = DateTime::createFromFormat('d/m/Y', $_POST['to_date']);
              $to = $date->format('Y-m-d');


              $income_query .= "incomes.created_date <= '$to'";
            }
                        
            $income_query .= ") group by inc_id  ORDER BY inc_id DESC";
            
          }
          else
          {
            $query = "SELECT expenses.*, sum(amount) as totExp FROM expenses group by exp_id ORDER BY exp_id DESC";
            $income_query = "SELECT incomes.*, sum(amount) as totInc FROM incomes group by inc_id ORDER BY inc_id DESC";

          }

  $exp_query = mysqli_query($mysqli, $query);
  $inc_query = mysqli_query($mysqli, $income_query);

  //$suninc = mysqli_fetch_array($inc_query);
?>	
	



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php //echo user_name_user($_SESSION['HrM']);?></title>
 <link rel="stylesheet" type="text/css" href="../assets/default/main/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/mstepper.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/animate.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/chartist.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/chartist-plugin-tooltip.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/materialize.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/dashboard-modern.css">
    <!--<link rel="stylesheet" type="text/css" href="../assets/default/main/css/form-wizard.css">-->
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/custom.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/jquery.mCustomScrollbar.css" />
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/color.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/table.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/tabs.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/dropify.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/spectrum.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/docs.css">
    <link type="text/css" rel="stylesheet" href="../assets/default/main/css/responsive-tabs.css" />
    <link type="text/css" rel="stylesheet" href="../assets/default/main/css/p-loading.css" />
    <link href="../assets/css/print.css" rel="stylesheet" media='print'>
<style type="text/css">
  body,html{
    background: #f0f0f0;
  }
  .mydivs{
    margin: 0 auto;
    left: 0;
    right: 0;
    padding: 10px;
    width: 600px;
    background: #fff;
    margin-bottom: 25px;
    border: solid 1px #fff;
  }

</style>
<body>
<div>
<div id="header_prvs"></div>
</div>
<!--<div style="width:595px; margin:auto; margin-bottom:20px;"><input type="submit" class="btn btn-info" value="Print" style="padding:5px; width:90px;" onclick="window.print()"></div>-->

 <div class="row">

<div class="col l6 mt-3 mb-3">
 <h6>Income Details</h6>
<table class="table_view">
  <thead>
 <th>Income Category</th> 
 <th>Amount</th> 
 <th>Received from</th>
  <th>Income Date</th>
</thead>
<tbody>
  
<?php
$totInc = 0;
while($incom = mysqli_fetch_array($inc_query)){ 
$totInc += $incom['totInc'];
?>
<tr>
<td ><?php echo ucwords($incom['Inc_type']); ?></td>
<td ><?php echo number_format($incom['amount'],2); ?></td>
<td ><?php echo ucwords($incom['receive_from']); ?></td>
<td><?php echo date("M jS, Y", strtotime($incom['created_date']));  ?></td>
</tr>
<?php } ?>

<tr>
<td colspan="4"><div align="right" style="font-size: 18px; font-weight: bolder;">Income total:&nbsp;&nbsp;&nbsp; <?php echo number_format($totInc); ?></div></td>
  </tr>
</tbody>
</table>

</div>

<div class="col l6 mt-3 mb-3">
   <h6>Expenses Details</h6>
<table class="striped">
  <thead>
 <th>Expense Category</th> 
 <th>Amount</th> 
 <th>Used for</th>
  <th>Expense Date</th>
</thead>
<tbody>
  
<?php
$totExp = 0;
while($exp = mysqli_fetch_array($exp_query)){ 
$totExp += $exp['totExp'];
?>
<tr>
<td width="100"><?php echo ucwords($exp['exp_type']); ?></td>
<td width="30"><?php echo number_format($exp['amount'],2); ?></td>
<td width="100"><?php echo ucwords($exp['receive_from']); ?></td>
<td width="150"><?php echo date("M jS, Y", strtotime($exp['created_date']));  ?></td>
</tr>
<?php } ?>

<tr>
<td colspan="4"><div align="right" style="font-size: 18px; font-weight: bolder;">Expenses total:&nbsp;&nbsp;&nbsp; <?php echo number_format($totExp); ?></div></td>
  </tr>
</tbody>
</table>

</div>

<div class="col s12 l12 alert alert-info"><div align="center"><h5>Total Profit:&nbsp;&nbsp;&nbsp; <?php echo number_format($totInc - $totExp); ?>  </h5></div></div>
 </div>
    
    <script>
    
    $(document).ready(function(e) {
      
      //window.print();
      
    });
    
  </script>


</body>
</html>
<?php //require '../databaseConnection/close_connection.php' ?>

