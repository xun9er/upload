<div class="tags">
 <div id="tagstitle">
   <ul>
   <li id="one1" onclick="setTab('one',1,6)" class="hover">编辑表单</li>
   </ul>
  </div> 
 <div id="tagscontent"> 
<div id="con_one_1">
<form method="post" action="" name="form1" id="form1" onsubmit="checkform1()">
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table">
<thead>
<tr>
<th colspan="2" >

</th>
</tr>
</thead>
<tbody>

<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">表单名称</td>
	<td><input size="20" name="cname" id="cname" value="{=@setting::$var[$table]['myform']['cname']?setting::$var[$table]['myform']['cname']:get('cname')}" /></td>
</tr>


<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">表名</td>
	<td>
	<b>{$table}</b>
    <input type="hidden"  name="name" id="name" value="{$table}" />
	</td>
</tr>


<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">模板</td>
	<td>
            {form::select('template',@setting::$var[$table]['myform']['template']?setting::$var[$table]['myform']['template']:get('template'),front::$view->myform_tpl_list())}
        </td>
</tr>


</tbody>
</table>

<div class="blank10"></div>
<input type="submit" name="submit" value=" 提交 " class="button" />

</form>

</div>
</div>
</div>