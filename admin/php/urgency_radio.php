<?php

$info_array=$task_database->getUrgency();

$row1 = "<tr>";
$row2 = "<tr>";

$cellWidth = 100 / count($info_array);

foreach ($info_array as $record)
{
	$checked="";
	if($task_urgency_id==$record[0])
	{	$checked=" checked=\"checked\" ";	}

	$row1 .= "<td width=\"".$cellWidth."%\">".str_replace(" ","<br />",$record[1])."</td>";
	$row2 .= "<td><input type=\"radio\" name=\"radUrgency\" value=\"".$record[0]."\" ".$checked."/></td>";
	
}

$row1 .= "</tr>";
$row2 .= "</tr>";

echo "<table class=\"tabRadio\">".$row1.$row2."</table>";
