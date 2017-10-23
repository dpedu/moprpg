<?php
ob_start();
Header('Cache-Control: no-cache');
Header('Pragma: no-cache');

$char['x']=$_GET['x'];
$char['y']=$_GET['y'];


//start mod
include("config.php");
include("battlezones.php");

$u=$char['x'];
$p=$char['y'];

if($u=="")
{
header("Location: index.php");
}

$result = mysql_query("SELECT * FROM mrpg_users WHERE name='$u'");
while($row = mysql_fetch_array($result))
{

$x=$row['x']+0;
$y=$row['y']+0;
$dir=$row['dir'];

$bzone=checkbzone($x, $y, 0);

	if(md5($row['password'])!=$p)
	{
header("Location: index.php");
exit;
	}
}

$char['x']=$x;
$char['y']=$y;

//end mod


$im=imageCreateFromPNG("media/map.png");
$im2 = imageCreateTrueColor(470, 329);



$images['chDown']=imageCreateFromPNG("media/chdown.png");
$images['chUp']=imageCreateFromPNG("media/chup.png");
$images['chLeft']=imageCreateFromPNG("media/chleft.png");
$images['chRight']=imageCreateFromPNG("media/chright.png");

$background = imageColorAllocate ($images['chDown'], 255, 0, 255);
$background = imageColorTransparent($images['chDown'],$background);

$background = imageColorAllocate ($images['chUp'], 255, 0, 255);
$background = imageColorTransparent($images['chUp'],$background);

$background = imageColorAllocate ($images['chLeft'], 255, 0, 255);
$background = imageColorTransparent($images['chLeft'],$background);

$background = imageColorAllocate ($images['chRight'], 255, 0, 255);
$background = imageColorTransparent($images['chRight'],$background);




$srcx=$char['x']*16-230;
$srcy=$char['y']*16-160;
$srcx2=$char['x']*16+5;
$srcy2=$char['y']*16+5;
$black = imageColorAllocate ($im, 0x00, 0x00, 0x00); 
$white = imageColorAllocate ($im, 0xFF, 0xFF, 0xFF);


$result = mysql_query("SELECT name,x,y,lastact,dir FROM mrpg_users");
while($row = mysql_fetch_array($result))
{

$dx=$row['x'];
$dy=$row['y'];
$thetime=$row['lastact'];
$dsrcx=$dx*16-230;
$dsrcy=$dy*16-160;


if((date("U")-$thetime)<=60) {

if($row['dir']==1) {
imageCopyMerge($im, $images['chUp'], $dsrcx +230,  $dsrcy +144, 0, 0, 12, 32,100);
} else if($row['dir']==2) {
imageCopyMerge($im, $images['chLeft'], $dsrcx +230,  $dsrcy +144, 0, 0, 12, 32,100);
} else if($row['dir']==3) {
imageCopyMerge($im, $images['chRight'], $dsrcx +230,  $dsrcy +144, 0, 0, 12, 32,100);
} else if($row['dir']==4) {
imageCopyMerge($im, $images['chDown'], $dsrcx +230,  $dsrcy +144, 0, 0, 12, 32,100);
}




//imageString($im,5, $dsrcx+230-(strlen($row['name'])*3), $dsrcy+129, ucfirst($row['name']), $black);
imageString($im,5, $dsrcx+233-(strlen($row['name'])*3), $dsrcy+127, ucfirst($row['name']), $black);
}
}




if($dir==1) {
imageCopyMerge($im, $images['chUp'], $srcx+230,  $srcy+144, 0, 0, 12, 32,100);
} else if($dir==2) {
imageCopyMerge($im, $images['chLeft'], $srcx+230,  $srcy+144, 0, 0, 12, 32,100);
} else if($dir==3) {
imageCopyMerge($im, $images['chRight'], $srcx+230,  $srcy+144, 0, 0, 12, 32,100);
} else if($dir==4) {
imageCopyMerge($im, $images['chDown'], $srcx+230,  $srcy+144, 0, 0, 12, 32,100);
}

//imageCopyMerge($im, $images['chDown'], $srcx+230,  $srcy+144, 0, 0, 12, 32,100);

imageCopy($im2, $im, 0, 0, $srcx, $srcy, 470, 329);

//imageFilledRectangle ($im2, 1, 1, 110, 20, $black);

//imageString($im2, 2, 2, 2, "X: $x, Y: $y, B: " . $bzone[0], $white);


header('Content-type: image/png');
imagePNG($im2);




imageDestroy($im); 
imageDestroy($im2); 






imageDestroy($images['chDown']);
imageDestroy($images['chUp']);
imageDestroy($images['chLeft']);
imageDestroy($images['chRight']);



ob_end_flush();
?>