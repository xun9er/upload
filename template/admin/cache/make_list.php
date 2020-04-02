<div class="tags">

<div id="tagscontent">
	<div id="con_one_1">

<form name="typeform" method="post" action="<?php echo front::$uri;?>">
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
<tbody>
<tr>
	<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">栏目</span></td>
	<td width="1%">&nbsp;</td>
                        <td width="80%"><?php
	$archive=archive::getInstance();
	echo form::select('catid',get('catid'),category::option());
	?>
	&nbsp;&nbsp;
	<?php echo form::submit('更新');
	?>
    </td></tr></tbody>
</table>
</form>
</div>
</div>
</div>
