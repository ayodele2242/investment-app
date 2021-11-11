<div class="fixed-top">
<div class="navbar-area">
<nav id='cssmenu'>
<div class="logo"><a href="<?php echo url; ?>"><img src="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?>" alt="logo" ></a></div>	



<div id="head-mobile"></div>
<div class="button"></div>
<!-- Collapsible content -->



<?php
function display_children($parent, $level) {
    global $mysqli;
    $result = mysqli_query($mysqli,"SELECT a.id, a.name, a.link, Deriv1.Count FROM `navigation_bar` a  LEFT OUTER JOIN (SELECT parent_id, COUNT(*) AS Count FROM `navigation_bar` GROUP BY parent_id) Deriv1 ON a.id = Deriv1.parent_id WHERE a.parent_id=" . $parent);
    if(!$result){ echo $mysqli->error; }
    echo "<ul>";
    while ($row = mysqli_fetch_array($result)) {
        if ($row['Count'] > 0) {
            echo "<li><a href=page?name=" . $row['link'] . ">" . $row['name'] . "</a>";
			display_children($row['id'], $level + 1);
			echo "</li>";
        } elseif ($row['Count']==0) {
            echo "<li><a href=page?name=" . $row['link'] . ">" . $row['name'] . "</a></li>";
        } else;
    }
    echo "</ul>";
}

?>



<?php echo display_children(0, 4); ?>

<!--<div class="navbar-option-item">
<a href="login-signup" class="btn1 blue-gradient btn-with-image text-nowrap">
<i class="fa fa-lock"></i>
<i class="fa fa-lock"></i>
Sign Up / Login
</a>
</div>-->	

<div class="login-btn">
<a href="login-signup" class="btn1 blue-gradient btn-with-image text-nowrap">
<i class="fa fa-lock"></i>
<i class="fa fa-lock"></i>
Sign Up / Login
</a></div>	

 </nav>
</div>
</div>
