<?php
include("inc/config.php");
//Check if cron works


mysqli_query($mysqli, "insert into cron_test(text)values('This cron job works')");


?>