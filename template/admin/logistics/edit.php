<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
 <div class="table_td" style="margin-top:10px;"> 

<input class="button" type="button" value=" 配货方式列表 " name="add" onclick="javascript:window.location.href='<?php echo modify("act/list/table/$table");?>'"/> 


<div class="blank10"></div>

<form method="post" action="" name="form1" id="form1" onsubmit="checkform1()">
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table">

<tbody>

<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">配货方式</td>
	<td><input type="text" name="title" id="title" value="{$data['title']}"  /></td>
</tr>

<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">配货方式描述</td>
	<td>{form::textarea('content',$data['content'],'cols="70" rows="6"')}</td>
</tr>

<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">配送价格</td>
	<td><input type="text" name="price" id="price" value="{$data['price']}"  /></td>
</tr>

<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">超重价格</td>
	<td><input type="text" name="overweight" id="overweight" value="{$data['overweight']}"  /></td>
</tr>


<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">货到付款</td>
	<td><input type="radio" value="1" name="cashondelivery" <?php if($data['cashondelivery']==1){?>checked="checked" <?php }?>  /> 启用&nbsp;
							<input type="radio" value="0" name="cashondelivery" <?php if($data['cashondelivery']==0){?>checked="checked" <?php }?> /> 关闭<br />
                              
							<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14" style="margin-left:10px; margin-right:5px;" /> <span class="tips">如果启用，则此配送方式费用不算入在线支付！</span>
							</td>
</tr>

<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">是否保价</td>
	<td><input type="radio" value="1" name="insure" onclick="javascript:document.getElementById('insureproportion_box').style.display='';" <?php if($data['insure']==1){?>checked="checked" <?php }?>> 启用&nbsp;
							<input type="radio" value="0" name="insure"  <?php if($data['insure']==0){?>checked="checked" <?php }?> onclick="javascript:document.getElementById('insureproportion_box').style.display='none';"> 关闭</td>
</tr>

<tr id="insureproportion_box" style="display:<?php if($data['insure']==0){?>none<?php }?>" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">保价比例</td>
	<td><input type="text" name="insureproportion" id="insureproportion" value="{$data['insureproportion']}"  />%</td>
</tr>




</tbody>
</table>

<input type="hidden"  name="pay_id"       value="{$data[pay][pay_id]}" />
      <input type="hidden"  name="pay_code"     value="{$data[pay][pay_code]}" />
      <input type="hidden"  name="is_cod"       value="{$data[pay][is_cod]}" />
      <input type="hidden"  name="is_online"    value="{$data[pay][is_online]}" />


<div class="blank10"></div>
<input type="submit" name="submit" value=" 提交 " class="button" />

</form>

</div>
</div>
</div>
</div>