<?php

include("gui.php");
include("config.php");
include("walkable.php");


$update=false;


$credsYo=$_COOKIE['mrpg-ethbnd'];
$credsYo=explode("@seperator@", $credsYo);

$u=strtolower($credsYo[0]);
$p=strtolower($credsYo[1]);

if($u=="") {
	header("Location: index.php?login");
}

$result = mysql_query("SELECT * FROM mrpg_users WHERE name='$u'");
while($row = mysql_fetch_array($result)) {
	if($row['password']!=$p)
	{
		header("Location: index.php");
		exit;
	}
}


$sql="SELECT * FROM mrpg_users WHERE name='$u'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)) {
	$char['x']=$row['x'];
	$char['y']=$row['y'];
}


?><script type='text/javascript'>

qSwitch=0

strW1=""
strW2=""
strW3=""
strW4=""
strW5=""



function qswitch() {
	if(qSwitch==0) {
		qSwitch=1
	} else if(qSwitch==1) {
		qSwitch=0
	}
		drawQs(qSwitch)
}


function dirtostring(dir) {
	if(dir==1) {
		return "<image src='images/icons_up.gif'>"
	} else if(dir==2) {
		return "<image src='images/icons_left.gif'>"
	} else if(dir==3) {
		return "<image src='images/icons_right.gif'>"
	} else if(dir==4) {
		return "<image src='images/icons_down.gif'>"
	} else if(dir==0) {
		return "<image src='images/exbox.gif'>"
	} else {
		return ""
	}

}

function drawQs(x) {
	if(x==1) {
		qSwitch=1
		obj = document.getElementById('qswitch')
		obj.innerHTML='<image src=\'images/switchon.gif\' border=\'0\'>'
		obj = document.getElementById('overlay')
		obj.style.display=""
		obj2 = document.getElementById('walkdiv')
		obj2.style.display=""
	}
	if(x==0) {
		qSwitch=0
		obj = document.getElementById('qswitch')
		obj.innerHTML='<image src=\'images/switchoff.gif\' border=\'0\'>'
		obj = document.getElementById('overlay')
		obj.style.display="none"
		obj = document.getElementById('walkdiv')
		obj.style.display="none"
	}

}

qued=0
q1=null
q2=null
q3=null
q4=null
q5=null
q6=null
q7=null
q8=null
q9=null
q10=null

function walkfunct(d) {
	if(qSwitch==1 && d!=null) {
		if(d==1) {
			obj2 = document.getElementById('square')
			obj2.style.top=(obj2.offsetTop - 16)
		} else if(d==2) {
			obj2 = document.getElementById('square')
			obj2.style.left=(obj2.offsetLeft - 16)
		} else if(d==3) {
			obj2 = document.getElementById('square')
			obj2.style.left=(obj2.offsetLeft + 16)
		} else if(d==4) {
			obj2 = document.getElementById('square')
			obj2.style.top=(obj2.offsetTop + 16)
		}

		if(q1==null) {
			q1=d
		} else if(q2==null) {
			q2=d
		} else if(q3==null) {
			q3=d
		} else if(q4==null) {
			q4=d
		} else if(q5==null) {
			q5=d
		} else if(q6==null) {
			q6=d
		} else if(q7==null) {
			q7=d
		} else if(q8==null) {
			q8=d
		} else if(q9==null) {
			q9=d
		} else if(q10==null) {
			q10=d
			goque()
		}

		drawque();
	} else {
		if(d==0) {
			document.all.TheFrame.src="actions.php"
		} else if(d==1) {
			document.all.TheFrame.src="actions.php?up"
		} else if(d==2) {
			document.all.TheFrame.src="actions.php?left"
		} else if(d==3) {
			document.all.TheFrame.src="actions.php?right"
		} else if(d==4) {
			document.all.TheFrame.src="actions.php?down"
		}
	}
}

function drawque() {
	strW1=dirtostring(q1)
	strW2=dirtostring(q2)
	strW3=dirtostring(q3)
	strW4=dirtostring(q4)
	strW5=dirtostring(q5)
	strW6=dirtostring(q6)
	strW7=dirtostring(q7)
	strW8=dirtostring(q8)
	strW9=dirtostring(q9)
	strW10=dirtostring(q10)

	questring="Walking Que: "

	if(strW1!="") {
		questring=questring+strW1
	}
	if(strW2!="") {
		questring=questring+", "+strW2
	}
	if(strW3!="") {
		questring=questring+", "+strW3
	}
	if(strW4!="") {
		questring=questring+", "+strW4
	}
	if(strW5!="") {
		questring=questring+", "+strW5
	}
	if(strW6!="") {
		questring=questring+", "+strW6
	}

	if(strW7!="") {
		questring=questring+", "+strW7
	}

	if(strW8!="") {
		questring=questring+", "+strW8
	}

	if(strW9!="") {
		questring=questring+", "+strW9
	}
	if(strW10!="") {
		questring=questring+", "+strW10+"."
	}

	obj = document.getElementById('theQue')
	obj.innerHTML=questring
}

