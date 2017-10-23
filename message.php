<?php


include("config.php");


$credsYo=$_COOKIE['mrpg-ethbnd'];
$credsYo=explode("@seperator@", $credsYo);

$u=strtolower($credsYo[0]);
$p=strtolower($credsYo[1]);

if($u=="") {
	header("Location: index.php?login");
	exit;
}

$result = mysql_query("SELECT * FROM mrpg_users WHERE name='$u'");
while($row = mysql_fetch_array($result)) {
	if($row['password']!=$p) {
		header("Location: index.php");
		exit;
	}
}


$sql="SELECT * FROM mrpg_users WHERE name='$u'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)) {
	$char['id']=$row['id'];
	$char['mode']=$row['mode'];
}

if($char['mode']!="message") {
	header("Location: actions.php");
	exit;
}


$sql="SELECT * FROM mrpg_message WHERE id=" . $char['id'] . ";";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)) {
	$confirm['q']=$row['q'];
	$confirm['x']=$row['x'];
	$confirm['y']=$row['y'];
}


if($_SERVER['QUERY_STRING']=="") {
	echo "<center><br><h4><font color='white'>" . $confirm['q'] . "</font></h4><br><br>
<h5><a href='message.php?yes'>Continue</a></h5>";

} else if($_SERVER['QUERY_STRING']=="yes") {

	$sql="UPDATE mrpg_users SET mode='norm', x=" . $confirm['x'] . ", y=" . $confirm['y'] . " WHERE id=" . $char['id'] . ";";
	mysql_query($sql);

	header("Location: actions.php");
	exit;

}

?>
