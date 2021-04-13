<?php
$host = 'localhost';
$dbname = 'segaof_admin';
$dbuser = 'segaof_admin';
$dbpass = '';
mb_internal_encoding('UTF-8');
try {  
  $DBH = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
  $DBH->exec('SET NAMES utf8');
  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
  
}catch(PDOException $e){
    echo "Не удаётся  установить соединение с базой данных";  
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Homework-2</title>
</head>
<body>
	<header>
		<div class="name">
			

		</div>
	</header>
	
	<div class="black">
		

	</div>
</body>
</html>