<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id='';
      echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
    <input type="hidden" name="onlymodify" value=""/>
    <table border="0" cellspacing="2" cellpadding="0" class="list" name="table">
        <tbody>


            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td><strong>栏目标签名称</strong></td></tr>

              
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td>
                    {form::getform('name',$form,$field,$data)}                </td>
            </tr>




            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td><strong>标签配置</strong></td></tr>


 <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td>
                
                {template 'table/templatetag/listtag_helper_cat.php'}
              
                
                </td>
            </tr> 


         




        </tbody></table>

    <div class="blank20"></div>
    <input type="submit" name="submit" value="提交" class="button" />
</form>

</div>
</div>
</div>