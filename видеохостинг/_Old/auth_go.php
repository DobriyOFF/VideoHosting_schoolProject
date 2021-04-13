<?php session_start();
header("Content-type: text/html; charset=utf-8");
include("config.php");
$don=0;
$ip=$_SERVER['REMOTE_ADDR'];
$login=htmlspecialchars(strip_tags(trim($_GET['p1'])));
$pass=htmlspecialchars(strip_tags(trim($_GET['p2'])));
$m=30;
$STH = $DBH->query("SELECT id FROM authorizations WHERE datetime>subdate(NOW(), INTERVAL ".$m." MINUTE) AND login='".$login."'");
$u = $STH->rowCount();

if($u<=3){

if($login<>"" AND $pass<>""){
if(mb_strlen($login)<21){
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = mb_strlen($chars) - 1;  
    while (mb_strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];  
    }
    return $code;
}
echo'<div align="center"><font face="Arial" size="4" color="#000080"></font></div>';
if(@$_SESSION['user_nick']<>"" AND @$_SESSION['user_nick']<>"Гость"){
$authmsg="Вы уже авторизованы. Чтобы выйти, воспользуйтесь меню";
}


$STH = $DBH->query("SELECT id FROM users WHERE nick='".htmlspecialchars($login)."' AND pass='".$pass."'");
$ko = $STH->rowCount();

if($ko==0){
$STH = $DBH->query("SELECT id FROM users WHERE nick='".htmlspecialchars($login)."'");
$ko3 = $STH->rowCount();

if($ko3==1){
$authmsg='<br><font face=Arial>К данному профилю не подходит введённый Вами пароль</font><br><br>';
$resu=0;
}else{
$authmsg='<br><font face=Arial color=red>Такого пользователя в базе не найдено</font><br><br>';
$resu=0;
}}else{
$STH = $DBH->query("SELECT id FROM users WHERE ip='".$ip."'");
$ukolv = $STH->rowCount();
$ukolv=0;
if($ukolv==0){

$_SESSION['user_nick']=$login;
$_SESSION['user']=$login;

try{$STH = $DBH->query("SELECT id FROM users WHERE nick='".$login."' AND pass='".$pass."'");
$STH->setFetchMode(PDO::FETCH_ASSOC);$row = $STH->fetch();
$idu=$row['id'];
}catch(PDOException $e){}

$_SESSION['user_id']=$idu;
$resu=1;

$_SESSION['global_mess']='';
$_SESSION['warning']='';

$hash = md5(generateCode(10));
$_SESSION['user_hash']=$hash;

try{$STH = $DBH->prepare("UPDATE users set ip='".$ip."',hash='".$hash."' WHERE nick='".$login."'");
$STH->execute();}catch(PDOException $e){}

?>
<script language="javascript" type="text/javascript">
document.location.href = "set_cookies.php";
</script>
<?php
$don=1;
$authmsg='<div align=center><font class=style1>Приветствуем Вас, '.$login.'!</font><br><br></div>';
}
}
$ip=$_SERVER['REMOTE_ADDR'];
try{$data = array($login,date("Y-m-j H:i:s"),$resu,$ip);
$STH = $DBH->prepare("INSERT INTO authorizations (login,datetime,good,ip) values (?,?,?,?)");
$STH->execute($data);}catch(PDOException $e){}
}else{$authmsg='Максимальная длина логина не должна превышать 20 символов. У Вас - '.mb_strlen($login).'';}
}else{$authmsg='<br><font color=red>Введены не все данные</font><br><br>';}
/*echo'<script language="javascript" type="text/javascript">document.location.href = "index.php";</script>';*/
if($don==0){$knopka2='<br><div align=center><a style="cursor: pointer;" onclick="top.document.getElementById(\'parent_popup\').style.display=\'none\';"><img border="0" src="images/ok.png" width="59" height="21" onmouseover="this.src=\'images/_ok.png\'" onmouseout="this.src=\'images/ok.png\'"></a></div>';}
else{$knopka2='<br><div align=center><a style="cursor: pointer;" onclick="top.document.getElementById(\'parent_popup\').style.display=\'none\';main();"><img border="0" src="images/ok.png" width="59" height="21" onmouseover="this.src=\'images/_ok.png\'" onmouseout="this.src=\'images/ok.png\'"></a></div>';}
if($authmsg<>"done"){echo'<div align=center><font class=2>'.$authmsg.'</font>'.$knopka2;}else{echo $authmsg;}
}else{echo'<div align=center><font face=Arial>Вы ввели неверный пароль 3 раза и были заблокированы сервером<br>игры на '.$m.' минут для обеспечения безопасности аккаунта</font></div>'.$_SESSION['knopka'];}
?>