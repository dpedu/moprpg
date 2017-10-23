<?php


include("config.php");


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
$char['mode']=$row['mode'];
}


if($char['mode']!="confirm") {
header("Location: action.php");
exit;
}


$sql="SELECT * FROM mrpg_confirm WHERE id=" . $char['id'] . ";";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
$confirm['q']=$row['q'];
$confirm['yesx']=$row['yesx'];
$confirm['yesy']=$row['yesy'];
$confirm['nox']=$row['nox'];
$confirm['noy']=$row['noy'];
}


if($_SERVER['QUERY_STRING']=="") {

echo "<center><br><h4><font color='white'>" . $confirm['q'] . "</font></h4><br><br>

<h5><a href='confirm.php?yes'>Yes</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='confirm.php?no'>No</a></h5>";

}


if($_SERVER['QUERY_STRING']=="yes") {

mysql_query("UPDATE mrpg_users SET mode='norm', x=" . $confirm['yesx'] . ", y=" . $confirm['yesy'] . " WHERE id=" . $char['id'] . ";");

header("Location: actions.php");
exit;

} 


if($_SERVER['QUERY_STRING']=="no") {

mysql_query("UPDATE mrpg_users SET mode='norm', x=" . $confirm['nox'] . ", y=" . $confirm['noy'] . " WHERE id=" . $char['id'] . ";");

header("Location: actions.php");
exit;

} 






?>