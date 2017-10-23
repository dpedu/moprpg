<?php

include("config.php");

function validname($input) {
    return (eregi('^[0-9a-zA-Z]{3,12}$', $input)) ? $input : "false";
}


if($_POST['reg']==1) {
    if($_POST['username']=="" || $_POST['password']=="" || $_POST['password2']=="") {
        $message.="Fill out all the feilds.<br>";
    } else {
        $u=strtolower(addslashes($_POST['username']));
        $p=strtolower(addslashes($_POST['password']));
        $p2=strtolower(addslashes($_POST['password2']));

        if(validname($u)=="false" || validname($p)=="false" || validname($p2)=="false") {
            $message.="Invalid entries. 3-12 characters, Alpha-Numeric only.<br>";
        } else {
            if($p!=$p2) {
                $message.="Passwords didn't match.<br>";
            } else {
                $result = mysql_query("SELECT * FROM mrpg_users WHERE name='$u'");
                while($row = mysql_fetch_array($result)) {
                    $namecheck=$row['id'];
                }

                if($namecheck!="") {
                    $message.="Username is taken!.<br>";
                } else {
                    //Register
                    $id=1;
                    $result = mysql_query("SELECT id FROM mrpg_users");
                    while($row = mysql_fetch_array($result)) {
                        if(($row['id']+1)>$id) {
                            $id=($row['id']+1);
                        }
                    }

                    mysql_query("INSERT INTO  `mrpg_users` (  `id` ,  `name` ,  `password` ,  `x` ,  `y` ,  `dir` ,  `inventory` ,  `level` ,  `lastact` ,  `mode` )
                    VALUES (
                    '$id',  '$u',  '$p',  '5',  '3',  '4',  '',  '0',  '0',  'norm'
                    );");

                    mysql_query("INSERT INTO `mrpg_confirm` VALUES (
                    '$id', '', '0', '0', '0', '0'
                    );");

                    mysql_query("INSERT INTO `mrpg_message` VALUES (
                    '$id', '', '0', '0'
                    );");

                    mysql_query("INSERT INTO  `mrpg_battles` (  `id` ,  `use` ,  `enemy` ,  `enemyhp` ,  `other` )
                    VALUES (
                    '$id',  '0',  '0',  '0',  ''
                    );");

                    mysql_query("INSERT INTO  `mrpg_stat` (  `id` ,  `hp` ,  `maxhp` ,  `pp` ,  `offense` ,  `defense` ,  `fight` ,  `speed` ,  `wisdom` ,  `strength` ,  `force` ,  `poison` ,  `other` )
                    VALUES (
                    '$id',  '20',  '20',  '5',  '1',  '1',  '1',  '1',  '1',  '1',  '1',  '0',  '0'
                    );");

                    $message.="Registered! You can now play!";

                }
            }
        }
    }
}

?>

<form action="index.php?register" method="post">
<table border="0">
<tr><td colspan="2" align="center"><font color="white">Registration</font></td></tr>
<tr><td colspan="2" align="center"><font color="white"><?php echo $message; ?></font></td></tr>
<tr><td><font color="white">Username: </font></td><td><input type="text" name="username" value="<?php echo $_POST['username']; ?>"></td></tr>
<tr><td><font color="white">Password: </font></td><td><input type="password" name="password" value="<?php echo $_POST['password']; ?>"></td></tr>
<tr><td><font color="white">Password: </font></td><td><input type="password" name="password2" value="<?php echo $_POST['password2']; ?>"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Register"></td></tr>
</table>
<input type="hidden" name="reg" value="1">
</form>
