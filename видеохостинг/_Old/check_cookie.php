<?php
if (isset($_COOKIE['cparam']) and isset($_COOKIE['chash'])){
try{$STH = $DBH->query("SELECT id,hash,nick FROM users WHERE id = '".$_COOKIE['cparam']."' LIMIT 1");
$STH->setFetchMode(PDO::FETCH_ASSOC);
$userdata = $STH->fetch();
}catch(PDOException $e){SQLErrors($e,'#error_02#');}
if(($userdata['hash'] !== $_COOKIE['chash']) or ($userdata['id'] !== $_COOKIE['cparam']))
{}
else
{
try{$STH = $DBH->query("SELECT nick FROM users WHERE id='".$_COOKIE['cparam']."'");
$STH->setFetchMode(PDO::FETCH_ASSOC);$row = $STH->fetch();
$nick=$row['nick'];
}catch(PDOException $e){SQLErrors($e,'#error_02#');}
$_SESSION['user']=$nick;
$_SESSION['user_id']=$_COOKIE['cparam'];
}}
?>