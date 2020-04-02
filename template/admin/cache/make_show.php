<div class="tags">

<div id="tagscontent">
	<div id="con_one_1">
<form name="aidform" method="post" action="<?php echo front::$uri;?>">
<table border="0" cellspacing="1" cellpadding="4" class="list" name="table" id="table">
<tbody>
<tr>
	<td class="left">按ID:</td>
	<td><?php
	$archive=new archive();
	$aid=$archive->rec_query_one("select min(aid) as min,max(aid) as max from ".$archive->name);
	echo " 从 ".form::input('aid_start',max($aid['max']-100,1));
	echo " 到 ".form::input('aid_end',$aid['max']);
	?>
	&nbsp;&nbsp;
	<?php echo form::submit('更新');
	?>
	&nbsp;&nbsp;(ID范围: {$aid['min']}~{$aid['max']} )
    </td></tr></tbody>

</form>&nbsp;

<form name="aidform2" method="post" action="<?php echo front::$uri;?>">

<tbody>
<tr>
	<td class="left">按栏目:</td>
	<td><?php
	$archive=archive::getInstance();
	echo form::select('catid',get('catid'),category::option());
	?>
	&nbsp;&nbsp;
	<?php echo form::submit('更新');
	?>
    </td></tr></tbody>
</table>
</form>&nbsp;
</div>
</div>
</div>