<?php

//include("../config.php");

function bimage($pid, $t1, $t2, $t3, $t4, $dead) {
global $con;

/*

Usage: bimage(PlayerID, "line1", "line2", "line3", "line4");

*/


////////Create User HP bar
$result = mysql_query("SELECT * FROM mrpg_stat WHERE id='$pid'");
$row = mysql_fetch_array($result);

$im=imageCreateTrueColor(470, 329);
$white=imageColorAllocate ($im, 255, 255, 255);
$red=imageColorAllocate ($im, 255, 0, 0);
$green=imageColorAllocate ($im, 0, 255, 0);
$black = imageColorAllocate ($im, 0, 0, 0);
imageFill($im, 5, 5, $black);

if($dead==true) {
$row['hp']=0;
}

$barw=round(($row['hp'] / $row['maxhp'])*370);

imageFilledRectangle($im, 50, 280, 420, 300, $red);
imageFilledRectangle($im, 50, 280, 50+$barw, 300, $green);
imageRectangle($im, 50, 280, 420, 300, $white);
imageString($im, 5, 175, 282, "Your HP: " . $row['hp'] . "/" . $row['maxhp'], $black);



////////Create enemy HP bar
$result = mysql_query("SELECT * FROM mrpg_battles WHERE id='$pid'");
$row = mysql_fetch_array($result);
$enemyid=$row['enemy'];
$enemyhp=$row['enemyhp'];
$result = mysql_query("SELECT * FROM mrpg_monsters WHERE id='$enemyid'");
$row = mysql_fetch_array($result);
if($row!="") {

$enemyimage=$row['image'];
$enemymaxhp=$row['hp'];
$barw=round(($enemyhp / $enemymaxhp)*370);
imageFilledRectangle($im, 50, 20, 420, 40, $red);
imageFilledRectangle($im, 50, 20, 50+$barw, 40, $green);
imageRectangle($im, 50, 20, 420, 40, $white);
imageString($im, 5, 175, 22, "Enemy HP: " . $enemyhp . "/" . $enemymaxhp, $black);


///////////Enemies image!

$igstr="images/monsters/$enemyimage";


$enemyimage=imageCreateFromPNG($igstr);

$iminfo=getImageSize($igstr);

$posX=235-(round($iminfo[0]/2));

$background = imageColorAllocate ($enemyimage, 0xFF, 0, 0xFF);
$background = imageColorTransparent($enemyimage, $background);

imageCopyMerge($im, $enemyimage, $posX, 70, 0, 0, 100, 100,100);
}

$tpos1=235-(round(strlen($t1)/2)*9);
imageString($im,5, $tpos1, 180, $t1, $white);

$tpos2=235-(round(strlen($t2)/2)*9);
imageString($im,5, $tpos2, 200, $t2, $white);

$tpos3=235-(round(strlen($t3)/2)*9);
imageString($im,5, $tpos3, 220, $t3, $white);

$tpos4=235-(round(strlen($t4)/2)*9);
imageString($im,5, $tpos4, 240, $t4, $white);


header('Content-type: image/png');
imagePNG($im);
imageDestroy($enemyimage); 
imageDestroy($im); 
}





?>