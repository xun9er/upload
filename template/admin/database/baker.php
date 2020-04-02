<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
 <div class="table_td" style="margin-top:10px;"> 

<strong>欢迎来到数据库备份页面。您可以对网站数据备份，数据将保存在data文件夹中。</strong>


<div class="blank10"></div>
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
      <thead>
        <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
           <th style="width:60px;"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /></th>
          <th>表名</th>
           <th>记录数</th>
           <th>大小</th>
        </tr>
</thead>
<tbody>
        {loop tdatabase::getInstance()->getTables() $table}
      <tr class="s_out" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
           <td style="width:60px;" align="center"><input onclick="c_chang(this)" type="checkbox" value="{$table.name}" name="select[]" class="checkbox" /></td>
          <td align="left" style="padding-left:10px;">{$table.name}</td>
          <td align="left" style="padding-left:10px;">{$table.count}</td>
          <td align="left" style="padding-left:10px;">{=ceil($table['size']/1024)}K</td>
        </tr>
       {/loop}

      </tbody>
    </table>


<div class="blank10"></div>
    <?php /*兼容MySQL4<input type="checkbox" name="mysql4" value="1"> */ ?>
    &nbsp;{form::select('bagsize',0,array(0=>'请选择分卷大小...',1=>'1M',2=>'2M',5=>'5M',10=>'10M'))}
    <input type="submit" name="submit" value=" 备份 " class="button" />



</form>


</div>
</div>
</div>
</div>