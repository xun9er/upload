<div class="tags">
<div id="tagstitle">
   <a id="one1" onclick="setTab('one',1,6)" class="hover">添加自定义标签</a>
  </div> 
 <div id="tagscontent"> 
 <div id="con_one_1">

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id='';
      echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
    <input type="hidden" name="onlymodify" value=""/>
    <table border="0" cellspacing="2" cellpadding="0" id="table" name="table" width="100%">
        <tbody>


            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td><strong>自定义中文标签名称</strong></td></tr>

              
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td>
                    {form::getform('name',$form,$field,$data)}                </td>
            </tr>




            <tr>
                <td><strong>标签配置</strong></td></tr>


 <tr>
                <td>
                
                {form::getform('tagcontent',$form,$field,$data)} 
              
                
                </td>
            </tr> 


         




        </tbody></table>

    <div class="blank20"></div>
    <input type="submit" name="submit" value="提交" class="button" />
</form>

</div>
</div>
</div>

<style>
table,table tr,table td,#table,#table tr,#table tr td {border:none;}
</style>