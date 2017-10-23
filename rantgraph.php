<?php


$text=file_get_contents("rantlog.txt");
$text=explode("\n", $text);
foreach($text as $key=>$value) {
$text[$key]=explode(":", $value);
}
$total=count($text)-1;
$num=0;

$graphdatshiz=array(0);
$graphdatshizdates=array(0);
while($num<=$total) {

if($num!=$total) {



//echo "<tr><td>"  . date("m-d-Y h:i:s", $text[$num][0]+21600) . " </td><td> " . date("m-d-Y h:i:s", $text[$num+1][0]+21600) . "</td><td>:</td>";



$newb=$text[$num][1] - $text[$num+1][1];

//$graphdatshizdates[]=$text[$num][0]+21600;

$graphdatshizdates[]=$text[$num][0]-518400;



if($newb<0) {
$newb=abs($newb);


}
else
{
$newb=$newb*-1;
}

$graphdatshiz[]=$newb;


//echo "<td>$newb</td></tr>\n";
}


$num++;
}





$width=count($graphdatshiz)*5;

//$im=imageCreateTrueColor (round($width/3), 300);


$im=imageCreateTrueColor ($width, 300);

$white = imageColorAllocate ($im, 0xFF, 0xFF, 0xFF); 
$light = ImageColorAllocate ($im, 0xCC, 0xCC, 0xCC); 
$black = imageColorAllocate ($im, 0x00, 0x00, 0x00);
$red = imageColorAllocate ($im, 0xFF, 0x00, 0x00); 


imageFill ($im, 1, 1, $white);


$printx=25;

while($printx<=$width) {
imageLine ( $im, $printx, 0, $printx, 300, $light);
$printx=$printx+5;
}


imageLine ( $im, 0, 1, $width, 1, $light);
imageLine ( $im, 0, 50, $width, 50, $light);
imageLine ( $im, 0, 100, $width, 100, $light);
imageLine ( $im, 0, 150, $width, 150, $light);
imageLine ( $im, 0, 200, $width, 200, $light);
imageLine ( $im, 0, 250, $width, 250, $light);
imageLine ( $im, 0, 298, $width, 299, $light);
imageString($im,1, 1, 1, "3000", $black);
imageString($im,1, 1, 47, "2500", $black);
imageString($im,1, 1, 97, "2000", $black);
imageString($im,1, 1, 147, "1500", $black);
imageString($im,1, 1, 197, "1000", $black);
imageString($im,1, 1, 247, "500", $black);
imageString($im,1, 1, 290, "0", $black);


imageString($im,3, 50, 1, "Graph of # of Rants on the Runescape forum per 10 minutes.", $black);
imageString($im,3, 50, 10, "Large spikes are caused by removal of large threads by Jagex.", $black);

imageRectangle ($im, 0, 0, $width-1, 299, $black);



function drawpoint($x, $y) {

global $black, $im, $red;

imageSetPixel($im, $x, $y, $red);
imageSetPixel($im, $x-1, $y, $red);
imageSetPixel($im, $x+1, $y, $red);
imageSetPixel($im, $x, $y-1, $red);
imageSetPixel($im, $x, $y+1, $red);
}


//drawpoint(5,5);


$x=25;
$y=0;

$previousX=25;
$previousY=300;


while($y<=count($graphdatshiz)) {


$pos=300-abs(round($graphdatshiz[$y]/10));



if(!(abs($previousY-$pos)>=1000))
{
imageLine ( $im, $previousX, $previousY, $x, $pos, $black);
$previousX=$x;
$previousY=$pos;
}

$date=$graphdatshizdates[$y];
$olddate=$graphdatshizdates[($y-1)];

$dateH=date("G", $date);
$datemin=date("i", $date);

$thedate=date("j", $date);
$olddate=date("j", $olddate);

/*if($dateH==0 && $datemin=="00") {*/

if($thedate!=$olddate) {

//imageString($im,1, $x-80, 290, "---" . date("m-d-Y", $date-86400) . "--><---" . date("m-d-Y", $date) . "-- $date -", $black);

imageString($im,1, $x, 290, "<---" . $thedate . "th", $black);


}

//imageString($im,1, $x, 280, "<-----", $black);

drawpoint($x,$pos);

$x=$x+5;
$y=$y+1;
}



header('Content-type: image/png');
imagePNG ($im); 
imageDestroy ($im); 

//print_r($graphdatshiz);

//print_r($graphdatshizdates);
?>