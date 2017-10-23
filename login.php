<?php

include("config.php");

if($_POST['u']!="")
{
$u=addslashes($_POST['u']);
$p=addslashes($_POST['p']);

if($u!="" && $p!="")
{
$sql="SELECT * FROM mrpg_users WHERE name='$u'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
if($row['password']==$p)
{
$message="You have been logged in. Proceed to <a href='game.php'>the Game.</a><br>";
setcookie("mrpg-ethbnd", strtolower($u . "@seperator@" . $p), time()+525600);
}
else
{
$message="Invalid username or password.";

}
}

}
}

?>


<form action='login.php' method='post'><?php echo $message; ?><table border='0' cellpadding='1' cellspacing='0'><tr><td>Username:</td><td><input type='text' name='u' value='<?php echo $u; ?>'></td></tr><tr><td>Password</td><td><input type='password' name='p' value='<?php echo $p; ?>'></td></tr><tr><td align='center' colspan='2'><input type='submit' value='Login'></td></tr></table></form>

