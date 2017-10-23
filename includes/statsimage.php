<?php

include("config.php");
include("includes/experience.php");

function makestatimage($pid) {

global $con;

$result = mysql_query("SELECT * FROM mrpg_stat WHERE id='$pid'");
$row = mysql_fetch_array($result);

$result = mysql_query("SELECT * FROM mrpg_users WHERE id='$pid'");
$exp = mysql_fetch_array($result);


$im=imageCreateTrueColor(450, 309);
$white=imageColorAllocate ($im, 255, 255, 255);
$red=imageColorAllocate ($im, 255, 0, 0);
$green=imageColorAllocate ($im, 0, 255, 0);
$black = imageColorAllocate ($im, 0, 0, 0);
imageFill($im, 5, 5, $black);

imageString($im, 4, 50, 100, "PP: " . $row['pp'], $white);
imageString($im, 4, 50, 140, "Offense: " . $row['offense'], $white);
imageString($im, 4, 50, 180, "Defense: " . $row['defense'], $white);
imageString($im, 4, 50, 220, "Fight: " . $row['fight'], $white);

imageString($im, 4, 340, 100, "Speed: " . $row['speed'], $white);
imageString($im, 4, 340, 140, "Wisdom: " . $row['wisdom'], $white);
imageString($im, 4, 340, 180, "Strength: " . $row['strength'], $white);
imageString($im, 4, 340, 220, "Force: " . $row['force'], $white);


imageString($im, 5, 200, 260, "Level: " . level(2, $exp['level']), $white);

imageString($im, 5, 200, 275, "EXP: " . $exp['level'], $white);

$barw=round(($row['hp'] / $row['maxhp'])*370);



imageFilledRectangle($im, 50, 30, 420, 70, $red);
imageFilledRectangle($im, 50, 30, 50+$barw, 70, $green);
imageRectangle($im, 50, 30, 420, 70, $white);

imageString($im, 5, 190, 10, "HP: " . $row['hp'] . "/" . $row['maxhp'], $green);

header('Content-type: image/png');
imagePNG($im);
imageDestroy($im); 
}


?>