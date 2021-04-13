<?php
header("Content-type: text/html; charset=utf-8");
function SQLErrors($er,$ide){echo $er;}
include ('config.php')
/*
   INSERT:
try{$data = array(,date("Y-m-j H:i:s"));
$STH = $DBH->prepare("INSERT INTO SQLErrors (text,datetime) values (?,?)");
$STH->execute($data);}catch(PDOException $e){SQLErrors($e,'#error_01#');}
-----------------------
   SELECT (одна запись):
try{$STH = $DBH->query("SELECT element_id FROM users WHERE id='".$_SESSION['game_id']."'");
 $STH->setFetchMode(PDO::FETCH_ASSOC);$row = $STH->fetch();
 $element_id=$row['element_id'];
}catch(PDOException $e){SQLErrors($e,'#error_1#');}
-----------------------
   SELECT (много записей):
try{$STH = $DBH->query("SELECT element_id FROM users WHERE id='".$_SESSION['game_id']."'");
 $STH->setFetchMode(PDO::FETCH_ASSOC);
 while($row = $STH->fetch()) {  
  $element_id=$row['element_id'];
}}catch(PDOException $e){SQLErrors($e,'#error_02#');}
-----------------------
    UPDATE:
try{$STH = $DBH->prepare("UPDATE users SET ip='".$ip."' WHERE id='".$_SESSION['game_id']."'");
$STH->execute();}catch(PDOException $e){SQLErrors($e,'#error_04#');}
-----------------------
 DELETE:
try{$STH = $DBH->prepare("DELETE FROM map WHERE what='Объект на поверхности' AND id='".$id."'");
$STH->execute();}catch(PDOException $e){SQLErrors($e,'#error_04#');}
-----------------------
    COUNT:
$STH = $DBH->query("SELECT id FROM objavleniya_auto");
$ukolv = $STH->rowCount();
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
 <meta charset="UTF-8">
 <title>test</title>
 <link rel="stylesheet" href="css/style.css">
 <script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
 
 
</head>

<body>
<div align=center>
<table border=0 width=1100><tr><td align=center valign=top><font face=arial size=4>

<?php

$p=@$_GET['predmet'];
if($p==''){
	
	

try{$STH = $DBH->query("SELECT id,nazv FROM predmets");
 $STH->setFetchMode(PDO::FETCH_ASSOC);
 while($row = $STH->fetch()) {  
  $nazv=$row['nazv'];
  $id=$row['id'];
  
  echo "<a href='index.php?predmet=".$id."'> ".$nazv."</a><br>";
  
  
}}catch(PDOException $e){SQLErrors($e,'#error_02#');}
}
else{
		$r=@$_GET['razdel'];
		if($r==''){
	try{$STH = $DBH->query("SELECT nazv FROM predmets WHERE id='".$p."'");
 $STH->setFetchMode(PDO::FETCH_ASSOC);$row = $STH->fetch();
 $nazv=$row['nazv'];
}catch(PDOException $e){SQLErrors($e,'#error_1#');}
	 echo "<div align=left><a href='index.php'><< назад</a><br></div>";

	echo 'Предмет: '.$nazv.'<br>Разделы: <br>';
	
	try{$STH = $DBH->query("SELECT id,nazv FROM razdels WHERE predmet_id='".$p."'");
 $STH->setFetchMode(PDO::FETCH_ASSOC);
 while($row = $STH->fetch()) {  
  $id=$row['id'];
  $rnazv=$row['nazv'];
    echo "<a href='index.php?predmet=".$p."&razdel=".$id."'>".$rnazv.'</a><br>';
}}catch(PDOException $e){SQLErrors($e,'#error_02#');}
			
		}else{
			$f=@$_GET['formula'];
		if($f==''){
			
try{$STH = $DBH->query("SELECT nazv FROM razdels WHERE id='".$r."'");
 $STH->setFetchMode(PDO::FETCH_ASSOC);$row = $STH->fetch();
 $nazv=$row['nazv'];
}catch(PDOException $e){SQLErrors($e,'#error_1#');}
	 echo "<div align=left><a href='index.php?predmet=".$p."'><< назад</a><br></div>";

		echo 'Раздел: '.$nazv.'<br>Формулы: <br>';
			try{$STH = $DBH->query("SELECT id,nazv,about FROM formuls WHERE razdel_id='".$r."'");
 $STH->setFetchMode(PDO::FETCH_ASSOC);
 while($row = $STH->fetch()) {  
  $id=$row['id'];
  $fnazv=$row['nazv'];
  $about=$row['about'];
    echo "<a href='index.php?predmet=".$p."&razdel=".$r."&formula=".$id."'>".$fnazv.'</a><br>';
}}catch(PDOException $e){SQLErrors($e,'#error_02#');}
		}else{
	 echo "<div align=left><a href='index.php?predmet=".$p."&razdel=".$r."'><< назад</a><br></div>";
try{$STH = $DBH->query("SELECT nazv,about,perem,php_code FROM formuls WHERE id='".$f."'");
 $STH->setFetchMode(PDO::FETCH_ASSOC);$row = $STH->fetch();
 $nazv=$row['nazv'];
 $about=$row['about'];
 $perem=$row['perem'];
 $php_code=$row['php_code'];
}catch(PDOException $e){SQLErrors($e,'#error_1#');}
			echo 'Формула: '.$nazv.'<br><font size=2>Описание: '.$about.'</font><br><br>';
			$h=explode(",",$perem); //explode - разбивка по символу в массив
			for($a=0;$a<=count($h)-1;$a++){ //закрытие, count - число
			echo'<table cellpadding=20 border=1 style="border-collapse: collapse; "><tr><td align=center>';
			$hh=explode("@",$h[$a]);
				
				if($a>=0){
					echo '<img src="img/'.$f.'_'.$a.'.png">';
					echo'<br><br>'.$hh[0].' ('.$hh[1].') <br> '; 
					echo'<br><form action="index.php">';
				$nom=@$_GET['nom'];
				if($nom==$a){
		$p1=@$_GET['p'.($a+0).'_1'];
		$p2=@$_GET['p'.($a+0).'_2'];
		$p3=@$_GET['p'.($a+0).'_3'];
		$p4=@$_GET['p'.($a+0).'_4'];
		}
		eval($php_code);//копирует, запускает php из переменной
		if($nom==$a AND $p1<>''){echo'<font size=4 color=blue>'.$res[$a].'</font><br><br>';}
	$hhh=explode(",",$pe[$a]);
	for($aa=1;$aa<=count($hhh)-1;$aa++){	
		echo ''.$hhh[$aa].' <input name="p'.$a.'_'.$aa.'" maxlength="15" size="10" value=""> ';
	}


  echo '<input type=hidden name=nom value="'.$a.'">
  <input type=hidden name=predmet value="'.$_GET['predmet'].'">
  <input type=hidden name=razdel value="'.$_GET['razdel'].'">
  <input type=hidden name=formula value="'.$_GET['formula'].'">
  <button type="submit">Рассчитать</button></form><br>';
	}else {echo '<form action="index.php#r" method="get">
   <p><input maxlength="15" size="20" value=""></p>
   <input type=hidden name=nom value="'.$a.'">
  <input type=hidden name=predmet value="'.$_GET['predmet'].'">
  <input type=hidden name=razdel value="'.$_GET['razdel'].'">
  <input type=hidden name=formula value="'.$_GET['formula'].'">
  <button type="submit">Рассчитать</button>
  </form><br>';} // окно
		echo '</td></tr></table><br>';	
		
		
		
		
		
			}
		}
		}
		
}
?>
</font></td></tr></table>
</body>
</html>