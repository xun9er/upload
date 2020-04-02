<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">


<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
      <input type="hidden" name="onlymodify" value=""/>
      <table width="100%" border="0" cellspacing="1" cellpadding="4" class="list" name="table" id="table">
        <tbody>
                                     
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">链接类型</td>
                <td>
                        {form::getform('linktype',$form,$field,$data)}       </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">所属类别</td>
                <td>
                        {form::getform('typeid',$form,$field,$data)}               </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">名称</td>
                <td>
                        {form::getform('name',$form,$field,$data)}           </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">排序号</td>
                <td>
                        {form::getform('listorder',$form,$field,$data)}    </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">链接</td>
                <td>
                        {form::getform('url',$form,$field,$data)}      </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">LOGO</td>
                <td>
                        {form::getform('logo',$form,$field,$data)}                </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">简介</td>
                <td>
                        {form::getform('introduce',$form,$field,$data)}                </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">用户名</td>
                <td>
                        {form::getform('username',$form,$field,$data)}                </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">状态</td>
                <td>
                        {form::getform('state',$form,$field,$data)}      <font color="red">*</font>          </td>
            </tr>
            
            <input type="hidden" name="hits" id="hits" value="0"   />

                        
            

            

        </tbody></table>

<div class="blank10"></div>
<div class="blank10"></div>
<input type="submit" name="submit" value=" 提交 " class="button"/>
    </form>
    
    </div>
    </div>
    </div>