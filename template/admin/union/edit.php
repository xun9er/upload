<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">

<div class="hid_box">
<strong>用户名</strong>
<div class="hbox" style="background:none;">
{$data['username']} 
</div>
</div>

<div class="hid_box">
<strong>点数结算利率</strong>
<div class="hbox" style="background:none;">
{form::getform('profitmargin',$form,$field,$data)} %
</div>
</div>


<div class="blank30"></div>
<input type="submit" name="submit" value="提交" class="button"/>

</form>

</div>
</div>
</div>