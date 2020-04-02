<div class="tags">

  <div id="tagscontent">
    <div id="con_one_1">
    
    <div class="table_td" style="margin-top:10px;">
    
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
<thead>
        <tr>
           <th width="60px"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
          <th align="center"><!--userid-->编号</th>
          <th align="center"><!--username-->用户名</th>
          <th align="center"><!--nickname-->昵称</th>
          <th align="center"><!--groupid-->用户组</th>
          <th align="center">操作</th>
        </tr>
</thead>
<tbody>

{loop $data $d}
<tr class="s_out" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">

<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

<td align="center">{cut($d['userid'])}</td>
<td align="left" style="padding-left:10px;">{cut($d['username'])}</td>
<td align="left" style="padding-left:10px;">{cut($d['nickname'])}</td>
<td align="left" style="padding-left:10px;">{usergroupname($d['groupid'])}</td>

<td align="center">
<a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>">编辑</a> 
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]");?>">删除</a>
</td>
</tr>
{/loop}


      </tbody>
    </table>


<div class="blank20"></div>

    <input type="hidden" name="batch" value="" />
<input  class="button" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>




</form>


<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>
<div class="blank20"></div>

</div>
</div>
</div>
</div>