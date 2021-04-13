<?php
header("Content-type: text/html; charset=utf-8");
$host = 'localhost';
$dbname = 'segaof_admin';
$dbuser = 'segaof_admin';
$dbpass = '13131414q';
mb_internal_encoding('UTF-8');
try {  
  $DBH = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
  $DBH->exec('SET NAMES utf8');
}  
catch(PDOException $e){
    echo "No connect to BD";  
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);  
}
?>