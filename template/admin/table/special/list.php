<div class="tags">

  <div id="tagscontent">
    <div id="con_one_1">
    
    <div class="table_td" style="margin-top:10px;">

<form name="listform" id="listform"  action="<?php echo uri(); ?>" method="post">

<input class="button" type="button" value=" 添加专题 " onclick="javascript:window.location.href='<?php echo url('table/add/table/special') ?>'" />


    <div class="blank10"></div>
    <table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
        <tbody id="listtable">
            <tr>
                <!--<th width="60" align="center"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>-->
                <!--<th>排序</th>-->
                <th><!--spid-->专题ID</th>
                <th><!--catname-->专题名称</th>
                <th>操作</th>
            </tr>

            {loop $data $d}
            <?php $spid=$d['spid']; ?>
            <tr class="s_out" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <!--<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$spid}" name="select[]"> </td>-->
                <!--<td>{form::input("listorder[$d[$primary_key]]",$d['listorder'],'size=3')}</td>-->
                <td align="center">{$d['spid']}</td>
                <td align="center">{$d['title']}</td>

                <td align="center">
                    <a href="<?php echo url("special/show/spid/$spid", false); ?>" title="查看动态页面" target="_blank">查看</a>	 /
                    <a href="<?php echo modify("/act/list/table/archive/spid/$spid"); ?>">管理内容</a>	 /
                    <a href="<?php echo modify("/act/edit/table/$table/id/$spid"); ?>">编辑</a>	 /
					<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/special/id/$spid"); ?>">删除</a></td>
            </tr>

            {/loop}

        </tbody>
    </table>


    <div class="blank10"></div>
    <input type="hidden" name="batch" value="">

</form>


<div class="page"><?php echo pagination::html($record_count); ?></div>
<div class="blank10"></div>
</div>
</div>
</div>
</div>