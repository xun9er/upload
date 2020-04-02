<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
 <div class="table_td" style="margin-top:10px;">  
 
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table">
      <thead>
        <tr>          
          <th><!--name-->支付方式</th>
          <th><!--rate-->支付费率</th>
          <th><!--ver-->插件版本</th>
          <th>操作</th>
        </tr>

</thead>
<tbody>
{loop $data $d}

<tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)">


<td width="70%" style="padding-left:10px;"><strong>{$d['name']}</strong><br /><img src="{$skin_path}/cuo.gif" alt="" width="14" height="14" style="margin-left:10px; margin-right:5px;" /> <span class="tips">{$d['desc']}</span></td>
<td align="center">{cut($d['pay_fee'])}%</td>
<td align="center">{cut($d['version'])}</td>

<td align="center">
<?php if ($d['install']==0){?>
<a href="<?php echo modify("act/install/table/$table/name/".$d['pay_code']);?>">安装</a>
<?php }else{?>
<a href="<?php echo modify("act/edit/table/$table/id/".$d['id']);?>">配置</a> 
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/".$d['id']);?>">删除</a>
<?php } ?>
</td>
</tr>
{/loop}


      </tbody>
    </table>


<div class="blank30"></div>



</form>

</div>
</div>
</div>
</div>

