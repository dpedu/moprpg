<?php


include("includes/experience.php");


$levels=50;


$x=0;
while($x<=$levels) {


echo "Exp $x: " . level(1, $x) . "<br>";

$x=$x+1;
}


?>