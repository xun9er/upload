<div class="tags">

 <div id="tagscontent"> 

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table">
        <tbody>
            
                                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">用户组</td>
                <td>
                        {form::getform('groupid',$form,$field,$data)}                </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">名称</td>
                <td>
                        {form::getform('name',$form,$field,$data)}                </td>
            </tr>

                        
            

            

        </tbody></table>

<div class="blank20"></div>
<input type="submit" name="submit" value="提交" class="button" />

</form>

</div>
</div>