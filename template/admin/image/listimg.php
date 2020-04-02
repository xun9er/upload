<div class="tags">

  <div id="tagscontent">
    <div id="con_one_1">
    
    <div class="table_td" style="margin-top:10px;">

<div class="blank30"></div>

<style>td {padding-left:10px;}a.j{padding:0px 8px;}</style>
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%" style="text-align:center">
<thead>
    <tr>
      
    </tr>
</thead>
<tbody>

<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff" >
<?php $i=0;?>
{loop $img_arr $t}
<td align="center" style="padding-bottom:15px;"> 
   <img src="upload/images/{front::get('dir')}/{$t}" width="140" height="120"/>
   <div>
      <a  href="upload/images/{front::get('dir')}/{$t}"   class="button" target="_blank">查看原图</a> &nbsp;
	  <a  href="{url('image/deleteimg/dir/'.front::get('dir').'/imgname/'.str_replace('.','___',$t))}"   class="button">删除图片</a> &nbsp;
   </div>
</td>
{if ++$i%4==0}
   </tr>
   <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
{/if}
{/loop}
</tr>


      </tbody>
    </table>
    
   </div>
   </div>
   </div>
   </div>