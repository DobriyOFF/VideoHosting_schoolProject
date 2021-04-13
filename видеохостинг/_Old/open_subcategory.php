<?php session_start();
header("Content-type: text/html; charset=utf-8");
include("config.php");
$i=@$_GET['i'];
$_SESSION['add_subcategory_text']=$i;
?>