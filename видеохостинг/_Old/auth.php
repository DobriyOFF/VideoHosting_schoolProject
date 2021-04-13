<?php 
header("Content-type: text/html; charset=utf-8");
echo'<br>';
if(@$_SESSION['user_id']<>""){
?>
<div align="center"><font face="Arial Black" size=3 color=blue><?php echo @$_SESSION['user'];?></font><br><img src="<?php echo $f;?>"><br><?php
echo'<a href="del_cookie.php"><b><img border=0 src="data/design/profile_exit.png" onmouseover="this.src=\'data/design/profile_exit_.png\'" onmouseout="this.src=\'data/design/profile_exit.png\'"></b></a>';?>
<br><br></div>


<?php
}else{
	
echo'
Логин: <input type="text" id="login" name="login" style="width: 145px; height: 25px; background-color: #E0E0E0"> &nbsp; Пароль: 
<input type="password" id="pass" name="pass" style="width: 145px; height: 25px; background-color: #E0E0E0" onkeyup="">

<a href="javascript:auth(encodeURIComponent(document.getElementById(\'login\').value),encodeURIComponent(document.getElementById(\'pass\').value));">Вход</a>
 &nbsp;&nbsp;&nbsp; <a href="javascript:reg();">Регистрация</a>
';
echo'</font><br><br><hr><br>';
}
?>