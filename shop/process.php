<?php
  require '../inc/config.php';
   header('Content-type: application/json; charset=utf-8');

   if(isset($_POST['id'])){
   $json = array();
   $id =  trim($_POST['id']);
   $query = "SELECT id, product_id, size, variant_price, image FROM product_sizes WHERE id = ?";
   $statement = $mysqli->prepare($query);
   $statement->bind_param('s', $id);
   $statement->execute();
   $statement->bind_result($nId, $npid, $nSize, $nAmount, $nImage);
   while ($statement->fetch()){
      $user=array('id'=>$nId,'product_id'=>$npid,'size'=>$nSize,'amount'=>$nAmount,'image'=>$nImage);
       array_push($json,$user);
   }
   echo json_encode($json, true);
   
    }

    if(isset($_POST['name'])){
      $json = array();
      $id =  trim($_POST['name']);
      $query = "SELECT regiNo, firstName, middleName, lastName FROM student WHERE regiNo = ?";
      $statement = $mysqli->prepare($query);
      $statement->bind_param('s', $id);
      $statement->execute();
      $statement->bind_result($rno, $fname, $mname, $lname);
      while ($statement->fetch()){
         $user=array('rno'=>$rno,'fname'=>$fname,'mname'=>$mname,'lname'=>$lname);
          array_push($json,$user);
      }
      echo json_encode($json, true);
      
       }


    




  ?>