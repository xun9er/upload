<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>


<script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>

<script>
function attachment_delect(id) {
$.ajax({
url: '{url('tool/deleteattachment/site/'.front::get(site),false)}&id='+id,
type: 'GET',
dataType: 'text',
timeout: 1000,
error: function(){
//	alert('Error loading XML document');
},
success: function(data){
document.form1.attachment_id.value=0;
get('attachment_path').innerHTML='';
get('file_info').innerHTML='';
}
});
}
</script>


<div class="tags">
 <div id="tagstitle">
   <a href="#" id="one1" onclick="setTab('one',1,6)" class="hover">基本信息</a>
   <a href="#" id="one2" onclick="setTab('one',2,6)">SEO信息</a>
   <a href="#" id="one3" onclick="setTab('one',3,6)">属性设置</a>
   <a href="#" id="one4" onclick="setTab('one',4,6)">扩展信息</a>
   <a href="#" id="one5" onclick="setTab('one',5,6)">权限审核</a>
  </div> 
  <div id="tagscontent">
	<div id="con_one_1">
    
<table width="100%" border="0" cellspacing="2" cellpadding="0">
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">所属栏目</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('parentid',$form,$field,$data)} &nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;">&nbsp;&nbsp;<span class="tips">顶级栏目可跳过</span></td>
                    </tr>

<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">栏目名称</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
{form::getform('catname',$form,$field,$data)} </td>
                    </tr>


<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">目录名称</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
{form::getform('htmldir',$form,$field,$data)} &nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;">&nbsp;&nbsp;<span class="tips">目录必须是英文名，留空则自动使用拼音名</span></td>
                    </tr>

<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">在导航中显示</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('isnav',$form,$field,$data)} &nbsp;&nbsp;<span class="tips">如果是一级目录，可选择是否在导航中显示栏目名称和链接</span></td>
                    </tr>

</table>
    </div>
    <div id="con_one_2" style="display:none">
    
   <table width="100%" border="0" cellspacing="2" cellpadding="0" id="table">
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">网页标题</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('meta_title',$form,$field,$data)}&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;">&nbsp;&nbsp;<span class="tips">可填写不同于内容名称的关键词，有利于搜索优化</span></td>
                    </tr>

<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">关键词</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('keyword',$form,$field,$data)}&nbsp;&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;"> <span class="tips"><a href="javascript:tipsbox('网页META信息中的keywords');">查看帮助</a></span></td>
                    </tr>

<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">页面描述</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('description',$form,$field,$data)}&nbsp;&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;"> <span class="tips"><a href="javascript:tipsbox('网页META信息中的description');">查看帮助</a></span></td>
                    </tr>

					<tr>
                <th colspan="3">URL规则</th>
				</tr>
	

<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">当前栏目列表</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('htmlrule',$form,$field,$data)}&nbsp;&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;"> <span class="tips"><a href="javascript:tipsbox('<strong>默&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认：</strong>&#123;$caturl&#125;/&#123;$page&#125;.html <br /><strong>短&nbsp;&nbsp;目&nbsp;&nbsp;录：</strong>&#123;$dir&#125/&#123;$page&#125;.html<br /><strong>自&nbsp;&nbsp;定&nbsp;&nbsp;义：</strong>自定义（英文或拼音）/&#123;$page&#125;.html<br /><strong>栏目目录：</strong>&#123;$caturl&#125;<br /><strong>当前目录：</strong>&#123;$dir&#125;<br /><strong>注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;意：</strong>&#123;$page&#125;必须存在URL内且为最后！');">查看帮助</a></span>
</td>
                    </tr>
<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">子栏目列表</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
{form::getform('listhtmlrule',$form,$field,$data)}&nbsp;&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;"> <span class="tips"><a href="javascript:tipsbox('<strong>默&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认：</strong>&#123;$caturl&#125;/&#123;$page&#125;.html <br /><strong>短&nbsp;&nbsp;目&nbsp;&nbsp;录：</strong>&#123;$dir&#125/&#123;$page&#125;.html<br /><strong>自&nbsp;&nbsp;定&nbsp;&nbsp;义：</strong>自定义（英文或拼音）/&#123;$page&#125;.html<br /><strong>栏目目录：</strong>&#123;$caturl&#125;<br /><strong>当前目录：</strong>&#123;$dir&#125;<br /><strong>注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;意：</strong>&#123;$page&#125;必须存在URL内且为最后！');">查看帮助</a></span>
</td>
                    </tr>
