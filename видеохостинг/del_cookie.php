<?php session_start();
setcookie("cparam");
setcookie("chash");
include("config.php");
$ip='';
try{$STH = $DBH->prepare("UPDATE users set ip='".$ip."' WHERE id='".$_SESSION['game_id']."'");
$STH->execute();}catch(PDOException $e){}
$_SESSION['user']="";
$_SESSION['user_nick']="";
$_SESSION['user_id']="";
$_SESSION['msg']="Возвращайтесь, мы уже начали активно скучать ;)";
?><script language="javascript" type="text/javascript">document.location.href = "index.php";</script>