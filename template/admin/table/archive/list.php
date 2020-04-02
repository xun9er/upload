<div class="tags">

  <div id="tagscontent">
    <div id="con_one_1">
     <form name="searchform" id="searchform"  action="<?php echo uri();?>" method="post">
            栏目
            <?php echo form::select('search_catid',get('search_catid')?get('search_catid'):0,category::option()); ?>
            分类
            <?php echo form::select('search_typeid',get('search_typeid')?get('search_typeid'):0,type::option()); ?>
            标题
            <input type="text" name="search_title" id="search_title" value=""/>

            <input type="submit" value="搜索" name="submit"  onclick="this.form.action='{url::modify('table/'.get('table').'/type/search')}'" class="button"/>
            
            

            <div class="blank10"></div>
            地区
            <?php echo form::select('search_province_id',get('search_province_id')?get('search_province_id'):0,area::province_option()); ?>
            <?php echo form::select('search_city_id',get('search_city_id')?get('search_city_id'):0,area::city_option(get('search_city_id'))); ?>
            <?php echo form::select('search_section_id',get('search_section_id')?get('search_section_id'):0,area::section_option(get('search_section_id'))); ?>

            专题
            <?php echo form::select('search_spid',get('search_spid')?get('search_spid'):0,special::option()); ?>
        </form>


		
        
        <div class="table_td" style="margin-top:10px;">
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

 <span style="float:right"><input type="button" value="添加内容" onClick="javascript:location.href='{$base_url}/index.php?case=table&act=add&table=archive&admin_dir={get('admin_dir')}'" class="button" /><input type="button" value="审核内容" onclick="javascript:window.location.href='{url::create('table/list/table/archive/needcheck/1')}'" class="button" /><input type="button" value="回收站" onclick="javascript:window.location.href='{url::modify("table/".get('table')."/deletestate/1/page/1")}'" class="button" />
       </span>

    <table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
        <thead>
            <tr>
                <th><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
                <th>排序</th>
                <th><!--aid-->编号</th>
                <th><!--catid-->栏目</th>
                <th><!--title-->标题</th>
                <th><!--username-->作者</th>
                <th><!--view-->浏览</th>
                <th><!--adddate-->添加时间</th>
                <th><!--checked-->审核</th>
          
                <th align="center">操作</th>
            </tr>

        </thead>
        <tbody>
            {loop $data $d}
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">

                <td align="center"><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>
                <td align="center">{form::input("listorder[$d[$primary_key]]",$d['listorder'],'size=3')}</td>

                <td align="center">{cut($d['aid'])}</td>
                <td align="center"><a href="<?php echo url("archive/list/catid/".$d[catid],false);?>" target="_blank">{catname($d['catid'])}</a></td>
                <td align="left" style="padding-left:10px;">{cut($d['title'])}</td>
                <td align="center">{cut($d['username'])}</td>
                <td align="center">{cut($d['view'])}</td>
                <td align="center">{cut($d['adddate'])}</td>
                <td align="center">{helper::yes($d['checked'])}</td>

                <td align="center">
                    <a href='<?php if($d['linkto']){echo $d['linkto'];}elseif(front::get('site')!='default'){echo config::get('site_url').'index.php?case=archive&act=show&aid='.$d[$primary_key];}else{echo url("archive/show/aid/$d[$primary_key]",false);}?>' target="_blank" title="查看动态页面">查看</a>
                    <a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>">编辑</a>
                </td>
            </tr>
            {/loop}


        </tbody>
    </table>


    <div class="blank10"></div>

    <input type="hidden" name="batch" value="">
    <input  class="button" type="button" value=" 排序 " name="order" onclick="this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='listorder'; this.form.submit();"/>

    <?php  if(!front::get('deletestate')) {?>
    <input type="button" value=" 审核 " name="check" onclick="if(getSelect(this.form)  && confirm('确实要审核ID为('+getSelect(this.form)+')的记录吗?')){ this.form.action='<?php echo modify('act/batch',true);?>';this.form.batch.value='check';this.form.submit();}" class="button" />
        <?php } ?>

    <?php if(!front::get('deletestate')) {?>
    <input type="button" value="删除到回收站" name="delete" onclick="if(getSelect(this.form) && confirm('确实要把ID为('+getSelect(this.form)+')的记录放到回收站吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='deletestate'; this.form.submit();}" class="button"/>


        <?php } ?>

    <input type="button" value="<?php if(get('table')=='archive') {?>彻底<?php } ?>删除" name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}" class="button" />

    <?php if(get('table')=='archive') {?>
    <input type="button" value=" 还原 " name="restore" onclick="if(getSelect(this.form) && confirm('确实要把ID为('+getSelect(this.form)+')的已删除记录还原吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='restore'; this.form.submit();}" class="button" />
        <?php } ?>        
        
      <div class="blank10"></div>     
      设置推荐位：<?php
		preg_match_all('/\(([\d\w]+)\)(\S+)/im', $settings['attr1'], $result, PREG_SET_ORDER);
		foreach($result as $val){
			$result[$val[1]]=$val[2];
		}
		$result[0]='请选择...';
		echo form::select('attr1',0,$result);
	  ?>
      <input  class="button" type="button" value="设置" name="recommend" onclick="if(getSelect(this.form)  && confirm('确实要设置ID为('+getSelect(this.form)+')的推荐位吗?')){ this.form.action='<?php echo modify('act/batch',true);?>';this.form.batch.value='recommend';this.form.submit();}"/>  
&nbsp;&nbsp;
       移动内容到：<?php echo form::select('catid',0,category::option()); ?> 
       <input  class="button" type="button" value="移动" name="movelist" onclick="if(getSelect(this.form)  && confirm('确实要移动ID为('+getSelect(this.form)+')的记录吗?')){ this.form.action='<?php echo modify('act/batch',true);?>';this.form.batch.value='movelist';this.form.submit();}"/>   
      
</form>
<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>
</div>
        
        
    </div> 
  </div>
</div>
<div class="blank10"></div>