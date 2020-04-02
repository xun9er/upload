<div class="tags">

  <div id="tagscontent">
    <div id="con_one_1">
    
    <div class="table_td" style="margin-top:10px;">

<div class="blank30"></div>

<style>td {padding-left:10px;}a.j{padding:0px 8px;}</style>
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%" style="text-align:center">
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
<td align="center"> 
   <a  href="{url('table/list/table/'.$t)}"   class="button">查看内容</a> &nbsp;
   <a  href="{url('form/add/form/'.$t,false)}" class="button" target="_blank">添加内容</a> &nbsp;
</td>
</tr>
{/loop}

      </tbody>
    </table>
    
   </div>
   </div>
   </div>
   </div>
