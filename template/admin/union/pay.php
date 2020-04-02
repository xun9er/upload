<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
 
  <div class="table_td" style="margin-top:10px;">
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
      <thead>
        <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
          <th align="center">联盟用户</th>
          <th align="center">结算日期</th>
          <th align="center">结算金额</th>
          <th align="center">支付账号</th>
          <th align="center">操作人员</th>
        </tr>

</thead>


<tbody>
{loop $data $d}
<tr class="s_out" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">

<td>{$d['username']}</td>
<td>{date('Y-m-d H:i:s',$d['addtime'])}</td>
<td>{$d['amount']} 元</td>
<td><font color="red">{$d['payaccount']}</font></td>
<td>{$d['inputer']}</td>

</tr>
{/loop}


      </tbody>
    </table>


<div class="blank30"></div>

    <input type="hidden" name="batch" value="">
<input  class="button" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>

</form>


<div class="page"><?php echo pagination::html($record_count); ?></div>


</div>
</div>
</div>
</div>