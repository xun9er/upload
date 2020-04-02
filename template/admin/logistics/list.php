<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
 <div class="table_td" style="margin-top:10px;">  


<input class="button" type="button" value=" 增加配货方式 " name="add" onclick="javascript:window.location.href='<?php echo modify("act/add/table/$table");?>'"/> 


<div class="blank10"></div>
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
      <thead>
        <tr>          
          <th align="left"><!--name-->配货方式</th>
          <th align="left"><!--rate-->配货费用</th>
          <th align="left"><!--ver-->货到付款</th>
          <th align="left">是否保价</th>
          <th align="left">操作</th>
        </tr>

</thead>
<tbody>
{loop $data $d}

<tr class="s_out" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">


<td width="left" style="padding-left:10px;"><strong>{$d['title']}</strong><br /><font color="#666666">{$d['content']}</font></td>
<td align="center">{$d['price']}</td>
<td align="center">{if $d['cashondelivery'] == 0}否{else}是{/if}</td>
<td align="center">{if $d['insure'] == 0}否{else}是{/if}</td>

<td align="center">
<a href="<?php echo modify("act/edit/table/$table/id/".$d['id']);?>">配置</a> 
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/".$d['id']);?>">删除</a>
</td>
</tr>
{/loop}


      </tbody>
    </table>


<div class="blank30"></div>

    <input type="hidden" name="batch" value="">
<input  class="button" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>

</form>

</div>
</div>
</div>
</div>

