<?php

/* * * * * * * * * * * * * * * * * * * * * \
Finds experience from level, and vice-versa
\ * * * * * * * * * * * * * * * * * * * * */


function level($mode,$input) {
    if($mode==1) {
        $a=pow($input, 2) * 31;
        return $a;
    }
    if($mode==2) {
        $val=$input/31;

        $val=sqrt($val);

        $val=round($val-.499);

        //$val=$val-.499;

        return(abs($val));
    }

}

?>
