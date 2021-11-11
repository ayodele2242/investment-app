<?php
require_once '../inc/config.php';
require_once '../config/function.php';
require_once '../class/database.php';
require_once '../class/category.php';
require_once '../inc/fetch.php';
require_once "../inc/functions.php";

$category = new Category();
$parent_cats = $category->getAllParentCats();


if(isset($parent_cats) && !empty($parent_cats)){
    
  $i = 0;
  foreach (array_slice($parent_cats, 0, 5) as $parents ) {
      ?>
    <!-- item -->

      <li class="list-group-item py-2 px-3 px-xl-4 px-wd-5 flex-horizontal-center shadow-on-hover-1 rounded-0 border-top-0 border-bottom-0 flex-shrink-0 flex-md-shrink-1">
          <a href="category?cid=<?php echo $parents->id; ?>" class="d-block py-2 text-center">
              <img class="img-fluid mb-1 max-width-100-sm" src="<?php echo '../upload/category/'.$parents->featured_image; ?>" alt="<?php echo $parents->title; ?>" style="width: 100%; max-width: 100px; min-width: 130px; height: 100%; min-height: 100px; max-height: 100px;">
              <h6 class="font-size-14 mb-0 text-gray-90 font-weight-semi-bold">
                <?php 
               echo stripcslashes(mb_strimwidth($parents->title, 0, 29, "..."))
              
              ?></h6>
          </a>
      </li>
 


    <!-- * item -->
    <?php  
}
}
 ?>
  



<script>
//When the page has loaded.
$(".product_item").addClass("loadingCategories");  
$( document ).ready(function(){
   $('.loader-top').hide();
   $(".product_item").removeClass("loadingCategories");
});
</script>  