<?php

include("gui.php");
?>

<script type="text/javascript">

x=3
y=5

function newframe(x,y) {
    document.all.TheFrame.src="showim.php?x=" + x + "&y=" + y
}

function go(d) {
// 1 for up, 2 for right, 3 for down, 4 for left

    if(d==1) {
        x=x
        y=y-1
    } else if(d==2) {
        x=x+1
        y=y
    } else if(d==3) {
        x=x
        y=y+1
    } else if(d==4) {
        x=x-1
        y=y
    }
    newframe(x,y)
}
</script>

<?php
    $frame="<iframe id='TheFrame' src='showim.php?x=3&y=5' frameborder='0' width='470' height='329'></iframe>";

    $links="<a href='javascript:go(1);'>Up</a> <br><a href='javascript:go(4);'>Left</a> <a href='javascript:go(2);'>Right</a><br>
<a href='javascript:go(3);'>Down</a>";

    make_gui($frame, $links);

?>
