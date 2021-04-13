<?php
$k1='';$k2='';$k3='';$k4='';$k5='';$k6='';
if(@$_GET['r']=="" OR @$_GET['r']=="undefined"){$k1='<span class="arrow">&nbsp;</span>';}
if(@$_GET['r']=="streams"){$k2='<span class="arrow">&nbsp;</span>';}
echo'<br>';

?>				
<div id="navigation">
	<ul>
		<li class="first active"><a href="javascript:main('','','','');"><span>Главная</span></a></li>
		<li><a href="javascript:main('','','','yrokam');"><span>К урокам</span></a></li>
		<li><a href="javascript:main('','','','nauka');"><span>Наука</span></a><span class="arrow31">&nbsp;</span></li>
		<li><a href="javascript:main('','','','video');"><span>Видео Уроки</span></a><span class="arrow2">&nbsp;</span></li>
		<li class="last"><a
	<li><a href="javascript:main('','','','interes');"><span>Интересное</span></a><span class="arrow2">&nbsp;</span></li> href="javascript:add();"><span>Добавить</span></a><span class="arrow">&nbsp;</span></li>
	</ul>
</div>

