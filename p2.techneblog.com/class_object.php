<?php 

class Contestant {
	public $name = "";
	public $number = "";
}

$Sam = new Contestant;

$Sam->name="Sam";
$Sam->number=rand(1,9);

echo $Sam->name;
echo $Sam->number;

$Fred = new Contestant;

$Fred->name="Fred Flintstone";
$Fred->number= rand(1,10);

$contestants = array($Sam,$Fred);

var_dump($contestants);

foreach ($contestants as $contestant){

	print "<li>" . $contestant->name . ": " . $contestant->number . "</li>";
}

//var_dump($Sam);

//echo "Hello";

?>

