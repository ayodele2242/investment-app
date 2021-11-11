<?php
include("header.php");
include("header_bottom.php");

include("left_nav.php");
$query = mysqli_query($mysqli,"select * from faqs");
$row = mysqli_fetch_array($query);

$qu = mysqli_query($mysqli,"select * from faqplus order by cont_id desc");
$count = mysqli_num_rows($qu);

if(isset($_GET['del'])){
  $id = $_GET['del'];
  $query2 = mysqli_query($mysqli, "SELECT * FROM faqplus WHERE cont_id = '$id'");
  $irow = mysqli_fetch_array($query2);
  

  if($query){
    $delMsg = '<div class="alert alert-warning">Are you surely you want to delete <b>'.$irow['title'].'</b>?  <a href="faq-list?yes_del='.$irow['cont_id'].'">Yes, delete it</a></div>';
  }
}
if(isset($_GET['yes_del'])){
  $id = $_GET['yes_del'];
  $query = mysqli_query($mysqli,"delete from faqplus WHERE cont_id = '$id'");
  if($query){
    $message = '<div class="alert alert-success">Deleted successfully</div>';
  }else{
    $delMsg = '<div class="alert alert-danger">Delete failed. '.$mysqli->error.'</div>';
  }

  }
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">note</i> FAQs List</h4>
              </div>
             
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
      <div class="card-content gradient-shadow">
      	  <?php
          if(isset($message)){
            echo $message;
            ?>
            <script type="text/javascript">
              setTimeout(function() {
              window.location.replace("faqs");
            }, 2000);
            </script>
            <?php
          }else{
            $message = "";
          }

          if(isset($delMsg)){
            echo $delMsg;
          }else{
            $delMsg = "";
          }
          ?>
      	<table class="table striped">
      		<thead>
      			<th>Title</th>
      			<th>Details</th>
      			<th></th>

      		</thead>
      		<tbody>
      	<?php

      	while($row = mysqli_fetch_array($qu)){
      		?>
      		<tr>
   <td><?php echo $row['title']; ?></td>
   <td><?php echo $row['dtl']; ?></td>
   <td>
   	 <a href="faqs?id=<?php echo $row['cont_id']; ?>"  class="btn btn-floating waves-effect waves-light green z-depth-3 btn-small modal-trigger usermodal" type="button" title="Edit"><i class="material-icons left">create</i></a>
   	 <a href="faq-list?del=<?php echo $row['cont_id']; ?>" class="btn btn-floating delUser waves-effect waves-light red z-depth-4 btn-small" type="button" title="Delete"><i class="material-icons left">delete</i></a>
   </td>
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

  



<?php
include("footer.php");
?>

