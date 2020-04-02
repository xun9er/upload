<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
 
  <div class="table_td" style="margin-top:10px;">

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
      <thead>
        <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
          <th align="center">用户名</th>
          <th align="center">email</th>
          <th align="center">注册IP</th>
          <th align="center">联盟ID</th>
        </tr>

</thead>


<tbody>
{loop $data $d}
<tr class="s_out" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">

<td>{$d['username']}</td>
<td>{$d['e_mail']}</td>
<td>{$d['userip']}</td>
<td>{$d['introducer']}[{$d['introducerusername']}]</td>

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