
<?php
$tagfrom = $_GET['tagfrom'];
if($tagfrom=='content'){
	$listname = '内容';
}elseif($tagfrom=='category'){
	$listname = '栏目';
}elseif($tagfrom=='function'){
	$listname = '函数';
}elseif($tagfrom=='system'){
	$listname = '系统';
}elseif($tagfrom=='define'){
	$listname = '自定义';
}
?>
<div class="tags">
 <div id="tagscontent">
 <div id="con_one_1">

  <div class="table_td" style="margin-top:10px;">

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

<a href="{$base_url}/index.php?case=table&act=add&table=templatetag&tagfrom=content&admin_dir={get('admin_dir')}&site=default"  class="button">添加内容标签</a><a href="{$base_url}/index.php?case=table&act=add&table=templatetag&tagfrom=category&admin_dir={get('admin_dir')}&site=default"  class="button">添加栏目标签</a><a href="{$base_url}/index.php?case=table&act=add&table=templatetag&tagfrom=define&admin_dir={get('admin_dir')}&site=default"  class="button">添加自定义标签</a><a class="button" onclick="javascript:tipsbox('一个中文标签代替一段代码。<br>标签调用方法：<b>{</b><b>tag_</b>标签名称<b>}</b><br>标签JS调用方法：<b>{</b><b>js_</b>标签名称<b>}</b><br>非中文标签调用直接放置代码，例如调用 [ICP备案号] 直接在模板插入<b>{</b>get(\'site_icp\')<b>}</b>')">标签调用说明</a>

<div class="blank10"></div><div class="blank10"></div>

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
<thead>
        <tr>
           <th><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
          <th><!--id-->编号</th>
          <th><!--name-->名称</th>
          <th><!--tagcontent-->代码内容/标签模板</th>
          <th>操作</th>
        </tr>
</thead>
<tbody>
{loop $data $d}
<tr class="s_out"  onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">

<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

<td align="center">{cut($d['id'])}</td>
<td>{cut($d['name'])}</td>
<td><?php
//if($d['tagcontent']=='null'){
//	$id = $d['id'];
//	$path=ROOT.'/config/tag/'.get('tagfrom').'_'.$id.'.php';
//	$tag_config = array();
//	$tag_config_content = @file_get_contents($path);
//	$tag_config = unserialize($tag_config_content);
//	echo $tag_config['tagtemplate'];
//}else{
	?>
	{tool::cn_substr(htmlspecialchars($d['tagcontent']),20)}
<?php
//}
?></td>

<td align="center">
<a href='<?php echo url("templatetag/test/id/$d[$primary_key]",false);?>' target="_blank">测试</a>
<?php
if(($_GET['tagfrom']!='function')){
	?>
<a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]/tagfrom/$tagfrom");?>">编辑</a>
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]");?>">删除</a>
<?php
}
?>
</td>
</tr>
{/loop}


      </tbody>
    </table>


<div class="blank20"></div>

    <input type="hidden" name="batch" value="" />
<input  class="greenbtn" type="button" value="删除" name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}" />




</form>


<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>

</div>

</div>
</div>
</div>