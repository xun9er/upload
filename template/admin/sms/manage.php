<div class="tags">

  <div id="tagscontent">
    <div id="con_one_1">
	<div class="table_td" style="margin-top:10px;">


<font color="#009900"><strong>充值使用短信消息功能即代表您同意本短信安全许可协议	！</strong></font><div class="blank10"></div>
<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;"> <span class="tips"><a href="http://pay.cmseasy.cn/rule.php" target="_blank">查看许可协议</a></span>

<div class="blank10"></div>

<span style="float:right">
<a href="http://pay.cmseasy.cn/reg.php" target="_blank" class="button">注册短信平台用户</a>&nbsp;
<a href="http://{$base_url}/index.php?case=sms&act=manage&admin_dir={get('admin_dir')}&site=default" class="button">短信设置</a>&nbsp;
<a target="_blank" href="http://pay.cmseasy.cn/list.php?username=<?php echo config::get('sms_username');?>&password=<?php echo md5(config::get('sms_password'));?>" class="button">点击查看发送详情</a>&nbsp;
<a target="_blank" href="http://pay.cmseasy.cn/plist.php?username=<?php echo config::get('sms_username');?>&password=<?php echo md5(config::get('sms_password'));?>" class="button">点击查看充值详情</a>
</span>
<div class="blank30"></div>


<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
        <thead>
            <tr>
                <th colspan="3" style="text-align:left;padding-left:10px;">

<p>你已发送<font color="#009900"><strong>{$info[1]}</strong></font>条短信,还有<font color="#CC0000"><strong>{$info[0]}</strong></font>条短信未使用.</p>

				</th>
            </tr>

        </thead>
        <tbody>
		<form method="post" action="http://pay.cmseasy.cn/pay.php" target="_blank">
		<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">
充值条数
				</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
 <select name="num" id="num">
  	<option value="10">10条	=	0.8 元（人民币）</option>
    <option value="100" selected>100条	=	 8 元（人民币）</option>
    <option value="200">200条	=	16 元（人民币）</option>
    <option value="300">300条	=	24 元（人民币）</option>
    <option value="500">500条	=	40 元（人民币）</option>
    <option value="1000">1000条	=	80 元（人民币）</option>
    <option value="5000">5000条	=	400 元（人民币）</option>
  </select>

<input type="submit" name="submit" id="submit" value="充值">
<input name="sms_username" type="hidden" value="<?php echo config::get('sms_username');?>">
&nbsp; <img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;"><span style="color:red;font-weight:bold;"> 注意</span> 充值前请先<a href="http://pay.cmseasy.cn/reg.php" target="_blank" style="color:#009900">注册用户</a>！并将短信设置里面账户和密码修改为注册用户和密码！
				</td>

				 </tr>
				 </form>
<form method="post" action="">
				 <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">
接收号码
</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
						
    <input type="text" name="mobile" id="mobile" />
	<input type="submit" name="submit" id="submit" value="发送">
  <input name="act" type="hidden" value="test"><img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;"> <span class="tips">测试短信发送</span>
</td>

				 </tr>
</form>

<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">
特别注意
</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
						1、由于运营商业务量巨大，短信发送可能会有延时；<br />
						2、每周日的短信将保存后由下周一同意发送；<br />
						3、短信每条0.08元，如有价格变动见CmsEasy官网通知。<br />
</td>

				 </tr>
				 </tbody>
				 <thead>
            <tr>
                <th colspan="3" style="text-align:left;padding-left:10px;">



				</th>
            </tr>

        </thead>


			<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">
使用说明
</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">


						1、首先，在网站后台的 [ 设置 ] － 填写好网站管理员的手机号码，随后<a href="http://pay.cmseasy.cn/reg.php" target="_blank" style="color:#009900">注册</a>短信平台用户；</br>
						2、注册用户后，将用户名和密码，填写在<a href="{$base_url}/index.php?case=config&act=system&set=sms&admin_dir={get('admin_dir')}&site=default" target="_blank" style="color:#009900">短信设置</a>的账户和密码里面；</br>
						3、然后进入<a href="{$base_url}/index.php?case=sms&act=manage&admin_dir={get('admin_dir')}&site=default" target="_blank" style="color:#009900">短信管理</a>界面，点击充值，可以按自己需要选择充值数量，最低充值人民币8角；</br>
						4、最后进入<a href="{$base_url}/index.php?case=config&act=system&set=sms&admin_dir={get('admin_dir')}&site=default" target="_blank" style="color:#009900">短信设置</a>，设置好短信发送的条件；</br>
						5、提交后，完成短信配置，网站可正常向访客发送短信。</br>
</td>

				 </tr>

        
    </table>


</div>
        
        
    </div> 
  </div>
</div>
<div class="blank10"></div>