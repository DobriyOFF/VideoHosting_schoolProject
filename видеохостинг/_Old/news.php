<?php

echo'<div align=center><font class=style1>Новости</font></div><br><font face=Arial size=3>';

try{$STH = $DBH->query("SELECT id,text,datetime FROM news ORDER BY datetime LIMIT 20");
$STH->setFetchMode(PDO::FETCH_ASSOC);
while($row = $STH->fetch()) {  
$nid=$row['id'];
$text=$row['text'];
echo'<div align=justify>&nbsp;&nbsp;&nbsp; - '.$text.'<br><br></div>';
}}catch(PDOException $e){}

?>