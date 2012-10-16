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
		private $_first_name;
		private $_last_name;
		private $_number;

		public function __construct($first_name, $last_name, $number) 
		{
			$this->_first_name = $first_name;
			$this->_last_name = $last_name;
			$this->_number = $number;
		}

		public function changeNumber($newnumber)
		{
			$this->_number = $newnumber;
		}

	}

//Create Contestant Objects
	$contestant1 = new Contestant("Sam", "Smith", 1);
	$contestant2 = new Contestant("Elliot", "Day", 2);
	$contestant3 = new Contestant("Liz", "Taylor", 1);
	$contestant4 = new Contestant("Max", "Weber", 1);

//Display Contestants
	echo "<pre>Contestant 1: ", print_r($contestant1, TRUE), "</pre>";
	echo "<pre>Contestant 2: ", print_r($contestant2, TRUE), "</pre>";
	echo "<pre>Contestant 3: ", print_r($contestant3, TRUE), "</pre>";
	echo "<pre>Contestant 4: ", print_r($contestant4, TRUE), "</pre>";
	?>
</body>
</html>