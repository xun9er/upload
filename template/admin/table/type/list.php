<div class="tags">

  <div id="tagscontent">
    <div id="con_one_1">
    
    <div class="table_td" style="margin-top:10px;">
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

    <?php
    //$data=type::gettypedata();
    ?>
    
    <input class="button" type="button" value=" 添加分类 " onclick="javascript:window.location.href='index.php?case=table&act=add&table=type&admin_dir={get('admin_dir')}'" />

    <div class="blank10"></div>
    <table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table"  width="100%">
        <tbody id="listtable">
            <tr>
                <th width="60" align="center"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
                <!--<th>排序</th>-->
                <th><!--typeid-->分类</th>
                <th><!--typename-->分类名称</th>
                                <th>操作</th>
            </tr>

            {loop $data $d}

            <tr class="s_out" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d[$primary_key]}" name="select[]"> </td>
                <!--<td>{form::input("listorder[$d[$primary_key]]",$d['listorder'],'size=3')}</td>-->
                <td align="center">
                    {$d['typeid']}            </td>
                <td align="left" style="padding-left:10px;">
                    {$d['typename']}
         
                </td>

   
                <td align="center">
                    <a href="<?php echo url("type/list/typeid/$d[$primary_key]",false);?>" title="查看动态页面" target="_blank">查看</a>	 /
                    <a href="<?php echo modify("/act/add/table/archive/typeid/$d[$primary_key]");?>">添加内容</a>	 /
                    <a href="<?php echo modify("/act/list/table/archive/typeid/$d[$primary_key]");?>">管理内容</a>	 /
                    <a href="<?php echo modify("/act/add/table/type/parentid/$d[$primary_key]");?>">添加子分类</a>	 /
                    <a href="<?php echo modify("/act/edit/table/$table/id/$d[$primary_key]");?>">编辑</a>	 / 
					<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]");?>">删除</a></td>
            </tr>
            
            <?php
                $data1=type::gettypedata($d['typeid'],$data11,$l=1);
				if(isset($data1)){
				?>
                {loop $data1 $d1}
                
                <tr class="s_out" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d1[$primary_key]}" name="select[]"> </td>
                <!--<td>{form::input("listorder[$d1[$primary_key]]",$d1['listorder'],'size=3')}</td>-->
                <td align="center">
                    {$d1['typeid']}            </td>
                <td align="left" style="padding-left:10px;">
                    {$d1['typename']}
                </td>

   
                <td align="center">
                    <a href="<?php echo url("type/list/typeid/$d1[$primary_key]",false);?>" title="查看动态页面" target="_blank">查看</a>	 /
                    <a href="<?php echo modify("/act/add/table/archive/typeid/$d1[$primary_key]");?>">添加内容</a>	 /
                    <a href="<?php echo modify("/act/list/table/archive/typeid/$d1[$primary_key]");?>">管理内容</a>	 /
                    <a href="<?php echo modify("/act/add/table/type/parentid/$d1[$primary_key]");?>">添加子分类</a>	 /
                    <a href="<?php echo modify("/act/edit/table/$table/id/$d1[$primary_key]");?>">编辑</a>	 /
					<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d1[$primary_key]");?>">删除</a>
					</td>
            </tr>
                
                {/loop}  
              
              <?php } unset($d1);unset($data1);unset($data11);?>
            

            {/loop}

        </tbody>
    </table>


    <div class="blank10"></div>
<!--    <input type="hidden" name="batch" value="">

    <input  class="button" type="button" value=" 排序 " name="order" onclick="this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='order'; this.form.submit();"/>
    &nbsp;&nbsp;
    移动分类：<?php echo form::select('typeid',0,type::option());?>&nbsp;
    <input  class="button" type="button" value=" 移动 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要移动ID为('+getSelect(this.form)+')的类吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='move'; this.form.submit();}"/>-->
</form>


<div class="page"><?php echo pagination::html($record_count); ?></div>

</div>
</div>
</div>
</div>