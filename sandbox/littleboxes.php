<!DOCTYPE html>
<html>
<head>
	<? 
	$boxes = "";
	for ($i = 1; $i <= 50; $i++) {
		$w = rand (5, 250);
		$h = rand (5, 250);
		$boxes .= "<div style='width:{$w}px; height:{$h}px; float:left; margin:4px; background-color:red'></div>";
	}
	?>
</head>
<body>
	<?=
	$boxes;
	?>
</body>
</html>