<?php

/*$im=imageCreateTrueColor(470, 329);

$white=imageColorAllocate ($im, 255, 255, 255);

$black = imageColorAllocate ($im, 0, 0, 0);

imageFill($im, 5, 5, $black);

*/

include("config.php");

function makestatimage($pid) {

    global $con;

    $result = mysql_query("SELECT * FROM mrpg_stat WHERE id='$pid'");
    $row = mysql_fetch_array($result);


    $im=imageCreateTrueColor(470, 329);
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

    $barw=round(($row['hp'] / $row['maxhp'])*370);



    imageFilledRectangle($im, 50, 30, 420, 70, $red);
    imageFilledRectangle($im, 50, 30, 50+$barw, 70, $green);
    imageRectangle($im, 50, 30, 420, 70, $white);

    imageString($im, 5, 210, 10, "HP: " . $row['hp'], $green);

    header('Content-type: image/png');
    imagePNG($im);
    imageDestroy($im);
}

makestatimage(1);


/*
$background = imageColorAllocate ($im, 255, 255, 255);
$background = imageColorTransparent($im,$background);

$y=0;

while($y<=1000) {
imageLine($im, 0, $y, 1000, $y, $black);
imageString($im,1, 1, $y+1, $y/16, $black);
$y=$y+16;

}

$x=0;
while($x<=1000) {
imageLine($im, $x, 0, $x, 1000, $black);
imageString($im,1, $x+1, 1, $x/16, $black);
$x=$x+16;
}*/


?>
