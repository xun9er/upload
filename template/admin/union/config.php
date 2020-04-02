<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">

<script language="javascript" src="{$base_url}/common/js/common.js"></script>


<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">

<table cellpadding="2" cellspacing="1" class="tableborder"> 
    <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff"> 
      <td width='40%' class='tablerow'><strong>推广联盟开关</strong></td> 
      <td class='tablerow'> 
	  <select name="setting[enabled]"> 
	  <option value="1" {if $data['enabled']==1}selected{/if}>开</option> 
	  <option value="0" {if $data['enabled']==0}selected{/if}>关</option> 
	  </select> 
	  </td> 
    </tr>  
    <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff"> 
      <td width='40%' class='tablerow'><strong>Cookie保存时间</strong></td> 
      <td class='tablerow'> 
	  <select name="setting[keeptime]"> 
	  <option value="86400" {if $data['keeptime']==86400}selected{/if}>一天</option> 
	  <option value="604800" {if $data['keeptime']==604800}selected{/if}>一周</option> 
	  <option value="2592000" {if $data['keeptime']==2592000}selected{/if}>一月</option> 
	  <option value="7776000" {if $data['keeptime']==7776000}selected{/if}>一季度</option> 
	  <option value="15552000" {if $data['keeptime']==15552000}selected{/if}>半年</option> 
	  <option value="31536000" {if $data['keeptime']==31536000}selected{/if}>一年</option> 
	  </select> 
	  </td> 
    </tr> 
    <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff"> 
      <td width='40%' class='tablerow'><strong>初始利润率</strong></td> 
      <td class='tablerow'><input name='setting[profitmargin]' type='text' id='profitmargin' value='{$data['profitmargin']}' size='3' maxlength='3'>%</td> 
    </tr> 
    <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff"> 
      <td width='40%' class='tablerow'><strong>访客默认跳转地址</strong></td> 
      <td class='tablerow'><input name='setting[forward]' type='text' id='forward' value='{$data['forward']}' size='50' maxlength='100'></td> 
    </tr> 
    <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff"> 
      <td width='40%' class='tablerow'><strong>带来一个有效IP访问赠送</strong></td> 
      <td class='tablerow'> 
	  <input name='setting[rewardnumber]' type='text' id='rewardnumber' value='{$data['rewardnumber']}' size='4' maxlength='5'> 
	  <select name="setting[rewardtype]"> 
	  <option value="point" >点</option> 
	  </select> 
	  </td> 
    </tr> 
    <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff"> 
      <td width='40%' class='tablerow'><strong>带来一个注册用户赠送</strong></td> 
      <td class='tablerow'> 
	  <input name='setting[regrewardnumber]' type='text' value='{$data['regrewardnumber']}' size='4' maxlength='5'> 
	  <select name="setting[regrewardtype]"> 
	  <option value="point" >点</option> 
	  </select> 
	  </td> 
    </tr> 
</table> 


<div class="blank30"></div>
<input type="submit" name="submit" value="提交" class="button"/>

</form>


</div>
</div>
</div>

