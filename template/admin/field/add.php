<?php $this->render('field/edit.php'); return; /*?>

<div class="blank10"></div>


<a href="<?php echo modify("/act/add/table/".$table);?>" class="button">添加字段</a>   <a href="<?php echo modify("/act/list/table/".$table);?>" class="button">查看列表</a>
<div class="blank10"></div><div class="blank10"></div>

<form name="fieldform" method="post" action="<?php echo modify("case/field/act/".front::$act."/table/".$table);?>">
<table border="0" cellspacing="1" cellpadding="4" class="list" name="table" id="table" width="100%">

<tbody>

<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td>名称</td>
	<td><input size="20" name="name" value="my_" class="input"/></td>
</tr>

<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td>类型</td>
	<td><select name="type">
	<option value="int">整数</option>
	<option value="varchar">单行文本</option>
	<option value="text" onclick="document.fieldform.len.hidden='hidden'">多行文本</option>
	<option value="mediumtext">超文本</option>
	
	<option value="datetime">日期</option>
	<option value="radio">[单选]</option>
	<option value="checkbox">[多选]</option>
	
	</select></td>
</tr>

<tr  id="len" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td>长度</td>
	<td><input size="10" name="len" value="" class="input"/></td>
</tr>


<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td>字段中文名</td>
	<td><input size="20" name="cname" value="" class="input"/></td>
</tr>

<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td>单选/多选  选项</td>
	<td>{form::textarea('select','',' rows="6" cols="40" ')}</td>
</tr>


</tbody></table>
<div class="blank10"></div>
<input type="submit" name="submit" value=" 提交 " class="button" />

</form>

*/ ?>