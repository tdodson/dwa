<?php
	foreach($posts as $post): 
?>

<h2><?php echo $post['first_name']?> <? echo $post['last_name']?> posted:</h2>

<?php 
	echo $post['content'];
?>

<br><br>

<?php 
	endforeach; 
?>