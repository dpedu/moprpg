<?php

include("config.php");
include("includes/statsimage.php");

$char['x']=$_GET['x'];
$char['y']=$_GET['y'];

$u=$char['x'];
$p=$char['y'];


$result = mysql_query("SELECT * FROM mrpg_users WHERE name='$u'");
while($row = mysql_fetch_array($result)) {
	$uid=$row['id'];
	$x=$row['x'];
	$y=$row['y'];

	if(md5($row['password'])!=$p) {
		header("Location: index.php");
		exit;
	}
}

makestatimage($uid);

?>
