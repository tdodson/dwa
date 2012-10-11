<!doctype html> 
<html lang="en">
<head>
	<meta charset="utf-8">  
	<title>Contestants</title>
</head>
<body>
	<?php $contestants = array("first_name" => array("Sam", "Eliot", "Liz", "Max"), "winner_loser" => array("winner", "loser", "winner", "loser")); ?>
	<?=$contestants["first_name"][0];?> is a <?=$contestants["winner_loser"][0];?><br>
	<?=$contestants["first_name"][1];?> is a <?=$contestants["winner_loser"][1];?><br>
	<?=$contestants["first_name"][2];?> is a <?=$contestants["winner_loser"][2];?><br>
	<?=$contestants["first_name"][3];?> is a <?=$contestants["winner_loser"][3];?><br>
</body>
</html>