<?php
$k1='';$k2='';$k3='';$k4='';$k5='';$k6='';
if(@$_GET['r']=="" OR @$_GET['r']=="undefined"){$k1='<span class="arrow">&nbsp;</span>';}
if(@$_GET['r']=="streams"){$k2='<span class="arrow">&nbsp;</span>';}
echo'<br>';

?>				
<div id="navigation">
	<ul>
		<li><a href="http://ruxer.ru/forum"><span></span></a><span class="arrow">&nbsp;</span></li>
		<li><a href="http://ruxer.ru/forum"><span></span></a><span class="arrow">&nbsp;</span></li>
		<li class="first active"><a href="javascript:main('','','','');"><span>Главная</span></a></li>
		<li><a href="javascript:main('','','','streams');"><span>Стримы</span></a></li>
		<li><a href="javascript:main('','','','games');"><span>Игры</span></a><span class="arrow2">&nbsp;</span></li>
		<li><a href="http://ruxer.ru/forum"><span>Форум</span></a><span class="arrow">&nbsp;</span></li>
		<!--<li><a href="javascript:main('','','','peredach');"><span>Передачи</span></a><span class="arrow31">&nbsp;</span></li>
		<li><a href="javascript:main('','','','humour');"><span>Юмор</span></a><span class="arrow3">&nbsp;</span></li>
		<li><a href="javascript:main('','','','bloggers');"><span>Блоггеры</span></a><span class="arrow3">&nbsp;</span></li> -->
		<li class="last"><a href="javascript:add();"><span>Добавить</span></a><span class="arrow">&nbsp;</span></li>
	</ul>
</div>

