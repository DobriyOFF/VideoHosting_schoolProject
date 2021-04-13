<?php session_start();
header("Content-type: text/html; charset=utf-8");
include("config.php");
$id=@$_GET['id'];
try{$STH = $DBH->query("SELECT nazv,about,code FROM streams WHERE id='".$id."'");
$STH->setFetchMode(PDO::FETCH_ASSOC);$row = $STH->fetch();
$nazv=$row['nazv'];
$about=$row['about'];
$code=$row['code'];
}catch(PDOException $e){SQLErrors($e,'#error_1#');}
$code = stripslashes($code);
if($nazv<>""){
	echo'<div align=center><br><font class=style1>'.$nazv.'</font><br><br>
	<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$code.'" frameborder="0" allowfullscreen></iframe>
	<br><br><font class=style4>'.$about.'</font><br><br></div>';
	
}

echo'<div style="position: absolute; left: 865px; top: 10px; width:15px; height:15px;"><a style="cursor: pointer;" onclick="top.document.getElementById(\'parent_popup\').style.display=\'none\';"><img src="images/close.png" onmouseover="this.src=\'images/close_.png\'" onmouseout="this.src=\'images/close.png\'"></a></div>';

?>