<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
 <div class="table_td" style="margin-top:10px;"> 
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

<table border="0" cellspacing="1" cellpadding="4" class="list" name="table" id="table" width="100%">
      <thead>
        <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
           <th><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /></th>
          <th>档案</th>
          <th>操作</th>
        </tr>
		</thead>
<tbody>
        {loop $db_dirs $dir}
      <tr class="s_out" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
           <td align="center"><input onclick="c_chang(this)" type="checkbox" value="{$dir}" name="select[]" class="checkbox" /> </td>
          <td align="left" style="padding-left:10px;">{$dir}</td>
           <td align="center">
            <input type="button" onclick="javascript:if(confirm('确实要 【恢复】 备份档案 ( {$dir} ) 吗?' )) location.href='<?php echo url('database/dorestore/db_dir/'.$dir);?>';"  class="button" value=" 还原 " />
           </td>
        </tr>
       {/loop}

      </tbody>
    </table>


    <div class="blank10"></div>
    <input type="submit" name="submit" value=" × 删除 " onclick="return getSelect(this.form) && confirm('确实要 【删除】 备份档案 ( '+getSelect(this.form)+' ) 吗?');" class="button" />
 


</form>

</div>
</div>
</div>
</div>