<?php

include("config.php");
include("includes/battleimfuncts.php");
include("includes/experience.php");

$test=level(1,1);

$credsYo=$_COOKIE['mrpg-ethbnd'];
$credsYo=explode("@seperator@", $credsYo);

$havegone=false;

$dead=false;

$messages=array();

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
	$char['exp']=$row['level'];
}

$sql="SELECT * FROM mrpg_battles WHERE id='" . $char['id'] . "'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)) {

	if($row['use']==0) {
		header("Location: actions.php");
		exit;
	}

	$enemy=$row['enemy'];
	$enemyhp=$row['enemyhp'];
}

$sql="SELECT * FROM mrpg_monsters WHERE id='$enemy'";
$result = mysql_query($sql);
$monsterstats = mysql_fetch_array($result);

$sql="SELECT * FROM mrpg_stat WHERE id='" . $char['id'] . "'";
$result = mysql_query($sql);
$pstats = mysql_fetch_array($result);


if($_GET['appear']==yes) {
	$messages[]=ucfirst($monsterstats['name']) . " appears!";
}

if($_GET['act']==run) {
	$run=rand(1,4);

	if($run==4) {

		$messages[]="You attempt to escape!";
		$messages[]="Success!";
		$havegone=false;
		$sql="UPDATE mrpg_battles SET `use`=0, `enemy`=0, `enemyhp`=0 WHERE `id`=" . $char['id'] . ";";
		mysql_query($sql);
		mysql_query("UPDATE mrpg_users SET mode='norm' WHERE id=" . $char['id'] . ";");
		} else {
		$havegone=true;
		$messages[]="You attempt to escape!";
		$messages[]="Failure...";

	}

} else if($_GET['act']==attack) {

	$messages[]="You attack the " . ucfirst($monsterstats['name']) . "!";
	$havegone=true;

	//(Strength + Force / 2) + (offense + fight / 2)

	$hit1=($pstats['strength'] + $pstats['force']) / 2;
	$hit2=($pstats['offsnse'] + $pstats['fight']) / 2;

	$hit=(2/3)*(($hit1+$hit2)/2);

	$hit=rand(0,round($hit+4.9999));
	$messages[]="And you deal $hit damage!";
	$enemyhp=$enemyhp-$hit;

}



//We've attacked and done all other things
//that could harm the enemy, lets save him
//and let him kick some ass!

mysql_query("UPDATE mrpg_battles SET enemyhp=$enemyhp WHERE id=" . $char['id'] . ";");


if($enemyhp<=0) {

	$messages[]=$monsterstats['diemsg'];

	$sql="UPDATE mrpg_battles SET `use`=0, `enemy`=0, `enemyhp`=0 WHERE `id`=" . $char['id'] . ";";
	mysql_query($sql);

	$expgiven=$monsterstats['expgive'];

	$messages[]="You gain $expgiven experience.";


	if( level(2, $char['exp']) != level(2, $char['exp']+$expgiven) ) {
		mysql_query("UPDATE mrpg_users SET mode='lvlup', level=level+$expgiven WHERE id=" . $char['id'] . ";");
	} else {
		mysql_query("UPDATE mrpg_users SET mode='norm', level=level+$expgiven WHERE id=" . $char['id'] . ";");
	}

	$havegone=false;

}



if($havegone==true) { //The player has acted! Now its the games turn!

	$monsterhit=rand(0, $monsterstats['power']);

	$pstats['hp']=$pstats['hp']-$monsterhit;

	mysql_query("UPDATE mrpg_stat SET hp=" . $pstats['hp'] . " WHERE id=" . $char['id'] . ";");

	$messages[]="The " . ucfirst($monsterstats['name']) . " attacks! And deals $monsterhit Damage!";


}



if($pstats['hp']<=0) {
	$messages[]="You died!";

	$dead=true;

	mysql_query("UPDATE mrpg_stat SET hp=maxhp, poison=0, other=0 WHERE id=" . $char['id'] . ";");

	mysql_query("UPDATE mrpg_battles SET `use`=0, enemy=0, enemyhp=0 WHERE id=" . $char['id'] . ";");

	mysql_query("UPDATE mrpg_users SET mode='norm', x=5, y=3 WHERE id=" . $char['id'] . ";");

}



bimage($char['id'], $messages[0], $messages[1], $messages[2], $messages[3], $dead);


?>
