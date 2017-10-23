<?php

//include("config.php");
include("includes/experience.php");


$sql=mysql_query("SELECT * FROM mrpg_users ORDER BY level DESC LIMIT 20");
while($row=mysql_fetch_array($sql)) {
    $hs[]=array("name"=>$row['name'], "exp"=>$row['level']);
}

//print_r($hs);

echo "<table border='1' cellspacing='0' class='hs'><tr><td colspan='4' align='center'> Earthbound Highscores </td></tr><tr><td>#</td><td>Name</td><td>EXP</td><td>Level</td></tr>";

$i=1;
foreach($hs as $value) {
    echo "<tr><td> $i: </td><td> " . ucfirst($value['name']) . " </td><td> " . $value['exp'] . " </td><td> " .  abs(level(2, $value['exp'])) . " </td></tr>";
    $i++;
}

echo "</table>";
?>
