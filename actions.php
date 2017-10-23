<?php

include("gui.php");
include("config.php");
include("walkable.php");
include("battlezones.php");

$update=false;


$credsYo=$_COOKIE['mrpg-ethbnd'];
$credsYo=explode("@seperator@", $credsYo);

$u=strtolower($credsYo[0]);
$p=strtolower($credsYo[1]);

if($u=="") {
	header("Location: index.php?login");
}

$result = mysql_query("SELECT * FROM mrpg_users WHERE name='$u'");
while($row = mysql_fetch_array($result)) {
	if($row['password']!=$p) {
		header("Location: index.php");
		exit;
	}
}

$sql="UPDATE mrpg_users SET lastact='" . date("U") . "' WHERE name='$u'";
$result = mysql_query($sql);

$sql="SELECT * FROM mrpg_users WHERE name='$u'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)) {
	$char['id']=$row['id'];
	$char['x']=$row['x'];
	$char['y']=$row['y'];
	$char['mode']=$row['mode'];
}

if($char['mode']=="battle") {

	if($_SERVER['QUERY_STRING']=="stats") {
			header("Location: stat.php?x=" . $u . "&y=" . md5($p));
			exit;
	}

	header("Location: battle.php");
	exit;

} else if($char['mode']=="lvlup") {

	header("Location: lvlup.php");
	exit;

} else if($char['mode']=="confirm") {

	header("Location: confirm.php");
	exit;

} else if($char['mode']=="message") {

	header("Location: message.php");
	exit;

}


if($_SERVER['QUERY_STRING']!="") {
	$update=true;
	switch($_SERVER['QUERY_STRING']) {

		case "up":
			$char['x']=$char['x'];
			$char['y']=$char['y']-1;
			$sql="UPDATE mrpg_users SET dir='1' WHERE name='$u'";
			$result = mysql_query($sql);
		break;

		case "down":
			$char['x']=$char['x'];
			$char['y']=$char['y']+1;
			$sql="UPDATE mrpg_users SET dir='4' WHERE name='$u'";
			$result = mysql_query($sql);
		break;

		case "right":
			$char['x']=$char['x']+1;
			$char['y']=$char['y'];
			$sql="UPDATE mrpg_users SET dir='3' WHERE name='$u'";
			$result = mysql_query($sql);
		break;

		case "left":
			$char['x']=$char['x']-1;
			$char['y']=$char['y'];
			$sql="UPDATE mrpg_users SET dir='2' WHERE name='$u'";
			$result = mysql_query($sql);
		break;
		case "stats":
		header("Location: stat.php?x=" . $u . "&y=" . md5($p));
		exit;
		break;
	}
}


if($_GET['que']!="") {
	$update=true;
	$que=$_GET['que'];
	$que=explode(",", $que);
	if($que[10]!="") {
		fallback();
	}

	foreach($que as $value) {
		walkByNumArray($value);
		if(!(walkable($char['x'], $char['y']))) {
			fallback();
		}
	}

}


/* TELES */
if($char['x']==19 && $char['y']==7) {
	$char['x']=10; $char['y']=60;

	//Lol heal
	mysql_query("UPDATE mrpg_stat SET hp=maxhp WHERE id=" . $char['id'] . ";");

}  //Tele into tut area
else if($char['x']==11 && $char['y']==59) {
	$char['x']=19; $char['y']=8;
}  //Tele out of tut area, to noobland
else if($char['x']==56 && $char['y']==10) {
	$char['x']=6; $char['y']=58;
	mysql_query("UPDATE mrpg_stat SET hp=maxhp WHERE id=" . $char['id'] . ";");
} //Out of canyon. + heal.


/* Misc stuff, like confirmations & messages */

if($char['x']==6 && $char['y']==56) {

	$char['x']=6;
	$char['y']=57;


	mysql_query("UPDATE mrpg_users SET mode='confirm' WHERE id=" . $char['id'] . ";");

	mysql_query("UPDATE mrpg_confirm SET q='The area you are about to enter is very dangerous for low-levels, and also leads to the first City. Level 10+ Reccommended. Once you exit it, you will never be able to return here. Do you want to continue?', yesx=56, yesy=11, nox=6, noy=57 WHERE id=" . $char['id'] . ";");

	header("Location: confirm.php");
	exit;

} else if($char['x']==97 && $char['y']==13) {


	mysql_query("UPDATE mrpg_users SET mode='message' WHERE id=" . $char['id'] . ";");

	mysql_query("UPDATE mrpg_message SET q='<h4>Chapter I:<br><br>Coming soon! :)<h4>', x=96, y=13 WHERE id=" . $char['id'] . ";");

	header("Location: message.php");
	exit;

}


if($update==true && walkable($char['x'], $char['y'])) {

	$tx=$char['x'];
	$ty=$char['y'];
	$sql="UPDATE mrpg_users SET x='$tx', y='$ty' WHERE name='$u'";
	$result = mysql_query($sql);

	///////////BATTLE CHECK////////////
	$bzone=checkbzone($tx, $ty, 0);

	$battle=$bzone[rand(0,(count($bzone)-1))];

	if($battle!=0) {

		$sql="UPDATE mrpg_users SET mode='battle' WHERE name='$u'";
		$result = mysql_query($sql);

		$result = mysql_query("SELECT * FROM mrpg_monsters WHERE id='$battle'");
		while($row = mysql_fetch_array($result))
		{
		$battlehp=$row['hp'];
		}



		$sql="UPDATE  `mrpg_battles` SET  `use` =  '1', `enemy` =  '$battle', `enemyhp` =  '$battlehp' WHERE  `id` =" . $char['id'] . ";";
		$result = mysql_query($sql);

		//echo "<font color='white'>BATTLE! <br> $sql";

		header("Location: battle.php?appear=yes");
		exit;

		}
		//////////END BATTLE CHECK//////////

	fallback();
}



function walkByNumArray($num) {
	global $char;
	if($num==1) {
		$char['x']=$char['x'];
		$char['y'] =$char['y']-1;
		} else if($num==2) {
		$char['x']=$char['x']-1;
		$char['y'] =$char['y'];
	} else if($num==3) {
		$char['x']=$char['x']+1;
		$char['y'] =$char['y'];
	} else if($num==4) {
		$char['x']=$char['x'];
		$char['y'] =$char['y']+1;
	}
}

function fallback() {
	global $u, $p;
	header('Location: showim.php?x=' . $u . '&y=' . md5($p));
	exit;
}

fallback();

?>
