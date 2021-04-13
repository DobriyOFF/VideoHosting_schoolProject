<?php session_start();
header("Content-type: text/html; charset=utf-8");
include("config.php");
$ip=$_SERVER['REMOTE_ADDR'];
$login=htmlspecialchars(strip_tags(trim($_POST['login'])));
$pass=htmlspecialchars(strip_tags(trim($_POST['pass'])));
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
$_SESSION['authmsg']="Вы уже авторизованы. Чтобы выйти, воспользуйтесь меню";
}

$STH = $DBH->query("SELECT id FROM users WHERE nick='".htmlspecialchars($login)."' AND pass='".$pass."'");
$ko = $STH->rowCount();

if($ko==0){
$STH = $DBH->query("SELECT id FROM users WHERE nick='".htmlspecialchars($login)."'");
$ko3 = $STH->rowCount();

if($ko3==1){
$_SESSION['authmsg']='<div align=center><font class=2><img src="data/images/auth_bad.png"><br><br>К данному персонажу не подходит введённый Вами пароль</div><br><br><a href="index.php"><img border="0" src="data/images/ok.png" onmouseover="this.src=\'data/images/_ok.png\'" onmouseout="this.src=\'data/images/ok.png\'"></a>';
$resu=0;
$_SESSION['scroll']="yes";
}else{
$_SESSION['authmsg']='<img src="data/images/auth_bad.png"><br><br><font color=red>Такого пользователя в базе не найдено</font>
<br><br><a href="index.php"><img border="0" src="data/images/ok.png" width="59" height="21" onmouseover="this.src=\'data/images/_ok.png\'" onmouseout="this.src=\'data/images/ok.png\'"></a></p>';
$resu=0;
$_SESSION['scroll']="yes";
}}
else{
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

$hash = md5(generateCode(10));
$_SESSION['user_hash']=$hash;
try{$STH = $DBH->prepare("UPDATE users set ip='".$ip."',hash='".$hash."' WHERE nick='".$login."'");
$STH->execute($data);}catch(PDOException $e){}

?>
<script language="javascript" type="text/javascript">
document.location.href = "set_cookies.php";
</script>
<?php
}else{$_SESSION['authmsg']='<img src="data/images/auth_bad.png"><br><br><font color=red>С данного IP-адреса уже есть авторизованный пользователь. Выйдите из активного профиля</font><br><br><a href="index.php"><img border="0" src="data/images/ok.png" width="59" height="21" onmouseover="this.src=\'data/images/_ok.png\'" onmouseout="this.src=\'data/images/ok.png\'"></a></p>';}

}
try{$data = array($login,date("Y-m-j H:i:s"),$resu);
$STH = $DBH->prepare("INSERT INTO authorizations (login,datetime,good) values (?,?,?)");
$STH->execute($data);}catch(PDOException $e){}
}else{$_SESSION['authmsg']='Максимальная длина логина не должна превышать 20 символов. У Вас - '.mb_strlen($login).'<br><br><a href="index.php"><img border="0" src="data/images/ok.png" onmouseover="this.src=\'data/images/_ok.png\'" onmouseout="this.src=\'data/images/ok.png\'"></a>';}
}else{$_SESSION['authmsg']='<font color=red>Введены не все данные</font><br><br><a href="index.php"><img border="0" src="data/images/ok.png" onmouseover="this.src=\'data/images/_ok.png\'" onmouseout="this.src=\'data/images/ok.png\'"></a>';}


echo'<script language="javascript" type="text/javascript">document.location.href = "index.php";</script>';

?>