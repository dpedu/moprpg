<?php

function make_gui($t, $b) {


echo '<table id="Table_01" width="537" height="594" border="0" cellpadding="0" cellspacing="0">
<tr>
<td colspan="3">
<img src="images/gui_01.gif" width="537" height="30" alt=""></td>
</tr>
<tr>
<td rowspan="4">
<img src="images/gui_02.gif" width="33" height="564" alt=""></td>
<td background="images/gui_03.gif" width="470" height="329" align="center" valign="middle">
' . $t . '
<td rowspan="4">
<img src="images/gui_04.gif" width="34" height="564" alt=""></td>
</tr>
<tr>
<td>
<img src="images/gui_05.gif" width="470" height="35" alt=""></td>
</tr>
<tr>
<td background="images/gui_06.gif" width="470" height="191" align="center" valign="top">
' . $b . '
</tr>
<tr>
<td>
<img src="images/gui_07.gif" width="470" height="9" alt=""></td>
</tr>
</table>';

}


?>