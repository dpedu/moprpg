<?php

include("config.php");


$result = mysql_query("SELECT name,lastact FROM mrpg_users WHERE (" . date("U") . "-lastact)<=60");
while($row = mysql_fetch_array($result)) {
    $online.=ucfirst($row['name']) . ", ";
}

if($online=="") {
    echo "None!";
} else {
    echo $online;
}

?>
