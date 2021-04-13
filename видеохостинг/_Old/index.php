<?php session_start();
header("Content-type: text/html; charset=utf-8");
include("config.php");
$_SESSION['knopka']='<br><div align=center><a style="cursor: pointer;" onclick="top.document.getElementById(\'parent_popup\').style.display=\'none\';main();"><img border="0" src="images/ok.png" width="59" height="21" onmouseover="this.src=\'images/_ok.png\'" onmouseout="this.src=\'images/ok.png\'"></a></div>';

/*
   INSERT:
try{$data = array(,date("Y-m-j H:i:s"));
$STH = $DBH->prepare("INSERT INTO SQLErrors (text,datetime) values (?,?)");
$STH->execute($data);}catch(PDOException $e){SQLErrors($e,'#error_01#');}
-----------------------
   SELECT (одна запись):
try{$STH = $DBH->query("SELECT element_id FROM game_users WHERE id='".$_SESSION['game_id']."'");
$STH->setFetchMode(PDO::FETCH_ASSOC);$row = $STH->fetch();
$element_id=$row['element_id'];
}catch(PDOException $e){SQLErrors($e,'#error_1#');}
-----------------------
   SELECT (много записей):
try{$STH = $DBH->query("SELECT element_id FROM game_users WHERE id='".$_SESSION['game_id']."'");
$STH->setFetchMode(PDO::FETCH_ASSOC);
while($row = $STH->fetch()) {  
$element_id=$row['element_id'];
}}catch(PDOException $e){SQLErrors($e,'#error_02#');}
-----------------------
    UPDATE:
try{$STH = $DBH->prepare("UPDATE game_users SET ip='".$ip."' WHERE id='".$_SESSION['game_id']."'");
$STH->execute();}catch(PDOException $e){SQLErrors($e,'#error_04#');}
-----------------------
    COUNT:
$STH = $DBH->query("SELECT id FROM objavleniya_auto");
$ukolv = $STH->rowCount();


*/


?>

<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title></title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!--[if IE 6]>
		<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
	<![endif]-->
	<link rel="shortcut icon" type="image/x-icon" href="css/images/favicon.ico" />
	<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
	<script src="js/jquery.jcarousel.js" type="text/javascript"></script>
	<script src="js/jquery-func.js" type="text/javascript"></script>
	<script>
	function main(cat,subcat,stream,razdel){
	$.ajax({url: "main.php?cat="+cat+"&subcat="+subcat+"&stream="+stream+"&razdel="+razdel,success: function(data){
	document.getElementById('window').innerHTML='<font color="#000000">'+data+'</font>';
	}})
	menu(razdel);
};

function see(id) {
	$.ajax({url: "see.php?id="+id,success: function(data){
	if(data!=''){
		var delay_popup = 1;
		document.getElementById('popup').innerHTML=data;
			setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
	}
	}})
}

function menu(razdel) {
	$.ajax({url: "menu.php?r="+razdel,success: function(data){
	if(data!=''){
		document.getElementById('mmenu').innerHTML=data;	

		
		}
		
		
	}})
}

function auth(p1,p2){
$.ajax({url: "auth_go.php?p1="+p1+"&p2="+p2,success: function(data){
if(data!=''){
var delay_popup = 1;
document.getElementById('popup').innerHTML=data;
	setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
	}
}})
online_show();
};

function reg(){
$.ajax({url: "reg.php",success: function(data){
document.getElementById('window').innerHTML='<font face="Arial" color="#C6C6C6" size="3">'+data+'</font>';
}})
};


function open_razdel(){
	var tn;
	tn=document.all.razdel.value;
	$.ajax({url: "open_razdel.php?i="+tn,success: function(data){
	add();
	}})
};

function open_category(){
	var tn;
	tn=document.all.category.value;
	$.ajax({url: "open_category.php?i="+tn,success: function(data){
	add();
	}})
};

function open_subcategory(){
	var tn;
	tn=document.all.subcategory.value;
	$.ajax({url: "open_subcategory.php?i="+tn,success: function(data){
	add();
	}})
};

function register(p1,p2,p3){
$.ajax({url: "register.php?p1="+p1+"&p2="+p2+"&p3="+p3,success: function(data){
if(data!=''){
	
var delay_popup = 1;
document.getElementById('popup').innerHTML=data;
	setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
	}
}})
};

