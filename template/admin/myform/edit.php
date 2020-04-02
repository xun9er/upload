<div class="tags">

<div id="tagscontent">
	<div id="con_one_1">

<div class="blank10"></div>

<script language="javascript" src="{$base_url}/common/js/common.js"></script>

<?php helper::filterField($field,$fieldlimit); ?>

<style type="text/css">
table td .left {width:10%;}
</style>

<form method="post" name="form1" action="">

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table">
<tbody>

{loop $field $f}
<?php
$name=$f['name'];
if(!isset($data[$name])) $data[$name]='';
if($name==$primary_key) continue; ?>
 
<tr>
	<td class="left">{$name|lang}</td>
	<td>
{form::getform($name,$form,$field,$data)}
</td>
</tr>
 
{/loop}




</tbody></table>

<div class="blank10"></div>
<input type="submit" name="submit" value=" 提交 " class="button" />

</form>

</div>
</div>
</div>
