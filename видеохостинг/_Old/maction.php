<?php session_start();
header("Content-type: text/html; charset=utf-8");
include("config.php");
$a=@$_GET['a'];
$i=@$_GET['i'];
if($a=="good"){
	try{$STH = $DBH->prepare("UPDATE streams SET check_=1 WHERE id='".$i."'");
	$STH->execute();}catch(PDOException $e){SQLErrors($e,'#error_04#');}
}
if($a=="delete"){
	try{$STH = $DBH->prepare("DELETE FROM streams WHERE id='".$i."'");
	$STH->execute();}catch(PDOException $e){SQLErrors($e,'#error_04#');}
}
?>