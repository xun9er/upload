<div class="tags">
  
  <div id="tagscontent">
    <div id="con_one_1">
    
    <div class="table_td" style="margin-top:10px;">
<a href="<?php echo modify("/act/add/table/".$table);?>" class="button">添加字段</a>   <a href="<?php echo modify("/act/list/table/".$table);?>" class="button">查看列表</a>
<div class="blank10"></div><div class="blank10"></div>
<table border="0" cellspacing="1" cellpadding="4" class="list" name="table" id="table" width="100%">


      <thead>
        <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
          <th>字段名名</th>
          <th>类型</th>
          <th>长度</th>
          <th>字段中文名</th>
          <th>操作</th>
        </tr>
</thead>
 <tbody>
{loop $fields $f}
<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">

<td align="center">{$f.name}</td>
<td align="center"><?php
$tmp = setting::$var['archive'][$f['name']];
if($tmp['type'] == 'varchar'){ 
	$s = '单行文本';
}
if($tmp['type'] == 'text'){ 
	$s = '多行文本';
}
if($tmp['type'] == 'mediumtext'){ 
	$s = '超文本';
}
if($tmp['type'] == 'int'){ 
	$s = '整型';
}
if($tmp['type'] == 'datetime'){ 
	$s = '日期型';
}
if($tmp['selecttype'] == 'radio'){
	$s = '单选';
}
if($tmp['selecttype'] == 'checkbox'){
	$s = '多选';
}
if($tmp['selecttype'] == 'select'){
	$s = '下拉选择';
}
if($tmp['filetype'] == 'image'){
	$s = '图片';
}
if($tmp['filetype'] == 'file'){
	$s = '附件';
}
echo $s;
?></td>
<td align="center">{$f.len}</td>
<td align="left" style="padding-left:10px;"><?php echo @setting::$var[$table][$f['name']]['cname'];?></td>

<td align="center"><a href="<?php echo modify("/act/edit/table/$table/name/".$f['name']);?>">编辑</a> <a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/name/".$f['name']);?>">删除</a></td>
</tr>
{/loop}

      </tbody>
    </table>
    
<div class="blank10"></div><div class="blank10"></div>
</div>
</div>
</div>
<div class="blank10"></div>
</div>