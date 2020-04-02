<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
 
  <div class="table_td" style="margin-top:10px;">

<form name="listform" id="listform"  action="?case=table&act=send&table=user&admin_dir={get('admin_dir')}&getSelect(this.form)" method="post">

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
<thead>
        <tr>
           <th><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
          <th align="center"><!--userid-->编号</th>
          <th align="center"><!--username-->用户名</th>
          <th align="center"><!--nickname-->昵称</th>
          <th align="center"><!--groupid-->用户组</th>
          <th align="center">操作</th>
        </tr>
</thead>
<tbody>

{loop $data $d}
<tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)">

<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

<td align="left" style="padding-left:10px;">{cut($d['userid'])}</td>
<td align="left" style="padding-left:10px;">{cut($d['username'])}</td>
<td align="left" style="padding-left:10px;">{cut($d['nickname'])}</td>
<td align="left" style="padding-left:10px;">{usergroupname($d['groupid'])}</td>

<td align="center">
<a href="<?php echo modify("st/1/act/send/table/$table/id/$d[$primary_key]");?>">发送邮件</a> 
</td>
</tr>
{/loop}


      </tbody>
    </table>


<div class="blank20"></div>

    <input type="hidden" name="batch" value="" />
<input  class="button" type="button" value=" 群发邮件(下一步) " name="sendall" onclick="if(getSelect(this.form) && confirm('确实要给ID为('+getSelect(this.form)+')的记录发送邮件吗?')){this.form.action='?case=table&act=send&table=user&admin_dir={get('admin_dir')}&st=1&id='+getSelect(this.form); this.form.submit();}"/> 




</form>


<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>

</div>
</div>
</div>
</div>