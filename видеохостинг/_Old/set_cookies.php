<?php session_start();
setcookie("cparam", $_SESSION['user_id'], time()+60*60*24*30);
setcookie("chash", $_SESSION['user_hash'], time()+60*60*24*30);?>
<script language="javascript" type="text/javascript">document.location.href = "index.php";</script>