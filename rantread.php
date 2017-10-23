<br>Rants<BR><?php

$text=file_get_contents("rantlog.txt");

$text=explode("\n", $text);

foreach($text as $key=>$value) {


$text[$key]=explode(":", $value);

}

$total=count($text)-1;

$num=0;


echo "<table border='1'><tr><td>Num</td><td>Raw Time</td><td>From</td><td>To</td><td></td><td>Amount</td></tr>\n";
while($num<=$total) {


if($num!=$total) {
echo "<tr><td>$num</td><td>" . $text[$num][0] . "</td><td>"  . date("m-d-Y h:i:s", $text[$num][0]+21600) . " </td><td> " . date("m-d-Y h:i:s", $text[$num+1][0]+21600) . "</td><td>:</td>";



$newb=$text[$num][1] - $text[$num+1][1];

if($newb<0) {
$newb=abs($newb);
}
else
{
$newb=$newb*-1;
}

echo "<td>$newb</td></tr>\n";
}


$num++;
}

echo "</table>";
//print_r($text);
?>