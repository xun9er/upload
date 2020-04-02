<div class="tags">

  <div id="tagscontent">
    <div id="con_one_1">
    
    <div class="table_td" style="margin-top:10px;">

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

    <input class="button" type="button" value=" 添加栏目 " onclick="javascript:window.location.href='index.php?case=table&act=add&table=category&admin_dir={get('admin_dir')}'" />
    <div class="blank10"></div>
    <table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
        <tbody id="listtable">
            <tr>
                <th><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
                <th>排序</th>
                <th><!--catid-->ID</th>
                <th><!--catname-->栏目名称</th>
                <th><!--htmldir-->目录名称</th>
                <th><!--isnav-->导航</th>
                <th>操作</th>
            </tr>

            {loop $data $d}

            <tr class="s_out" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d[$primary_key]}" name="select[]"> </td>
                <td align="center" >{form::input("listorder[$d[$primary_key]]",$d['listorder'],'size=3')}</td>
                <td align="center" >
                    {$d['catid']}            </td>
                <td align="left" style="padding-left:10px;"><a title="点击编辑栏目设置"  href="<?php echo modify("/act/edit/table/$table/id/$d[$primary_key]");?>">{$d['catname']}</a></a>
                </td>

                <td align="center" >
                    <a href="<?php echo url("archive/list/catid/$d[$primary_key]",false);?>" title="点击查看前台页面效果" target="_blank">{$d['htmldir']}</a>            </td>

                <td align="center" >
                    {helper::yes($d['isnav'],false)}            </td>

                <td align="center" >
<a title="查看动态页面"  href="<?php echo url("archive/list/catid/$d[$primary_key]",false);?>" target="_blank">查看</a>	 /
				<a title="点击编辑栏目设置"  href="<?php echo modify("/act/edit/table/$table/id/$d[$primary_key]");?>">编辑</a>	/
				<a href="<?php echo modify("/act/add/table/category/parentid/$d[$primary_key]");?>">添加子栏目</a>	/
                    <a href="<?php echo modify("/act/add/table/archive/catid/$d[$primary_key]");?>">添加内容</a>	/
                    <a href="<?php echo modify("/act/list/table/archive/catid/$d[$primary_key]");?>">管理内容</a>	/
                    
					<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]");?>">删除</a></td>
            </tr>
              <?php
                $data1=category::getcategorydata($d['catid'],$data11,$l=1);
				if(isset($data1)){
				?>
                {loop $data1 $d1}

            <tr  onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d1[$primary_key]}" name="select[]"> </td>
                <td align="center" >{form::input("listorder[$d1[$primary_key]]",$d1['listorder'],'size=3')}</td>
                <td align="center" >
                    {$d1['catid']}            </td>
                <td align="left" style="padding-left:10px;">
                   <a href="<?php echo modify("/act/edit/table/$table/id/$d1[$primary_key]");?>" title="点击编辑栏目设置">{$d1['catname']}</a>
             
                </td>

                <td align="center" >
                    <a href="<?php echo url("archive/list/catid/$d1[$primary_key]",false);?>" title="查看动态页面" target="_blank">{$d1['htmldir']}</a>            </td>

                <td align="center" >
                    {helper::yes($d1['isnav'],false)}            </td>

                <td align="center" >
                    <a href="<?php echo url("archive/list/catid/$d1[$primary_key]",false);?>" title="查看动态页面" target="_blank">查看</a>	/
					<a href="<?php echo modify("/act/edit/table/$table/id/$d1[$primary_key]");?>">编辑</a>	/
					<a href="<?php echo modify("/act/add/table/category/parentid/$d1[$primary_key]");?>">添加子栏目</a>	/
                    <a href="<?php echo modify("/act/add/table/archive/catid/$d1[$primary_key]");?>">添加内容</a>	/
                    <a href="<?php echo modify("/act/list/table/archive/catid/$d1[$primary_key]");?>">管理内容</a>	/
					<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d1[$primary_key]");?>">删除</a></td>
            </tr>
              {/loop}  
              
              <?php } unset($d1);unset($data1);unset($data11);?>
                
                

            {/loop}

        </tbody>
    </table>


    <div class="blank10"></div>
    <input type="hidden" name="batch" value="">

    <input  class="button" type="button" value=" 排序 " name="order" onclick="this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='listorder'; this.form.submit();"/>
    &nbsp;&nbsp;
    <input  class="button" type="button" value=" 移动到 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要移动ID为('+getSelect(this.form)+')的栏目吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='move'; this.form.submit();}"/>
    <?php echo form::select('catid',0,category::option());?>
</form>


<div class="page"><?php echo pagination::html($record_count); ?></div>
<div class="blank10"></div>
</div>

</div>
</div>
</div>