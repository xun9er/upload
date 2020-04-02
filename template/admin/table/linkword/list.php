<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
 
  <div class="table_td" style="margin-top:10px;">


<input title="增加内链" onclick="window.location.href='{url::create('table/add/table/linkword')}'" type="button" name="addcontentlinkword" class="button" value="增加内链" />


<div class="blank10"></div>


<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
<thead>
            <tr>
                <th><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
                                <th align="center"><!--id-->编号</th>
                                <th align="center"><!--linkword-->链接词</th>
                                <th align="center"><!--linkurl-->URL</th>
                                <th align="center"><!--linkorder-->链接权重值</th>
                                <th align="center"><!--linktimes-->链接次数</th>
                                <th align="center">操作</th>
            </tr>

</thead>
<tbody>

            {loop $data $d}
            <tr class="s_out" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">

                <td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

                                                    <td align="center">{cut($d['id'])}</td>
                                                    <td align="left" style="padding-left:10px;">{cut($d['linkword'])}</td>
                                                    <td align="left" style="padding-left:10px;">{$d['linkurl']}</td>
                                                    <td align="center">{cut($d['linkorder'])}</td>
                                                    <td align="center">{cut($d['linktimes'])}</td>
                
                <td align="center">
                                                
                                            <a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>">编辑</a>
                        
                                            <a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]");?>">删除</a>
                                        </td>
            </tr>
            {/loop}


        </tbody>
    </table>


    <div class="blank10"></div>

    <input type="hidden" name="batch" value="" />

        
        
    <input  class="button" type="button" value=" <?php if(get('table')=='archive') {?>彻底<?php } ?>删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}" />

    
</form>


<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>


</div>
</div>
</div>
</div>