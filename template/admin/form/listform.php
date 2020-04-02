<div class="tags">

  <div id="tagscontent">
    <div id="con_one_1">
    
    <div class="table_td" style="margin-top:10px;">


表单链接调用格式：<font color="#FF0000"><strong>{</strong>myform("my_表单名称")<strong>}</strong></font>
<div class="blank30"></div>

<style>td {padding-left:10px;}a.j{padding:0px 8px;}</style>
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
<thead>
        <tr>
          <th>名称(记录数)</th>
          <th>表名</th>
          <th>操作</th>
        </tr>
</thead>
<tbody>
{loop $tables $t}
<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td>{=@setting::$var[$t]['myform']['cname']}
    (<a href="{url('table/list/table/'.$t)}" class="j"><font color="red"><?php  $_table=new defind($t); echo $_table->rec_count();?></font></a>)
</td>
<td>{$t}</td>
<td align="center"> <a  href="{url('form/add/form/'.$t,false)}" target="_blank" class="button">预览</a> &nbsp;
 <a  href="<?php echo modify("/act/editform/table/$t");?>" class="button">修改</a> &nbsp;
<a href="<?php echo url::create('field/list/table/'.$t)?>" class="button">管理字段</a> &nbsp;
<a href="<?php echo url::create('field/add/table/'.$t)?>" class="button">添加字段</a>
<a  onclick="javascript: return confirm('删除表单会删除表单中所有的记录！确认删除吗?');" href="<?php echo modify("/act/delete/table/$t");?>" class="button">删除表单</a>
</td>
</tr>
{/loop}

      </tbody>
    </table>
    
   </div>
   </div>
   </div>
   </div>
