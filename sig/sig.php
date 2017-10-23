<?php

include("../config.php");
include("../includes/experience.php");

$im=imageCreateFromPNG("def.png");

$name=addslashes($_GET['name']);

$result = mysql_query("SELECT * FROM mrpg_users WHERE name='$name'");
$info = mysql_fetch_array($result);

if($info=="") { 
echo "No name specified (?name=Mop)";
exit;
}


$white=imageColorAllocate ($im, 255, 255, 255);
$grey=imageColorAllocate ($im, 70, 70, 70);

imageString($im,5, 7, 5, "EarthBound User: " . ucfirst($info['name']), $grey);
imageString($im,5, 6, 4, "EarthBound User: " . ucfirst($info['name']), $white);



imageString($im,5, 8, 26, "Level: " . abs(level(2, $info['level'])), $grey);
imageString($im,5, 7, 25, "Level: " . abs(level(2, $info['level'])), $white);


imageString($im,5, 90, 26, "EXP: " . $info['level'], $grey);
imageString($im,5, 91, 25, "EXP: " . $info['level'], $white);



$rank=1;
$set=0;
$sql=mysql_query("SELECT * FROM mrpg_users ORDER BY level DESC");
while($row=mysql_fetch_array($sql)) {

if($row['level']!=$info['level'] && $set==0) {

$rank++;
} else {
$set=1;
}



}




imageString($im,5, 180, 26, "Rank: $rank", $grey);
imageString($im,5, 181, 25, "Rank: $rank", $white);



header('Content-type: image/png');
imagePNG($im); 
imageDestroy($im);
?>