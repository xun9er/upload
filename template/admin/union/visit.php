<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
 
  <div class="table_td" style="margin-top:10px;">

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
      <thead>
        <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
          <th align="center">来源地址</th>
          <th align="center">访问IP</th>
          <th align="center">访问时间</th>
          <th align="center">注册用户</th>
          <th align="center">注册时间</th>
        </tr>

</thead>


<tbody>
{loop $data $d}
<tr class="s_out" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">

<td>{if $d['referer']}{$d['referer']}{else}地址栏直接进入{/if}</td>
<td>{$d['visitip']}</td>
<td>{date('Y-m-d H:i:s',$d['visittime'])}</td>
<td>{$d['regusername']}</td>
<td>{if $d['regtime']}{date('Y-m-d H:i:s',$d['regtime'])}{/if}</td>

</tr>
{/loop}


      </tbody>
    </table>


<div class="blank30"></div>


<div class="page"><?php echo pagination::html($record_count); ?></div>


</div>
</div>
</div>
</div>