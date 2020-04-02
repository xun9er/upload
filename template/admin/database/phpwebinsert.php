<script src="{$base_url}/common/js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>
<script>

</script>

<form name="form" id="listform"  action="<?php echo uri();?>" method="post">

<div class="tags">
 <div id="tagstitle">
 <a href="#" class="hover">导入其他CMS数据</a>
</div> 
  <div id="tagscontent">
	<div id="con_one_1">
    
<table width="100%" border="0" cellspacing="2" cellpadding="0">
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">
数据库表前缀
</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
{form::input('phpweb_prefix','','size="20"')}
						 &nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;">&nbsp;&nbsp;<span class="tips">PHPWEB表前缀，不需包含下划线 _</span></td>
                    </tr>
<tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">
数据库文件
</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
{form::upload_file('data','data')}
						 &nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;">&nbsp;&nbsp;<span class="tips">只支持.txt和.sql文件格式</span></td>
                    </tr>

</table>
<div class="blank30"></div>
{form::submit('开始导入')}
</div>
</div>
</div>
</form>