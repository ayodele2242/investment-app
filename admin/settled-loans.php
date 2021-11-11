<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["LOAN PRODUCTS"]["SETTLED LOANS"]["create"]) || 
authorize($_SESSION["access"]["LOAN PRODUCTS"]["SETTLED LOANS"]["edit"]) || 
authorize($_SESSION["access"]["LOAN PRODUCTS"]["SETTLED LOANS"]["view"]) || 
authorize($_SESSION["access"]["LOAN PRODUCTS"]["SETTLED LOANS"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

include("left_nav.php");
?>
<style>
   tr > td > span{
        font-weight: bolder;
        text-align:center;
       
    }
    
  
</style>

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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">people</i> SETTLED LOANS</h4>
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
        <div class="col s12 refresh scroll">

          <p id="selectTriggerFilter"><label><b>Filter:</b></label><br></p>
     <table id="tableTrigger" class="table_view ">
       <thead>
        
       
      <th>Name</th>
       <th>Email</th>
       <th>Phone</th>
       <th>Loan Type</th>
       <th>Amount Borrowed</th>
       <th>Interest</th>
       <th>Total</th>
       <th>Loan Duration</th>
       <th>Status</th>
       
 
       </thead>
       <tbody class="refresh">
       <?php  
       $invest = getSettledLoan();
       foreach($invest as $rows){
        
        
        ?> 
        <tr class="animated fadeIn">
        <td><?php echo ucwords($rows['name']); ?></td>
        <td><?php echo $rows['email']; ?></td>
        <td><?php echo $rows['phone']; ?></td>
         <td><?php echo ucwords($rows['loan_type']); ?></td>
        <td><?php echo number_format($rows['amt_borrowed'],2); ?></td>   
        <td><?php echo number_format($rows['interest'],2); ?></td>  
        <td><?php echo number_format($rows['total'],2); ?></td>  
        <td><?php echo $rows['duration']; ?></td> 
        <td>Loan Settled</td>
        
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

  

 <div id="LOAN PRODUCTS-modal" class="modal">
    <div class="modal-content">
     <div id="modal-loader" style="display: none; text-align: center;">
           <!-- ajax loader -->
           <img src="../assets/img/loading.gif">
           </div>
                            
           <!-- mysql data will be load here -->                          
           <div id="contents"></div>
    </div>
    
  </div>
    


<?php
include("footer.php");
?>

<script>
 //Delete User from users' list
 $(document).ready(function(){
    $(".delUser").click(function() {
     var pid = $(this).attr('id'); // get id of clicked row  
     var name = $(this).attr('data-name');

     
     if (confirm("Are you sure you want to delete? There is no undo.")) {
     $.post("../inc/user/deleteInvestment.php", {"id": pid, }, 
    function(data) {
        if(data == 1){
             M.toast({html: "Investment Delected"});
             location.reload();
            // $(".refresh").load(location.href + ".refresh");
            //alert(data);
        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });
    }

    });
  });
</script>

<script type="text/javascript">
  
$(document).ready(function(){
   //User's account status update
      $('.invDetails').on('click', function() {
       
      var checkStatus = this.checked ? 1 : 0;
      var id = $(this).attr('id');
     
    $.post("../inc/members/investor_status_updates.php", {"id": id, "sta":checkStatus, }, 
    function(data) {
        if(data == 1){
           // $('#email_status').prop( "checked", true );
             M.toast({html: "User Account Activated", classes: 'alert-success'});
            //alert(data);
        }else if(data == 0){
            //$('#email_status').prop( "checked", false );
             M.toast({html: "User Account Deactivated", classes: 'alert-warning'});
        }else{
            M.toast({html: data, classes: 'alert-danger'});
            //alert(data);
        }
        
    });
    });

});




var table = $('#tableTrigger').DataTable({
 "lengthMenu": [
      [50, 100, -1],
      [50, 100, "All"]
    ],
    "scrollY": "400px",
     "scrollX": true,
   
   /* "dom": 'rtipS',
    // searching: false,
    "deferRender": true,
    initComplete: function() {
      var column = this.api().column(0);

      var select = $('<select class="filter"><option value="">Search</option></select>')
        .appendTo('#selectTriggerFilter')
        .on('change', function() {
          var val = $(this).val();
          //column.search(val ? '^' + $(this).val() + '$' : val, true, false).draw();
          column.search(val).draw()
        });

       var offices = []; 
       column.data().toArray().forEach(function(s) {
          s = s.split(',');
          s.forEach(function(d) {
            if (!~offices.indexOf(d)) {
              offices.push(d)
              select.append('<option value=' + d + '>' + d + '</option>');                         }
          })
       })    
     
    }*/
  });







</script>
<SCRIPT language="javascript">

    $(function () {

        // add multiple select / deselect functionality

        $("#selectall").click(function () {

            $('.name').attr('checked', this.checked);

        });

 

        // if all checkbox are selected, then check the select all checkbox

        // and viceversa

        $(".name").click(function () {

 

            if ($(".name").length == $(".name:checked").length) {

                $("#selectall").attr("checked", "checked");

            } else {

                $("#selectall").removeAttr("checked");

            }

 

        });

    });

</SCRIPT>