<div class="tags">

  <div id="tagscontent">
    <div id="con_one_1">
    
    <div class="table_td" style="margin-top:10px;">

<div class="blank30"></div>

<style>td {padding-left:10px;}a.j{padding:0px 8px;}</style>
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%" style="text-align:center">
<thead>
    <tr>
        <th>日期</th>
        <th>操作</th>
    </tr>
</thead>
<tbody>
{loop $dir_arr $t}
<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td>{$t}</td>
<td align="center"> 
   <a  href="{url('image/listimg/dir/'.$t)}"   class="button">查看内容</a> &nbsp;
</td>
</tr>
{/loop}

      </tbody>
    </table>
    
   </div>
   </div>
   </div>
   </div>