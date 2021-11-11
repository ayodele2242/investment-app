<?php
require_once '../inc/config.php';
require_once '../config/function.php';
require_once 'review_pagination.php';
$pid   = $_POST['productid'];
$limit = 200;
$reviews = getLimitRatings($pid, $limit);
?>



                                 <?php   

                                 if(!$reviews){
                                 	echo '<div class="alert alert-danger">No reviews yet for this item</div>';
                                 }else{
                                
                                foreach ($reviews as $value) {
                                    
                                 ?>
                                <!-- Review -->
                                <div class="pb-2 border-bottom mb-2">
                                    <!-- Review Rating -->
                                    <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                                        <div class="text-warning text-ls-n2 font-size-16" style="width: auto;">
                                           <?php echo mrate($value['rating']); ?>
                                        </div>
                                    </div>
                                    <!-- End Review Rating -->

                                    <p class="text-gray-90"><?php echo $value['review']; ?></p>

                                    <!-- Reviewer -->
                                    <div class="mb-2">
                                        <strong><?php echo $value['name']; ?></strong>
                                        <span class="font-size-13 text-gray-23">- <?php echo $value['added_date']; ?></span>
                                    </div>
                                    <!-- End Reviewer -->
                                </div>
                                <!-- End Review -->

                                <?php 
                            } 
                        }
                        ?>