<?php if (!defined('ADMIN')) exit('Can\'t Access !'); ?>
 <div class="homecon">
    <div id="homecon_left">
        <div class="homecon_lefttit">系统信息</div>
        <div class="homecon_leftcon" >
服务器环境：<?php echo $_SERVER['SERVER_SOFTWARE'];?><br />
服务器IP：<?php echo $_SERVER[SERVER_ADDR];?><br />
当前登录用户：{$user.username}<br />
当前网站语言：<?php echo config::get('lang_type');?><br />
开发团队：CmsEasy Team <br />
程序版本：CmsEasy  <span id="__version"><?php echo _VERSION;?></span> <a href="javascript:checkver();"><span style="color:red; font-weight:bold">(检查更新)</span></a><br />
</div>

    </div>
    <div id="homecon_right">

            <div class="homecon_lefttit">推荐关注</div>
        <div class="homecon_leftcon" id="information">
        <ul id="officialinf">
            {cookie::get('passinfo')}
        </ul>
        授权信息: <span id="__buy"><a href="http://vip.cmseasy.cn" target="_blank"><span style="color:green;">自助查询</span></a></span>
        </div>

    </div>
    <div class="clear"></div>
  </div>
<div class="blank30"></div>
 <div id="btn">
 <?php $menu=admin_menu::get(); ?>
{loop $menu $ns $ms}
{loop $ms $n $m}
{if $m}<a href="{$m}" class="button">{$n}</a>{else}{$n}{/if}
{/loop}
{/loop}
 </div>
    <script>
	   $(document).ready(function(){
	      $.get('./lib/tool/getinf.php?type=officialinf',function(data){
	          $("#information").append(data);
	      });
	   });
   </script>