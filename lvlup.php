<?php

include("config.php");
include("includes/experience.php");

$credsYo=$_COOKIE['mrpg-ethbnd'];
$credsYo=explode("@seperator@", $credsYo);

$u=strtolower($credsYo[0]);
$p=strtolower($credsYo[1]);

if($u=="")
{
header("Location: index.php?login");
}

$result = mysql_query("SELECT * FROM mrpg_users WHERE name='$u'");
while($row = mysql_fetch_array($result))
{

	if($row['password']!=$p)
	{
header("Location: index.php");
exit;
	}
}


$sql="SELECT * FROM mrpg_users WHERE name='$u'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
$char['id']=$row['id'];
$char['exp']=$row['level'];
$mode=$row['mode'];
}

if($mode!="lvlup") {
header("Location: actions.php");
exit;
}


$sql="SELECT * FROM mrpg_stat WHERE id='" . $char['id'] . "'";
$result = mysql_query($sql);
$pstats = mysql_fetch_array($result);


//print_r($pstats);


$newlvl=level(2, $char['exp']);


if($newlvl<=5) {
$increase=2;
} else if($newlvl>5 && $newlvl<=7) {
$increase=4;
} else if($newlvl>7 && $newlvl<=13) {
$increase=6;
} else if($newlvl>13 && $newlvl<=20) {
$increase=8;
} else if($newlvl>20 && $newlvl<=27) {
$increase=10;
} else {
$increase=10;
}

$nhp=rand(1, $increase);
$npp=rand(1, $increase);
$noffense=rand(1, $increase);
$ndefense=rand(1, $increase);
$nfight=rand(1, $increase);
$nspeed=rand(1, $increase);
$nwisdom=rand(1, $increase);
$nstrength=rand(1, $increase);
$nforce=rand(1, $increase);

$sql="UPDATE mrpg_stat SET
`maxhp`=`maxhp`+$nhp,
`pp`=`pp`+$npp,
`offense`=`offense`+$noffense,
`defense`=`defense`+$ndefense,
`fight`=`fight`+$nfight,
`speed`=`speed`+$nspeed,
`wisdom`=`wisdom`+$nwisdom,
`strength`=`strength`+$nstrength,
`force`=`force`+$nforce
WHERE id='" . $char['id'] . "'";
 

mysql_query($sql);

mysql_query("UPDATE mrpg_users SET mode='norm' WHERE id='" . $char['id'] . "'");

$messages=array();

$messages[]="Max HP increased by $nhp!";
$messages[]="PP increased by $npp!";
$messages[]="Offense increased by $noffense!";
$messages[]="Defense increased by $ndefense!";
$messages[]="Fight increased by $nfight!";
$messages[]="Speed increased by $nspeed!";
$messages[]="Wisdom increased by $nwisdom!";
$messages[]="Strength increased by $nstrength!";
$messages[]="Force increased by $nforce!";



$fwim=imageCreateFromjpeg("media/firework.jpg");
$white=imageColorAllocate ($fwim, 0xFF, 0xFF, 0xFF);

imageString($fwim,5, 140, 15, "Congrats on leveling up!", $white);

$y=50;
Foreach($messages as $value) {

$pos=140;

imageString($fwim,5, $pos, $y, "$value", $white);

$y=$y+25;
}

imageString($fwim,5, $pos, $y+20, "Your level is now " . level(2, $char['exp']), $white);


header('Content-type: image/png');
imagejpeg($fwim); 
imageDestroy($fw); 

?>