<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["EMERGENCY WITHDRAWAL"]["EMERGENCY PAID OUT"]["create"]) || 
authorize($_SESSION["access"]["EMERGENCY WITHDRAWAL"]["EMERGENCY PAID OUT"]["edit"]) || 
authorize($_SESSION["access"]["EMERGENCY WITHDRAWAL"]["EMERGENCY PAID OUT"]["view"]) || 
authorize($_SESSION["access"]["EMERGENCY WITHDRAWAL"]["EMERGENCY PAID OUT"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

include("left_nav.php");
?>


    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-blue-grey-blue gradient-shadow"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">people</i> Emergency Paid Out</h4>
              </div>
             
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
      <div class="card-content gradient-shadow">
            
    <div class="row">
        <div class="col s12 refresh">

           <div class="switch" style="padding: 10px; margin-bottom: 10px;"> 
            Account Status Indicator: 
    <label>
       <i class="text-green">Activated</i>
      <input type="checkbox" checked disabled>
      <span class="lever"></span>
    </label>
     <label>
     De-activated
      <input disabled type="checkbox">
      <span class="lever"></span>
  
    </label>

  </div>

     <table class="table_view">
       <thead>
       <th>Name</th>
       <th>Email</th>
       <th>Phone</th>
       <th>Amount</th>
       <th>Transaction Code</th>
       <th>Status</th>
        
       </thead>
       <tbody class="refresh">
       <?php  
       $row = getPaidEmergency();
       foreach($row as $rows){
        $name = $rows['last_name']. ' '.$rows['first_name'];
        ?> 
        <tr class="animated fadeIn">
        <td><?php echo ucwords($rows['last_name']. ' '.$rows['first_name']); ?></td>
        <td><?php echo ucwords($rows['email']); ?></td>
        <td><?php echo $rows['phone']; ?></td>
        <td><?php echo number_format($rows['amount']); ?></td>
        <td><?php echo $rows['transfer_code']; ?></td>
        <td><?php echo $rows['estatus']; ?></td>
   
        </tr>

        <?php
        }
        ?>
       </tbody>


     </table>       
            
                   
        </div>
    </div>

                        
</div>
</div>
</div>
</div>
</div>
</div>


<?php include("right_menu.php"); ?>
         
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

  

 <div id="Withdraw-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header" id="tite-info"></div>
           <!-- mysql data will be load here -->                          
           <div id="contents">
               <div class="row roe-ibody">
                   <div class="col l12" id="amtDetail"></div>
                   <div class="col l12 mt-2" id="toAc"></div>
                   <div class="col l12  " id="bankname"></div>
                   <div class="col l12  mb-3" id="repCode"></div>
                   
                   
                   
               </div>
               <form id="paymentForm">
                   <input type="hidden" name="rname" value="" id="rname">
                   <input type="hidden" name="pid" value="" id="pid">
                   <input type="hidden" name="amount" value="" id="amount">
                   <input type="hidden" name="email" value="" id="iemail">
                   <input type="hidden" name="acno" value="" id="acno">
                   <input type="hidden" name="bankcode" value="" id="bankcode">
                   <input type="hidden" name="recipientCode" value="" id="recipientCode" readonly>
                   <div align="center" class="mt-5">
                   <button class="btn btn-block" id="sendMoney">Process</button>
                   <button class="btn btn-block" id="tranferMoney">Send Money</button>
                   
                   </div>
                   
               </form>
               
                 <form id="otpForm">
                   <input type="text" placeholder="Enter otp" name="otp" value="" id="otp" >
                   
                   <input type="hidden" name="transfer_code" value="" id="itransfer_code">
                   <input type="hidden" name="ref" value="" id="iref">
                   
                   <div align="center" class="mt-5">
                   
                   <button class="btn btn-block" id="confirmOPT">Confirm OTP</button>
                   
                   </div>
                   
               </form>
                <div class="row">
               <div class="col l12 mt-4 mb-3" id="resp"></div>
               </div>
               
           </div>
    </div>
    
  </div>
  
   <!--<div id="otp-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header" id="itite-info"></div>
                                  
           <div id="contents">
              
               <form id="paymentForm">
                   <input type="text" placeholder="Enter otp" name="otp" value="" id="otp" >
                   
                   <input type="text" name="transfer_code" value="" id="itransfer_code">
                   <input type="text" name="ref" value="" id="iref">
                   
                   <div align="center" class="mt-5">
                   
                   <button class="btn btn-block" id="tranferMoney">Confirm OTP</button>
                   
                   </div>
                   
               </form>
                <div class="row">
               <div class="col l12 mt-4 mb-3" id="resp"></div>
               </div>
               
           </div>
    </div>
    
  </div>-->
    


<?php
include("footer.php");
?>

