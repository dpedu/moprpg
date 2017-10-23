<?php
ob_start();

Header('Cache-Control: no-cache');
Header('Pragma: no-cache');

echo '<meta http-equiv="cache-control" content="no-cache"><meta http-equiv="expires" content="-1">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">';

echo '<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"><image src="coordim.php?x=' . $_GET['x'] . '&y=' . $_GET['y'] . '">';

ob_end_flush();
?>