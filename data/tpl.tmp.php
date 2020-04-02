<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>{if !empty($archive[mtitle])}{$archive[mtitle]}-{elseif !empty($archive[title])}{$archive[title]}-{/if}{if $type[meta_title]}{$type[meta_title]}-{elseif typename($type[typeid])}{typename($type[typeid])}-{/if}{if $category[$catid][meta_title]}{$category[$catid][meta_title]}-{elseif !empty($catid)}{catname($catid)}-{/if}{get('fullname')} - Powered by CmsEasy</title>
<meta name="keywords" content="{if $archive[keyword]}{$archive[keyword]}{else}{if $type[keyword]}{$type[keyword]}{elseif $category[$catid][keyword]}{$category[$catid][keyword]}{else}{get('site_keyword')}{/if}{/if}" />
<meta name="description" content="{if $archive[description]}{$archive[description]}{else}{if $type[description]}{$type[description]}{elseif $category[$catid][description]}{$category[$catid][description]}{else}{get('site_description')}{/if}{/if}" />
<meta name="author" content="CmsEasy Team" />
<link rel="icon" href="{$base_url}/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="{$base_url}/favicon.ico" type="image/x-icon" />
<link href="{$skin_path}/index.css" rel="stylesheet" type="text/css" />
<link href="{$base_url}/js/artDialog/skin/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{$base_url}/js/jquery.min.js"></script>
<script type="text/javascript" src="{$base_url}//js/artDialog/artDialog.min.js"></script>
<script language="javascript" type="text/javascript">
<!-- 
function ResumeError()  
{ 
    return true; 
} 
window.onerror = ResumeError; 
function check()
{
if(document.search.keyword.value.length==0){
     alert("{lang(pleaceinputtext)}");
     document.search.keyword.focus();
     return false;
    }

	}
// --> 

function getcontent(type,id){	
	if(type=='login'){
		var _url = '<?php echo url('user/dialog_login');?>';
		var _tiptext = '会员登录';
		var _height = 250;
		var _width = 460;
	}
	art.dialog({
		id:type,
		iframe:_url,
		title:_tiptext,
		width: _width,
		height: _height
	});
}
</script>
</head>
 <body>
 <div id="body">
	<div id="main">
     
     {ballot(1)}
     {ballot(2)}
     
		<div id="i_head">
		<div id="i_topmenu">
{login_js()}
<a id="StranLink" title="繁简转换">繁体 - </a>
<a title="{lang(feedback)}" href="{url('guestbook')}" target="_blank">{lang(feedback)} - </a>
<a href="{$site_url}" onclick="window.external.addFavorite(this.href,this.title);return false;" title='{get(sitename)}' rel="sidebar">{lang(favorite)} - </a>
</div>
		<div id="logo"><a href="{$base_url}/" title="{get(sitename)}"><img src="{$base_url}/{get(site_logo)}" width="{get(logo_width)}" alt="{get(sitename)}" /></a></div>
		</div>

<div id="i_banner"><img src="{$skin_path}/banner_i.jpg" /></div>
<div id="i_menu">
<a title="{lang(homepage)}" href="{$base_url}/" class="home">{lang(homepage)}</a>
{loop categories_nav() $t}
<a title="{$t[catname]}" href="{$t[url]}"{if isset($topid) && $topid==$t[catid]} class="on"{/if}>{$t[catname]}</a>
{/loop}
</div>

<div id="i_announ">
<h5>{lang(siteannoun)}</h5>
<ul>
{loop announ(5) $an}
<li><a href="{$an[url]}">{$an[title]}</a></li>
{/loop}
</ul>
<div id="i_search">
<form name='search' action="<?php echo url('archive/search');?>" onsubmit="search_check();" method="post">
<input  id="i_search_text" name="keyword" type="text" align="absmiple" />
<input type="submit" id="i_search_btn" align="absmiple" name='submit' value=" " />
</form>
</div>
</div>

<div id="i_c">

<div class="i_news">
<div class="title"><?php $t=position_p($typeid=2);?>
<a href="{$t.url}" title="{$t['name']}">{$t['name']}</a>
<?php?></div>
<ul>

{loop archive(2,0,0,'0,0,0',16,'aid',5,false,0) $i $archive} 
<li><a href="{$archive[url]}" title="{$arc[title]}">{$archive[title]}</a></li>
{/loop}
</ul>
</div>

<div class="i_product">
<div class="title"><?php $t=position_p($typeid=3);?>
<a href="{$t.url}" title="{$t['name']}">{$t['name']}</a>
<?php?></div>