function add(){
$.ajax({url: "add.php",success: function(data){
if(data!=''){
var delay_popup = 1;
document.getElementById('popup').innerHTML=data;
	setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
	}
}})
};

function add_go(r,c,s,co,a,n){
$.ajax({url: "add_go.php?r="+r+"&c="+c+"&s="+s+"&co="+co+"&a="+a+"&n="+n,success: function(data){
if(data!=''){
var delay_popup = 1;
document.getElementById('popup').innerHTML=data;
	setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
	}
}})
};

function moderation(){
$.ajax({url: "moderation.php",success: function(data){
	document.getElementById('window').innerHTML='<font color="#000000">'+data+'</font>';
}})
};

function maction(a,i){
$.ajax({url: "maction.php?a="+a+"&i="+i,success: function(data){
	moderation();
}})
};


	</script>
	<style type="text/css">
.styleE {color: white; font-size:18px; font-family:Calibri,Arial;}
.styleB {color: white; font-size:18px; font-family:Calibri,Arial;font-weight: bold;}
.style0 {color: white; font-size:23px; font-family:Calibri,Arial;}
.style1 {color: black; font-size:23px; font-family:Calibri,Arial;}
.style2 {color: black; font-size:15px; font-family:Calibri,Arial;}
.style3 {color: black; font-size:15px; font-family:Calibri,Arial;}
.style4 {color: black; font-size:18px; font-family:Calibri,Arial;}
.style5 {color: #515151; font-size:18px; font-family:Calibri,Arial;}
.style40 {color: #C6C6C6; font-size:18px; font-family:Calibri,Arial;}
.style6 {color: black; font-size:20px; font-family:Calibri,Arial;}
.style7 {color: #23317A; font-size:18px; font-family:Calibri,Arial;}
</style>
</head>
<body>
<div id="parent_popup"><div id="popup">&nbsp;</div></div>
	<!-- Begin Header Holder -->
	<div id="header-holder">
		<!-- Begin Shell -->
		<div class="shell">
			<!-- Begin Header -->
			<div id="header">
				<div id="logo">
					<h1><a href="http://Ruxer.ru">Ruxer.ru - видеонавигатор</a></h1>
					<p>Только лучшее видео из Всемирной Сети</p>
				</div>
				<div id=mmenu></div>
			</div>
			<!-- End Header -->
		</div>
		<!-- End Shell -->
	</div>
	<!-- End Header Holder -->
	<!-- Begin Main Holder -->
	<div id="main-holder">
		<!-- Begin Shell -->
		<div class="shell">
			<!-- Begin Main -->
			<div id="main">
				<!-- Begin Big Content -->
				<div id="big-content">
					<div class="boxes-holder">
						<div class="box">
							<table border=0 width=948><tr><td align=center valign=top>
		<div id="window" style="align:center; position: absolute; top: 185px;"></div>
							</td></tr></table>
					</div>
					
				</div>
				<!-- End Big Content -->
			</div>
			<!-- End Main -->
		</div>
		<!-- End Shell -->
	</div>
	<!-- End Main Holder -->
	<!-- Begin Footer Holder -->
	<div id="footer-holder">
		<!-- Begin Shell -->
		<div class="shell">
			<!-- Begin Footer -->
			<div id="footer">
				<p class="right">&copy; Ruxer.ru</p>
				<p>
					<a href="javascript:main('','','','');">Главная</a> <span>|</span>
					<a href="javascript:main('','','','streams');">Стримы</a> <span>|</span>
					<a href="javascript:main('','','','games');">Игры</a> <span>|</span>
					<!--<a href="javascript:main('','','','peredach');">Передачи</a> <span>|</span> --> 
					<!--<a href="javascript:main('','','','humour');">Юмор</a> <span>|</span> -->
					<!--<a href="javascript:main('','','','bloggers');">Блоггеры</a> <span>|</span> -->
				</p>
			</div>
			<!-- End Footer -->
		</div>
		<!-- End Shell -->
	</div>
	<!-- End Footer Holder -->
</body>
</html>
<?php
?>
<script>main();</script>