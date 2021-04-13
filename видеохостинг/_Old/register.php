<?php session_start();
header("Content-type: text/html; charset=utf-8");
include("config.php");
@$login=htmlspecialchars(strip_tags(trim($_GET['p1'])));
@$password=htmlspecialchars(strip_tags(trim($_GET['p2'])));
@$email=htmlspecialchars(strip_tags(trim($_GET['p3'])));
$notr=0;
$knopka2='<br><div align=center><a style="cursor: pointer;" onclick="top.document.getElementById(\'parent_popup\').style.display=\'none\';">OK</a></div>';

function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = mb_strlen($chars) - 1;  
    while (mb_strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];  
    }
    return $code;
}

if($login<>"" AND $password<>""){

$login=str_replace("/","",$login);
$login=str_replace(":","",$login);
$login=str_replace("<","",$login);
$login=str_replace(">","",$login);
$login=str_replace("!","",$login);
$login=str_replace("*","",$login);

$login=mb_substr($login,0,20);

$password=str_replace("/","",$password);
$password=str_replace(":","",$password);
$password=str_replace("<","",$password);
$password=str_replace(">","",$password);
$password=str_replace("!","",$password);
$password=mb_substr($password,0,20);

$oke=0;
$oke2=0;
$yescan=0;

$eng=0;
$rus=0;
if(preg_match('/[a-zA-Z]/u',$login)){$eng=0;}else{$eng=1;}
if(preg_match('/[а-яА-Я]/u',$login)){$rus=0;}else{$rus=1;}

if($rus==1 AND $eng==0){$yescan=1;}
if($rus==0 AND $eng==1){$yescan=1;}

if(preg_match( '/[^а-яА-Яa-zA-Z0-9_ -]/u', $login)){$prov3=0;}else{$prov3=1;}
$yescan=$yescan*$prov3;

if($yescan==1){
if(mb_strlen($login)<21 AND mb_strlen($login)>2 AND mb_strlen($password)<21 AND mb_strlen($password)>2){


if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]-_/",$login)) {
echo'<br><br><div align=center>Недопустимые символы в логине<br><br>'.$knopka2;
}else{

$STH = $DBH->query("SELECT id FROM users WHERE nick='".$login."'");
$ukolv = $STH->rowCount();
  if($ukolv >= 1) {
 echo'<br><br><div align=center>Пользователь с таким ником уже есть в нашей базе<br><br>'.$knopka2;
  }
else
{
$ip=$_SERVER['REMOTE_ADDR'];

$STH = $DBH->query("SELECT id FROM users WHERE nick='".$login."'");
$ukolv = $STH->rowCount();
if($ukolv==0){$m=60;
	$STH = $DBH->query("SELECT id FROM registrations WHERE datetime>subdate(NOW(), INTERVAL ".$m." MINUTE) AND ip='".$ip."'");
	$u = $STH->rowCount();

if($u==0){
$lev="0.0";$en=100;$ab=10;
$referrer=0;
if(@$_SESSION['referrer']<>""){$referrer=@$_SESSION['referrer'];@$_SESSION['referrer']='';}

if($email==""){$email=' ';}


try{$data = array($login,date("Y-m-j H:i:s"),$password,$email,$referrer);
$STH = $DBH->prepare("INSERT INTO users (nick,dateregister,pass,email,referrer) values (?,?,?,?,?)");
$STH->execute($data);}catch(PDOException $e){}



$wi=90;$he=120;$ty='user';$gx=4920;$gy=4920;
$ix=mt_rand(-4,4)*120;
$iy=mt_rand(-4,4)*120;
$gx=$gx+$ix;
$gy=$gy+$iy;
try{$STH = $DBH->query("SELECT id FROM users WHERE nick='".trim($login)."'");
$STH->setFetchMode(PDO::FETCH_ASSOC);$row = $STH->fetch();
$wkid=$row['id'];
}catch(PDOException $e){}
	try{$data = array(date("Y-m-j H:i:s"),$ip);
	$STH = $DBH->prepare("INSERT INTO registrations (datetime,ip) values (?,?)");
	$STH->execute($data);}catch(PDOException $e){}

}else{$notr=1;echo'<div align=center><br><font face=Arial size=3>С данного IP уже была регистрация менее чем час назад.<br>Попробуйте зарегистрироваться позже</font></div><br>'.$knopka;}
}

try{$STH = $DBH->query("SELECT id FROM users WHERE nick='".trim($login)."'");
$STH->setFetchMode(PDO::FETCH_ASSOC);$row = $STH->fetch();
$kid=$row['id'];
}catch(PDOException $e){}


$knopka='<form method="POST" action="auth_go_auto.php">
<input type="hidden" name="login" size="20" value="'.$login.'">
<input type="hidden" name="pass" size="20" value="'.$password.'">
<br><input src="data/design/enter.png" type="image" onclick="top.document.getElementById(\'parent_popup\').style.display=\'none\';top.main();"></form>';
if(@$notr==0){
echo"<br><br><div align=center><font size=4 face=Arial>Приветствуем, ".$login."!<br><br>Искренне надеемся, что Вам у нас понравится!<br><br></font>".$knopka."</div>";
}else{echo'<br><div align=center><a style="cursor: pointer;" onclick="top.document.getElementById(\'parent_popup\').style.display=\'none\';"><img border="0" src="data/design/ok.png" width="59" height="21" onmouseover="this.src=\'data/design/_ok.png\'" onmouseout="this.src=\'data/design/ok.png\'"></a></div>';}
if($email<>"" AND $email<>" "){
function send_mime_mail($name_from, /* имя отправителя*/
                        $email_from, /* email отправителя*/
                        $name_to, /* имя получателя*/
                        $email_to, /* email получателя*/
                        $data_charset, /* кодировка переданных данных*/
                        $send_charset, /* кодировка письма*/
                        $subject, /* тема письма*/
                        $body, /* текст письма*/
                        $html = TRUE /* письмо в виде html или обычного текста*/
                        ) {
  $to = mime_header_encode($name_to, $data_charset, $send_charset)
                 . ' <' . $email_to . '>';
  $subject = mime_header_encode($subject, $data_charset, $send_charset);
  $from =  mime_header_encode($name_from, $data_charset, $send_charset)
                     .' <' . $email_from . '>';
  if($data_charset != $send_charset) {
    $body = iconv($data_charset, $send_charset, $body);
  }
  $headers = "From: $from\r\n";
  $type = ($html) ? 'html' : 'plain';
  $headers .= "Content-type: text/$type; charset=$send_charset\r\n";
  $headers .= "Mime-Version: 1.0\r\n";
 
  return mail($to, $subject, $body, $headers);
}
 }
 
function mime_header_encode($str, $data_charset, $send_charset) {
  if($data_charset != $send_charset) {
    $str = iconv($data_charset, $send_charset, $str);
  }
  return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}
 
if($email<>""){
$tee="Здравствуйте, <font color=blue><b>".$login."</b></font><br>Ваш пароль: <font color=blue><b>".$password."</b></font><br><br>это письмо регистрации на сайте <a href='http://ruxer.ru'>Ruxer.ru</a><br><br>Если Вы не регистрировались, то просто проигнорируйте это письмо.<br><br>Благодарим за регистрацию в нашем проекте и надеемся, что Вам у нас понравится!<br><br><i>Администратор Ruxer.ru</i>";
send_mime_mail('Администрация сайта Ruxer.ru','admin@ruxer.ru',$login,$email,'UTF-8','UTF-8','Ruxer.ru Видеонавигатор: Регистрация',$tee);
}
}
}
}else{
echo'<br><br><div align=center>В логине и пароле разрешены отдельно только русские или английские буквы и цифры. Длина логина должна быть от 3 до 20 символов<br><br>'.$knopka2;
}
}else{
echo'<br><br><div align=center>В логине и пароле разрешены отдельно только русские или английские буквы и цифры. Длина логина должна быть от 3 до 20 символов<br><br>'.$knopka2;
}
}else{echo'<br><br><div align=center>Введены не все данные для регистрации<br><br>'.$knopka2;}
?>

