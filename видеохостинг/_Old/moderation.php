<?php
include("config.php");
echo'<div align=center><font class=style1>Модерация видеороликов</font></div><br><table border=0 width=920>';
try{$STH = $DBH->query("SELECT id,nazv,about,code,cat_id,subcat_id,razdel FROM streams WHERE check_=0");
$STH->setFetchMode(PDO::FETCH_ASSOC);
while($row = $STH->fetch()) {  
$id=$row['id'];
$nazv=$row['nazv'];
$about=$row['about'];
$code=$row['code'];
$cat_id=$row['cat_id'];
$subcat_id=$row['subcat_id'];
$razdel=$row['razdel'];

try{$STH2 = $DBH->query("SELECT nazv,razdel,rusrazdel,about FROM categories WHERE id='".$cat_id."'");
$STH2->setFetchMode(PDO::FETCH_ASSOC);$row2 = $STH2->fetch();
$qnazv=$row2['nazv'];
$qrazdel=$row2['razdel'];
$qrusrazdel=$row2['rusrazdel'];
$qabout=$row2['about'];
}catch(PDOException $e){SQLErrors($e,'#error_1#');}


echo'<tr><td width=230>';
		$pos=strrpos($code,'embed');
		$pos2=strrpos($code,'frameborder');

if($razdel<>"streams1"){
		$pict='http://img.youtube.com/vi/'.mb_substr($code,$pos+6,$pos2-$pos-8).'/0.jpg';
		$pict2='http://img.youtube.com/vi/'.mb_substr($code,$pos+6,$pos2-$pos-8).'/1.jpg';
		echo'<a href="javascript:see(\''.$id.'\');"><img width=200 height=150 border=0 src='.$pict.' onmouseover="this.src=\''.$pict2.'\'" onmouseout="this.src=\''.$pict.'\'"></a> ';
}else{
	echo'<a href="javascript:see(\''.$id.'\');">стрим</a> ';
}
echo'</td><td align=left valign=middle><font face=Arial size=3><b>'.$nazv.'</b><br><br>'.$about.'<br><br>Категория: '.$qnazv.'<br>
Раздел: '.$qrusrazdel.' ('.$qrazdel.') &quot;'.$qabout.'&quot;<br>

</font></td><td width=80><a style="text-decoration: none" href="javascript:maction(\'good\',\''.$id.'\');"><img src=images/dalee.png onmouseover="this.src=\'images/dalee_.png\'" onmouseout="this.src=\'images/dalee.png\'"></a>
 &nbsp;&nbsp;&nbsp;&nbsp; <a style="text-decoration: none" href="javascript:maction(\'delete\',\''.$id.'\');"><img src=images/close.png onmouseover="this.src=\'images/close_.png\'" onmouseout="this.src=\'images/close.png\'"></a>
</td></tr>';
}}catch(PDOException $e){}
echo'</table>';
?>