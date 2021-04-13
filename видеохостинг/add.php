<?php session_start();
header("Content-type: text/html; charset=utf-8");
include("config.php");
if(@$_SESSION['user_id']<>""){




$c="";
if(@$_SESSION['add_razdel_text']<>""){$r=@$_SESSION['add_razdel_text'];}
if(@$_SESSION['add_category_text']<>""){$c=@$_SESSION['add_category_text'];}
$d1='';$d2='';$d3='';$d4='';$d5='';
if($r=="yrokam"){$d1=' SELECTED';}
if($r=="naukam"){$d2=' SELECTED';}
if($r=="video"){$d3=' SELECTED';}
if($r=="interes"){$d4=' SELECTED';}
if($r=="bloggers"){$d5=' SELECTED';}
echo'<br><select name="razdel" id="razdel" size=1 style="width:90; background-color: #E0E0E0" onchange="top.open_razdel();">
<option value="yrokam"'.$d1.'>Стримы</option>
<option value="naukam"'.$d2.'>Передачи</option>
<option value="video"'.$d3.'>Игры</option>
<option value="interes"'.$d4.'>Юмор</option>
<option value="bloggers"'.$d5.'>Блоггеры</option>
</select>';

if($r<>""){
echo'&nbsp;&nbsp;&nbsp;<select name="category" id="category" size=1 style="width:260; background-color: #E0E0E0" onchange="top.open_category();"><option></option>';
echo "SELECT id,nazv FROM categories WHERE razdel='".$r."'";

try{$STH = $DBH->query("SELECT id,nazv FROM categories WHERE razdel='".$r."'");
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	while($row = $STH->fetch()) {  
		$bid=$row['id'];
		$nazv=$row['nazv'];
	if(@$_SESSION['add_category_text']==$bid){echo'<option value="'.$bid.'" SELECTED>'.$nazv.'</option>';}else{echo'<option value="'.$bid.'">'.$nazv.'</option>';}
}}catch(PDOException $e){SQLErrors($e,'#error_02#');}
echo'</select>';
}

if($c<>""){
try{$STH = $DBH->query("SELECT id FROM categories WHERE id='".$c."'");
	$STH->setFetchMode(PDO::FETCH_ASSOC);$row = $STH->fetch();
	$cid=$row['id'];
}catch(PDOException $e){SQLErrors($e,'#error_1#');}
echo'&nbsp;&nbsp;&nbsp;<select name="subcategory" id="subcategory" size=1 style="width:260; background-color: #E0E0E0" onchange="top.open_subcategory();"><option></option>';
try{$STH = $DBH->query("SELECT id,nazv FROM subcategories WHERE cat_id='".$cid."'");
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	while($row = $STH->fetch()) {  
		$bid=$row['id'];
		$nazv=$row['nazv'];
		if(@$_SESSION['add_subcategory_text']==$bid){echo'<option value="'.$bid.'" SELECTED>'.$nazv.'</option>';}else{echo'<option value="'.$bid.'">'.$nazv.'</option>';}
}}catch(PDOException $e){SQLErrors($e,'#error_02#');}
echo'</select>';
}
echo'<br><br>Название: <input type="text" value="" id="nazv" name="nazv" size=100 style="background-color: #E0E0E0;"><br><br>Код видео:<br><textarea rows="5" id="code" name="code" style="width:840; background-color: #E0E0E0;"></textarea>
<br><br>Описание:<br><textarea rows="5" id="about" name="about" style="width:840; background-color: #E0E0E0;"></textarea><br><br>
<a href="javascript:add_go(encodeURIComponent(document.getElementById(\'razdel\').value),encodeURIComponent(document.getElementById(\'category\').value),encodeURIComponent(document.getElementById(\'subcategory\').value),encodeURIComponent(document.getElementById(\'code\').value),encodeURIComponent(document.getElementById(\'about\').value),encodeURIComponent(document.getElementById(\'nazv\').value));"><img src=images/add.png onmouseover="this.src=\'images/_add.png\'" onmouseout="this.src=\'images/add.png\'" style="vertical-align: middle;"></a>
';


}else{echo'<br><div align=center><font class=style2>Вы должны быть авторизованы, чтобы подать заявку для добавления нового видео</font></div><br>';}
echo $_SESSION['knopka'];
?>
