<?php

include("config.php");

if($_POST['u']!="")
{
$u=addslashes($_POST['u']);
$p=addslashes($_POST['p']);

if($u!="" && $p!="")
{
$sql="SELECT * FROM mrpg_users WHERE name='$u'";
//echo $sql;
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
if($row['password']==$p)
{

setcookie("mrpg-ethbnd", strtolower($u . "@seperator@" . $p), time()+525600);
header("Location: game.php");
exit;
}
else
{
$message="Invalid username or password.";

}
}

}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>EarthBound - Online RPG Game by Mop</title>
<meta name="#"> 
<meta name="Keywords" content="#">
<meta name="Copyright" content="">
<meta name="Language" content="English">
<meta name="Author" content="">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body marginleft="0" marginright="0" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<br></br>






<table align="center" height=100 width="740" cellspacing="0" border="0" cellpadding="0" class="table2">
   <tr>
   
	 <td valign=center width="241" background="images/sidediv.jpg"><center>
	<img src="images/home_icon.jpg"><a href="index.php" class="menulink" alt="Home"> Home</a> &nbsp;&nbsp;
	<img src="images/about_icon.jpg"><a href="?login" class="menulink" alt="about"> Play Now!</a> &nbsp;&nbsp;
	<img src="images/guestbook_icon.jpg"><a href="?register" class="menulink" alt="register"> Register</a><br><br>
	<img src="images/about_icon.jpg"><a href="?highscores" class="menulink" alt="Top20"> Top 20</a> &nbsp;&nbsp;
	<img src="images/guestbook_icon.jpg"><a href="forum/" class="menulink" alt="forum">Forum</a> 




   	 </td><td align="right" width="499" background="images/right_side.jpg">

  </td>
  </tr>
</table>


<table align="center" height=360 width="740" cellspacing="0" border="0" cellpadding="0" class="table3">
   <tr>
   	 <td align="left" width="239" bgcolor="#B3B3B3">
 

	<table align="center" height=150 width="200" cellspacing="0" cellpadding="0">
	<tr>

		<td valign="top">

		<div class="style5" align="left"><img src="images/arrow_icon.jpg">News & Events</div>


		<div align="right" class="style1">Dec 17th 2007</div>

		<div align="left" class="style2"><img src="images/smallarrow_icon.jpg">Forum added!</div>
		<br>
		<div align="left" class="style3">
		We've added a forum to the site, please take the time to register!
		<br>
		<hr width="180">





		<div align="right" class="style1">Dec 1st 2007</div>

		<div align="left" class="style2"><img src="images/smallarrow_icon.jpg"> Open!</div>
		<br>
		<div align="left" class="style3">
		EarthBound Is now OPEN!<br>
		<hr width="180"></hr>

</tr>
</table>



	 <td align="center" width="1" bgcolor="#000000">
	 <td align="center" width="499" bgcolor="#5A6674">

<table align="center" height=300 width="435" cellspacing="0" cellpadding="15" class="table2">
<tr>
	<td valign="top" align="center"><?php 
if($_SERVER['QUERY_STRING']=="register") { 
include("register.php");
} else if($_SERVER['QUERY_STRING']=="login") {

echo "<form action='index.php?login' method='post'>$message<table border='0' cellpadding='1' cellspacing='0' class='style1'><tr><td>Username:</td><td><input type='text' name='u' value='$u'></td></tr><tr><td>Password</td><td><input type='password' name='p' value='$p'></td></tr><tr><td align='center' colspan='2'><input type='submit' value='Login'></td></tr></table></form>";


} else if($_SERVER['QUERY_STRING']=="highscores") {

include("hs.php");

} else {
echo '<div class="style4"><b>EarthBound Welcomes You</b></div>
	<br>

	<div class="style7"> </div>
	<br>
	<div class="style1">
The game is now open! Go play!
</div>';
}

?>
</td>
</tr>
</table>



</td>
</tr>
</table>





<table align="center" height=140 width="740" cellspacing="0" border="0" cellpadding="0" class="table3">
   <tr>
   	 <td valign=center width="239" bgcolor="#7D7D7D">
	<table align="center" height=100 width="200" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top">

		<!--<div class="style1" align="left"><img src="images/arrow_icon2.jpg"> E-mail Subscription</div>
		<br>

		<div align="left" class="style2">Enter your e-mail below to subscribe</div>
		<br>
		<div align="left" class="style3">

		<form width:5em name="input" action="email.cgi" method="get">
		E-mail: 
		<input type="text" size="10" name="user">
		<input type="submit" class="submit" value="Submit">
		</form>-->

</tr>
</table>


 	 <td valign=center width="1" bgcolor="#000000">

   	 <td valign="top" width="498" bgcolor="#5A6674">




<table align="center" height=25 width="498" cellspacing="0" cellpadding="0">
<tr>
	<td align="left" bgcolor="#B3B3B3" class="style2">Game Stats

</tr>


<tr>
	<td align="center" height="1" bgcolor="#000000">
</table>



<br>
<table align="center" height=85 width="435" cellspacing="0" cellpadding="10" border="0" class="table2">
<tr>
	<td valign="top">

	<div class="style1" align="center">
Players Online: <?php include("stats.php"); ?>
</tr>
</table>


  </td>
  </tr>
</table>




<table align="center" height=30 width="740" cellspacing="0" cellpadding="0" class="table4">
   <tr>
   	 <td align="center" bgcolor="#424E5B"><div align="center" class="style1">&copy; Mop 2007<br>Style by StealthTemplates (Modified)



  </td>
  </tr>
</table>


</body>
</html>