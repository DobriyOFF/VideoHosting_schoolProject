<?php session_start();
header("Content-type: text/html; charset=utf-8");
include("config.php");
$i=@$_GET['i'];

$_SESSION['add_razdel_text']=$i;
@$_SESSION['add_category_text']='';
@$_SESSION['add_subcategory_text']='';
?>