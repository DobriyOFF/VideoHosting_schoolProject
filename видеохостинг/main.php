<?php session_start();
header("Content-type: text/html; charset=utf-8");
include("config.php");
if(@$_SESSION['user_id']==""){include("auth.php");}


echo'<div align=right>';
if(@$_SESSION['user_id']<>""){echo @$_SESSION['user_nick'].' &nbsp;&nbsp;&nbsp; <a href="del_cookie.php">Выйти</a></div><hr><br>';}

echo'<table border=0 width=945><tr><td align=center>';
if(@$_GET['razdel']<>"" AND @$_GET['razdel']<>"undefined" AND (@$_GET['cat']=="undefined" OR @$_GET['cat']=="")){
try{$STH = $DBH->query("SELECT id,nazv FROM categories WHERE razdel='".@$_GET['razdel']."'");
$STH->setFetchMode(PDO::FETCH_ASSOC);
while($row = $STH->fetch()) {  
	$cid=$row['id'];
	$cnazv=$row['nazv'];
	echo '<a href="javascript:main(\''.$cid.'\',\'\',\'\',\''.@$_GET['razdel'].'\');"><img width=200 height=150 src="images/categories/'.$cid.'.png" onmouseover="this.src=\'images/categories/'.$cid.'_.png\'" onmouseout="this.src=\'images/categories/'.$cid.'.png\'"></a> ';
}}catch(PDOException $e){SQLErrors($e,'#error_02#');}
echo'<br>';
}



if(@$_GET['cat']<>"" AND @$_GET['cat']<>"undefined"){
	echo'<div align=left><a style="text-decoration: none" href="javascript:main(\'\',\'\',\'\',\''.@$_GET['razdel'].'\');"><img src=images/back.png onmouseover="this.src=\'images/back_.png\'" onmouseout="this.src=\'images/back.png\'"></a></div>';
try{$STH = $DBH->query("SELECT nazv,about FROM categories WHERE id='".@$_GET['cat']."'");
	$STH->setFetchMode(PDO::FETCH_ASSOC);$row = $STH->fetch();
	$nazv=$row['nazv'];
	$about=$row['about'];
}catch(PDOException $e){SQLErrors($e,'#error_1#');}
echo'<div align=center><font class=style1>'.$nazv.'</style><br><br><table border=0 width=800><tr><td width=240><img src=images/categories/'.@$_GET['cat'].'.png onmouseover="this.src=\'images/categories/'.@$_GET['cat'].'_.png\'" onmouseout="this.src=\'images/categories/'.@$_GET['cat'].'.png\'"></td><td valign=top>'.$about.'</td></tr></table></div><br>';
}
if(@$_GET['cat']<>"" AND @$_GET['cat']<>"undefined"){
	try{$STH = $DBH->query("SELECT id,nazv FROM subcategories WHERE cat_id='".@$_GET['cat']."'");
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	while($row = $STH->fetch()) {  
		$uid=$row['id'];
		$unazv=$row['nazv'];
		echo '<a href="javascript:main(\''.@$_GET['cat'].'\',\''.$uid.'\',\'\',\''.@$_GET['razdel'].'\');"><img src="images/subcategories/'.$uid.'.png" onmouseover="this.src=\'images/subcategories/'.$uid.'_.png\'" onmouseout="this.src=\'images/subcategories/'.$uid.'.png\'"></a> ';
	}}catch(PDOException $e){SQLErrors($e,'#error_02#');}

echo'<br><br>';
}

$wh='';
if(@$_GET['cat']<>"" AND @$_GET['subcat']<>"" AND @$_GET['cat']<>"undefined" AND @$_GET['subcat']<>"undefined"){
$wh=' WHERE cat_id='.@$_GET['cat'].' AND subcat_id='.@$_GET['subcat'].' AND ';

try{$STH = $DBH->query("SELECT id,nazv,about,code FROM streams WHERE razdel='".@$_GET['razdel']."' AND cat_id='".@$_GET['cat']."' AND subcat_id='".@$_GET['subcat']."' ORDER BY id DESC LIMIT 100");
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	while($row = $STH->fetch()) {  
		$id=$row['id'];
		$nazv=$row['nazv'];
		$about=$row['about'];
		$code=$row['code'];
		$pict='http://i4.ytimg.com/vi/'.$code.'/default.jpg';
		echo'<a href="javascript:see(\''.$id.'\');"><img src='.$pict.'></a> ';

		
}}catch(PDOException $e){SQLErrors($e,'#error_02#');}
}
echo'</td></tr></table></div>';
?>