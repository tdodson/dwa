<!doctype html> 
<html lang="en">
<head>
	<meta charset="utf-8">  
	<title>Contestants</title>
</head>
<body>
	<?php
	$contestants = array("Sam","Eliot","Liz","Max");
	$contestants["Liz"] = "loser";
	echo $contestants["Liz"]; ?><br>
	
	<?php $contestants2 = array("first_name" => "Thomas", "last_name" => "Dodson", "winner_loser" => "winner"); ?>
	<?=$contestants2["first_name"] . " " . $contestants2["last_name"];?> is a <?=$contestants2["winner_loser"];?><br>
	<pre>
		<?php print_r($contestants2);?>
	</pre>

	<?php 
	$contestants3 = array(1,2,3,4);
	$contestants3[1] = "Sam";
	$contestants3[2] = "Eliot";
	$contestants3[3] = "Liz";
	$contestants3[4] = "Max"; 
	?>
	<pre>
		<?php print_r($contestants3);?>
	</pre>

	<?php $contestantsx = array("first_name" => array("Sam", "Eliot", "Liz", "Max")); ?>
	<pre><?php print_r($contestantsx);?></pre>
	<?=$contestantsx["first_name"][1]; ?>



</body>
</html>