function goque() {
	document.all.TheFrame.src="actions.php?que=" + q1 + "," + q2 + "," + q3 + "," + q4 + "," + q5 + "," + q6 + "," + q7 + "," + q8 + "," + q9 + "," + q10
	clearque()
}

function clearque() {
	qued=0
	q1=null
	q2=null
	q3=null
	q4=null
	q5=null
	q6=null
	q7=null
	q8=null
	q9=null
	q10=null

	obj = document.getElementById('square')
	obj.style.top=199
	obj.style.left=272


	drawque()
}

function tab(id) {

	if(id==0) {
		document.all.TheFrame.src="actions.php"
		show('GUI-walktable')
		hide('GUI-battle');
	} else if(id==1) {
		drawQs(0)
		show('GUI-battle')
		hide('GUI-walktable')
	}
}

function show(id){
	if (document.getElementById){
		obj = document.getElementById(id);
		obj.style.display = "";
	}
}

function hide(id){
	if (document.getElementById){
		obj = document.getElementById(id);
		obj.style.display = "none";
	}
}

function stats() {
	document.all.TheFrame.src="actions.php?stats"
}

function battle(action) {
	if(action==0) {
		document.all.TheFrame.src="battle.php?act=attack"
	} else if(action==1) {
		document.all.TheFrame.src="battle.php?act=run"
	}
}
</script>

<style type="text/css">
	#overlay {
		width: 470px;
		height: 329px;
		position: absolute;
		top: 38px;
		left: 41px;
	}
	#square {
		width: 15px;
		height: 15px;
		position: absolute;
		top: 199px;
		left: 272px;
	}
</style>

<div id="overlay" style="display:none;"><image src='media/overlay.png'></div>



<div id="walkdiv" style="display:none;"><div id="square"><image src='images/redsq.png'></div></div>



<?php

$frame="

<iframe id='TheFrame' src='showim.php?x=" . $u . "&y=" . md5($p) . "' frameborder='0' width='470' height='329' scrolling='no'></iframe>";

$guif="<table border='1' cellpadding='1' cellspacing='0' width='100%'><tr><td colspan='2'>
Controls: <a href='javascript:tab(0);'>Movement</a>
<a href='javascript:stats();'>Status</a>
<a href='javascript:tab(1);'>Battle</a>
</td></tr></table>



<div id='GUI-walktable'>
<table border='1' cellpadding='1' cellspacing='0' width='100%'><tr><td align='center' rowspan='2' width='150'>
<table border='0'>
<tr><td colspan='3' align='center'><a href='javascript:walkfunct(1)'><image src='images/icons_up.gif' border='0'></a></td></tr>
<tr><td><a href='javascript:walkfunct(2)'><image src='images/icons_left.gif' border='0'></a></td>
<td><a href='javascript:walkfunct(0)'><image src='images/ex.gif' border='0'></a></td>
<td><a href='javascript:walkfunct(3)'><image src='images/icons_right.gif' border='0'></a></td></tr>
<tr><td colspan='3' align='center'><a href='javascript:walkfunct(4)'><image src='images/icons_down.gif' border='0'></a></td></tr></table>
</td><td>
<table border='0' cellpadding='0' cellspacing='0'><tr><td>Walking Que: </td><td><a href='javascript:qswitch();'><div id='qswitch'><image src='images/switchoff.gif' border='0'></div></a></td><td>&nbsp;&nbsp; <a href='javascript:goque()'><image src='images/check.gif' border='0'></a> &nbsp; <a href='javascript:clearque()'><image src='images/ex.gif' border='0'></a></td></tr></table>
</td></tr>
<tr><td><div id='theQue'>Walking Que: </div></td>
</tr></table></div>

<div id='GUI-battle' style='display: none;'>
<a href='javascript:battle(0);'>Attack</a> | <a href='javascript:battle(1);'>Run</a>

</div>
";

make_gui($frame, $guif);


?>
