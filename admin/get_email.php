 <?php
require_once('../inc/config.php');
if(isset($_POST["confirm_no"]) && $_POST["confirm_no"] == "A"){
    
    $d = $_POST['confirm_no'];
    $query = mysqli_query($mysqli, "select distinct email from members WHERE status = '1'");
    
    if(mysqli_num_rows($query) > 0){
    // You have many results - fetch them all iteratively
    // use `fetch_assoc` to have ability to use `mails`
    while ($row = mysqli_fetch_assoc($query)) {
        $emailArr[] = $row["email"];
    }
    $emails = implode(";", $emailArr);

    echo $emails;
}else{
    echo 'No email for this selection.';
}
}

if(isset($_POST["confirm_no"]) && $_POST["confirm_no"] == "I"){
    
    $d = $_POST['confirm_no'];
    $query = mysqli_query($mysqli, "select distinct email from members WHERE status != '1'");
    
    if(mysqli_num_rows($query) > 0){
    // You have many results - fetch them all iteratively
    // use `fetch_assoc` to have ability to use `mails`
    while ($row = mysqli_fetch_assoc($query)) {
        $emailArr[] = $row["email"];
    }
    $emails = implode(";", $emailArr);

    echo $emails;
}else{
    echo 'No email for this selection.';
}
}

if(isset($_POST["confirm_no"]) && $_POST["confirm_no"] == "All"){
    
    $d = $_POST['confirm_no'];
    $query = mysqli_query($mysqli, "select distinct email from members");
    
    if(mysqli_num_rows($query) > 0){
    // You have many results - fetch them all iteratively
    // use `fetch_assoc` to have ability to use `mails`
    while ($row = mysqli_fetch_assoc($query)) {
        $emailArr[] = $row["email"];
    }
    $emails = implode(";", $emailArr);

    echo $emails;
}else{
    echo 'No email for this selection.';
}
}







if(isset($_POST["sms"]) && $_POST["sms"] == "A"){
    
    $d = $_POST['sms'];
    $query = mysqli_query($mysqli, "select distinct phone from members WHERE status = '1'");
    
    if(mysqli_num_rows($query) > 0){
    // You have many results - fetch them all iteratively
    // use `fetch_assoc` to have ability to use `mails`
    while ($row = mysqli_fetch_assoc($query)) {
        $phoneArr[] = $row["phone"];
    }
    $phones = implode(",", $phoneArr);

    echo $phones;
}else{
    echo 'No phone number available for this selection.';
}
}

if(isset($_POST["sms"]) && $_POST["sms"] == "I"){
    
    $d = $_POST['sms'];
    $query = mysqli_query($mysqli, "select distinct phone from members WHERE status != '1'");
    
    if(mysqli_num_rows($query) > 0){
    
   while ($row = mysqli_fetch_assoc($query)) {
        $phoneArr[] = $row["phone"];
    }
    $phones = implode(",", $phoneArr);

    echo $phones;
}else{
   echo 'No phone number available for this selection.';
}
}

if(isset($_POST["sms"]) && $_POST["sms"] == "All"){
    
    $d = $_POST['sms'];
    $query = mysqli_query($mysqli, "select distinct phone from members");
    
    if(mysqli_num_rows($query) > 0){
    
    while ($row = mysqli_fetch_assoc($query)) {
        $phoneArr[] = $row["phone"];
    }
    $phones = implode(",", $phoneArr);

    echo $phones;
}else{
    echo 'No phone number available for this selection.';
}
}

?>