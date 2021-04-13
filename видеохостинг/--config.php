<?php
$host = 'localhost';
$dbname = 'stream';
$dbuser = 'root';
$dbpass = 'al1922';
mb_internal_encoding('UTF-8');
try {  
  $DBH = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
  $DBH->exec('SET NAMES utf8');
}  
catch(PDOException $e){
    echo "Не удаётся  установить соединение с базой данных";  
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);  
}
?>