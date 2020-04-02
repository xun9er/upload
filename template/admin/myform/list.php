<div class="tags">
 <div id="tagstitle">
   <a id="one1" onclick="setTab('one',1,6)" class="hover">表单提交信息</a>
  </div> 
 <div id="tagscontent"> 
 <div id="con_one_1">



<?php helper::filterField($field,$fieldlimit);?>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

  <?php
  if(get('table')=='type')
  $this->render('_table/type/_list.php');
  else { ?>

<div class="table_td" style="margin-top:10px;">  
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
<thead>
<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<th width="60px"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
{loop $field $f}
          <th align="center"><!--{$f.name}-->{$f.name|lang}</th>
{/loop}
          <th align="center">操作</th>
        </tr>

</thead>
<tbody>
{loop $data $d}
<tr class="s_out" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">

<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

{loop $field $f}
<?php $name=$f['name']; ?>
<td align="left" style="padding-left:10px;">{cut($d[$name])}</td>
{/loop}

<td align="center">

<a href='<?php echo url("table/show/table/$table/id/$d[$primary_key]");?>' class="button">查看</a>
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]");?>" class="button">删除</a>


</td>
</tr>
{/loop}


      </tbody>
    </table>
</div>

<div class="blank10"></div>

    <input type="hidden" name="batch" value=""  class="button" />

<input  class="button" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}" />

<?php } ?>


</form>


<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>

<div class="blank10"></div><div class="blank10"></div>
</div>
</div>
</div>