<div class="tags">

 <div id="tagscontent"> 

<form method="post" action="" name="form1" id="form1" onsubmit="checkform1()">

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table">

<tbody>
<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">表单名称</td>
	<td><input size="20" name="cname" id="cname" value="{get('cname')}" /></td>
</tr>


<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">表名</td>
	<td>
	<input size="20" name="name" id="name" value="{=get('name')?get('name'):'my_'}"  />
	</td>
</tr>


<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">模板</td>
	<td>
            {form::select('template','',front::$view->myform_tpl_list())}
        </td>
</tr>


</tbody>
</table>

<div class="blank10"></div>
<input type="submit" name="submit" value=" 提交 " class="button" />

</form>

</div>
</div>