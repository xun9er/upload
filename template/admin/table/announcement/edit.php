<div class="tags">

 <div id="tagscontent"> 
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
      <input type="hidden" name="onlymodify" value=""/>

<div class="hid_box">
<strong>公告标题：</strong>
<div class="hbox" style="background:none;">
{form::getform('title',$form,$field,$data)}    <font color="red">*</font> <br /><br />
</div>
</div>

<div class="hid_box">
<strong>公告内容：</strong>
<div class="hbox" style="background:none;">
{form::getform('content',$form,$field,$data)} <br /><br />
</div>
</div>
	

    <div class="blank30"></div>
    <input type="submit" name="submit" value="提交" class="button"/>
    </form>
    
    
  </div>
  </div>