<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">内容页</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
{form::getform('showhtmlrule',$form,$field,$data)}&nbsp;&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;"> <span class="tips"><a href="javascript:tipsbox('<strong>默&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认：</strong>&#123;$caturl&#125;/show_&#123;$aid&#125;(_&#123;$page&#125;).html<br /><strong>短&nbsp;&nbsp;目&nbsp;&nbsp;录：</strong>&#123;$dir&#125/show_&#123;$aid&#125;(_&#123;$page&#125;).html<br /><strong>自&nbsp;&nbsp;定&nbsp;&nbsp;义：</strong>自定义（英文或拼音）/&#123;$page&#125;.html<br /><strong>栏目目录：</strong>&#123;$caturl&#125;<br /><strong>当前目录：</strong>&#123;$dir&#125;<br /><strong>注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;意：</strong>&#123;$page&#125;必须存在URL内且为最后！');">查看帮助</a></span>
</td>
                    </tr>
					</table>

    
    </div>
    <div id="con_one_3" style="display:none">
    
<table width="100%" border="0" cellspacing="2" cellpadding="0" id="table">
<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">当前使用模板</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
{form::getform('template',$form,$field,$data)}&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;">&nbsp;&nbsp;<span class="tips">当前栏目应用的模板样式</span>
</td>
                    </tr>

<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">所属列表页模板</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
{form::getform('listtemplate',$form,$field,$data)}&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;">&nbsp;&nbsp;<span class="tips">栏目下属子级栏目应用模板样式</span>
</td>
                    </tr>

<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">所属内容页模板</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
{form::getform('showtemplate',$form,$field,$data)} &nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;">&nbsp;&nbsp;<span class="tips">栏目下属内容页模板样式</span>
</td>
                    </tr>

<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">是否启用</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('isshow',$form,$field,$data)}&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;">&nbsp;&nbsp;<span class="tips">选择栏目是否启用</span></td>
                    </tr>
<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">动静态设置</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('ishtml',$form,$field,$data)}&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;">&nbsp;&nbsp;<span class="tips">选择栏目显示状态</span></td>
                    </tr>
					<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">分页设置</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('ispages',$form,$field,$data)}&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;">&nbsp;&nbsp;<span class="tips">选择栏目是否分页显示</span></td>
                    </tr>
<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">分页值</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('attr3',$form,$field,$data)}&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;">&nbsp;&nbsp;<span class="tips">留空按全局设置数量显示</span></td>
                    </tr>
<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">子栏目内容设置</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('includecatarchives',$form,$field,$data)}&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;">&nbsp;&nbsp;<span class="tips">选择栏目列表中是否包含下属栏目中的内容</span></td>
                    </tr>

<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">外部链接</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('linkto',$form,$field,$data)}&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;">&nbsp;&nbsp;<span class="tips">填写外部链接地址后，访问栏目将跳转到填写的地址！</span></td>
                    </tr>
</table>

    </div>
    <div id="con_one_4" style="display:none">
    
   
<table width="100%" border="0" cellspacing="2" cellpadding="0" id="table">
<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">封面内容</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
{form::getform('categorycontent',$form,$field,$data)} <br />&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;">&nbsp;&nbsp;<span class="tips">如使用设置栏目封面，请在模板处选择本栏目应用list_page.html模板</span></td>
                    </tr>

<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">栏目说明图片</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('image',$form,$field,$data)}&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;">&nbsp;&nbsp;<span class="tips">栏目banner功能,需在模板中调用显示</span></td>
                    </tr>

<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">缩略图大小</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::input('thumb_width',$data['thumb_width'],'size="5"')} px × {form::input('thumb_height',$data['thumb_height'],'size="5"')} px
默认: {type::getwidthofthumb(get('id'))} px × {type::getheightofthumb(get('id'))} px</td>
                    </tr>

</table>
</div>  

    <div id="con_one_5" style="display:none">
    
    <div class="hid_box">
<div id=lm13 class="hbox">
<table width="90%" style="margin:20px;">
<tr>
<td width="20%">&nbsp;</td>
<td  width="35%">浏览(<font color="Red">×</font>)</td>
<td  width="35%">下载附件(<font color="Red">×</font>)</td>
</tr>
{loop usergroup::getInstance()->group $group}
<?php if($group['groupid']=='888') continue; ?>
<tr><td>{$group.name}</td>
<td>{form::checkbox("_ranks[".$group['groupid']."][view]",-1, @$data['_ranks'][$group['groupid']]['view'])}</td>
<td>{form::checkbox("_ranks[".$group['groupid']."][down]",-1, @$data['_ranks'][$group['groupid']]['down'])}</td>
</tr>
{/loop}
</table>
<div class="blank30"></div>
<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;"> &nbsp;注意：勾选为该用户组禁止浏览或下载
</div>
</div>
    
    </div>
   </div>
  </div>






<div class="blank20"></div>
<input type="submit" name="submit" value=" 提交 " class="button" />
</form>