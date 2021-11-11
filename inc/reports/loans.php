<?php 
include '../config.php';
//include '../function.php';
error_reporting(0);

 if($_POST['from_date'] || $_POST['to_date'])
          {
            $count_post = 0;
            
            $query = "SELECT loan_disburse.*, sum(loan_disburse.amt_borrowed) as loan_amt_borrowed, sum(loan_disburse.interest) as loan_insterest, loans_packages.name FROM loan_disburse INNER JOIN loans_packages ON loans_packages.id = loan_disburse.loan_id WHERE (";
            
            if($_POST['from_date'])
            {
              $count_post++;
              
             //$from = date("Y-m-d", strtotime($_POST['from_date']));  

             $date = DateTime::createFromFormat('d/m/Y', $_POST['from_date']);
              $from = $date->format('Y-m-d');

             
              $query .= "loan_disburse.rdate >= '$from' ";
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

              $query .= "loan_disburse.rdate <= '$to'";
            }
                        
            $query .= ") group BY loan_disburse.id ORDER BY loan_disburse.id DESC";

           
          }
          else
          {
            $query = "SELECT loan_disburse.*, sum(loan_disburse.amt_borrowed) as loan_amt_borrowed, sum(loan_disburse.interest) as loan_insterest, loans_packages.name FROM loan_disburse INNER JOIN loans_packages ON loans_packages.id = loan_disburse.loan_id group BY loan_disburse.id ORDER BY loan_disburse.id DESC";
           

          }

  $query = mysqli_query($mysqli, $query);
 

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

<div class="col l12 s12 mt-3 mb-3">
 <h6>Loans Details</h6>
<table class="table">
  <thead>
 <th style="text-align: center;">Loan Category</th> 
 <th style="text-align: center;">Amount Borrowed</th> 
 <th style="text-align: center;">Interest</th>
</thead>
<tbody>
  
<?php
$totInc = 0;
while($incom = mysqli_fetch_array($query)){ 
$totInt += $incom['loan_insterest'];
$totBorrowed += $incom['loan_amt_borrowed'];
?>
<tr>
<td style="text-align: center;"><?php echo ucwords($incom['name']); ?></td>
<td style="text-align: center;"><?php echo number_format($totBorrowed,2); ?></td>
<td style="text-align: center;"><?php echo number_format($totInt,2); ?></td>

</tr>
<?php } ?>

<tr style="background: #f0f0f0;">
<td style="font-weight:bolder; text-align: center;">TOTAL</td>
<td style="font-weight:bolder; text-align: center;"><?php echo number_format($totBorrowed); ?></div></td>
<td style="font-weight:bolder; text-align: center;"><?php echo number_format($totInt); ?></div></td>
  </tr>
</tbody>
</table>

</div>



<div class="col s12 l12 alert alert-info"><div align="center"><h5>Total Profit:&nbsp;&nbsp;&nbsp; <?php echo number_format($totBorrowed - $totInt); ?>  </h5></div></div>
 </div>
    
    <script>
    
    $(document).ready(function(e) {
      
      //window.print();
      
    });
    
  </script>


</body>
</html>
<?php //require '../databaseConnection/close_connection.php' ?>

