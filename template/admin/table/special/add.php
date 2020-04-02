<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id='';
      echo modify("/act/".front::$act."/table/".$table.$id);?>" enctype="multipart/form-data" onsubmit="return checkform();">
    <input type="hidden" name="onlymodify" value=""/>

    <script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>
    
    
    
<div class="tags">
 <div id="tagstitle">
   <a id="one1" onclick="setTab('one',1,6)" class="hover">基本信息</a>
  </div> 
  <div id="tagscontent">
	<div id="con_one_1">
    <table width="100%" border="0" cellspacing="2" cellpadding="0">
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">标题</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
            {form::getform('title',$form,$field,$data)}</td>
                    </tr>

    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">横幅</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
            {form::getform('banner',$form,$field,$data)}</td>
                    </tr>

         <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
<td width="19%" align="right"><span style="  width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">描述</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%"><div class="blank10"></div>
            {form::getform('description',$form,$field,$data)}</td>
                    </tr>
					</table>
    
    
    </div>
  </div>
</div>


    


    
    <div class="blank10"></div>
    <input type="submit" name="submit" value=" 提交 " class="button" />
    <div class="blank10"></div>

</form>