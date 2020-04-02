<script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>
<script type="text/javascript">
jQuery(function($){
	$("#demo_btn").click(function(){
		$("#demo_div").attr("src",
			"demo.php?pattern="+$("#ifocus_pattern").val()+"&width="+$("#ifocus_width").val()+"&height="+$("#ifocus_height").val()+
			"&number="+$("#ifocus_number").val()+"&time="+$("#ifocus_time").val());	
	});
});
</script>
<form method="post" action="<?php echo uri();?>" name="config_form">
<div class="tags" style="margin-bottom:20px;">
<div id="tagstitle">
      <?php $i=1;?>
      {loop $units $key $unit}
	  <a id="one{$i}" onclick="setTab('one',{$i},20)" class="{if $i==1}hover{/if}" href="#">{$unit}</a>
      <?php $i++;?>
      {/loop}
  </div>
<?php unset($i);?>
         
   <div id="tagscontent">         
     <?php $onei=1;?>
     {loop $units $key $unit}         
     {if isset($items[$key])}
     <div id="con_one_{$onei}" {if $onei>1}style="display:none"{/if} >
      <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table">
       {loop $items[$key] $item}
         <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
           <td width="11%" align="right"><strong>{$item.title}</strong></td>
           <td width="1%">&nbsp;</td>
           <td width="80%">

		   {if $item['name']=='ditu_explain'}
使用说明：<br />
1、首先，点击	<a href="http://dev.baidu.com/wiki/static/map/API/tool/getPoint/" id="submit" target="_blank">&nbsp;按钮&nbsp;</a>	，获取地图数值；<br />
2、数据包含：当前层级、当前坐标点；<br />
3、坐标点逗号前为经度值；<br />
4、坐标点逗号后为纬度值；<br />
5、将经纬度值复制到后台中的经纬度输入框，提交即可。<br />
6、地图调用代码为 {&nbsp;template 'ditu.html'&nbsp;} ,复制后，请将里面空格删除 。<br />
<style>
#ditu_explain {display:none;}
</style>
{/if}


             {if $item['name']=='template_dir'}
             <div id="template">
				{loop $item['select'] $key2 $val}
             <div class="template_box"> <div class="t_box"> <div class="img-wrap"><img src="{config::get('site_url')}/template/{$key2}/skin/thumbnails.jpg" /></div></div>
                    {$val}
                     <input name="template_dir_select[]" type="radio" value="{$key2}" {if get($item['name'])==$key2} checked="checked" {/if} onclick="this.form.template_dir.value=this.value" />
                                  选择</div>
				{/loop}	</div>
</div>

             {form::hidden($item['name'],get($item['name']))}
		
			  {else}
                {if isset($item['select']) && is_array($item['select'])}
                {form::select($item['name'],get($item['name']),$item['select'],'class="select1"')}
                {elseif strlen(get($item['name']))>50}
                {form::textarea($item['name'],get($item['name']),'cols="40" rows="5" class="textarea1"')}
                {elseif isset($item['image'])}
                {form::upload_image($item['name'],get($item['name']))}
                {else}{form::input($item['name'],get($item['name']),'class="skey"')}
                {/if}
                {if $item['name']=='watermark_pos'}
                {template 'config/watermark_pos_select.php'}
                {/if}                    
           {/if}
          {if strlen($item['intro'])>1}<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14" / style="margin-left:10px; margin-right:5px;"> <span class="tips">{$item['intro']}</span>{/if}{if $item['title']=='风格应用选择'}<button id="demo_btn" type="button" style="width:80px; height:30px; margin:4px;">演 示</button><br />
<iframe id="demo_div" width="100%" height="400" frameborder="0" scrolling="no" src="demo.php"></iframe>

{/if}

 

</td>
       </tr>
    {/loop}
    <?php $onei++;?>
   </table>
   </div>   

  {/loop}
  {/if}        
  <div style="margin-left:10%; margin-top:10px;"><input name="submit" type="submit" value="提交" id="submit" /></div>

  </div>

</div>
</form>

