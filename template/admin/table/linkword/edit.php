<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table">
        <tbody>
            
                                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">链接词</td>
                <td>
                        {form::getform('linkword',$form,$field,$data)}                </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">URL</td>
                <td>
                        {form::getform('linkurl',$form,$field,$data)}                </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">链接权重值</td>
                <td>
                        {form::getform('linkorder',$form,$field,$data)}                </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">链接次数</td>
                <td>
                        {form::getform('linktimes',$form,$field,$data)}                </td>
            </tr>

                        
            

            

        </tbody></table>

<div class="blank20"></div>
<input type="submit" name="submit" value=" 提交 " class="button" />
    </form>
    
    
    </div>
    </div>
    </div>