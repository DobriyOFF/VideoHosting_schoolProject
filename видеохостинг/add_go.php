<?php session_start();
header("Content-type: text/html; charset=utf-8");
include("config.php");
$don=0;
$ip=$_SERVER['REMOTE_ADDR'];
$r=htmlspecialchars(strip_tags(trim($_GET['r'])));
$c=htmlspecialchars(strip_tags(trim($_GET['c'])));
$s=htmlspecialchars(strip_tags(trim($_GET['s'])));
$co=addslashes(trim($_GET['co']));
$a=htmlspecialchars(strip_tags(trim($_GET['a'])));
$n=htmlspecialchars(strip_tags(trim($_GET['n'])));

$STH = $DBH->query("SELECT id FROM streams WHERE nazv='".$n."' OR code='".$co."'");
$u = $STH->rowCount();
if($u==0){
	
/*	
echo $r.'<br>';
echo $c.'<br>';
echo $s.'<br>';
echo $co.'<br>';
echo $a.'<br>';
echo $n.'<br>';
	*/
	
/*$co=mysql_real_escape_string($co);*/

try{$data = array($n,$a,$co,$c,$s,$r);
$STH = $DBH->prepare("INSERT INTO streams (nazv,about,code,cat_id,subcat_id,razdel) values (?,?,?,?,?,?)");
$STH->execute($data);}catch(PDOException $e){SQLErrors($e,'#error_01#');}
echo'Видео успешно добавлено в базу';

}else{echo'Видео с таким названием или кодом уже есть в базе';}
?>