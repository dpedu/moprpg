<?php

function checkbzone($x, $y, $m) {
    if($y>=0 && $y<=12 && $x>=0 && $x<=25) { //Noob zone
        return array(1,2,0,0,0,0,0,0,0); //   1/10th chance rat :O
    } else if($y>=11 && $y<=15 && $x>=53 && $x<=99) {
        return array(2,0,0,0,0,3);
    } else {
        return array(0);
    }
}

?>
