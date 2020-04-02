<div class="tags">

  <div id="tagscontent">

<form method="post" action="" name="form1" id="form1" onsubmit="checkform1()">
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table">
<thead>

<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<th colspan="2" >
安装支付方式
</th>
</tr>
</thead>
<tbody>

<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">支付方式</td>
	<td><input type="text" name="pay_name" id="pay_name" value="{$data[pay]['pay_name']}"  /></td>
</tr>

<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">支付方式描述</td>
	<td>{form::textarea('pay_desc',$data[pay]['pay_desc'],'cols="70" rows="6"')}</td>
</tr>

{loop $data[pay][pay_config] $pay_config}

<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">{$pay_config.label}</td>
	<td>
      <?php if ($pay_config[type] == "text") {?> 
      <input name="cfg_value[]" type="{$pay_config.type}" value="{$pay_config.value}" size="40" />
      <?php }elseif ($pay_config[type] == "textarea") {?> 
      <textarea name="cfg_value[]" cols="80" rows="5">{$pay_config.value}</textarea>
      <?php }elseif ($pay_config[type] == "select") {?>            
      {form::select('cfg_value[]', $pay_config[value], $pay_config[range])}
      <?php } ?>  
     <input name="cfg_name[]" type="hidden" value="{$pay_config.name}" />
      <input name="cfg_type[]" type="hidden" value="{$pay_config.type}" />
      <input name="cfg_lang[]" type="hidden" value="{$pay_config.lang}" />
	</td>
</tr>

{/loop}



<tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
	<td class="left">支付费率</td>
	<td>
	<input size="3" name="pay_fee" id="pay_fee" value="{$data[pay]['pay_fee']}"  />%
	</td>
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