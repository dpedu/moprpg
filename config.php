<?php


/*echo "<h1>Down for maintenance!</h1>";
exit;*/


$con = mysql_connect("mysql","mop_admin","droids");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("mop_rpg", $con);

//Get user IP
if($_SERVER['HTTP_X_FORWARDED_FOR']!="") {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip=$_SERVER['REMOTE_ADDR'];
}

?>
