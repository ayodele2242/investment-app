<?php
include("header.php");
include("top-header.php");

?>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>



    <div class="nk-content nk-content-lg nk-content-fluid ">
                    <div class="container-xl wide-lg ">
                        <div class="nk-content-inner">
                            <div class="nk-content-body mt-5">
                                <div class="nk-block-head">
                                    <div class="nk-block-between-md g-3">
                                        <div class="nk-block-head-content">
                                            <div class="nk-block-head-sub">
                                                <span>Welcome!</span>
                                            </div>
                                            <div class="align-center flex-wrap pb-2 gx-4 gy-3">
                                                <div>
                                                    <h2 class="nk-block-title fw-normal"><?php echo ucwords($name); ?></h2>
                                                </div>
                                                <div><a href="#" data-toggle="modal" data-target="#modalWithdraw" class="btn btn-white btn-light">Get a Loan &nbsp;<ion-icon class="icon" name="cash-outline"></ion-icon></a></div>
                                                <div>
                                               
                                                </div>
                                            </div>
                                            <div class="nk-block-des">
                                                <p>At a glance summary of your account.</p>
                                                <?php 
                                                
                                               
                                                //echo $newDateTime = date('j M, Y h:i:s A'); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="nk-block-head-content d-none d-md-block">
                                             <div class="nk-slider nk-slider-s1">
                                                 <div class="slider-init alert alert-default" data-slick='{"dots": true, "arrows": false, "fade": true}'>

                                                   <strong>Note that your first saving belong to the Akawo Community.</strong>

                                                 </div>
                                                 

                                             </div>
                                         </div>
                                        
                                        </div>
                                    </div>
                                </div>
                                 <?php if($acno == ""){ ?>
                                <div class="nk-block">
                                    <div class="nk-news card card-bordered alert alert-danger">
                                        <div class="card-inner">
                                            <div class="nk-news-list">
                                                <div class="nk-news-item">
                                                    <div class="nk-news-icon">
                                                        <ion-icon class="icons" name="information-circle-outline"></ion-icon>
                                                    </div>
                                                   
                                                    <div class="nk-news-text">
                                                        
                                                           Your bank account details needs to be updated before you can use this platform. Follow this &nbsp;<a href="profile#accountSettings"><strong>link</strong></a>&nbsp; to update your account details.
                                                      
                                                        
                                                    </div>
                                                

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="nk-block">
                                    <div class="row gy-gs">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="nk-wg-card is-dark card card-bordered">
                                                <div class="card-inner">
                                                    <div class="nk-iv-wg2">
                                                        <div class="nk-iv-wg2-title">
                                                            <h6 class="title">
                                                                Total Saving <ion-icon name="information-circle-outline"></ion-icon>
                                                            </h6>
                                                        </div>
                                                        <div class="nk-iv-wg2-text">
                                                            <div class="nk-iv-wg2-amount">
                                                                <?php  echo getBalance($email); ?> 
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($ecashout['amount'] != ""){ ?>
                                           <div class="col-md-6 col-lg-4">
                                            <div class="nk-wg-card is-light card card-bordered">
                                                <div class="card-inner">
                                                    <div class="nk-iv-wg2">
                                                        <div class="nk-iv-wg2-title">
                                                           
                                                                <?php if($ecashout['status'] == "Pending"){ ?>
                                                                 <h6 class="title text-danger">Awaiting cashout</h6>
                                                                <?php }else if($ecashout['status'] == "Transfer has been queued"){
                                                                echo '<h6 class="title text-info">Transfer has been queued</h6>';
                                                                }else{ ?>
                                                                <h6 class="title text-success">Cash Transferred</h6>
                                                                <?php } ?>
                                                            
                                                        </div>
                                                        <div class="nk-iv-wg2-text">
                                                            <div class="nk-iv-wg2-amount">
                                                                <?php  echo number_format($ecashout['amount']); ?> 
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                       
                                        
                                         <div class="col-sm-12 col-md-4 col-lg-4">
                                            
                                            <!-- Visa - selectable -->
                                        <div class="credit-card visa selectable">
                                            <div class="credit-card-last4">
                                                <?php if(!empty($card['last4'])){ echo $card['last4']; }  ?>
                                            </div>
                                            <div class="credit-card-expiry">
                                                <?php if(!empty($card['exp_year'])){ echo $card['exp_year']; }  ?>/<?php if(!empty($card['exp_month'])){ echo $card['exp_month']; }  ?>
                                            </div>
                                        </div>
                                            
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        
                                    </div>
                                </div>
                                <div class="nk-block">
                                    <div class="row gy-gs">

                                         <div class="col-sm-12 col-lg-12">
                                            <div class="nk-wg-card card card-bordered h-100">
                                                <div class="card-inner h-100">
                                                    <div class="nk-iv-wg2">
                                                        <div class="nk-iv-wg2-title">
                                                            <h6 class="title">Recent Transactions <a href="transactions">View all</a></h6>
                                                        </div>
                                                        <div class="nk-iv-wg2-text">
                                                           
                                                           
                                                            <ul class="nk-iv-wg2-list">
                                                                <?php 
                                                                $limit = 10;
                                                                $hist = transHistory($email, $limit);
                                                                foreach($hist as $planhistory){ 

                                                                    ?>
                                                                <li <?php  if($planhistory['status'] != "pending"){ echo 'class="text-success"'; }else{ echo 'class="text-danger"'; } ?>>
                                                                     <?php if($planhistory['status'] != "pending"){ 
                                                                        echo '<ion-icon name="arrow-up"></ion-icon>'; }else{ 
                                                                        echo '<ion-icon name="arrow-down"></ion-icon>'; } 
                                                                       ?>
                                                                    <span class="item-label">

                                                                        <a href="#" <?php  if($planhistory['status'] != "pending"){ echo 'class="text-success"'; }else{ echo 'class="text-danger"'; } ?>>

                                                                            <?php echo $planhistory['saving_category']; ?> </a>
                                                                        <small>- <?php echo number_format($planhistory['amount_saved'],2); ?></small>
                                                                    </span>
                                                                    <span class="item-value"><?php echo $planhistory['created_date']; ?></span>

                                                                     
                                                                </li>

                                                            <?php } ?>
                                                               
                                                            </ul>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                      

                                       

                                         


                                    </div>
                                </div>
                                
                                <div class="nk-block">
                                    <div class="card card-bordered">
                                        <div class="nk-refwg">
                                            <div class="nk-refwg-invite card-inner">
                                                <div class="nk-refwg-head g-3">
                                                    <div class="nk-refwg-title">
                                                        <h5 class="title">Refer Us & Earn</h5>
                                                        <div class="title-sub">Use the bellow link to invite your friends.</div>
                                                    </div>
                                                    <!--<div class="nk-refwg-action">
                                                        <a href="#" class="btn btn-primary">Invite</a>
                                                    </div>-->
                                                </div>
                                                <div class="nk-refwg-url">
                                                    <div class="form-control-wrap">
                                                        <div class="form-clip clipboard-init">
                                                           <ion-icon name="copy"></ion-icon>
                                                            <span class="clipboard-text" onclick="copy('hello world')">Copy Link</span>
                                                        </div>
                                                        <div class="form-icon">
                                                           <ion-icon name="link"></ion-icon>
                                                        </div>
                                                        <input type="text" class="form-control copy-text" id="refUrl" value="<?php echo $set['installUrl']; ?>login-signup?ref=<?php if(!empty($refCode)){ echo $refCode; }else{ echo "nil"; }    ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-refwg-stats card-inner bg-lighter">
                                                <div class="nk-refwg-group g-3">
                                                    <div class="nk-refwg-name">
                                                        <h6 class="title">
                                                            My Referral  <ion-icon name="information-circle" data-toggle="tooltip" data-placement="right" title="Referral Informations"></ion-icon>
                                                           
                                                        </h6>
                                                    </div>
                                                    <div class="nk-refwg-info g-3">
                                                        <div class="nk-refwg-sub">
                                                            <div class="title">
                                                            <?php
                                                            if($refRow['totReferred'] != ""){
                                                                echo number_format($refRow['totReferred']);
                                                            }else{
                                                                echo 0;
                                                            }
                                                            ?>
                                                            </div>
                                                            <div class="sub-text">Total Joined</div>
                                                        </div>
                                                        <div class="nk-refwg-sub">
                                                            <div class="title">
                                                                <?php
                                                            if($refRow['totAmt'] != ""){
                                                                echo number_format($refRow['totAmt']);
                                                            }else{
                                                                echo 0;
                                                            }
                                                            ?>
                                                            </div>
                                                            <div class="sub-text">Referral Earn</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-refwg-more dropdown mt-n1 mr-n1">
                                                        <a href="#" class="btn btn-icon btn-trigger" data-toggle="dropdown">
                                                           <ion-icon name="more"></ion-icon>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                                            <ul class="link-list-plain sm">
                                                                <li>
                                                                    <a href="#">7 days</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">15 Days</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">30 Days</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-refwg-ck">
                                                    <canvas class="chart-refer-stats" id="refBarChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
<div class="modal fade zoom" tabindex="-1" id="modalWithdraw">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                <ion-icon class="icon" name="wallet"></ion-icon> Get a Loan</h5>
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <ion-icon name="close"></ion-icon>
            </a>
        </div>
        <div class="modal-body" id="pass-con">
            
            <h4>Loan coming soon</h4>
            
          <!--<form id="cashOutForm">
           
            <div class="col-lg-12">
                
                <?php  
                $querys = "
                SELECT total_saved as savings FROM savings_total where email='$email'";
                $getifs = mysqli_query ($mysqli, $querys);
                $srow = mysqli_fetch_array($getifs);
                $myamt = $srow['savings'];
                $interestdue = round($myamt / 100 * 25);
                
                ?>

                 <p>You are about to withdraw <b><?php echo number_format($interestdue);  ?></b></p> 
                 <input type="hidden" name="cashoutAmt" value="<?php echo $interestdue;  ?>">
                  <input type="hidden" name="email" value="<?php echo $email;  ?>">
                     
           </div>
            <div class="col-lg-12">
                <?php if($interestdue > 0){ ?>
                <div align="center"><button class="btn btn-lg btn-warning" id="cashOutBtn">Cashout</button></div>
                <?php }else{ ?>
                <div align="center" class="alert alert-danger">You do not have enough saving to be able to cashout</div>
                <?php } ?>
            </div>
         
          </form>-->
           
        </div>
        
    </div>
</div>
</div>

<?php
include("footer.php");
?>

<script type="text/javascript">
 $("#cashOutBtn").click(function(e) {
      e.preventDefault();
      $("#cashOutBtn").html("Processing");
       var serializedData = $("#cashOutForm").serialize();
       $.ajax({
            type : 'POST',
            url  : '../inc/payment/emergencyCashout.php',
            data : serializedData,
            success :  function(data)
            {
                if(data == 1)
                {

                   $.toast({ 
                      text : 'We have received your request. We will get back to you.', 
                      showHideTransition : 'fade',
                      bgColor : 'green',            
                      textColor : '#fff',
                      allowToastClose : false,
                      hideAfter : 4000,
                      loader: false,            
                      stack : 5,                     
                      textAlign : 'center', 
                      position : 'top-right'  
                  });
                  $("#cashOutBtn").html("Cashout");
                  location.reload(true);
                  
                }else{
                    
                  $("#cashOutBtn").html("Cashout");
                  $.toast({ 
                      text : data, 
                      showHideTransition : 'fade',
                      bgColor : 'red',            
                      textColor : '#fff',
                      allowToastClose : false,
                      hideAfter : 4000,
                      loader: false,            
                      stack : 5,                     
                      textAlign : 'center', 
                      position : 'top-right'  
                  });

                  
                    

                }
            }
        });
        return false;
      
      
 });
     
    </script>