<div class="scoll_img">
        <table width="400" height="154" border="0" cellPadding="0" cellSpacing="0">
          <tr>
            <td width="16" ><div class="GalleryPictureScrollerMoveLeft" title="Turn to left" onmouseover=r_left() onMouseDown="r_f_left()" onMouseUp="r_left()"></div></td>
            <td width="362"><div class="GalleryPictureScroller" id=demo>
                <div id=demo1 style="FLOAT:left">
                 <div id=demo1 style="FLOAT:left">
                  <table border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                      <tr>
                      {loop archive(3,0,0,'0,0,0',20,'aid',10,true,0) $i $archive} <td class="GalleryPictureScrollerImageArea"><div class="GalleryPictureScrollerImage"><a href="{$archive[url]}" title="{$archive[title]}"><img src="{$base_url}/{$archive[thumb]}" alt="{$archive[title]}" /></a></div>
                              <div class="GalleryPictureScrollerDetails"><a href="{$archive[url]}" title="{$archive[title]}">{$archive[title]}</a></div>
                            </td>{/loop}

                      </tr>
                    </tbody>
                  </table>
                </div>
                <DIV id=demo2 style="FLOAT: left"></DIV>
              </div></td>
            <td width="22"><div class="GalleryPictureScrollerMoveRight" title="Turn to right"  onmouseover=r_right() onMouseDown="r_f_right()" onMouseUp="r_right()"></div></td>
          </tr>
               
          <script src="{$skin_path}/contentscroller.js" type="text/javascript"></script>
        </table>
      </div>

</div>

<div class="i_contact">
<ul>
<li style="font-size:18px;">{lang(servertel)}</li>
<li style="line-height:32px;font-size:22px;border-bottom:1px solid #f5f5f5;">{get(tel)}</li>
<li style="font-size:16px;line-height:26px;">{lang(contactmode)}</li> 
<li><a href="">{lang(email)}：{get(email)}</a></li> 
<li><a href="">{lang(servers)}：{get(qq1)}</a></li>
</ul>
</div>

</div>
	</div>
<div id="foot">
<div class="foot">

<style type="text/css">
#links {
position:relative;
float:right;
width:168px;
height:19px;
line-height:16px;color:#fff;
background:url({$skin_path}/links.gif) right 2px no-repeat;
}

#links ul li a, #links ul li a:visited {color:#fff;display:block; text-decoration:none; width:168px; height:19px; text-align:left; padding-left:10px;  line-height:19px; font-size:12px;}
#links ul {padding:0; margin:0;list-style-type: none; }
#links ul li {float:left; position:relative;}
#links ul li ul {display: none;}
/* specific to non IE browsers */

#links ul li:hover ul {display:block; position:absolute; bottom:18px; left:0;}
#links ul li:hover ul li a.hide {}
#links ul li:hover ul li {display:block; width:168px; clear:both;
background:url({$skin_path}/links_bg.gif) left top repeat-y;
}

</style>
<!--[if lte IE 6]>
<style type="text/css">
table {border-collapse:collapse; margin:0; padding:0;}
#links ul li a.hide, #links ul li a:visited.hide {display:none;}
#links ul li a:hover ul li a.hide {display:none;}
#links ul li a:hover {color:#fff; background:none;}
#links ul li a:hover ul {display:block; position:absolute; bottom:22px; right:0;}
#links ul li a:hover ul li {display:block; background:none; color:#fff; width:168px;overflow:hidden;
background:url({$skin_path}/links_bg.gif) repeat-y left top;}
</style>
<![endif]-->

<div id="links">
<ul>


<li><a class="hide" style="text-align:right;font-size:10px;color:#999;">Links<span style="padding-right:80px;"></span></a>
<!--[if lte IE 6]>
<a href="#" style="text-align:right;font-size:10px;padding-right:80px;color:#999;">Links
<table><tr><td>
<![endif]-->
<ul>
<li style="height:7px;background:url({$skin_path}/links_top.png) no-repeat left top !important; /*For Firefox*/*background:none;/*For IE7 & IE6*/_filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='{$skin_path}/links_top.png',sizingMethod='crop');/*For IE6*/display: block;"></li>
{loop friendlink('text',0,6) $flink}
<li>{$flink[link]}</li>
{/loop}
<li style="height:41px;background:url({$skin_path}/links_bt.png) no-repeat left top !important; /*For Firefox*/*background:none;/*For IE7 & IE6*/_filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='{$skin_path}/links_bt.png',sizingMethod='crop');/*For IE6*/display: block;"><a title="{get('sitename')}" href="{$base_url}/">{get('sitename')}</a></li>

</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>
</div>

Copyright © 2010 <a href="{$base_url}/">{get(sitename)}</a>. All Rights Reserved.
<a href="http://www.miibeian.gov.cn/" target="_blank">{get('site_icp')}</a>
<br />热门关键词：{gethotsearch(10)}
<!-- 非商业用户请勿删除 -->
<div class="copyright"><a href="http://www.cmseasy.cn" title="Powered by CmsEasy.cn" target="_blank">Powered by CmsEasy</a>  {getcnzzcount()}</div>
</div>
</div>
</div>
<script> 
function resizeImg(obj)
{ 
var obj = document.getElementById(obj); 
var objContent = obj.innerHTML;
var imgs = obj.getElementsByTagName('img'); 
if(imgs==null) return; 
for(var i=0; i<imgs.length; i++) 
{ 
if(imgs[i].width>parseInt(obj.style.width)) 
{ 
imgs[i].width = parseInt(obj.style.width);
} 
} 
} 
window.onload = function() {resizeImg('text');
} 
</script>
{template 'system/servers.html'}test
</body>
</html>