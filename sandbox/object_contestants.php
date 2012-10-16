<!doctype html> 
<html lang="en">
<head>
	<meta charset="utf-8">  
	<title>Contestants</title>
</head>
<body>
	<?php
	class Contestant
	{
		public $_first_name;
		public $_last_name;
		public $_number;

		public function __construct($first_name, $last_name) // could $number herejust be rand(5,15)?
		{
			$this->_first_name = $first_name;
			$this->_last_name = $last_name;
			$this->_number = rand(5,15);
		}

		public function changeNumber($newnumber)
		{
			$this->_number = $newnumber;
		}

	}

//Create Contestant Objects
	$contestant1 = new Contestant("Sam", "Smith");
	$contestant2 = new Contestant("Elliot", "Day");
	$contestant3 = new Contestant("Liz", "Taylor");
	$contestant4 = new Contestant("Max", "Weber");

 //Display Contestants
	echo "<pre>Contestant 1: ", print_r($contestant1, TRUE), "</pre>";
	echo "<pre>Contestant 2: ", print_r($contestant2, TRUE), "</pre>";
	echo "<pre>Contestant 3: ", print_r($contestant3, TRUE), "</pre>";
	echo "<pre>Contestant 4: ", print_r($contestant4, TRUE), "</pre> <br><br>";

	$contestant1->changeNumber(5);	

	echo $contestant1->_number;


	
	if ($contestant1->_number == 5) 
{
	echo $contestant1->_first_name . "is a winner!";
} else {
	echo $contestant1->_first_name . "is a loser.";
}

	?>
</body>
</html>