<?php session_start();
header("Content-type: text/html; charset=utf-8");

echo'<div align=center>
<form>
Логин: <input type="text" id="login" name="login" style="width: 225px; height: 25px; background-color: #E0E0E0"">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Пароль: <input type="password" id="pass" name="pass" style="width: 205px; height: 25px; background-color: #E0E0E0"">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Почта (E-Mail): <input type="text" id="email" name="email" style="width: 225px; height: 25px; background-color: #E0E0E0"">
<br><br><a href="javascript:register(encodeURIComponent(document.getElementById(\'login\').value),encodeURIComponent(document.getElementById(\'pass\').value),document.getElementById(\'email\').value);">Регистрация</a>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php">Отмена</a>

</form>
</div>
';